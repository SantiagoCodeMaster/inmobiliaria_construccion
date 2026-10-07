<?php

namespace Tests\Feature;

use App\Models\Cotizacion;
use App\Services\CotizacionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class LightPropuestaTest extends TestCase
{
    use RefreshDatabase;

    private function datos(array $extra = []): array
    {
        return array_merge([
            'area_privada' => 63,
            'num_banos' => 1,
            'num_habitaciones' => 2,
            'tiene_mueble_alto_cocina' => true,
            'tiene_barra_auxiliar' => true,
        ], $extra);
    }

    private function propuestas(array $extra = []): array
    {
        return app(CotizacionService::class)->calcularPropuestas($this->datos($extra));
    }

    /** [categoria, unidad, cantidad, valor_unitario, vr_total] */
    private function filas(array $propuesta): array
    {
        return array_map(static fn (array $d): array => [
            $d['categoria'],
            $d['unidad'],
            $d['cantidad'],
            $d['valor_unitario'],
            $d['vr_total'],
        ], $propuesta['detalle']);
    }

    public function test_light_es_la_primera_de_cinco_lineas(): void
    {
        $this->assertSame(
            ['light', 'elemental', 'estandar', 'experto', 'maestro'],
            array_keys($this->propuestas())
        );
    }

    public function test_desglose_y_totales_de_referencia_63m2_un_bano(): void
    {
        $light = $this->propuestas()['light'];

        $this->assertSame([
            ['Pisos', 'm2', 63.0, 50000, 3150000],
            ['Muros', 'm2', 189.0, 37050, 7002450],
            ['Muros', 'm2', 30.0, 85023, 2550690],
            ['Aseo', 'm2', 63.0, 12000, 756000],
            ['PISOS APTO (linea economica)', 'm2', 63.0, 100000, 6300000],
            ['TECHOS', 'm2', 63.0, 70000, 4410000],
            ['baño', 'UND', 1.0, 600000, 600000],
        ], $this->filas($light));

        $this->assertSame([], $light['bonus_track']);
        $this->assertSame(24769140, $light['subtotal']);
        $this->assertSame(2972297, $light['administracion_12pct']);
        $this->assertSame(743074, $light['imprevistos_3pct']);
        $this->assertSame(990766, $light['utilidad_4pct']);
        $this->assertSame(188245, $light['iva_sobre_u_19pct']);
        $this->assertSame(29663522, $light['vr_total']);
        $this->assertSame('$470.850/m²', $light['precio_m2_formateado']);
    }

    public function test_light_es_mas_barata_que_elemental(): void
    {
        $propuestas = $this->propuestas();

        $this->assertLessThan($propuestas['elemental']['vr_total'], $propuestas['light']['vr_total']);
    }

    public function test_las_cantidades_en_m2_escalagan_con_el_area(): void
    {
        $light = $this->propuestas(['area_privada' => 32])['light'];

        $this->assertSame([
            ['Pisos', 'm2', 32.0, 50000, 1600000],
            ['Muros', 'm2', 96.0, 37050, 3556800],
            ['Muros', 'm2', 30.0, 85023, 2550690],
            ['Aseo', 'm2', 32.0, 12000, 384000],
            ['PISOS APTO (linea economica)', 'm2', 32.0, 100000, 3200000],
            ['TECHOS', 'm2', 32.0, 70000, 2240000],
            ['baño', 'UND', 1.0, 600000, 600000],
        ], $this->filas($light));

        $this->assertSame(16923872, $light['vr_total']);
    }

    public function test_el_combo_sanitario_escala_con_los_banos(): void
    {
        $light = $this->propuestas(['area_privada' => 38, 'num_banos' => 2])['light'];

        $this->assertSame([
            ['Pisos', 'm2', 38.0, 50000, 1900000],
            ['Muros', 'm2', 114.0, 37050, 4223700],
            ['Muros', 'm2', 30.0, 85023, 2550690],
            ['Aseo', 'm2', 38.0, 12000, 456000],
            ['PISOS APTO (linea economica)', 'm2', 38.0, 100000, 3800000],
            ['TECHOS', 'm2', 38.0, 70000, 2660000],
            ['baño', 'UND', 2.0, 600000, 1200000],
        ], $this->filas($light));

        $this->assertSame(20108171, $light['vr_total']);
    }

    public function test_api_store_devuelve_las_cinco_lineas(): void
    {
        $response = $this->postJson('/api/cotizacion/store', [
            'nombre' => 'Juan',
            'apellido' => 'Pérez',
            'email' => 'juan@example.com',
            'telefono' => '3001234567',
            'area_privada' => 63,
            'num_habitaciones' => 2,
            'num_banos' => 1,
            'tiene_mueble_alto_cocina' => true,
            'tiene_barra_auxiliar' => true,
            'nombre_proyecto' => 'Proyecto Test',
        ]);

        $response->assertCreated();

        $this->assertSame(
            ['light', 'elemental', 'estandar', 'experto', 'maestro'],
            array_keys($response->json('propuestas'))
        );
        $this->assertSame(29663522, $response->json('propuestas.light.vr_total'));
        $this->assertSame([], $response->json('propuestas.light.bonus_track'));
    }

    public function test_api_seleccionar_acepta_la_linea_light(): void
    {
        Http::fake(['graph.facebook.com/*' => Http::response(['messages' => [['id' => 'ok']]])]);
        Http::preventStrayRequests();

        $cotizacion = Cotizacion::create([
            'nombre' => 'Juan',
            'apellido' => 'Pérez',
            'email' => 'juan@example.com',
            'telefono' => '3001234567',
            'tipo_obra' => 'obra gris',
            'area_privada' => 63,
            'num_habitaciones' => 2,
            'num_banos' => 1,
            'tiene_mueble_alto_cocina' => true,
            'tiene_barra_auxiliar' => true,
            'nombre_proyecto' => 'Proyecto Test',
        ]);

        $this->postJson("/api/cotizacion/{$cotizacion->id}/seleccionar", [
            'tipo_propuesta' => 'light',
            'vr_total' => 29663522,
            'precio_m2' => 470850,
        ])->assertOk();

        Http::assertSent(fn ($request) => str_contains($request['text']['body'], 'Propuesta Elegida:* Light'));
    }
}
