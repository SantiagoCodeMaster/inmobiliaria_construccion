<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Constructora Escuadr Arq S.A.S. - Portafolio corporativo y experiencia en construcción y remodelación.">
    <title>Nuestra Experiencia | Constructora Escuadr Arq S.A.S.</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('Screenshot_1.ico') }}">

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
            --primary-soft: #2a2a2a;
            --accent: #c9a961;
            --accent-hover: #b89548;
            --accent-light: #e8d5a1;
            --accent-dark: #8a6f3a;
            --bg-white: #ffffff;
            --bg-subtle: #faf9f6;
            --bg-cream: #f5f2ec;
            --border-color: #e8e6e1;
            --text-muted: #6b6b6b;
            --success: #10b981;
            --shadow-sm: 0 2px 8px rgba(0,0,0,0.04);
            --shadow-md: 0 10px 30px rgba(0,0,0,0.08);
            --shadow-lg: 0 25px 50px rgba(0,0,0,0.12);
            --shadow-gold: 0 20px 40px rgba(201, 169, 97, 0.25);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { scroll-behavior: smooth; overflow-x: hidden; }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--bg-white);
            color: var(--primary);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        h1, h2, h3, h4 { 
            font-family: 'Syne', sans-serif; 
            font-weight: 800; 
            letter-spacing: -0.03em; 
        }

        .serif-italic {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-weight: 400;
        }

        .container { max-width: 1280px; margin: 0 auto; padding: 0 1.5rem; }
        
        .accent-text { 
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%); 
            -webkit-background-clip: text; 
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ============ ANIMACIONES ============ */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes pulse-gold {
            0%, 100% { box-shadow: 0 0 0 0 rgba(201, 169, 97, 0.4); }
            50% { box-shadow: 0 0 0 15px rgba(201, 169, 97, 0); }
        }

        .fade-in-up {
            opacity: 0;
            animation: fadeInUp 0.8s ease forwards;
        }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }

        /* ============ HEADER ============ */
        header {
            position: fixed; 
            top: 0; 
            width: 100%; 
            z-index: 1000;
            background: rgba(255, 255, 255, 0.92); 
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0,0,0,0.04);
            transition: all 0.3s ease;
        }
        header.scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: var(--shadow-sm);
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
            transition: transform 0.3s;
        }
        .brand-logo:hover { transform: scale(1.02); }
        .brand-img { 
            height: 42px;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
        }
        .brand-text { display: flex; flex-direction: column; }
        .brand-text span:first-child { 
            font-family: 'Syne'; 
            font-weight: 800; 
            color: var(--primary); 
            font-size: 1.25rem; 
            line-height: 1; 
        }
        .brand-text span:last-child { 
            font-size: 0.6rem; 
            color: var(--accent); 
            font-weight: 700; 
            letter-spacing: 2.5px;
            margin-top: 3px;
        }
        
        .nav-links { 
            display: none; 
            gap: 2.5rem; 
            align-items: center; 
        }
        @media(min-width: 768px) { .nav-links { display: flex; } }
        
        .nav-links a { 
            color: var(--primary); 
            text-decoration: none; 
            font-weight: 500; 
            font-size: 0.95rem; 
            transition: color 0.3s;
            position: relative;
        }
        .nav-links a:not(.btn-nav-cta)::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--accent);
            transition: width 0.3s ease;
        }
        .nav-links a:not(.btn-nav-cta):hover::after { width: 100%; }
        .nav-links a:hover { color: var(--accent); }
        
        .btn-nav-cta {
            background: var(--primary); 
            color: white !important; 
            padding: 0.75rem 1.75rem; 
            border-radius: 100px;
            font-family: 'Syne'; 
            font-weight: 700; 
            font-size: 0.9rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            text-decoration: none;
        }
        .btn-nav-cta::before {
            content: '';
            position: absolute;
            inset: 0;
            background: var(--accent);
            transform: translateY(100%);
            transition: transform 0.3s ease;
        }
        .btn-nav-cta span { position: relative; z-index: 1; }
        .btn-nav-cta:hover::before { transform: translateY(0); }
        .btn-nav-cta:hover { 
            transform: translateY(-2px); 
            box-shadow: var(--shadow-gold);
        }

        /* ============ HERO CORPORATIVO ============ */
        .hero { 
            padding: 11rem 0 6rem; 
            display: flex; 
            align-items: center;
            position: relative;
            background: linear-gradient(180deg, var(--bg-cream) 0%, var(--bg-white) 100%);
            overflow: hidden;
            text-align: center;
        }
        .hero::before {
            content: '';
            position: absolute;
            top: -20%;
            left: 50%;
            transform: translateX(-50%);
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(201,169,97,0.08) 0%, transparent 60%);
            border-radius: 50%;
            filter: blur(40px);
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 900px;
            margin: 0 auto;
        }

        .hero-tag {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(201, 169, 97, 0.1);
            color: var(--accent-dark);
            padding: 0.5rem 1rem;
            border-radius: 100px;
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 2rem;
            border: 1px solid rgba(201, 169, 97, 0.2);
        }
        
        .hero-content h1 { 
            font-size: clamp(2.5rem, 5vw, 4.5rem); 
            line-height: 1.1; 
            margin-bottom: 1.5rem; 
            color: var(--primary);
        }
        .hero-content p { 
            font-size: 1.25rem; 
            color: var(--text-muted); 
            margin-bottom: 2.5rem; 
            line-height: 1.7;
            max-width: 700px;
            margin-inline: auto;
        }

        /* ============ SECTION HEADERS ============ */
        .section-header { 
            text-align: center; 
            margin-bottom: 4rem; 
            max-width: 800px; 
            margin-inline: auto; 
        }
        .section-label {
            display: inline-block;
            font-size: 0.75rem;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--accent);
            font-weight: 700;
            margin-bottom: 1rem;
        }
        .section-label::before { content: '— '; }
        .section-label::after { content: ' —'; }
        .section-header h2 { 
            font-size: clamp(2rem, 4vw, 3.2rem); 
            margin-bottom: 1rem;
            line-height: 1.1;
        }
        .section-header p { 
            color: var(--text-muted); 
            font-size: 1.1rem; 
        }

        /* ============ QUIÉNES SOMOS ============ */
        .about-section {
            padding: 5rem 0 8rem;
            background: var(--bg-white);
        }
        .about-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2.5rem;
        }
        .about-card {
            background: var(--bg-subtle);
            padding: 3.5rem 2.5rem;
            border-radius: 24px;
            border: 1px solid var(--border-color);
            transition: transform 0.4s ease;
            position: relative;
        }
        .about-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
            border-color: rgba(201, 169, 97, 0.3);
        }
        .about-icon {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            display: inline-block;
            color: var(--accent);
        }
        .about-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--primary);
        }
        .about-card p {
            color: var(--text-muted);
            line-height: 1.7;
            font-size: 1rem;
        }

        /* ============ SERVICIOS ============ */
        .services-section {
            padding: 7rem 0;
            background: var(--primary);
            color: white;
            position: relative;
        }
        .services-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(201,169,97,0.08) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(201,169,97,0.05) 0%, transparent 50%);
        }
        .services-section .section-header p { color: #a0a0a0; }
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            position: relative;
            z-index: 1;
        }
        .service-item {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 2rem;
            border-radius: 20px;
            display: flex;
            align-items: flex-start;
            gap: 1.2rem;
            transition: all 0.3s ease;
        }
        .service-item:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--accent);
            transform: translateY(-5px);
        }
        .service-icon {
            color: var(--accent);
            font-size: 1.5rem;
            flex-shrink: 0;
            background: rgba(201, 169, 97, 0.1);
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
        }
        .service-text h4 {
            font-size: 1.1rem;
            font-weight: 700;
            line-height: 1.4;
            font-family: 'Outfit', sans-serif;
        }

        /* ============ CLIENTES ============ */
        .clients-section {
            padding: 7rem 0;
            background: var(--bg-cream);
        }
        .clients-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 2rem;
            align-items: center;
        }
        .client-logo-placeholder {
            width: 200px;
            height: 100px;
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.95rem;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            padding: 1rem;
        }
        .client-logo-placeholder:hover {
            border-color: var(--accent);
            box-shadow: var(--shadow-md);
            transform: translateY(-3px);
            color: var(--primary);
        }
        .client-logo-placeholder img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            /* Descomentar cuando insertes las imágenes
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            padding: 15px; */
        }

        /* ============ PORTAFOLIO PROYECTOS ============ */
        .portfolio-section { 
            padding: 7rem 0;
            background: var(--bg-white);
        }
        .projects-wrapper {
            display: flex;
            flex-direction: column;
            gap: 5rem;
        }
        .project-block {
            background: white;
            border-radius: 30px;
            padding: 3.5rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            position: relative;
            overflow: hidden;
        }
        .project-block::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 6px;
            height: 100%;
            background: linear-gradient(180deg, var(--accent), var(--accent-dark));
            border-radius: 30px 0 0 30px;
        }
        .project-block:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }
        .project-info {
            margin-bottom: 2.5rem;
        }
        .project-info .tag {
            display: inline-block;
            background: rgba(201, 169, 97, 0.15);
            color: var(--accent-dark);
            padding: 0.4rem 1rem;
            border-radius: 100px;
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 1.2rem;
        }
        .project-info h3 {
            font-size: 2.2rem;
            margin-bottom: 0.8rem;
            color: var(--primary);
        }
        .project-info p {
            color: var(--text-muted);
            font-size: 1.15rem;
            line-height: 1.6;
        }
        .project-images {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }
        .img-placeholder {
            aspect-ratio: 4/3;
            background: var(--bg-subtle);
            border-radius: 20px;
            border: 2px dashed var(--border-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
            font-weight: 500;
            font-size: 1rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .img-placeholder:hover {
            border-color: var(--accent);
            background: rgba(201, 169, 97, 0.05);
            color: var(--accent-dark);
        }
        .img-placeholder img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 1; /* Esto ocultará el texto cuando la imagen esté presente */
        }

        /* ============ CTA FINAL ============ */
        .final-cta {
            padding: 7rem 0;
            background: linear-gradient(135deg, var(--bg-cream) 0%, var(--accent-light) 100%);
            text-align: center;
            position: relative;
        }
        .final-cta h2 {
            font-size: clamp(2rem, 4vw, 3rem);
            margin-bottom: 1.5rem;
            color: var(--primary);
        }
        .final-cta p {
            color: var(--primary-soft);
            font-size: 1.2rem;
            margin-bottom: 3rem;
            max-width: 600px;
            margin-inline: auto;
        }
        .btn-cta-large {
            display: inline-block;
            background: var(--primary);
            color: white;
            padding: 1.25rem 3rem;
            border-radius: 100px;
            font-family: 'Syne';
            font-weight: 700;
            font-size: 1.1rem;
            text-decoration: none;
            transition: all 0.3s;
            box-shadow: var(--shadow-md);
        }
        .btn-cta-large:hover {
            background: var(--primary-light);
            transform: translateY(-3px);
            box-shadow: var(--shadow-lg);
            color: var(--accent);
        }

        /* ============ FOOTER ============ */
        footer { 
            background: #050505; 
            color: white; 
            padding: 4rem 2rem 2rem;
            position: relative;
        }
        .footer-grid {
            max-width: 1280px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr;
            gap: 3rem;
            margin-bottom: 3rem;
        }
        @media(min-width: 768px) {
            .footer-grid { grid-template-columns: 2fr 1fr 1fr 1fr; }
        }
        .footer-brand h3 { font-size: 1.5rem; margin-bottom: 0.5rem; }
        .footer-brand .tag { color: var(--accent); font-size: 0.75rem; letter-spacing: 2px; margin-bottom: 1rem; display: block; }
        .footer-brand p { color: #888; font-size: 0.9rem; line-height: 1.7; max-width: 320px; margin-bottom: 0.5rem; }
        .footer-col h4 { font-size: 0.9rem; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 1.5rem; color: var(--accent); }
        .footer-col ul { list-style: none; }
        .footer-col ul li { margin-bottom: 0.75rem; }
        .footer-col a { color: #aaa; text-decoration: none; font-size: 0.9rem; transition: color 0.3s; }
        .footer-col a:hover { color: var(--accent); }
        .footer-bottom {
            max-width: 1280px; margin: 0 auto; padding-top: 2rem;
            border-top: 1px solid #222; display: flex; justify-content: space-between;
            align-items: center; flex-wrap: wrap; gap: 1rem;
        }
        .footer-bottom p { color: #666; font-size: 0.85rem; }
        .social-links { display: flex; gap: 1rem; }
        .social-links a {
            width: 40px; height: 40px; border-radius: 50%; background: #151515;
            display: flex; align-items: center; justify-content: center; color: #888;
            transition: all 0.3s; border: 1px solid #222;
        }
        .social-links a:hover { background: var(--accent); color: var(--primary); transform: translateY(-2px); }

        /* ============ BOTÓN WHATSAPP FLOTANTE ============ */
        .whatsapp-float {
            position: fixed; bottom: 25px; right: 25px; width: 60px; height: 60px;
            background: #25D366; color: white; border-radius: 50%; display: flex;
            align-items: center; justify-content: center; text-decoration: none;
            box-shadow: 0 10px 30px rgba(37, 211, 102, 0.4); z-index: 999;
            transition: all 0.3s; animation: pulse-gold 2s infinite;
        }
        .whatsapp-float:hover { transform: scale(1.1); }
        .whatsapp-float svg { width: 30px; height: 30px; }
        
    </style>
</head>
<body>

    <header id="mainHeader">
        <div class="nav-container">
            <a href="/" class="brand-logo">
                <img src="{{ asset('construccion.ico') }}" alt="Escuadr Arq" class="brand-img">
                <div class="brand-text">
                    <span>Escuadr Arq</span>
                    <span>Constructora S.A.S.</span>
                </div>
            </a>
            <nav class="nav-links">
                <a href="#nosotros">Quiénes Somos</a>
                <a href="#servicios">Servicios</a>
                <a href="#clientes">Experiencia</a>
                <a href="#proyectos">Proyectos</a>
                <a href="/" class="btn-nav-cta"><span>Ir al Cotizador</span></a>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-tag fade-in-up">Brochure Corporativo</div>
                <h1 class="fade-in-up delay-100">
                    Construimos más que espacios, <br>
                    <span class="serif-italic accent-text">construimos confianza.</span>
                </h1>
                <p class="fade-in-up delay-200">
                    Descubre nuestra trayectoria, servicios y los proyectos que respaldan nuestra excelencia en arquitectura e ingeniería en Bogotá.
                </p>
                <div class="fade-in-up delay-300" style="margin-top: 2rem;">
                    <p style="font-family: 'Playfair Display', serif; font-size: 1.4rem; color: var(--accent-dark); font-style: italic;">
                        "Ser la mejor empresa, es asegurarse de tener los mejores clientes"
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="nosotros" class="about-section">
        <div class="container">
            <div class="section-header">
                <span class="section-label">Quiénes Somos</span>
                <h2>Nuestra <span class="accent-text">Esencia</span></h2>
                <p>El propósito y la visión que nos impulsan a ser líderes en el sector.</p>
            </div>
            
            <div class="about-grid">
                <div class="about-card fade-in-up">
                    <span class="about-icon">🏢</span>
                    <h3>Objeto Social</h3>
                    <p>Gerencia, Promoción, Ventas y Construcción de proyectos inmobiliarios propios y en asociación con terceros.</p>
                </div>
                <div class="about-card fade-in-up delay-100">
                    <span class="about-icon">🎯</span>
                    <h3>Misión</h3>
                    <p>Resolver necesidades en temas inmobiliarios y de construcción en Arquitectura e Ingeniería, brindando soluciones integrales y eficientes.</p>
                </div>
                <div class="about-card fade-in-up delay-200">
                    <span class="about-icon">👁️</span>
                    <h3>Visión</h3>
                    <p>Reconocimiento en toda Bogotá como solución a empresas que requieren la Promoción, gerencia, ventas, y construcción de proyectos inmobiliarios.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="servicios" class="services-section">
        <div class="container">
            <div class="section-header">
                <span class="section-label" style="color: var(--accent-light);">Portafolio</span>
                <h2 style="color: white;">Nuestros <span class="accent-text">Servicios</span></h2>
                <p>Abarcamos todas las fases del desarrollo inmobiliario y constructivo.</p>
            </div>

            <div class="services-grid">
                <div class="service-item fade-in-up">
                    <div class="service-icon">🏗️</div>
                    <div class="service-text">
                        <h4>Diseños y Licencias de construcción</h4>
                    </div>
                </div>
                <div class="service-item fade-in-up delay-100">
                    <div class="service-icon">📋</div>
                    <div class="service-text">
                        <h4>Consultoría y supervisión técnica</h4>
                    </div>
                </div>
                <div class="service-item fade-in-up delay-200">
                    <div class="service-icon">🧱</div>
                    <div class="service-text">
                        <h4>Construcción Civil y Arquitectónica</h4>
                    </div>
                </div>
                <div class="service-item fade-in-up delay-300">
                    <div class="service-icon">⚖️</div>
                    <div class="service-text">
                        <h4>Asesoría en norma urbana</h4>
                    </div>
                </div>
                <div class="service-item fade-in-up">
                    <div class="service-icon">🤝</div>
                    <div class="service-text">
                        <h4>Promoción, Compra y venta de Inmuebles</h4>
                    </div>
                </div>
                <div class="service-item fade-in-up delay-100">
                    <div class="service-icon">📄</div>
                    <div class="service-text">
                        <h4>Estudios de Títulos</h4>
                    </div>
                </div>
                <div class="service-item fade-in-up delay-200">
                    <div class="service-icon">📊</div>
                    <div class="service-text">
                        <h4>Avalúo de Inmuebles</h4>
                    </div>
                </div>
                <div class="service-item fade-in-up delay-300">
                    <div class="service-icon">💼</div>
                    <div class="service-text">
                        <h4>Asesoramiento Legal inmobiliario</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="clientes" class="clients-section">
        <div class="container">
            <div class="section-header">
                <span class="section-label">Nuestra Experiencia</span>
                <h2>Clientes que <span class="accent-text">confían</span> en nosotros</h2>
                <p>Empresas y corporaciones que han dejado sus proyectos en nuestras manos.</p>
            </div>
            
            <div class="clients-grid">
                <div class="client-logo-placeholder fade-in-up">
                     <img src="{{ asset('AVINGCO.png') }}" alt="Logo AVINGCO S.A.S." style="max-width: 100%; height: auto;">
                </div>
                <div class="client-logo-placeholder fade-in-up delay-100">
                   <img src="{{ asset('Riaño.png') }}" alt="Logo RIAÑO" style="max-width: 100%; height: auto;">
                </div>
                <div class="client-logo-placeholder fade-in-up delay-200">
                  <img src="{{ asset('terranvm.png') }}" alt="Logo TERRANVM" style="max-width: 100%; height: auto;">
                </div>
                <div class="client-logo-placeholder fade-in-up delay-300">
                 <img src="{{ asset('makro.png') }}" alt="Logo MAKRO" style="max-width: 100%; height: auto;">
                </div>
                <div class="client-logo-placeholder fade-in-up">
                    <img src="{{ asset('arpro.png') }}" alt="Logo ARPRO" style="max-width: 100%; height: auto;">
                </div>
                <div class="client-logo-placeholder fade-in-up delay-100">
                   <img src="{{ asset('rd.png') }}" alt="Logo RD Studio" style="max-width: 100%; height: auto;">
                </div>
                <div class="client-logo-placeholder fade-in-up delay-200">
                   <img src="{{ asset('condival.png') }}" alt="Logo CONDIVAL" style="max-width: 100%; height: auto;">
                </div>
            </div>
        </div>
    </section>

    <section id="proyectos" class="portfolio-section">
        <div class="container">
            <div class="section-header">
                <span class="section-label">Obras Destacadas</span>
                <h2>Nuestros <span class="accent-text">Proyectos</span></h2>
                <p>Un recorrido por nuestras obras, mostrando la calidad y el detalle que nos caracteriza.</p>
            </div>

            <div class="projects-wrapper">
                
                <div class="project-block fade-in-up">
                    <div class="project-info">
                        <span class="tag">Año 2021 - 2022</span>
                        <h3>Edificio Emanuel</h3>
                        <p>Ubicación: Av. Américas con Av. Boyacá. <br> Alcance: Obra Nueva, Demolición, Cimentación, Estructura, Mampostería y Cubierta.</p>
                    </div>
                    <div class="project-images">
                        <div class="img-placeholder">
                            <img src="{{ asset('edificio_manuel1.png') }}" alt="Foto 1 - Edificio Emanuel" style="max-width: 100%; height: auto;">
                        </div>
                        <div class="img-placeholder">
                          <img src="{{ asset('edificio_manuel2.png') }}" alt="Foto 2 - Edificio Emanuel" style="max-width: 100%; height: auto;">
                        </div>
                        <div class="img-placeholder">
                             <img src="{{ asset('edificio_manuel3.png') }}" alt="Foto 3 - Edificio Emanuel" style="max-width: 100%; height: auto;">
                        </div> 
                    </div>
                </div>

                <div class="project-block fade-in-up">
                    <div class="project-info">
                        <span class="tag">Año 2020</span>
                        <h3>Remodelación Tayrona</h3>
                        <p>Ubicación: Barrio Nicolás de Federman. <br> Alcance: Remodelación integral apartamento de 130 m².</p>
                    </div>
                    <div class="project-images">
                        <div class="img-placeholder" style="width: 100%; height: 300px; overflow: hidden;">
                          <img src="{{ asset('tayrona-1.png') }}" 
                            alt="Foto Tayrona" 
                            style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div class="img-placeholder" style="width: 100%; height: 300px; overflow: hidden; background: #000;">
                           <img src="{{ asset('tayrona-2.png') }}" 
                             alt="Foto 2 - Tayrona" 
                             style="width: 100%; height: 100%; object-fit: contain;">
                        </div>
                        <div class="img-placeholder" style="width: 100%; height: 300px; overflow: hidden; background: #000;">
                           <img src="{{ asset('tayrona-3.png') }}" 
                             alt="Foto 3 - Tayrona" 
                             style="width: 100%; height: 100%; object-fit: contain;">
                       </div>
                    </div>
                </div>

                <div class="project-block fade-in-up">
                    <div class="project-info">
                        <span class="tag">Año 2023</span>
                        <h3>Remates de Estructura Makro - ARPRO</h3>
                        <p>Alcance: Trabajo estructural e industrial a nivel corporativo.</p>
                    </div>
                    <div class="project-images">
                        <div class="img-placeholder" style="width: 100%; height: 300px; overflow: hidden; background: #000;">
                           <img src="{{ asset('makro1.png') }}" 
                             alt="Foto 1 - Makro" 
                             style="width: 100%; height: 100%; object-fit: contain;">
                        </div>
                            <div class="img-placeholder" style="width: 100%; height: 300px; overflow: hidden; background: #000;">
                                 <img src="{{ asset('makro2.png') }}" 
                                  alt="Foto 2 - Makro" 
                                  style="width: 100%; height: 100%; object-fit: contain;">
                        </div>
                        <div class="img-placeholder" style="width: 100%; height: 300px; overflow: hidden; background: #000;">
                            <img src="{{ asset('makro3.png') }}" 
                                 alt="Foto 3 - Makro" 
                                 style="width: 100%; height: 100%; object-fit: contain;">
                        </div>
                    </div>
                </div>

                <div class="project-block fade-in-up">
                    <div class="project-info">
                        <span class="tag">Año 2023</span>
                        <h3>Remodelación Casas 2 Pisos</h3>
                        <p>Ubicación: Av. 1ra de Mayo. <br> Alcance: Remodelación completa, área total intervenida de 300 m².</p>
                    </div>
                    <div class="project-images">
                        <div class="img-placeholder" style="width: 100%; height: 300px; overflow: hidden; background: #000;">
                         <img src="{{ asset('mayo1.png') }}" 
                          alt="Foto 1 - Casas 1ra Mayo" 
                          style="width: 100%; height: 100%; object-fit: contain;">
                   </div>
                        <div class="img-placeholder" style="width: 100%; height: 300px; overflow: hidden; background: #000;">
                            <img src="{{ asset('mayo2.png') }}" 
                                 alt="Foto 2 - Casas 1ra Mayo" 
                                 style="width: 100%; height: 100%; object-fit: contain;">
                        </div>
                            </div>
                        <div class="img-placeholder" style="width: 100%; height: 300px; overflow: hidden; background: #000;">
                            <img src="{{ asset('mayo3.png') }}" 
                                 alt="Foto 3 - Casas 1ra Mayo" 
                                 style="width: 100%; height: 100%; object-fit: contain;">
                        </div>
                    </div>
                </div>

                <div class="project-block fade-in-up">
                    <div class="project-info">
                        <span class="tag">Año 2023</span>
                        <h3>Remodelación Baviera II</h3>
                        <p>Ubicación: Colina Campestre. <br> Alcance: Remodelación de apartamento de 68 m².</p>
                    </div>
                    <div class="project-images">
                        <div class="img-placeholder" style="width: 100%; height: 300px; overflow: hidden; background: #000;">
                           <img src="{{ asset('baviera1.png') }}" 
                           alt="Foto 1 - Baviera II" 
                       style="width: 100%; height: 100%; object-fit: contain;">
                    </div>
                        <div class="img-placeholder" style="width: 100%; height: 300px; overflow: hidden; background: #000;">
                            <img src="{{ asset('baviera2.png') }}" 
                                 alt="Foto 2 - Baviera II" 
                                 style="width: 100%; height: 100%; object-fit: contain;">
                        </div>
                        <div class="img-placeholder" style="width: 100%; height: 300px; overflow: hidden; background: #000;">
                            <img src="{{ asset('baviera3.png') }}" 
                                 alt="Foto 3 - Baviera II" 
                                 style="width: 100%; height: 100%; object-fit: contain;">
                        </div>
                    </div>
                </div>

                <div class="project-block fade-in-up">
                    <div class="project-info">
                        <span class="tag">Año 2024</span>
                        <h3>Acabados Aptos Natura Living & Veramonte Living</h3>
                        <p>Ubicación: Colina Campestre. <br> Alcance: Diseño y ejecución de acabados en proyectos VIS/VIP de 35 m².</p>
                    </div>
                    <div class="project-images">
                        <div class="img-placeholder" style="width: 100%; height: 300px; overflow: hidden; background: #000;">
                           <img src="{{ asset('colina1.png') }}" 
                             alt="Foto 1 - Natura/Veramonte" 
                             style="width: 100%; height: 100%; object-fit: contain;">
                        </div>
                        <div class="img-placeholder" style="width: 100%; height: 300px; overflow: hidden; background: #000;">
                            <img src="{{ asset('colina2.png') }}" 
                                 alt="Foto 2 - Natura/Veramonte" 
                                 style="width: 100%; height: 100%; object-fit: contain;">
                        </div>
                        <div class="img-placeholder" style="width: 100%; height: 300px; overflow: hidden; background: #000;">
                            <img src="{{ asset('colina3.png') }}" 
                                 alt="Foto 3 - Natura/Veramonte" 
                                 style="width: 100%; height: 100%; object-fit: contain;">
                        </div>
                            </div>
                    </div>
                </div>

                <div class="project-block fade-in-up">
                    <div class="project-info">
                        <span class="tag">Años 2025 - 2026</span>
                        <h3>Proyectos Corporativos y Edificios</h3>
                        <p>Alcance: Remodelación Edificio Calvo Sur (5 Pisos, 500m²) y Local Comercial San Fernando (30m²).</p>
                    </div>
                    <div class="project-block fade-in-up">
    <div class="project-info">
        <span class="tag">Años 2025 - 2026</span>
        <h3>Proyectos Corporativos y Edificios</h3>
        <p>Alcance: Remodelación Edificio Calvo Sur (5 Pisos, 500m²) y Local Comercial San Fernando (30m²).</p>
    </div>

    <div class="project-images">
        
        <div class="img-placeholder" style="width: 100%; height: 300px; overflow: hidden; background: #000;">
            <img src="{{ asset('Corp1.png') }}" 
                 alt="Foto 1 - Corp / Comercial" 
                 style="width: 100%; height: 100%; object-fit: contain;">
        </div>

        <div class="img-placeholder" style="width: 100%; height: 300px; overflow: hidden; background: #000;">
            <img src="{{ asset('copr2.png') }}" 
                 alt="Foto 2 - Corp / Comercial" 
                 style="width: 100%; height: 100%; object-fit: contain;">
        </div>

        <div class="img-placeholder" style="width: 100%; height: 300px; overflow: hidden; background: #000;">
            <img src="{{ asset('copr3.png') }}" 
                 alt="Foto 3 - Corp / Comercial" 
                 style="width: 100%; height: 100%; object-fit: contain;">
        </div>

    </div>
</div>
                </div>

            </div>
        </div>
    </section>

    <section class="final-cta">
        <div class="container">
            <h2>¿Tienes un proyecto en mente?</h2>
            <p>Conoce nuestras líneas de acabados y obtén un presupuesto automático al instante.</p>
            <a href="/" class="btn-cta-large">Ir al Cotizador Interactivo</a>
        </div>
    </section>

    <footer>
        <div class="footer-grid">
            <div class="footer-brand">
                <h3>Escuadr Arq</h3>
                <span class="tag">CONSTRUCTORA S.A.S.</span>
                <p>Nit: 901.794.009-0 | Régimen Común</p>
                <p>Arl: Sura | Caja de Compensación: Cafam</p>
                <p style="margin-top: 10px; font-style: italic; color: var(--accent);">"Ser la mejor empresa, es asegurarse de tener los mejores clientes"</p>
            </div>
            <div class="footer-col">
                <h4>Empresa</h4>
                <ul>
                    <li><a href="#nosotros">Quiénes Somos</a></li>
                    <li><a href="#servicios">Servicios</a></li>
                    <li><a href="#proyectos">Portafolio</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Servicios Rápidos</h4>
                <ul>
                    <li><a href="/">Cotización Online</a></li>
                    <li><a href="/">Líneas de Acabados</a></li>
                    <li><a href="/">Proceso de Obra</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Contacto</h4>
                <ul>
                    <li><a href="tel:+573224307053">+57 322 4307053</a></li>
                    <li><a href="mailto:proyectos.escuadrarq@gmail.com">proyectos.escuadrarq@gmail.com</a></li>
                    <li><a href="#">Bogotá, Colombia</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Constructora Escuadr Arq S.A.S. — Todos los derechos reservados.</p>
            <div class="social-links">
                <a href="#" aria-label="Instagram">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                </a>
                <a href="#" aria-label="Facebook">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                </a>
            </div>
        </div>
    </footer>

    <a href="https://wa.me/573224307053?text=Hola,%20me%20gustar%C3%ADa%20conocer%20m%C3%A1s%20sobre%20sus%20servicios%20de%20construcci%C3%B3n." class="whatsapp-float" target="_blank" aria-label="Contactar por WhatsApp">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
    </a>

    <script>
        // Header scroll effect
        const header = document.getElementById('mainHeader');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Intersection Observer para las animaciones al hacer scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.fade-in-up').forEach(el => {
                // Elementos que ya tienen la clase fade-in-up en el HTML inicial para animarse con CSS no necesitan esto, 
                // pero lo aplicamos a elementos que hacemos scroll.
                if(!el.closest('.hero')) {
                    el.style.opacity = '0';
                    el.style.transform = 'translateY(30px)';
                    el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                    observer.observe(el);
                }
            });
        });
    </script>
</body>
</html>