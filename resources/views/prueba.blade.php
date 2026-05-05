{{-- resources/views/cotizacion/resultado.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Resultado de cotización - Constructora Escuadr Arq S.A.S.">
    <title>Resultado Cotización | Escuadr Arq</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif

    <style>
        :root {
            --primary: #0a0a0a;
            --primary-light: #1a1a1a;
            --accent: #c9a961;
            --accent-hover: #b89548;
            --accent-light: #e8d5a1;
            --bg-white: #ffffff;
            --bg-subtle: #faf9f6;
            --bg-cream: #f5f2ec;
            --border-color: #e8e6e1;
            --text-muted: #6b6b6b;
            --success: #10b981;
            --shadow-md: 0 10px 30px rgba(0,0,0,0.08);
            --shadow-lg: 0 25px 50px rgba(0,0,0,0.12);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Outfit', sans-serif;
            background: var(--bg-subtle);
            color: var(--primary);
            line-height: 1.6;
        }

        h1, h2, h3, h4 { font-family: 'Syne', sans-serif; font-weight: 800; letter-spacing: -0.03em; }
        .container { max-width: 1280px; margin: 0 auto; padding: 0 1.5rem; }
        .accent-text { color: var(--accent); }

        /* Header */
        header {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0,0,0,0.04);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.5rem;
            max-width: 1400px;
            margin: 0 auto;
        }
        .brand-logo {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            text-decoration: none;
        }
        .brand-img { height: 42px; }
        .brand-text span:first-child {
            font-family: 'Syne';
            font-weight: 800;
            font-size: 1.25rem;
        }
        .brand-text span:last-child {
            font-size: 0.6rem;
            color: var(--accent);
            letter-spacing: 2.5px;
        }
        .btn-back {
            background: var(--primary);
            color: white;
            padding: 0.6rem 1.5rem;
            border-radius: 100px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-back:hover {
            background: var(--accent);
            transform: translateY(-2px);
        }

        /* Resultado Principal */
        .resultado-hero {
            background: linear-gradient(135deg, var(--primary) 0%, #1a1a2e 100%);
            color: white;
            padding: 4rem 0 3rem;
            text-align: center;
        }
        .precio-total {
            font-size: clamp(2.5rem, 6vw, 4rem);
            font-weight: 800;
            color: var(--accent);
            margin: 1rem 0;
        }
        .precio-m2 {
            font-size: 1.25rem;
            color: rgba(255,255,255,0.7);
        }

        /* Layout Principal */
        .main-layout {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 2rem;
            padding: 3rem 0;
        }
        @media (max-width: 768px) {
            .main-layout { grid-template-columns: 1fr; }
        }

        /* Plano de Obra (Componentes Visuales) */
        .plano-obra {
            background: white;
            border-radius: 24px;
            padding: 2rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
        }
        .plano-titulo {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--accent);
            display: inline-block;
        }
        .componente-grid {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        .componente-categoria {
            background: var(--bg-subtle);
            border-radius: 16px;
            padding: 1.25rem;
            transition: transform 0.2s;
        }
        .componente-categoria:hover {
            transform: translateX(5px);
            background: #fff;
            box-shadow: var(--shadow-md);
        }
        .categoria-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid var(--border-color);
        }
        .categoria-icon { font-size: 1.5rem; }
        .categoria-nombre {
            font-family: 'Syne';
            font-weight: 700;
            font-size: 1.1rem;
        }
        .categoria-cantidad {
            margin-left: auto;
            background: var(--accent);
            color: white;
            padding: 0.2rem 0.8rem;
            border-radius: 100px;
            font-size: 0.8rem;
            font-weight: 700;
        }
        .item-lista {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-top: 0.75rem;
        }
        .item-badge {
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 0.5rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            transition: all 0.2s;
        }
        .item-badge:hover {
            border-color: var(--accent);
            transform: translateY(-2px);
        }
        .item-cantidad {
            background: var(--accent);
            color: white;
            border-radius: 20px;
            padding: 0.1rem 0.6rem;
            font-weight: 700;
            font-size: 0.75rem;
        }
        .item-nombre { color: var(--primary); }

        /* Tabla de Detalle */
        .detalle-tabla {
            background: white;
            border-radius: 24px;
            padding: 2rem;
            box-shadow: var(--shadow-md);
            overflow-x: auto;
        }
        .detalle-tabla table {
            width: 100%;
            border-collapse: collapse;
        }
        .detalle-tabla th,
        .detalle-tabla td {
            padding: 1rem 0.75rem;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }
        .detalle-tabla th {
            background: var(--primary);
            color: white;
            font-weight: 600;
            font-size: 0.85rem;
        }
        .detalle-tabla tr:hover {
            background: var(--bg-subtle);
        }
        .text-right { text-align: right; }

        /* Tarjetas AIU */
        .aiu-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin: 2rem 0;
        }
        .aiu-card {
            background: white;
            border-radius: 16px;
            padding: 1rem;
            text-align: center;
            border: 1px solid var(--border-color);
        }
        .aiu-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            color: var(--text-muted);
            letter-spacing: 1px;
        }
        .aiu-value {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--primary);
        }

        /* Botones Acción */
        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin: 3rem 0 2rem;
        }
        .btn-primary, .btn-secondary {
            padding: 1rem 2rem;
            border-radius: 100px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-primary {
            background: var(--accent);
            color: var(--primary);
        }
        .btn-primary:hover {
            background: var(--accent-hover);
            transform: translateY(-3px);
        }
        .btn-secondary {
            background: var(--primary);
            color: white;
        }
        .btn-secondary:hover {
            background: var(--primary-light);
            transform: translateY(-3px);
        }

        footer {
            background: #050505;
            color: white;
            padding: 3rem 2rem 2rem;
            margin-top: 3rem;
            text-align: center;
        }
    </style>
</head>
<body>

<header>
    <div class="nav-container">
        <a href="/" class="brand-logo">
            <img src="{{ asset('construccion.ico') }}" alt="Escuadr Arq" class="brand-img">
            <div class="brand-text">
                <span>Escuadr Arq</span>
                <span>Constructora S.A.S.</span>
            </div>
        </a>
        <a href="/" class="btn-back">← Nueva Cotización</a>
    </div>
</header>

<main>
    <!-- Hero con resultados -->
    <section class="resultado-hero">
        <div class="container">
            <h1>📐 Resultado de tu Cotización</h1>
            <div class="precio-total">{{ $resultado['vr_total_formateado'] ?? '$0' }}</div>
            <div class="precio-m2">{{ $resultado['precio_m2_formateado'] ?? '$0/m²' }}</div>
            <p style="margin-top: 1rem; opacity: 0.8;">
                Basado en {{ $parametros['area_privada'] }} m² • 
                {{ $parametros['num_habitaciones'] }} Habitación(es) • 
                {{ $parametros['num_banos'] }} Baño(s)
            </p>
        </div>
    </section>

    <div class="container main-layout">
        <!-- COLUMNA IZQUIERDA: PLANO DE OBRA (Componentes cuantificados) -->
        <div class="plano-obra">
            <h2 class="plano-titulo">🏗️ Plano de Obra</h2>
            <p style="color: var(--text-muted); margin-bottom: 1.5rem; font-size: 0.9rem;">
                Componentes calculados según tus espacios:
                <strong>{{ $parametros['num_habitaciones'] }} hab • {{ $parametros['num_banos'] }} baños • {{ $parametros['num_habitaciones'] + $parametros['num_banos'] }} puertas</strong>
            </p>
            
            <div class="componente-grid">
                <!-- PUERTAS (cálculo dinámico) -->
                <div class="componente-categoria">
                    <div class="categoria-header">
                        <span class="categoria-icon">🚪</span>
                        <span class="categoria-nombre">Puertas</span>
                        <span class="categoria-cantidad">{{ $parametros['num_habitaciones'] + $parametros['num_banos'] }} Und</span>
                    </div>
                    <div class="item-lista">
                        @php $totalPuertas = $parametros['num_habitaciones'] + $parametros['num_banos']; @endphp
                        @for($i = 1; $i <= $totalPuertas; $i++)
                            <div class="item-badge">
                                <span class="item-cantidad">{{ $i }}</span>
                                <span class="item-nombre">Puerta interior {{ $i }}</span>
                            </div>
                        @endfor
                    </div>
                </div>

                <!-- HABITACIONES (closets por hab) -->
                <div class="componente-categoria">
                    <div class="categoria-header">
                        <span class="categoria-icon">🛏️</span>
                        <span class="categoria-nombre">Habitaciones</span>
                        <span class="categoria-cantidad">{{ $parametros['num_habitaciones'] }} Und</span>
                    </div>
                    <div class="item-lista">
                        @for($i = 1; $i <= $parametros['num_habitaciones']; $i++)
                            <div class="item-badge">
                                <span class="item-cantidad">{{ $i }}</span>
                                <span class="item-nombre">Closet habitación {{ $i }}</span>
                            </div>
                        @endfor
                    </div>
                </div>

                <!-- BAÑOS (sanitarios, lavamanos, duchas, divisiones) -->
                <div class="componente-categoria">
                    <div class="categoria-header">
                        <span class="categoria-icon">🚽</span>
                        <span class="categoria-nombre">Baños</span>
                        <span class="categoria-cantidad">{{ $parametros['num_banos'] }} Und</span>
                    </div>
                    <div class="item-lista">
                        @for($i = 1; $i <= $parametros['num_banos']; $i++)
                            <div class="item-badge">
                                <span class="item-cantidad">{{ $i }}</span>
                                <span class="item-nombre">Sanitario {{ $i }}</span>
                            </div>
                            <div class="item-badge">
                                <span class="item-cantidad">{{ $i }}</span>
                                <span class="item-nombre">Lavamanos {{ $i }}</span>
                            </div>
                            <div class="item-badge">
                                <span class="item-cantidad">{{ $i }}</span>
                                <span class="item-nombre">Ducha {{ $i }}</span>
                            </div>
                            <div class="item-badge">
                                <span class="item-cantidad">{{ $i }}</span>
                                <span class="item-nombre">División baño {{ $i }}</span>
                            </div>
                            <div class="item-badge">
                                <span class="item-cantidad">{{ $i }}</span>
                                <span class="item-nombre">Espejo flotado {{ $i }}</span>
                            </div>
                        @endfor
                    </div>
                </div>

                <!-- COCINA (siempre 1, elementos fijos) -->
                <div class="componente-categoria">
                    <div class="categoria-header">
                        <span class="categoria-icon">🍳</span>
                        <span class="categoria-nombre">Cocina</span>
                        <span class="categoria-cantidad">1 Und</span>
                    </div>
                    <div class="item-lista">
                        <div class="item-badge">Mueble bajo cocina</div>
                        @if($parametros['tiene_mueble_alto_cocina'])
                            <div class="item-badge">Mueble alto cocina</div>
                        @endif
                        @if($parametros['tiene_barra_auxiliar'])
                            <div class="item-badge">Barra auxiliar</div>
                        @endif
                        <div class="item-badge">Campana extractora</div>
                        <div class="item-badge">Mesón granito</div>
                        <div class="item-badge">Lavaplatos</div>
                    </div>
                </div>

                <!-- Áreas por m² (pisos, muros, techos) -->
                <div class="componente-categoria">
                    <div class="categoria-header">
                        <span class="categoria-icon">📐</span>
                        <span class="categoria-nombre">Áreas de construcción</span>
                        <span class="categoria-cantidad">{{ $parametros['area_privada'] }} m²</span>
                    </div>
                    <div class="item-lista">
                        <div class="item-badge">Piso vinilo/laminado</div>
                        <div class="item-badge">Muros (pintura)</div>
                        <div class="item-badge">Cielo falso</div>
                        <div class="item-badge">Instalación eléctrica</div>
                        <div class="item-badge">Hidráulica</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- COLUMNA DERECHA: DETALLE DE COSTOS -->
        <div class="detalle-tabla">
            <h3 style="margin-bottom: 1rem;">💰 Desglose Detallado</h3>
            <table>
                <thead>
                    <tr><th>Concepto</th><th>Cantidad</th><th>Vlr Unitario</th><th class="text-right">Total</th></tr>
                </thead>
                <tbody>
                    @foreach($resultado['detalle'] ?? [] as $item)
                        <tr>
                            <td>
                                <strong>{{ $item['descripcion'] }}</strong><br>
                                <small style="color: var(--text-muted);">{{ $item['categoria'] }}</small>
                            </td>
                            <td>{{ $item['cantidad'] }} {{ $item['unidad'] }}</td>
                            <td>${{ number_format($item['valor_unitario'], 0, ',', '.') }}</td>
                            <td class="text-right">${{ number_format($item['vr_total'], 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Tarjetas AIU -->
            <div class="aiu-cards">
                <div class="aiu-card"><div class="aiu-label">Subtotal</div><div class="aiu-value">${{ number_format($resultado['subtotal'] ?? 0, 0, ',', '.') }}</div></div>
                <div class="aiu-card"><div class="aiu-label">Administración (12%)</div><div class="aiu-value">${{ number_format($resultado['administracion_12pct'] ?? 0, 0, ',', '.') }}</div></div>
                <div class="aiu-card"><div class="aiu-label">Imprevistos (3%)</div><div class="aiu-value">${{ number_format($resultado['imprevistos_3pct'] ?? 0, 0, ',', '.') }}</div></div>
                <div class="aiu-card"><div class="aiu-label">Utilidad (4%)</div><div class="aiu-value">${{ number_format($resultado['utilidad_4pct'] ?? 0, 0, ',', '.') }}</div></div>
                <div class="aiu-card"><div class="aiu-label">IVA Utilidad (19%)</div><div class="aiu-value">${{ number_format($resultado['iva_sobre_u_19pct'] ?? 0, 0, ',', '.') }}</div></div>
            </div>

            <div class="action-buttons">
                <a href="#" class="btn-primary" onclick="window.print(); return false;">🖨️ Imprimir Cotización</a>
                <a href="https://wa.me/573224307053?text={{ urlencode('Hola, me gustaría solicitar más información sobre la cotización de ' . ($resultado['vr_total_formateado'] ?? 'mi proyecto')) }}" class="btn-secondary" target="_blank">📱 Enviar por WhatsApp</a>
            </div>
        </div>
    </div>
</main>

<footer>
    <div class="container">
        <p style="color: var(--accent); font-style: italic;">"Ser la mejor empresa, es asegurarse de tener los mejores clientes"</p>
        <p style="margin-top: 1rem; font-size: 0.8rem;">Constructora Escuadr Arq S.A.S. - Todos los derechos reservados</p>
    </div>
</footer>

<script>
    // Pequeño script para asegurar datos dinámicos
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Cotización generada con parámetros:', {
            habitaciones: {{ $parametros['num_habitaciones'] ?? 0 }},
            banos: {{ $parametros['num_banos'] ?? 0 }},
            puertas: {{ ($parametros['num_habitaciones'] ?? 0) + ($parametros['num_banos'] ?? 0) }},
            area: {{ $parametros['area_privada'] ?? 0 }}
        });
    });
</script>

</body>
</html>