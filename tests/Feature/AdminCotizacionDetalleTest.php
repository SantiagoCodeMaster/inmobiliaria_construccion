<?php

namespace Tests\Feature;

use App\Models\Cotizacion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCotizacionDetalleTest extends TestCase
{
    use RefreshDatabase;

    private function adminUser(): User
    {
        return User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'is_admin' => 1,
        ]);
    }

    private function cotizacion(): Cotizacion
    {
        return Cotizacion::create([
            'nombre' => 'Juan',
            'apellido' => 'Pérez',
            'email' => 'juan@example.com',
            'telefono' => '3001234567',
            'tipo_obra' => 'apartamento',
            'area_privada' => 100,
            'num_habitaciones' => 3,
            'num_banos' => 2,
            'tiene_mueble_alto_cocina' => true,
            'tiene_barra_auxiliar' => true,
            'nombre_proyecto' => 'Proyecto Test',
        ]);
    }

    public function test_detalle_page_renders_plan_cards(): void
    {
        $cotizacion = $this->cotizacion();

        $this->actingAs($this->adminUser())
            ->get("/admin/cotizaciones/{$cotizacion->id}/detalle")
            ->assertOk()
            ->assertSee('Línea elemental')
            ->assertSee('Línea estandar')
            ->assertSee('Línea experto')
            ->assertSee('Ver desglose completo de la obra')
            ->assertSee('Personalizar esta línea')
            ->assertSee('modalDesglose')
            ->assertSee('propuestasAdmin');
    }

    public function test_detalle_page_requires_admin(): void
    {
        $cotizacion = $this->cotizacion();
        $user = User::create([
            'name' => 'Normal',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'is_admin' => 0,
        ]);

        $this->actingAs($user)
            ->get("/admin/cotizaciones/{$cotizacion->id}/detalle")
            ->assertForbidden();
    }
}
