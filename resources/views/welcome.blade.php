{{-- resources/views/cotizacion/index.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} | Cotiza tu proyecto</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif

    <style>
        :root {
            --primary: #1a1a1a;
            --primary-light: #2d2d2d;
            --accent: #d4af37;
            --accent-dark: #b8941f;
            --success: #10b981;
            --info: #3b82f6;
            --error: #ef4444;
            --border-color: #e5e5e5;
            --bg-subtle: #f9f9f9;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: linear-gradient(135deg, #ffffff 0%, #f5f5f5 100%);
            color: var(--primary);
            line-height: 1.6;
            letter-spacing: 0.3px;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        /* Header Premium */
        header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-color);
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.04);
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .logo {
            font-family: 'Syne', sans-serif;
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: -1px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo::before {
            content: "⬚";
            font-size: 1.2rem;
            background: linear-gradient(135deg, var(--accent) 0%, #f4d9a3 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-desktop {
            display: none;
            gap: 3rem;
            font-size: 0.9rem;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        .nav-desktop a {
            color: var(--primary);
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-desktop a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--accent);
            transition: width 0.3s ease;
        }

        .nav-desktop a:hover::after {
            width: 100%;
        }

        @media (min-width: 768px) {
            .nav-desktop {
                display: flex;
            }
        }

        .header-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .btn-secondary {
            padding: 0.65rem 1.5rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background: transparent;
            color: var(--primary);
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-secondary:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: rgba(212, 175, 55, 0.05);
        }

        /* Hero Section Premium */
        .hero {
            max-width: 1400px;
            margin: 0 auto;
            padding: 4rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            z-index: -1;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            z-index: -1;
        }

        .hero h1 {
            font-size: clamp(2.5rem, 6vw, 4rem);
            line-height: 1.1;
            margin-bottom: 1.5rem;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .hero-subtitle {
            font-size: 1.1rem;
            color: #666;
            max-width: 600px;
            margin: 0 auto 3rem;
            font-weight: 300;
            line-height: 1.8;
        }

        .accent-text {
            background: linear-gradient(135deg, var(--accent) 0%, #f4d9a3 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Main Form Container */
        .form-container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            border-radius: 16px;
            border: 1px solid var(--border-color);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            padding: 3rem 2rem;
            position: relative;
            overflow: hidden;
        }

        .form-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.15) 0%, transparent 70%);
            border-radius: 50%;
        }

        .form-header h2 {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
        }

        .form-header p {
            font-size: 0.95rem;
            color: rgba(255, 255, 255, 0.8);
            position: relative;
            z-index: 1;
            font-weight: 300;
        }

        .form-content {
            padding: 3rem 2rem;
        }

        /* Secciones del formulario */
        .form-section {
            margin-bottom: 2.5rem;
        }

        .form-section-title {
            font-family: 'Syne', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--accent);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.85rem;
        }

        .form-section-title::before {
            content: '';
            width: 8px;
            height: 8px;
            background: var(--accent);
            border-radius: 50%;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        @media (min-width: 768px) {
            .form-row {
                grid-template-columns: 1fr 1fr;
            }
            .form-row.full {
                grid-template-columns: 1fr;
            }
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-label {
            font-family: 'Syne', sans-serif;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 0.7rem;
            letter-spacing: 0.3px;
            text-transform: capitalize;
        }

        .form-label .required {
            color: #ef4444;
            margin-left: 0.3rem;
        }

        .form-input, .form-select, .form-textarea {
            padding: 0.85rem 1.2rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-family: 'Outfit', sans-serif;
            font-size: 0.95rem;
            background: var(--bg-subtle);
            color: var(--primary);
            transition: all 0.3s ease;
            letter-spacing: 0.3px;
        }

        .form-input:focus, .form-select:focus, .form-textarea:focus {
            outline: none;
            border-color: var(--accent);
            background: white;
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
            font-family: 'Outfit', sans-serif;
        }

        /* Error Message in Form */
        .form-error {
            color: var(--error);
            font-size: 0.8rem;
            margin-top: 0.4rem;
            display: none;
        }

        .form-error.show {
            display: block;
        }

        /* Botones Premium */
        .btn-primary {
            padding: 1rem 2rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-family: 'Syne', sans-serif;
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            letter-spacing: 0.5px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            text-transform: uppercase;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(212, 175, 55, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s ease, height 0.6s ease;
        }

        .btn-primary:hover:not(.loading)::before {
            width: 300px;
            height: 300px;
        }

        .btn-primary:hover:not(.loading) {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-primary.loading {
            opacity: 0.8;
            cursor: not-allowed;
        }

        .btn-primary span {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .spinner {
            width: 18px;
            height: 18px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Resultados Container */
        .results-container {
            max-width: 1200px;
            margin: 3rem auto 0;
            padding: 0 2rem;
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.8s ease;
            pointer-events: none;
        }

        .results-container.visible {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }

        .results-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            padding: 2.5rem;
            border-radius: 16px 16px 0 0;
            position: relative;
            overflow: hidden;
        }

        .results-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.15) 0%, transparent 70%);
        }

        .results-header h2 {
            font-size: 1.6rem;
            margin-bottom: 0.3rem;
            position: relative;
            z-index: 1;
        }

        .results-header p {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.8);
            position: relative;
            z-index: 1;
        }

        .plans-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
            padding: 3rem 2rem;
            background: white;
            border-radius: 0 0 16px 16px;
            border: 1px solid var(--border-color);
            border-top: none;
        }

        @media (min-width: 768px) {
            .plans-grid {
                grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            }
        }

        .plan-card {
            border: 2px solid var(--border-color);
            border-radius: 12px;
            padding: 2rem;
            background: var(--bg-subtle);
            transition: all 0.4s ease;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
        }

        .plan-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--accent) 0%, #f4d9a3 100%);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .plan-card:hover {
            border-color: var(--accent);
            background: white;
            box-shadow: 0 20px 50px rgba(212, 175, 55, 0.1);
            transform: translateY(-8px);
        }

        .plan-card:hover::before {
            transform: scaleX(1);
        }

        .plan-header {
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .plan-name {
            font-family: 'Syne', sans-serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary);
            text-transform: capitalize;
        }

        .plan-badge {
            font-size: 0.7rem;
            font-weight: 700;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .plan-badge.basic {
            background: #e5e5e5;
            color: #666;
        }

        .plan-badge.standard {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }

        .plan-badge.premium {
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.2), rgba(244, 217, 163, 0.2));
            color: var(--accent-dark);
        }

        .plan-price {
            font-size: 2rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .plan-price-period {
            font-size: 0.85rem;
            color: #999;
            margin-bottom: 1.5rem;
        }

        .plan-description {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .plan-features {
            list-style: none;
            margin-bottom: 2rem;
            flex-grow: 1;
        }

        .plan-features li {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            color: #666;
        }

        .plan-features li::before {
            content: '✓';
            color: var(--success);
            font-weight: 700;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .btn-select-plan {
            padding: 0.9rem 1.5rem;
            background: transparent;
            border: 2px solid var(--accent);
            color: var(--accent);
            border-radius: 8px;
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .btn-select-plan:hover {
            background: var(--accent);
            color: white;
            box-shadow: 0 10px 30px rgba(212, 175, 55, 0.2);
        }

        /* Success Message */
        .success-message {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(16, 185, 129, 0.05));
            border-left: 4px solid var(--success);
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .success-message::before {
            content: '✓';
            font-size: 1.5rem;
            color: var(--success);
            font-weight: 700;
        }

        .success-message p {
            margin: 0;
            color: #065f46;
        }

        /* Error Message */
        .error-message {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(239, 68, 68, 0.05));
            border-left: 4px solid #ef4444;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            color: #7f1d1d;
        }

        /* Footer Premium */
        footer {
            background: var(--primary);
            color: white;
            margin-top: 6rem;
            padding: 3rem 2rem;
            border-top: 1px solid var(--border-color);
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            text-align: center;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.7);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero {
                padding: 3rem 1.5rem;
            }

            .form-content {
                padding: 2rem 1.5rem;
            }

            .plans-grid {
                padding: 2rem 1.5rem;
            }

            .plan-card {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>

    <header>
        <div class="header-container">
            <div class="logo">Diseño & Construcción</div>
            <nav class="nav-desktop">
                <a href="#inicio">Inicio</a>
                <a href="#servicios">Servicios</a>
                <a href="#contacto">Contacto</a>
            </nav>
            <div class="header-actions">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-secondary">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn-secondary">Acceso</a>
                @endauth
            </div>
        </div>
    </header>

    <section class="hero" id="inicio">
        <h1>Cotiza tu <span class="accent-text">proyecto arquitectónico</span></h1>
        <p class="hero-subtitle">Obtén propuestas personalizadas en tiempo real. Completa el formulario y descubre tres planes especialmente diseñados para tu obra.</p>
    </section>

    <main>
        <div class="form-container">
            <div class="form-header">
                <h2>Solicita tu cotización</h2>
                <p>Cuéntanos sobre tu proyecto y recibe propuestas profesionales al instante</p>
            </div>

            <form id="cotizacionForm" class="form-content">
                @csrf

                <div class="form-section">
                    <h3 class="form-section-title">Información Personal</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nombre" class="form-label">Nombre<span class="required">*</span></label>
                            <input type="text" id="nombre" name="nombre" class="form-input" placeholder="Tu nombre completo" required>
                            <div class="form-error" data-field="nombre"></div>
                        </div>
                        <div class="form-group">
                            <label for="apellido" class="form-label">Apellido<span class="required">*</span></label>
                            <input type="text" id="apellido" name="apellido" class="form-input" placeholder="Tu apellido" required>
                            <div class="form-error" data-field="apellido"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="email" class="form-label">Correo electrónico<span class="required">*</span></label>
                            <input type="email" id="email" name="email" class="form-input" placeholder="tu@email.com" required>
                            <div class="form-error" data-field="email"></div>
                        </div>
                        <div class="form-group">
                            <label for="telefono" class="form-label">Teléfono<span class="required">*</span></label>
                            <input type="tel" id="telefono" name="telefono" class="form-input" placeholder="+57 300 123 4567" required>
                            <div class="form-error" data-field="telefono"></div>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="form-section-title">Detalles del Proyecto</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nombre_proyecto" class="form-label">Nombre del proyecto</label>
                            <input type="text" id="nombre_proyecto" name="nombre_proyecto" class="form-input" placeholder="Ej: Casa Campestre Los Andes">
                            <div class="form-error" data-field="nombre_proyecto"></div>
                        </div>
                        <div class="form-group">
                            <label for="tipo_obra" class="form-label">Tipo de obra</label>
                            <select id="tipo_obra" name="tipo_obra" class="form-select">
                                <option value="">Selecciona una opción</option>
                                <option value="obra gris">Obra gris</option>
                                <option value="vivienda usada">Vivienda usada</option>
                            </select>
                            <div class="form-error" data-field="tipo_obra"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="area_privada" class="form-label">Área privada (m²)</label>
                            <input type="number" id="area_privada" name="area_privada" class="form-input" placeholder="Ej: 250" step="0.01">
                            <div class="form-error" data-field="area_privada"></div>
                        </div>
                        <div class="form-group">
                            <label for="fecha_entrega" class="form-label">Fecha de entrega deseada</label>
                            <input type="date" id="fecha_entrega" name="fecha_entrega" class="form-input">
                            <div class="form-error" data-field="fecha_entrega"></div>
                        </div>
                    </div>
                </div>

                <div style="display: flex; justify-content: center; padding-top: 1rem;">
                    <button type="submit" class="btn-primary">
                        <span>
                            <span class="button-text">Solicitar Cotización</span>
                        </span>
                    </button>
                </div>
            </form>
        </div>

        <div id="resultados-container" class="results-container">
            <div class="results-header">
                <h2>✨ Planes disponibles para tu proyecto</h2>
                <p>Selecciona el plan que mejor se ajuste a tus necesidades</p>
            </div>
            <div id="planes-list" class="plans-grid">
                </div>
        </div>
    </main>

    <footer>
        <div class="footer-content">
            <p>&copy; {{ date('Y') }} Diseño & Construcción. Todos los derechos reservados. | Soluciones arquitectónicas de nivel profesional</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('cotizacionForm');
            const resultsContainer = document.getElementById('resultados-container');
            const planesList = document.getElementById('planes-list');
            const submitBtn = form.querySelector('button[type="submit"]');

            // Formatear números como moneda COP
            function formatCOP(value) {
                return new Intl.NumberFormat('es-CO', {
                    style: 'currency',
                    currency: 'COP',
                    minimumFractionDigits: 0
                }).format(value);
            }

            // Limpiar errores previos
            function limpiarErrores() {
                const errorDivs = document.querySelectorAll('.form-error');
                errorDivs.forEach(div => {
                    div.textContent = '';
                    div.classList.remove('show');
                });
            }

            // Mostrar errores de validación
            function mostrarErrores(errors) {
                limpiarErrores();
                Object.keys(errors).forEach(field => {
                    const errorDiv = document.querySelector(`[data-field="${field}"]`);
                    if (errorDiv) {
                        errorDiv.textContent = errors[field][0];
                        errorDiv.classList.add('show');
                    }
                });
            }

            // Función para manejar el loading del botón
            function setLoading(isLoading) {
                if (isLoading) {
                    submitBtn.classList.add('loading');
                    submitBtn.disabled = true;
                    const buttonText = submitBtn.querySelector('.button-text');
                    buttonText.innerHTML = '<span class="spinner"></span> Procesando solicitud...';
                } else {
                    submitBtn.classList.remove('loading');
                    submitBtn.disabled = false;
                    const buttonText = submitBtn.querySelector('.button-text');
                    buttonText.innerHTML = 'Solicitar Cotización';
                }
            }

            // Envío del formulario
            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                // Limpiar errores
                limpiarErrores();

                // Ocultar resultados previos
                resultsContainer.classList.remove('visible');

                setLoading(true);

                const formData = new FormData(form);
                const data = Object.fromEntries(formData.entries());

                try {
                    // Nota: Asegúrate de que esta URL sea correcta. Si tu ruta de Laravel es '/cotizacion/store' sin 'api',
                    // puedes cambiarla a '/cotizacion/store'.
                    const response = await fetch('/api/cotizacion/store', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(data)
                    });

                    const result = await response.json();
                    console.log("Respuesta del servidor:", result); // <-- Útil para depurar

                    if (response.ok || response.status === 201) {
                        // Cotización exitosa
                        mostrarPlanes(result.planes_disponibles, result.datos_cliente);
                    } else if (response.status === 206) {
                        // Cotización parcial (guardada pero error en planes)
                        const errorHtml = `<div class="error-message"><strong>⚠️ Atención:</strong> ${result.detalle_error}</div>`;
                        planesList.innerHTML = errorHtml;
                        resultsContainer.classList.add('visible');
                        setLoading(false);
                    } else if (response.status === 422 && result.errors) {
                        // Errores de validación
                        mostrarErrores(result.errors);
                        setLoading(false);
                    } else {
                        // Otros errores
                        const errorHtml = `<div class="error-message"><strong>Error:</strong> ${result.error || 'Ocurrió un error al procesar la cotización'}</div>`;
                        planesList.innerHTML = errorHtml;
                        resultsContainer.classList.add('visible');
                        setLoading(false);
                    }
                } catch (error) {
                    console.error('Error:', error);
                    const errorHtml = `<div class="error-message"><strong>Error de conexión:</strong> Por favor, intenta de nuevo más tarde.</div>`;
                    planesList.innerHTML = errorHtml;
                    resultsContainer.classList.add('visible');
                    setLoading(false);
                }
            });

            // Mostrar planes (Variables ajustadas al JSON real del backend)
            function mostrarPlanes(planes, datosCliente) {
                planesList.innerHTML = '';

                if (!planes || planes.length === 0) {
                    planesList.innerHTML = '<p style="text-align: center; color: #999; padding: 2rem;">No se pudieron generar planes en este momento.</p>';
                } else {
                    planes.forEach((plan, index) => {
                        let badgeClass = 'standard';
                        
                        // Adaptamos la lectura a 'nombre_plan' en lugar de 'nombre'
                        let nombrePlan = plan.nombre_plan || `Plan ${index + 1}`;
                        // Adaptamos la lectura a 'total_a_pagar' en lugar de 'precio'
                        let precioPlan = plan.total_a_pagar || 0;
                        // Adaptamos el 'id_producto' en lugar de 'id'
                        let idPlan = plan.id_producto || index;

                        if (nombrePlan.toLowerCase().includes('premium')) {
                            badgeClass = 'premium';
                        } else if (nombrePlan.toLowerCase().includes('básico') || nombrePlan.toLowerCase().includes('basico')) {
                            badgeClass = 'basic';
                        }

                        const card = document.createElement('div');
                        card.className = 'plan-card';
                        card.innerHTML = `
                            <div class="plan-header">
                                <h3 class="plan-name">${nombrePlan}</h3>
                                <span class="plan-badge ${badgeClass}">
                                    ${index === 1 ? 'Recomendado' : 'Disponible'}
                                </span>
                            </div>
                            <div class="plan-price">${formatCOP(precioPlan)}</div>
                            <p class="plan-price-period">Valor total del proyecto</p>
                            <p class="plan-description">Plan diseñado para ${plan.tipo_obra || 'tu proyecto'}.</p>
                            <ul class="plan-features">
                                <li>Precio base: ${plan.precio_base_formateado || formatCOP(plan.precio_base_sugerido)}</li>
                                <li>Gestión de obra completa</li>
                                <li>Asesoría personalizada</li>
                            </ul>
                            <button type="button" class="btn-select-plan" onclick="seleccionarPlan('${idPlan}', '${nombrePlan}', ${precioPlan}, '${datosCliente.email || ''}')">
                                Elegir este plan
                            </button>
                        `;
                        planesList.appendChild(card);
                    });
                }

                // Mostrar resultados con animación
                resultsContainer.classList.add('visible');
                setLoading(false);
                
                // Scroll suave a los resultados
                setTimeout(() => {
                    resultsContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }, 300);
            }

            // Función global para seleccionar plan
            window.seleccionarPlan = function(planId, planNombre, precio, email) {
                const mensaje = `Has seleccionado el plan "${planNombre}" por un valor de ${formatCOP(precio)}.\n\nEn breve recibirás un correo en ${email} con los siguientes pasos para continuar.`;
                alert(mensaje);
                console.log(`Plan seleccionado: ${planId} - ${planNombre} - ${precio}`);
            };
        });
    </script>
</body>
</html>