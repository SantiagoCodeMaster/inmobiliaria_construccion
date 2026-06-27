<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización {{ strtoupper($propuesta['tipo']) }} - {{ $cotizacion->nombre_proyecto ?? 'Proyecto' }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 9px;
            color: #1a1a1a;
            background: white;
        }

        /* HEADER EMPRESA */
        .header-empresa {
            background: #1a1a1a;
            color: white;
            padding: 12px 16px;
            margin-bottom: 0;
        }
        .header-empresa-inner {
            display: table;
            width: 100%;
        }
        .header-logo-col {
            display: table-cell;
            width: 70%;
            vertical-align: middle;
        }
        .header-badge-col {
            display: table-cell;
            width: 30%;
            vertical-align: middle;
            text-align: right;
        }
        .empresa-nombre {
            font-size: 16px;
            font-weight: bold;
            color: #c9a961;
            letter-spacing: 1px;
        }
        .empresa-nit {
            font-size: 9px;
            color: #a0a0a0;
            margin-top: 2px;
        }
        .empresa-titulo {
            font-size: 10px;
            color: #e0e0e0;
            margin-top: 4px;
            letter-spacing: 0.5px;
        }
        .logo-badge {
            background: #c9a961;
            color: #1a1a1a;
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 8px;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* TABLA DATOS PROYECTO */
        .datos-proyecto {
            margin-top: 10px;
            margin-bottom: 8px;
        }
        .datos-table {
            width: 100%;
            border-collapse: collapse;
        }
        .datos-table td {
            padding: 4px 8px;
            border: 1px solid #ddd;
            vertical-align: middle;
        }
        .datos-table .lbl {
            background: #2a2a2a;
            color: #c9a961;
            font-weight: bold;
            font-size: 8px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            width: 14%;
        }
        .datos-table .val {
            background: #faf9f6;
            color: #1a1a1a;
            font-size: 9px;
            width: 22%;
        }

        /* BANNER LÍNEA */
        .linea-banner {
            background: linear-gradient(135deg, #c9a961, #8a6f3a);
            color: white;
            text-align: center;
            padding: 8px 16px;
            margin-bottom: 10px;
            border-radius: 4px;
        }
        .linea-banner-label {
            font-size: 8px;
            letter-spacing: 2px;
            text-transform: uppercase;
            opacity: 0.85;
        }
        .linea-banner-name {
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        /* TABLA ACTIVIDADES */
        .actividades-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .actividades-table thead tr {
            background: #1a1a1a;
            color: white;
        }
        .actividades-table thead th {
            padding: 6px 6px;
            text-align: left;
            font-size: 8px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            border: 1px solid #333;
        }
        .actividades-table thead th.right { text-align: right; }
        .actividades-table thead th.center { text-align: center; }

        .actividades-table tbody tr:nth-child(even) { background: #faf9f6; }
        .actividades-table tbody tr:nth-child(odd) { background: #ffffff; }
        .actividades-table tbody tr:hover { background: #f5f2ec; }

        .actividades-table tbody td {
            padding: 4px 6px;
            border: 1px solid #e8e6e1;
            vertical-align: top;
            font-size: 8px;
        }
        .actividades-table tbody td.num { text-align: center; width: 4%; }
        .actividades-table tbody td.cap {
            font-weight: bold;
            color: #c9a961;
            width: 10%;
            font-size: 8px;
        }
        .actividades-table tbody td.act { width: 45%; line-height: 1.4; }
        .actividades-table tbody td.cant { text-align: right; width: 12%; }

        /* FORMA DE PAGO */

        /* FORMA DE PAGO */
        .pago-table {
            width: 100%;
            border-collapse: collapse;
        }
        .pago-table thead tr {
            background: #2a2a2a;
            color: #c9a961;
        }
        .pago-table thead th {
            padding: 5px 8px;
            font-size: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: 1px solid #333;
        }
        .pago-table tbody td {
            padding: 5px 8px;
            border: 1px solid #e0e0e0;
            font-size: 8.5px;
        }
        .pago-table tbody tr:nth-child(even) { background: #faf9f6; }
        .pago-table .pct { text-align: center; font-weight: bold; color: #c9a961; }
        .pago-table .monto { text-align: right; font-weight: bold; }

        /* SPECS Y GARANTÍAS */
        .specs-box {
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            padding: 8px 10px;
            margin-bottom: 8px;
            background: #faf9f6;
        }
        .specs-box h4 {
            font-size: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #c9a961;
            font-weight: bold;
            margin-bottom: 5px;
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 3px;
        }
        .specs-box p, .specs-box li {
            font-size: 8px;
            color: #444;
            line-height: 1.5;
        }
        .specs-box ul {
            margin-left: 12px;
            margin-top: 3px;
        }

        /* VIGENCIA / CONTACTO */
        .footer-info {
            margin-top: 10px;
            border-top: 2px solid #c9a961;
            padding-top: 8px;
        }
        .footer-inner {
            display: table;
            width: 100%;
        }
        .footer-left {
            display: table-cell;
            width: 60%;
            vertical-align: top;
        }
        .footer-right {
            display: table-cell;
            width: 40%;
            vertical-align: top;
            text-align: right;
        }
        .vigencia-badge {
            background: #c9a961;
            color: #1a1a1a;
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 8px;
            font-weight: bold;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }
        .contacto-info {
            font-size: 8px;
            color: #555;
            line-height: 1.6;
        }
        .contacto-info strong {
            color: #1a1a1a;
        }

        .section-title {
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #1a1a1a;
            margin-bottom: 6px;
            margin-top: 12px;
            border-bottom: 2px solid #c9a961;
            padding-bottom: 3px;
        }

        .nota-enchape {
            background: #fff8e8;
            border: 1px solid #c9a961;
            border-radius: 4px;
            padding: 5px 8px;
            font-size: 7.5px;
            color: #5a4a20;
            margin-bottom: 8px;
        }
    </style>
</head>
<body>

    {{-- ENCABEZADO EMPRESA --}}
    <div class="header-empresa">
        <div class="header-empresa-inner">
            <div class="header-logo-col">
                <div class="empresa-nombre">CONSTRUCTORA ESCUADR ARQ SAS</div>
                <div class="empresa-nit">NIT. 901.794.009-0 — Régimen Común</div>
                <div class="empresa-titulo">ACABADOS APARTAMENTO RECIBIDO EN OBRA GRIS</div>
            </div>
            <div class="header-badge-col">
                <div class="logo-badge">
                    ESCUADR ARQ<br>Constructora
                </div>
            </div>
        </div>
    </div>

    {{-- DATOS DEL PROYECTO --}}
    <div class="datos-proyecto">
        <table class="datos-table">
            <tr>
                <td class="lbl">Proyecto</td>
                <td class="val">{{ $cotizacion->nombre_proyecto ?? 'No especificado' }}</td>
                <td class="lbl">Habitaciones</td>
                <td class="val">{{ $numHabitaciones }}</td>
            </tr>
            <tr>
                <td class="lbl">Email</td>
                <td class="val">{{ $cotizacion->email }}</td>
                <td class="lbl">Baños</td>
                <td class="val">{{ $cotizacion->num_banos }}</td>
            </tr>
            <tr>
                <td class="lbl">Teléfono</td>
                <td class="val">{{ $cotizacion->telefono }}</td>
                <td class="lbl">Nombre</td>
                <td class="val">{{ $cotizacion->nombre }}</td>
            </tr>
            <tr>
                <td class="lbl">Área privada</td>
                <td class="val">{{ number_format($cotizacion->area_privada, 2) }} m²</td>
                <td class="lbl">Apellido</td>
                <td class="val">{{ $cotizacion->apellido }}</td>
            </tr>
            <tr>
                <td class="lbl">Inicio obras</td>
                <td class="val">{{ $cotizacion->fecha_entrega ? $cotizacion->fecha_entrega->format('d/m/Y') : 'Por definir' }}</td>
                <td class="lbl">WhatsApp</td>
                <td class="val">{{ $cotizacion->telefono }}</td>
            </tr>
        </table>
    </div>

    {{-- LÍNEA ELEGIDA --}}
    <div class="linea-banner">
        <div class="linea-banner-label">Línea Elegida</div>
        <div class="linea-banner-name">Línea {{ strtoupper($propuesta['tipo']) }}</div>
    </div>

    {{-- NOTA ENCHAPES --}}
    <div class="nota-enchape">
        ⚠️ <strong>Nota:</strong> Los trabajos propuestos son a todo costo excepto el material y sus derivados correspondiente a enchape (cerámica, porcelanato, etc.). El cliente selecciona el material en el momento de la visita técnica.
    </div>

    {{-- TABLA DE ACTIVIDADES --}}
    <div class="section-title">Desglose de Actividades</div>
    <table class="actividades-table">
        <thead>
            <tr>
                <th class="center">No</th>
                <th>Capítulo</th>
                <th>Actividades</th>
                <th class="right">Cantidad</th>
                <th class="right">UND</th>
            </tr>
        </thead>
        <tbody>
            @php $rowNum = 1; @endphp
            @foreach($propuesta['detalle'] as $item)
            <tr>
                <td class="num">{{ $rowNum++ }}</td>
                <td class="cap">{{ $item['categoria'] }}</td>
                <td class="act">{{ $item['descripcion'] }}</td>
                <td class="cant">{{ number_format($item['cantidad'], 2) }}</td>
                <td class="cant">{{ $item['unidad'] ?? '' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- VALOR TOTAL --}}
    @php $total = $propuesta['vr_total']; @endphp
    <div style="margin-bottom:10px; padding:10px 14px; background:#1a1a1a; border-radius:6px; display:table; width:100%;">
        <div style="display:table-cell; vertical-align:middle; color:#e0e0e0; font-size:9px; text-transform:uppercase; letter-spacing:1px;">Valor Total de la Cotización</div>
        <div style="display:table-cell; vertical-align:middle; text-align:right; font-size:16px; font-weight:bold; color:#c9a961;">
            $ {{ number_format($total, 0, ',', '.') }}
        </div>
    </div>

    {{-- FORMA DE PAGO --}}
    <div class="section-title">Forma de Pago</div>
    @php
        $pagos = [
            ['cuota' => '45% de anticipo para inicio de labores', 'pct' => 45, 'detalle' => 'M.O + materiales obra gris + super board + parcial madera'],
            ['cuota' => '30%  semana No. 3', 'pct' => 30, 'detalle' => 'M.O + materiales madera'],
            ['cuota' => '25%  semana No. 7', 'pct' => 25, 'detalle' => 'M.O + materiales electrodomésticos + vidrio'],
            ['cuota' => '5%  contra entrega', 'pct' => 5, 'detalle' => 'Mano de obra final'],
        ];
    @endphp
    <table class="pago-table">
        <thead>
            <tr>
                <th>Cuota</th>
                <th>%</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pagos as $pago)
            <tr>
                <td>{{ $pago['cuota'] }}</td>
                <td class="pct">{{ $pago['pct'] }}%</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- ESPECIFICACIONES Y GARANTÍAS --}}
    <div class="specs-box">
        <h4>Especificaciones Técnicas</h4>
        <ul>
            <li>Los trabajos propuestos son a todo costo excepto el material y sus derivados correspondiente a enchape.</li>
            <li>Los materiales sobrantes se solicitan a la administración el respectivo retiro. Se enlonará y se dejarán en punto de acopio.</li>
        </ul>
    </div>

    <div class="specs-box">
        <h4>Garantías — 6 Meses Por</h4>
        <ul>
            <li>Funcionamiento de carpintería en madera.</li>
            <li>Electrodomésticos: se entregan fichas técnicas y de garantía — contacto directo con proveedor.</li>
            <li>No cubre fisuramientos por efecto de asentamientos del edificio.</li>
            <li>Se entregarán los acabados con sus respectivas pruebas para garantizar su funcionamiento.</li>
        </ul>
    </div>

    <div class="specs-box">
        <h4>Tiempo de Entrega</h4>
        <p><strong>75 días calendario — 10 semanas</strong></p>
    </div>

    {{-- PIE DE PÁGINA --}}
    <div class="footer-info">
        <div class="footer-inner">
            <div class="footer-left">
                <div class="vigencia-badge">Vigencia de cotización: 10 días a partir de la fecha</div>
                <div class="contacto-info">
                    <strong>CONTACTO:</strong> Ing. JHON DOMINGUEZ CESPEDES — Representante legal<br>
                    <strong>Teléfono:</strong> 316 703 44 47<br>
                    <strong>Correo:</strong> proyectos.escuadrarq@gmail.com
                </div>
            </div>
            <div class="footer-right">
                <div class="contacto-info" style="font-size: 7px; color: #888; margin-top: 20px;">
                    Cotización generada el {{ now()->format('d/m/Y') }}<br>
                    Constructora Escuadr Arq S.A.S.<br>
                    NIT. 901.794.009-0<br>
                    Bogotá, Colombia
                </div>
            </div>
        </div>
    </div>

</body>
</html>
