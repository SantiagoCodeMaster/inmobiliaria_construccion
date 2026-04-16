<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Constructora Escuadr Arq S.A.S. | Innovación en Acabados</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('Screenshot_1.ico') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif

    <style>
        :root {
            --primary: #111111;
            --primary-light: #2a2a2a;
            --accent: #d4af37;
            --accent-light: #f4d9a3;
            --bg-white: #ffffff;
            --bg-subtle: #f7f7f5;
            --border-color: #e5e5e5;
            --success: #10b981;
            --error: #ef4444;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { scroll-behavior: smooth; overflow-x: hidden; }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--bg-white);
            color: var(--primary);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4 { font-family: 'Syne', sans-serif; font-weight: 800; letter-spacing: -0.03em; }

        .container { max-width: 1280px; margin: 0 auto; padding: 0 1.5rem; }
        .accent-text { background: linear-gradient(135deg, var(--accent) 0%, #b8941f 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        
        /* Estilos para imágenes de galería */
        .gallery-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.5s ease;
        }
        
        .bento-item {
            position: relative;
            overflow: hidden;
            border-radius: 24px;
            cursor: pointer;
        }
        
        .bento-item:hover .gallery-img {
            transform: scale(1.05);
        }
        
        .bento-item::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.3), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 24px;
            pointer-events: none;
        }
        
        .bento-item:hover::after {
            opacity: 1;
        }

        header {
            position: fixed; top: 0; width: 100%; z-index: 1000;
            background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        .nav-container { display: flex; justify-content: space-between; align-items: center; padding: 1.2rem 1.5rem; max-width: 1400px; margin: 0 auto; }
        .brand-logo { display: flex; align-items: center; gap: 0.8rem; text-decoration: none; }
        .brand-img { height: 38px; }
        .brand-text { display: flex; flex-direction: column; }
        .brand-text span:first-child { font-family: 'Syne'; font-weight: 800; color: var(--primary); font-size: 1.2rem; line-height: 1; }
        .brand-text span:last-child { font-size: 0.6rem; color: var(--accent); font-weight: 700; letter-spacing: 2px; }
        
        .nav-links { display: none; gap: 2.5rem; align-items: center; }
        @media(min-width: 768px) { .nav-links { display: flex; } }
        .nav-links a { color: var(--primary); text-decoration: none; font-weight: 500; font-size: 0.95rem; transition: color 0.3s; }
        .nav-links a:hover { color: var(--accent); }
        .btn-nav-cta {
            background: var(--primary); color: white !important; padding: 0.6rem 1.5rem; border-radius: 100px;
            font-family: 'Syne'; font-weight: 700; transition: transform 0.3s, box-shadow 0.3s;
        }
        .btn-nav-cta:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); background: var(--accent); }

        .hero { padding: 8rem 0 4rem; min-height: 90vh; display: flex; align-items: center; }
        .hero-grid { display: grid; grid-template-columns: 1fr; gap: 4rem; align-items: center; }
        @media(min-width: 1024px) { .hero-grid { grid-template-columns: 1.1fr 0.9fr; gap: 6rem; } }
        
        .hero-content h1 { font-size: clamp(3rem, 6vw, 4.5rem); line-height: 1.05; margin-bottom: 1.5rem; }
        .hero-content p { font-size: 1.2rem; color: #555; margin-bottom: 2.5rem; max-width: 500px; }
        
        .hero-cta-group { display: flex; gap: 1rem; align-items: center; flex-wrap: wrap; }
        .btn-hero {
            padding: 1.2rem 2.5rem; border-radius: 100px; font-family: 'Syne'; font-weight: 700; font-size: 1.1rem;
            cursor: pointer; transition: all 0.3s ease; text-decoration: none; display: inline-block;
        }
        .btn-hero-primary { background: var(--primary); color: white; border: 2px solid var(--primary); }
        .btn-hero-primary:hover { background: var(--accent); border-color: var(--accent); transform: translateY(-3px); box-shadow: 0 15px 30px rgba(212, 175, 55, 0.2); }
        .btn-hero-secondary { background: transparent; color: var(--primary); border: 2px solid var(--border-color); }
        .btn-hero-secondary:hover { border-color: var(--primary); }

        .hero-visual { position: relative; height: 600px; width: 100%; border-radius: 30px; overflow: hidden; }
        .hero-visual img { width: 100%; height: 100%; object-fit: cover; }
        
        .floating-badge {
            position: absolute; bottom: 40px; left: -30px; background: white; padding: 1.5rem;
            border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.08); display: flex; align-items: center; gap: 1rem;
            animation: float 6s ease-in-out infinite; z-index: 10;
        }
        @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-15px); } }
        .badge-icon { width: 50px; height: 50px; background: var(--bg-subtle); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--accent); font-size: 1.5rem; }
        .badge-text h4 { font-size: 1rem; margin: 0; }
        .badge-text p { font-size: 0.8rem; color: #666; margin: 0; font-family: 'Outfit'; }

        .features { padding: 6rem 0; background: var(--bg-subtle); }
        .section-header { text-align: center; margin-bottom: 4rem; max-width: 700px; margin-inline: auto; }
        .section-header h2 { font-size: clamp(2rem, 4vw, 3rem); margin-bottom: 1rem; }
        .section-header p { color: #666; font-size: 1.1rem; }

        .features-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; }
        .feature-card { background: white; padding: 3rem 2rem; border-radius: 24px; transition: transform 0.3s; border: 1px solid rgba(0,0,0,0.03); }
        .feature-card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0,0,0,0.04); }
        .feature-icon { font-size: 2.5rem; margin-bottom: 1.5rem; }
        .feature-card h3 { font-size: 1.4rem; margin-bottom: 1rem; }
        .feature-card p { color: #666; font-size: 0.95rem; }

        .gallery { padding: 6rem 0; }
        .bento-grid { 
            display: grid; 
            grid-template-columns: repeat(4, 1fr); 
            grid-auto-rows: 280px; 
            gap: 1.5rem; 
        }
        .bento-item { 
            border-radius: 24px; 
            overflow: hidden;
            position: relative;
        }
        .bento-item:nth-child(1) { 
            grid-column: span 2; 
            grid-row: span 2; 
        }
        .bento-item:nth-child(2) { 
            grid-column: span 2; 
        }
        .bento-item:nth-child(3), 
        .bento-item:nth-child(4) { 
            grid-column: span 1; 
        }
        
        @media(max-width: 768px) { 
            .bento-grid { 
                display: flex; 
                flex-direction: column; 
            } 
            .bento-item { 
                height: 280px; 
                min-height: 280px;
            }
        }

        .cotizador-section { padding: 6rem 0; background: var(--primary); color: white; border-radius: 40px 40px 0 0; position: relative; }
        .cotizador-section .section-header p { color: #a0a0a0; }
        .wizard-wrapper { max-width: 700px; margin: 0 auto; }
        
        .wizard-form { background: white; border-radius: 24px; padding: 1rem; box-shadow: 0 30px 60px rgba(0,0,0,0.2); color: var(--primary); }
        
        .progress-container { width: calc(100% - 4rem); margin: 2rem auto; height: 4px; background: #f0f0f0; border-radius: 10px; overflow: hidden; }
        .progress-bar { height: 100%; background: var(--accent); width: 33.33%; transition: width 0.4s ease; }

        .step-content { display: none; padding: 1.5rem 2rem 3rem; animation: fadeIn 0.4s ease-out; }
        .step-content.active { display: block; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

        .step-title { font-size: 1.6rem; margin-bottom: 0.5rem; }
        .step-subtitle { color: #666; margin-bottom: 2rem; font-size: 0.95rem; }

        .form-group { margin-bottom: 1.5rem; }
        .form-label { display: block; font-size: 0.9rem; font-weight: 700; margin-bottom: 0.5rem; color: var(--primary); }
        .form-input {
            width: 100%; padding: 1.2rem; border: 2px solid var(--border-color); border-radius: 12px;
            font-family: 'Outfit'; font-size: 1rem; transition: all 0.3s; background: var(--bg-subtle);
        }
        .form-input:focus { outline: none; border-color: var(--accent); background: white; }
        
        .grid-2 { display: grid; grid-template-columns: 1fr; gap: 1rem; }
        @media(min-width: 600px) { .grid-2 { grid-template-columns: 1fr 1fr; gap: 1.5rem; } }

        .stepper-group { display: flex; align-items: center; gap: 1rem; background: var(--bg-subtle); padding: 0.5rem; border-radius: 12px; border: 2px solid var(--border-color); width: fit-content; }
        .btn-stepper { width: 45px; height: 45px; border-radius: 8px; border: none; background: white; font-size: 1.2rem; font-weight: bold; cursor: pointer; transition: all 0.2s; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .btn-stepper:hover { background: var(--accent); color: white; }
        .stepper-value { font-size: 1.2rem; font-weight: 700; width: 40px; text-align: center; border: none; background: transparent; pointer-events: none; color: var(--primary);}

        .wizard-footer { padding: 1.5rem 2rem; border-top: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center; }
        .btn { padding: 1rem 2rem; border-radius: 12px; font-family: 'Syne'; font-weight: 700; font-size: 1rem; cursor: pointer; transition: all 0.3s; border: none; }
        .btn-back { background: transparent; color: #666; border: 2px solid var(--border-color); }
        .btn-back:hover { background: var(--border-color); color: var(--primary); }
        .btn-next, .btn-submit { background: var(--primary); color: white; width: 100%; }
        @media(min-width: 600px) { .btn-next, .btn-submit { width: auto; } }
        .btn-next:hover, .btn-submit:hover { background: var(--accent); transform: translateY(-2px); }
        .btn-submit.loading { opacity: 0.7; cursor: wait; }

        .form-error { color: var(--error); font-size: 0.8rem; margin-top: 0.5rem; display: none; }
        .form-error.show { display: block; }
        .input-error { border-color: var(--error) !important; }

        .results-container { max-width: 1200px; margin: 4rem auto; padding: 0 1.5rem; display: none; }
        .results-container.visible { display: block; animation: slideUp 0.8s ease forwards; }
        @keyframes slideUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
        
        .plans-grid { display: grid; grid-template-columns: 1fr; gap: 2rem; margin-top: 3rem; }
        @media (min-width: 1024px) { .plans-grid { grid-template-columns: repeat(3, 1fr); } }

        .plan-card {
            background: white; border-radius: 24px; padding: 2.5rem; border: 1px solid var(--border-color);
            display: flex; flex-direction: column; color: var(--primary); transition: all 0.3s;
        }
        .plan-card:hover { transform: translateY(-5px); }
        .plan-card.experto { border: 3px solid var(--accent); position: relative; box-shadow: 0 20px 40px rgba(0,0,0,0.3); transform: scale(1.02); }
        .plan-card.experto::before {
            content: 'El Más Elegido'; position: absolute; top: -15px; left: 50%; transform: translateX(-50%);
            background: var(--accent); color: white; font-size: 0.8rem; font-weight: 700; padding: 6px 20px; border-radius: 100px; text-transform: uppercase;
        }

        .plan-name { font-size: 1.5rem; margin-bottom: 0.5rem; }
        .plan-price { font-size: 2.5rem; margin-top: 0.5rem; letter-spacing: -1px; line-height: 1;}
        .plan-price-m2 { font-size: 0.9rem; color: #888; font-family: 'Outfit'; margin-top: 0.5rem; margin-bottom: 2rem; padding-bottom: 1.5rem; border-bottom: 1px solid var(--border-color); }

        .plan-features { list-style: none; margin-bottom: 2rem; flex-grow: 1; }
        .plan-features li { display: flex; align-items: flex-start; gap: 0.75rem; margin-bottom: 1rem; font-size: 0.95rem; color: #444; }
        .plan-features li i { color: var(--accent); font-style: normal; font-weight: bold; }

        details.plan-accordion { background: var(--bg-subtle); border-radius: 16px; padding: 1.2rem; margin-bottom: 2rem; }
        details.plan-accordion summary { font-size: 0.95rem; font-weight: 700; cursor: pointer; list-style: none; display: flex; justify-content: space-between; align-items: center; }
        details.plan-accordion summary::-webkit-details-marker { display: none; }
        details.plan-accordion summary::after { content: '+'; font-size: 1.4rem; color: var(--accent); }
        details.plan-accordion[open] summary::after { content: '-'; }
        .details-list { margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #e0e0e0; max-height: 250px; overflow-y: auto; }
        .details-list::-webkit-scrollbar { width: 4px; }
        .details-list::-webkit-scrollbar-thumb { background: var(--accent); border-radius: 4px; }
        .detail-item { display: flex; align-items: flex-start; gap: 0.5rem; margin-bottom: 0.8rem; font-size: 0.85rem; }
        .detail-item i { color: var(--success); font-weight: bold; font-style: normal;}

        .btn-select-plan { padding: 1.2rem; background: var(--primary-light); color: white; border: none; border-radius: 12px; font-family: 'Syne'; font-weight: 700; width: 100%; cursor: pointer; transition: 0.3s; }
        .btn-select-plan:hover { background: var(--primary); }
        .plan-card.experto .btn-select-plan { background: var(--accent); }
        .plan-card.experto .btn-select-plan:hover { background: var(--primary); }

        footer { background: #0a0a0a; color: white; padding: 4rem 2rem; text-align: center; font-size: 0.9rem; }
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
            <nav class="nav-links">
                <a href="#ventajas">¿Por qué nosotros?</a>
                <a href="#galeria">Proyectos</a>
                <a href="#cotizador" class="btn-nav-cta">Cotizar Obra Gris</a>
            </nav>
        </div>
    </header>

    <section class="hero container">
        <div class="hero-grid">
            <div class="hero-content">
                <h1>Tu apartamento en <span class="accent-text">Obra Gris</span>, listo para habitar.</h1>
                <p>Olvídate del estrés de las remodelaciones tradicionales. Diseñamos, costeamos y construimos los acabados de tu nuevo hogar con transparencia total desde el primer clic.</p>
                
                <div class="hero-cta-group">
                    <a href="#cotizador" class="btn-hero btn-hero-primary">Calcular mi presupuesto</a>
                    <a href="#galeria" class="btn-hero btn-hero-secondary">Ver proyectos</a>
                </div>
            </div>
            
            <div class="hero-visual">
                <img src="{{ asset('casa1.ico') }}" alt="Proyecto destacado Escuadr Arq">
            </div>
        </div>
    </section>

    <section id="ventajas" class="features">
        <div class="container">
            <div class="section-header">
                <h2>El futuro de las remodelaciones</h2>
                <p>Revolucionamos la forma en que cotizas y construyes los acabados de tu propiedad en Bogotá y alrededores.</p>
            </div>
            
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">⏱️</div>
                    <h3>Cotización Instantánea</h3>
                    <p>No esperes días por un presupuesto. Nuestro algoritmo calcula el valor de tu obra basado en el área y volumetría en tiempo real.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📐</div>
                    <h3>Diseño a la medida</h3>
                    <p>Tres líneas de acabados diseñadas por arquitectos expertos, desde lo más esencial hasta detalles de alta gama en Quarztone y maderas.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🛡️</div>
                    <h3>Cero imprevistos</h3>
                    <p>Nuestras propuestas incluyen Administración, Imprevistos y Utilidades (A.I.U). Lo que ves es lo que inviertes, sin sorpresas en el camino.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="galeria" class="gallery container">
        <div class="section-header">
            <h2>Nuestros Acabados</h2>
            <p>Espacios reales transformados por Escuadr Arq.</p>
        </div>

        <div class="bento-grid">
            <!-- Imagen Principal - Cocina/Barra -->
            <div class="bento-item">
                <img src="{{ asset('casa5.ico') }}" alt="Cocina de lujo Escuadr Arq" class="gallery-img">
            </div>
            <!-- Imagen Sala de estar -->
            <div class="bento-item">
                <img src="{{ asset('casa2.ico') }}" alt="Sala de estar moderna" class="gallery-img">
            </div>
            <!-- Imagen Baño de lujo -->
            <div class="bento-item">
                <img src="{{ asset('casa4.ico') }}" alt="Baño de lujo con acabados premium" class="gallery-img">
            </div>
            <!-- Imagen Habitación -->
            <div class="bento-item">
                <img src="{{ asset('casa3.ico') }}" alt="Habitación con diseño contemporáneo" class="gallery-img">
            </div>
        </div>
    </section>

    <section id="cotizador" class="cotizador-section">
        <div class="container">
            <div class="section-header">
                <h2 style="color: white;">Descubre el valor de tu obra</h2>
                <p>Completa estos 3 simples pasos y obtén 3 opciones de diseño instantáneas.</p>
            </div>

            <div id="wizard-box" class="wizard-wrapper">
                <div class="wizard-form">
                    <div class="progress-container"><div class="progress-bar" id="progressBar"></div></div>

                    <form id="cotizacionForm">
                        @csrf
                        <div class="step-content active" data-step="1">
                            <h3 class="step-title">Sobre el proyecto</h3>
                            <p class="step-subtitle">Datos básicos de la propiedad en obra gris.</p>

                            <div class="form-group">
                                <label class="form-label">Nombre del proyecto/conjunto</label>
                                <input type="text" name="nombre_proyecto" class="form-input" placeholder="Ej: Torres del Parque">
                            </div>
                            
                            <div class="grid-2">
                                <div class="form-group">
                                    <label class="form-label">Área Privada (m²) <span style="color:var(--accent)">*</span></label>
                                    <input type="number" name="area_privada" class="form-input" placeholder="Ej: 55.5" step="0.01" required>
                                    <div class="form-error" data-field="area_privada"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Fecha de entrega</label>
                                    <input type="date" name="fecha_entrega" class="form-input">
                                </div>
                            </div>
                        </div>

                        <div class="step-content" data-step="2">
                            <h3 class="step-title">Distribución</h3>
                            <p class="step-subtitle">¿Cómo está dividido el apartamento?</p>

                            <div class="grid-2">
                                <div class="form-group">
                                    <label class="form-label">Habitaciones <span style="color:var(--accent)">*</span></label>
                                    <div class="stepper-group">
                                        <button type="button" class="btn-stepper" onclick="updateStepper('num_habitaciones', -1)">-</button>
                                        <input type="text" name="num_habitaciones" id="num_habitaciones" class="stepper-value" value="1" readonly required>
                                        <button type="button" class="btn-stepper" onclick="updateStepper('num_habitaciones', 1)">+</button>
                                    </div>
                                    <div class="form-error" data-field="num_habitaciones"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Baños <span style="color:var(--accent)">*</span></label>
                                    <div class="stepper-group">
                                        <button type="button" class="btn-stepper" onclick="updateStepper('num_banos', -1)">-</button>
                                        <input type="text" name="num_banos" id="num_banos" class="stepper-value" value="1" readonly required>
                                        <button type="button" class="btn-stepper" onclick="updateStepper('num_banos', 1)">+</button>
                                    </div>
                                    <div class="form-error" data-field="num_banos"></div>
                                </div>
                            </div>
                        </div>

                        <div class="step-content" data-step="3">
                            <h3 class="step-title">Tus resultados están listos</h3>
                            <p class="step-subtitle">Déjanos tus datos para mostrarte los presupuestos.</p>

                            <div class="grid-2">
                                <div class="form-group">
                                    <label class="form-label">Nombre <span style="color:var(--accent)">*</span></label>
                                    <input type="text" name="nombre" class="form-input" required>
                                    <div class="form-error" data-field="nombre"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Apellido <span style="color:var(--accent)">*</span></label>
                                    <input type="text" name="apellido" class="form-input" required>
                                    <div class="form-error" data-field="apellido"></div>
                                </div>
                            </div>

                            <div class="grid-2">
                                <div class="form-group">
                                    <label class="form-label">WhatsApp <span style="color:var(--accent)">*</span></label>
                                    <input type="tel" name="telefono" class="form-input" placeholder="Ej: 300 123 4567" required>
                                    <div class="form-error" data-field="telefono"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Correo electrónico <span style="color:var(--accent)">*</span></label>
                                    <input type="email" name="email" class="form-input" placeholder="tu@email.com" required>
                                    <div class="form-error" data-field="email"></div>
                                </div>
                            </div>
                        </div>

                        <div class="wizard-footer">
                            <button type="button" class="btn btn-back" id="btnPrev" style="display: none;">Atrás</button>
                            <div style="flex-grow: 1;"></div>
                            <button type="button" class="btn btn-next" id="btnNext">Continuar</button>
                            <button type="submit" class="btn btn-submit" id="btnSubmit" style="display: none;">Calcular Presupuestos</button>
                        </div>
                    </form>
                </div>
            </div>

            <div id="resultados-container" class="results-container">
                <div class="section-header" style="margin-bottom: 2rem;">
                    <h2 style="color: white; font-size: 2.5rem;">Tus Opciones de Diseño</h2>
                    <p>Basado en las dimensiones de tu inmueble, estas son las propuestas:</p>
                </div>
                
                <div id="planes-list" class="plans-grid"></div>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; {{ date('Y') }} Constructora Escuadr Arq S.A.S. - Todos los derechos reservados.</p>
        <p style="color: #666; font-size: 0.8rem; margin-top: 0.5rem;">Desarrollado para transformar espacios en Bogotá y alrededores.</p>
    </footer>

    <script>
        function updateStepper(fieldId, change) {
            const input = document.getElementById(fieldId);
            let value = parseInt(input.value) || 1;
            value += change;
            if (value < 1) value = 1;
            input.value = value;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('cotizacionForm');
            const steps = Array.from(document.querySelectorAll('.step-content'));
            const btnNext = document.getElementById('btnNext');
            const btnPrev = document.getElementById('btnPrev');
            const btnSubmit = document.getElementById('btnSubmit');
            const progressBar = document.getElementById('progressBar');
            
            const wizardBox = document.getElementById('wizard-box');
            const resultsContainer = document.getElementById('resultados-container');
            const planesList = document.getElementById('planes-list');

            let currentStep = 0;

            function updateWizard() {
                steps.forEach((step, index) => step.classList.toggle('active', index === currentStep));
                btnPrev.style.display = currentStep > 0 ? 'block' : 'none';
                
                if (currentStep === steps.length - 1) {
                    btnNext.style.display = 'none';
                    btnSubmit.style.display = 'block';
                } else {
                    btnNext.style.display = 'block';
                    btnSubmit.style.display = 'none';
                }
                const progress = ((currentStep + 1) / steps.length) * 100;
                progressBar.style.width = `${progress}%`;
            }

            function validateCurrentStep() {
                const activeStep = steps[currentStep];
                const inputs = activeStep.querySelectorAll('input[required]');
                let isValid = true;

                inputs.forEach(input => {
                    if (!input.value.trim()) {
                        input.classList.add('input-error');
                        isValid = false;
                    } else {
                        input.classList.remove('input-error');
                    }
                });

                if (!isValid) {
                    activeStep.style.transform = 'translateX(5px)';
                    setTimeout(() => activeStep.style.transform = 'translateX(-5px)', 100);
                    setTimeout(() => activeStep.style.transform = 'translateX(0)', 200);
                }
                return isValid;
            }

            btnNext.addEventListener('click', () => { if (validateCurrentStep()) { currentStep++; updateWizard(); } });
            btnPrev.addEventListener('click', () => { currentStep--; updateWizard(); });

            function limpiarErrores() {
                document.querySelectorAll('.form-error').forEach(d => { d.textContent = ''; d.classList.remove('show'); });
                document.querySelectorAll('.input-error').forEach(input => input.classList.remove('input-error'));
            }

            function mostrarErrores(errors) {
                Object.keys(errors).forEach(field => {
                    const div = document.querySelector(`[data-field="${field}"]`);
                    const input = document.querySelector(`[name="${field}"]`);
                    if (div) { div.textContent = errors[field][0]; div.classList.add('show'); }
                    if (input) { input.classList.add('input-error'); }
                });
            }

            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                if (!validateCurrentStep()) return;
                limpiarErrores();
                
                btnSubmit.classList.add('loading'); 
                btnSubmit.innerText = 'Calculando...';
                btnSubmit.disabled = true;

                const formData = new FormData(form);
                const data = Object.fromEntries(formData.entries());
                
                data.tiene_mueble_alto_cocina = 1;
                data.tiene_barra_auxiliar = 1;

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
                        wizardBox.style.display = 'none';
                        mostrarPropuestas(result.propuestas, result.cotizacion.id);
                    } else if (response.status === 422) {
                        mostrarErrores(result.errors || result);
                    } else {
                        alert('Error: ' + (result.error || 'No se pudo generar la cotización'));
                    }
                } catch (error) {
                    alert('Hubo un problema de red.');
                } finally {
                    btnSubmit.classList.remove('loading');
                    btnSubmit.innerText = 'Calcular Presupuestos';
                    btnSubmit.disabled = false;
                }
            });

            function mostrarPropuestas(propuestasObj, cotizacionId) {
                planesList.innerHTML = '';
                const propuestas = Object.values(propuestasObj);

                propuestas.forEach((plan) => {
                    let detallesHTML = '';
                    if(plan.detalle && plan.detalle.length > 0) {
                        plan.detalle.forEach(item => {
                            detallesHTML += `<div class="detail-item"><i>✓</i><span><strong>${item.categoria}:</strong> ${item.descripcion} (${item.cantidad} ${item.unidad})</span></div>`;
                        });
                    }

                    let features = `<li><i>✓</i> Diseño, Administración y A.I.U incluido</li>`;
                    if(plan.tipo === 'elemental') {
                        features += `<li><i>✓</i> Muros, Pisos y Techos listos</li><li><i>✓</i> Aseo final especializado</li>`;
                    } else if (plan.tipo === 'estandar') {
                        features += `<li><i>✓</i> Todo lo Elemental</li><li><i>✓</i> Carpintería en madera</li><li><i>✓</i> Divisiones en vidrio</li>`;
                    } else {
                        features += `<li><i>✓</i> Todo lo Estándar</li><li><i>✓</i> Mesones en Quarztone</li><li><i>✓</i> Griferías de Lujo</li>`;
                    }

                    const card = document.createElement('div');
                    card.className = `plan-card ${plan.tipo === 'experto' ? 'experto' : ''}`;
                    
                    card.innerHTML = `
                        <h3 class="plan-name">Línea ${plan.tipo}</h3>
                        <div class="plan-price">${plan.vr_total_formateado}</div>
                        <div class="plan-price-m2">Inversión aprox por m²: ${plan.precio_m2_formateado}</div>
                        
                        <ul class="plan-features">${features}</ul>

                        <details class="plan-accordion">
                            <summary>Ver desglose de obra</summary>
                            <div class="details-list">${detallesHTML}</div>
                        </details>

                        <button type="button" class="btn-select-plan" 
                            onclick="seleccionarPlan(${cotizacionId}, '${plan.tipo}', ${plan.vr_total}, ${plan.precio_oferta_m2}, this)">
                            Me interesa esta línea
                        </button>
                    `;
                    planesList.appendChild(card);
                });

                resultsContainer.classList.add('visible');
                setTimeout(() => {
                    document.getElementById('cotizador').scrollIntoView({ behavior: 'smooth' });
                }, 100);
            }

            window.seleccionarPlan = async function(cotizacionId, tipoPropuesta, vrTotal, precioM2, btnElement) {
                const originalText = btnElement.innerText;
                btnElement.innerText = "Procesando...";
                btnElement.disabled = true;

                try {
                    const response = await fetch(`/api/cotizacion/${cotizacionId}/seleccionar`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            tipo_propuesta: tipoPropuesta,
                            vr_total: vrTotal,
                            precio_m2: precioM2
                        })
                    });

                    if (response.ok) {
                        alert(`¡Perfecto! Hemos registrado tu interés en la línea ${tipoPropuesta.toUpperCase()}. En breve te contactaremos vía WhatsApp para coordinar los detalles de tu apartamento.`);
                        btnElement.innerText = "¡Solicitud Enviada!";
                        btnElement.style.background = "var(--success)";
                        btnElement.style.color = "white";
                    } else {
                        alert('Error al seleccionar la propuesta. Intenta de nuevo.');
                        btnElement.innerText = originalText;
                        btnElement.disabled = false;
                    }
                } catch (error) {
                    alert('Error de red. Verifica tu conexión.');
                    btnElement.innerText = originalText;
                    btnElement.disabled = false;
                }
            };
            
            updateWizard();
        });
    </script>
</body>
</html>