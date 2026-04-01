<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Constructora Escuadr Arq S.A.S. | Cotiza tu proyecto</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('Screenshot_1.ico') }}">

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

        /* Header Premium & Nuevo Branding */
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

        /* Estilos específicos para Constructora Escuadr Arq S.A.S. */
        .brand-container {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
        }

        /* NUEVA CLASE PARA EL LOGO IMAGEN */
        .brand-img {
            height: 40px;
            width: auto;
            display: block;
            object-fit: contain;
        }

        .brand-text-wrapper {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .brand-title {
            font-family: 'Syne', sans-serif;
            font-size: 1.25rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            color: var(--primary);
            line-height: 1.1;
        }

        .brand-subtitle {
            font-family: 'Outfit', sans-serif;
            font-size: 0.65rem;
            font-weight: 700;
            color: var(--accent-dark);
            letter-spacing: 2px;
            text-transform: uppercase;
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

        /* Hero Section */
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

        /* Form Container */
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
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            padding: 3rem 2rem;
            position: relative;
        }

        .form-header h2 { font-size: 1.8rem; margin-bottom: 0.5rem; }
        .form-header p { font-size: 0.95rem; color: rgba(255, 255, 255, 0.8); font-weight: 300; }

        .form-content { padding: 3rem 2rem; }
        .form-section { margin-bottom: 2.5rem; }
        .form-section-title {
            font-family: 'Syne', sans-serif;
            font-size: 0.85rem;
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
        }
        .form-section-title::before {
            content: ''; width: 8px; height: 8px; background: var(--accent); border-radius: 50%;
        }

        .form-row { display: grid; grid-template-columns: 1fr; gap: 1.5rem; margin-bottom: 2rem; }
        @media (min-width: 768px) { .form-row { grid-template-columns: 1fr 1fr; } }

        .form-group { display: flex; flex-direction: column; }
        .form-label {
            font-family: 'Syne', sans-serif; font-size: 0.9rem; font-weight: 600;
            margin-bottom: 0.7rem; color: var(--primary); text-transform: capitalize;
        }
        .form-label .required { color: var(--error); margin-left: 0.3rem; }
        .form-input, .form-select {
            padding: 0.85rem 1.2rem; border: 1px solid var(--border-color); border-radius: 8px;
            font-family: 'Outfit', sans-serif; font-size: 0.95rem; background: var(--bg-subtle);
            transition: all 0.3s ease;
        }
        .form-input:focus, .form-select:focus {
            outline: none; border-color: var(--accent); background: white;
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
        }

        .form-error { color: var(--error); font-size: 0.8rem; margin-top: 0.4rem; display: none; }
        .form-error.show { display: block; }

        /* Buttons */
        .btn-primary {
            padding: 1rem 2rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white; border: none; border-radius: 8px; font-family: 'Syne', sans-serif;
            font-size: 0.95rem; font-weight: 700; cursor: pointer; transition: all 0.4s ease;
            text-transform: uppercase; letter-spacing: 0.5px;
        }
        .btn-primary:hover:not(.loading) { transform: translateY(-2px); box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2); }
        .btn-primary.loading { opacity: 0.8; cursor: not-allowed; }

        /* Resultados y Tarjetas de Planes */
        .results-container {
            max-width: 1200px; margin: 3rem auto 0; padding: 0 2rem;
            opacity: 0; transform: translateY(40px); transition: all 0.8s ease; pointer-events: none;
        }
        .results-container.visible { opacity: 1; transform: translateY(0); pointer-events: auto; }

        .results-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white; padding: 2.5rem; border-radius: 16px 16px 0 0;
        }
        .results-header h2 { font-size: 1.6rem; margin-bottom: 0.3rem; }
        .results-header p { font-size: 0.9rem; color: rgba(255, 255, 255, 0.8); }

        .plans-grid {
            display: grid; grid-template-columns: 1fr; gap: 2rem; padding: 3rem 2rem;
            background: white; border-radius: 0 0 16px 16px; border: 1px solid var(--border-color); border-top: none;
        }
        @media (min-width: 768px) { .plans-grid { grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); } }

        .plan-card {
            border: 2px solid var(--border-color); border-radius: 12px; padding: 2rem;
            background: var(--bg-subtle); transition: all 0.4s ease; display: flex; flex-direction: column;
            position: relative; overflow: hidden;
        }
        .plan-card:hover {
            border-color: var(--accent); background: white;
            box-shadow: 0 20px 50px rgba(212, 175, 55, 0.1); transform: translateY(-8px);
        }

        .plan-header { margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: flex-start; }
        .plan-name { font-family: 'Syne', sans-serif; font-size: 1.3rem; font-weight: 700; color: var(--primary); text-transform: capitalize; }
        
        .plan-badge { font-size: 0.7rem; font-weight: 700; padding: 0.4rem 0.8rem; border-radius: 20px; text-transform: uppercase; }
        .plan-badge.basic { background: #e5e5e5; color: #666; }
        .plan-badge.standard { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
        .plan-badge.premium { background: linear-gradient(135deg, rgba(212, 175, 55, 0.2), rgba(244, 217, 163, 0.2)); color: var(--accent-dark); }

        .plan-price { font-size: 2rem; font-weight: 800; color: var(--primary); margin-bottom: 0.5rem; }
        .plan-price-period { font-size: 0.85rem; color: #999; margin-bottom: 1.5rem; }

        /* NUEVO: Caja para la descripción larga */
        .plan-description-box {
            background: rgba(212, 175, 55, 0.05);
            border-left: 3px solid var(--accent);
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 0 8px 8px 0;
            font-size: 0.85rem;
            color: #444;
            line-height: 1.5;
            white-space: pre-line; /* Respeta los saltos de línea del textarea */
            max-height: 160px; /* Limita la altura */
            overflow-y: auto; /* Agrega scroll si es muy largo */
            flex-grow: 1;
        }
        
        /* Estilizar el scrollbar de la descripción */
        .plan-description-box::-webkit-scrollbar { width: 5px; }
        .plan-description-box::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 4px; }
        .plan-description-box::-webkit-scrollbar-thumb { background: #d4af37; border-radius: 4px; }

        .plan-features { list-style: none; margin-bottom: 2rem; }
        .plan-features li { display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem; font-size: 0.9rem; color: #666; }
        .plan-features li::before { content: '✓'; color: var(--success); font-weight: 700; font-size: 1.1rem; }

        .btn-select-plan {
            padding: 0.9rem 1.5rem; background: transparent; border: 2px solid var(--accent);
            color: var(--accent); border-radius: 8px; font-family: 'Syne', sans-serif;
            font-weight: 700; cursor: pointer; transition: all 0.3s ease;
            text-transform: uppercase; font-size: 0.85rem; margin-top: auto;
        }
        .btn-select-plan:hover { background: var(--accent); color: white; box-shadow: 0 10px 30px rgba(212, 175, 55, 0.2); }

        .error-message {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(239, 68, 68, 0.05));
            border-left: 4px solid #ef4444; border-radius: 8px; padding: 1.5rem; margin-bottom: 2rem; color: #7f1d1d;
        }

        footer { background: var(--primary); color: white; margin-top: 6rem; padding: 3rem 2rem; border-top: 1px solid var(--border-color); }
        .footer-content { max-width: 1400px; margin: 0 auto; text-align: center; font-size: 0.9rem; color: rgba(255, 255, 255, 0.7); }

        @media (max-width: 768px) {
            .hero { padding: 3rem 1.5rem; }
            .form-content, .plans-grid { padding: 2rem 1.5rem; }
            .brand-title { font-size: 1rem; }
        }
    </style>
</head>
<body>

    <header>
        <div class="header-container">
            <a href="/" class="brand-container">
                <img src="{{ asset('construccion.ico') }}" alt="Logo Escuadr Arq" class="brand-img">
                
                <div class="brand-text-wrapper">
                    <span class="brand-title">Constructora Escuadr Arq</span>
                    <span class="brand-subtitle">S.A.S.</span>
                </div>
            </a>
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
        <p class="hero-subtitle">Obtén propuestas personalizadas en tiempo real. Completa el formulario y descubre los planes diseñados especialmente para tu obra por Constructora Escuadr Arq.</p>
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
                        <span><span class="button-text">Solicitar Cotización</span></span>
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
            <p>&copy; {{ date('Y') }} Constructora Escuadr Arq S.A.S. Todos los derechos reservados. | Soluciones arquitectónicas de nivel profesional</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('cotizacionForm');
            const resultsContainer = document.getElementById('resultados-container');
            const planesList = document.getElementById('planes-list');
            const submitBtn = form.querySelector('button[type="submit"]');

            function formatCOP(value) {
                return new Intl.NumberFormat('es-CO', {
                    style: 'currency', currency: 'COP', minimumFractionDigits: 0
                }).format(value);
            }

            function limpiarErrores() {
                const errorDivs = document.querySelectorAll('.form-error');
                errorDivs.forEach(div => { div.textContent = ''; div.classList.remove('show'); });
            }

            function mostrarErrores(errors) {
                limpiarErrores();
                Object.keys(errors).forEach(field => {
                    const errorDiv = document.querySelector(`[data-field="${field}"]`);
                    if (errorDiv) { errorDiv.textContent = errors[field][0]; errorDiv.classList.add('show'); }
                });
            }

            function setLoading(isLoading) {
                if (isLoading) {
                    submitBtn.classList.add('loading'); submitBtn.disabled = true;
                    submitBtn.querySelector('.button-text').innerHTML = 'Procesando...';
                } else {
                    submitBtn.classList.remove('loading'); submitBtn.disabled = false;
                    submitBtn.querySelector('.button-text').innerHTML = 'Solicitar Cotización';
                }
            }

            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                limpiarErrores();
                resultsContainer.classList.remove('visible');
                setLoading(true);

                const formData = new FormData(form);
                const data = Object.fromEntries(formData.entries());

                try {
                    const response = await fetch('/api/cotizacion/store', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(data)
                    });

                    const result = await response.json();

                    if (response.ok || response.status === 201) {
                        mostrarPlanes(result.planes_disponibles, result.datos_cliente);
                    } else if (response.status === 206) {
                        planesList.innerHTML = `<div class="error-message"><strong>⚠️ Atención:</strong> ${result.detalle_error}</div>`;
                        resultsContainer.classList.add('visible');
                        setLoading(false);
                    } else if (response.status === 422 && result.errors) {
                        mostrarErrores(result.errors);
                        setLoading(false);
                    } else {
                        planesList.innerHTML = `<div class="error-message"><strong>Error:</strong> ${result.error || 'Ocurrió un error'}</div>`;
                        resultsContainer.classList.add('visible');
                        setLoading(false);
                    }
                } catch (error) {
                    planesList.innerHTML = `<div class="error-message"><strong>Error de conexión:</strong> Intenta más tarde.</div>`;
                    resultsContainer.classList.add('visible');
                    setLoading(false);
                }
            });

            function mostrarPlanes(planes, datosCliente) {
                planesList.innerHTML = '';

                if (!planes || planes.length === 0) {
                    planesList.innerHTML = '<p style="text-align: center; color: #999; padding: 2rem;">No se pudieron generar planes en este momento.</p>';
                } else {
                    planes.forEach((plan, index) => {
                        let badgeClass = 'standard';
                        let nombrePlan = plan.nombre_plan || `Plan ${index + 1}`;
                        let precioPlan = plan.total_a_pagar || 0;
                        let idPlan = plan.id_producto || index;
                        
                        // Validar si existe la descripción que viene desde la BD, sino ponemos un default
                        let descripcionPlan = plan.descripcion 
                            ? plan.descripcion 
                            : `Plan estándar de gestión y desarrollo diseñado para tu proyecto de ${plan.tipo_obra || 'construcción'}.`;

                        if (nombrePlan.toLowerCase().includes('premium')) { badgeClass = 'premium'; } 
                        else if (nombrePlan.toLowerCase().includes('básico') || nombrePlan.toLowerCase().includes('basico')) { badgeClass = 'basic'; }

                        const card = document.createElement('div');
                        card.className = 'plan-card';
                        
                        // Inyectamos la variable descripcionPlan en el HTML
                        // AQUÍ MODIFIQUÉ EL BOTÓN PARA QUE USE EL ID DE LA COTIZACIÓN Y PASE 'this' (EL BOTÓN EN SÍ)
                        card.innerHTML = `
                            <div class="plan-header">
                                <h3 class="plan-name">${nombrePlan}</h3>
                                <span class="plan-badge ${badgeClass}">
                                    ${index === 1 ? 'Recomendado' : 'Disponible'}
                                </span>
                            </div>
                            <div class="plan-price">${formatCOP(precioPlan)}</div>
                            <p class="plan-price-period">Valor total del proyecto</p>
                            
                            <div class="plan-description-box">${descripcionPlan}</div>
                            
                            <ul class="plan-features">
                                <li>Precio base calc: ${plan.precio_base_formateado || formatCOP(plan.precio_base_sugerido)}</li>
                                <li>Gestión de obra completa</li>
                            </ul>
                            <button type="button" class="btn-select-plan" onclick="seleccionarPlan(${datosCliente.id}, '${nombrePlan}', ${precioPlan}, this)">
                                Elegir este plan
                            </button>
                        `;
                        planesList.appendChild(card);
                    });
                }

                resultsContainer.classList.add('visible');
                setLoading(false);
                setTimeout(() => { resultsContainer.scrollIntoView({ behavior: 'smooth', block: 'start' }); }, 300);
            }

            // AQUÍ MODIFIQUÉ LA FUNCIÓN PARA QUE HAGA LA PETICIÓN POST A TU API
            window.seleccionarPlan = async function(cotizacionId, planNombre, precio, btnElement) {
                // Validación por si acaso no llegó el ID
                if(!cotizacionId) {
                    alert('Error: No se encontró el ID de la cotización.');
                    return;
                }

                // Guardamos el texto original y cambiamos el estado del botón
                const textoOriginal = btnElement.innerText;
                btnElement.innerText = "Procesando...";
                btnElement.disabled = true;

                try {
                    // Hacemos la petición a la nueva ruta en tu controlador
                    const response = await fetch(`/api/cotizacion/${cotizacionId}/seleccionar`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            nombre_plan: planNombre,
                            precio: precio
                        })
                    });

                    const result = await response.json();

                    // Si todo sale bien (status 200)
                    if (response.ok) {
                        alert(`¡Gracias! Hemos registrado tu interés en el plan "${planNombre}". En breve nos comunicaremos para gestionar tu proyecto.`);
                        
                        // Cambiamos el botón para que se vea que ya fue seleccionado
                        btnElement.innerText = "¡Seleccionado!";
                        btnElement.style.backgroundColor = "var(--success)";
                        btnElement.style.borderColor = "var(--success)";
                        btnElement.style.color = "white";
                    } else {
                        // Si el controlador nos devuelve un error
                        alert('Hubo un error al procesar tu selección: ' + (result.error || 'Intenta nuevamente.'));
                        btnElement.innerText = textoOriginal;
                        btnElement.disabled = false;
                    }
                } catch (error) {
                    // Si el servidor se cae o no hay internet
                    alert('Error de conexión. Por favor verifica tu internet e intenta de nuevo.');
                    btnElement.innerText = textoOriginal;
                    btnElement.disabled = false;
                }
            };
        });
    </script>
</body>
</html>