<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Constructora Escuadr Arq S.A.S. - Transformamos apartamentos en obra gris en hogares de ensueño. Promoción, gerencia, ventas y construcción.">
    <title>Constructora Escuadr Arq S.A.S. | Acabados de Lujo en Bogotá</title>

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
        /* ============ VARIABLES ============ */
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
            --error: #ef4444;
            --shadow-sm: 0 2px 8px rgba(0,0,0,0.04);
            --shadow-md: 0 10px 30px rgba(0,0,0,0.08);
            --shadow-lg: 0 25px 50px rgba(0,0,0,0.12);
            --shadow-gold: 0 20px 40px rgba(201, 169, 97, 0.25);
        }

        /* ============ RESET ============ */
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Outfit', sans-serif;
            background: var(--bg-white);
            color: var(--primary);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            overflow-x: hidden;
            width: 100%;
        }
        body.modal-open {
            overflow: hidden;
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
        .container {
            width: 100%;
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }
        .accent-text {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Utilidad para salto de línea responsive */
        .br-desktop { display: inline; }
        @media(max-width: 767px) {
            .br-desktop { display: none; }
        }

        /* ============ ANIMACIONES ============ */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-12px); }
        }
        @keyframes shimmer {
            0% { background-position: -200% center; }
            100% { background-position: 200% center; }
        }
        @keyframes pulse-gold {
            0%, 100% { box-shadow: 0 0 0 0 rgba(201, 169, 97, 0.4); }
            50% { box-shadow: 0 0 0 12px rgba(201, 169, 97, 0); }
        }
        @keyframes float-cloud {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-10px) scale(1.02); }
        }
        .fade-in-up { opacity: 0; animation: fadeInUp 0.8s ease forwards; }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }

        /* ============ HEADER & TOP BAR ============ */
        header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0,0,0,0.04);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }
        header.scrolled {
            background: rgba(255,255,255,0.98);
            box-shadow: var(--shadow-sm);
        }
        
        .top-bar {
            background: var(--primary);
            color: white;
            padding: 0.55rem 1rem;
            text-align: center;
            font-size: 0.78rem;
            font-weight: 500;
            letter-spacing: 0.4px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            max-height: 50px;
        }
        .top-bar::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, transparent, rgba(201,169,97,0.15), transparent);
            background-size: 200% 100%;
            animation: shimmer 4s linear infinite;
        }
        .top-bar span { position: relative; z-index: 1; }
        .top-bar strong { color: var(--accent); }
        
        header.scrolled .top-bar {
            max-height: 0;
            padding-top: 0;
            padding-bottom: 0;
            opacity: 0;
            border: none;
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.9rem 1.5rem;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }
        .brand-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            transition: transform 0.3s;
            flex-shrink: 0;
        }
        .brand-logo:hover { transform: scale(1.02); }
        .brand-img { height: 40px; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1)); }
        .brand-text { display: flex; flex-direction: column; }
        .brand-text span:first-child {
            font-family: 'Syne';
            font-weight: 800;
            color: var(--primary);
            font-size: 1.2rem;
            line-height: 1;
        }
        .brand-text span:last-child {
            font-size: 0.58rem;
            color: var(--accent);
            font-weight: 700;
            letter-spacing: 2.5px;
            margin-top: 3px;
        }
        .nav-links { display: none; gap: 2.5rem; align-items: center; }
        @media(min-width: 768px) { .nav-links { display: flex; } }
        .nav-links a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.92rem;
            transition: color 0.3s;
            position: relative;
            white-space: nowrap;
        }
        .nav-links a:not(.btn-nav-cta)::after {
            content: '';
            position: absolute;
            bottom: -4px; left: 0;
            width: 0; height: 2px;
            background: var(--accent);
            transition: width 0.3s ease;
        }
        .nav-links a:not(.btn-nav-cta):hover::after { width: 100%; }
        .nav-links a:hover { color: var(--accent); }
        .btn-nav-cta {
            background: var(--primary);
            color: white !important;
            padding: 0.7rem 1.6rem;
            border-radius: 100px;
            font-family: 'Syne';
            font-weight: 700;
            font-size: 0.88rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
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
        .btn-nav-cta:hover { transform: translateY(-2px); box-shadow: var(--shadow-gold); }

        /* ============ HERO ============ */
        .hero {
            padding: 10rem 0 5rem;
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            background: linear-gradient(180deg, var(--bg-white) 0%, var(--bg-cream) 100%);
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute;
            top: 10%; right: -10%;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(201,169,97,0.08) 0%, transparent 70%);
            border-radius: 50%;
            filter: blur(40px);
            pointer-events: none;
        }
        .hero::after {
            content: '';
            position: absolute;
            bottom: 10%; left: -5%;
            width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(201,169,97,0.05) 0%, transparent 70%);
            border-radius: 50%;
            filter: blur(40px);
            pointer-events: none;
        }
        .hero-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 3rem;
            align-items: center;
            position: relative;
            z-index: 1;
        }
        @media(min-width: 1024px) {
            .hero-grid { grid-template-columns: 1.1fr 0.9fr; gap: 5rem; }
        }
        .hero-tag {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(201,169,97,0.1);
            color: var(--accent-dark);
            padding: 0.45rem 0.9rem;
            border-radius: 100px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 1.25rem;
            border: 1px solid rgba(201,169,97,0.2);
        }
        .hero-tag::before {
            content: '';
            width: 7px; height: 7px;
            background: var(--accent);
            border-radius: 50%;
            animation: pulse-gold 2s infinite;
            flex-shrink: 0;
        }
        .hero-content h1 {
            font-size: clamp(1.8rem, 5vw, 3.8rem);
            line-height: 1.08;
            margin-bottom: 1.25rem;
            word-break: normal; 
            overflow-wrap: break-word; 
        }
        .hero-content h1 .serif-italic {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: inline;
        }
        .hero-content p {
            font-size: 1.05rem;
            color: var(--text-muted);
            margin-bottom: 2rem;
            max-width: 520px;
            line-height: 1.75;
        }
        .hero-cta-group {
            display: flex;
            gap: 0.85rem;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 2.5rem;
        }
        .btn-hero {
            padding: 1rem 2rem;
            border-radius: 100px;
            font-family: 'Syne';
            font-weight: 700;
            font-size: 0.92rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            letter-spacing: 0.4px;
            text-align: center;
            line-height: 1.3;
        }
        .btn-hero-primary {
            background: var(--primary);
            color: white;
            border: 2px solid var(--primary);
            box-shadow: var(--shadow-md);
        }
        .btn-hero-primary:hover {
            background: var(--accent);
            border-color: var(--accent);
            transform: translateY(-3px);
            box-shadow: var(--shadow-gold);
        }
        .btn-hero-primary .arrow { transition: transform 0.3s; }
        .btn-hero-primary:hover .arrow { transform: translateX(4px); }
        .btn-hero-secondary {
            background: transparent;
            color: var(--primary);
            border: 2px solid var(--border-color);
        }
        .btn-hero-secondary:hover {
            border-color: var(--primary);
            background: var(--primary);
            color: white;
        }
        .hero-trust {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
            padding-top: 1.75rem;
            border-top: 1px solid var(--border-color);
        }
        .trust-item { display: flex; flex-direction: column; }
        .trust-item .number {
            font-family: 'Syne';
            font-size: 1.8rem;
            font-weight: 800;
            line-height: 1;
        }
        .trust-item .label {
            font-size: 0.78rem;
            color: var(--text-muted);
            margin-top: 0.3rem;
            letter-spacing: 0.4px;
        }
        .hero-visual {
            position: relative;
            height: 580px;
            width: 100%;
            border-radius: 28px;
            overflow: visible;
        }
        .hero-visual .img-container {
            position: relative;
            width: 100%;
            height: 100%;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
        }
        .hero-visual .img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
            display: block;
        }
        .hero-visual:hover .img-container img { transform: scale(1.05); }
        .hero-visual .img-container::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.3), transparent 50%);
            z-index: 1;
            pointer-events: none;
        }
        .cloud-bonus {
            position: absolute;
            top: -18px; right: -15px;
            background: rgba(255,255,255,0.96);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            padding: 1rem 1.5rem;
            border-radius: 50px;
            box-shadow: 0 12px 30px rgba(201,169,97,0.22), inset 0 0 0 1px rgba(255,255,255,0.8);
            display: flex;
            align-items: center;
            gap: 1rem;
            animation: float-cloud 5s ease-in-out infinite;
            z-index: 20;
            border: 2px solid var(--accent-light);
        }
        .cloud-bonus .icon {
            font-size: 1.8rem;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            flex-shrink: 0;
        }
        .cloud-bonus .text { display: flex; flex-direction: column; }
        .cloud-bonus .text strong {
            color: var(--primary);
            font-family: 'Syne', sans-serif;
            font-size: 1.05rem;
            line-height: 1.2;
            letter-spacing: -0.5px;
        }
        .cloud-bonus .text span {
            color: var(--accent-dark);
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.4px;
            text-transform: uppercase;
        }
        .floating-badge {
            position: absolute;
            bottom: 25px; left: -15px;
            background: white;
            padding: 1rem 1.25rem;
            border-radius: 18px;
            box-shadow: var(--shadow-lg);
            display: flex;
            align-items: center;
            gap: 0.85rem;
            animation: float 6s ease-in-out infinite;
            z-index: 10;
            border: 1px solid var(--border-color);
        }
        .badge-icon {
            width: 46px; height: 46px;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
            border-radius: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.35rem;
            box-shadow: var(--shadow-gold);
            flex-shrink: 0;
        }
        .badge-text h4 { font-size: 0.9rem; margin: 0; font-family: 'Syne'; }
        .badge-text p { font-size: 0.72rem; color: var(--text-muted); margin: 0; font-family: 'Outfit'; }

        /* ============ STATS BAR ============ */
        .stats-bar {
            background: var(--primary);
            color: white;
            padding: 2.75rem 0;
            position: relative;
            overflow: hidden;
        }
        .stats-bar::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 20% 50%, rgba(201,169,97,0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(201,169,97,0.1) 0%, transparent 50%);
            pointer-events: none;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
            position: relative;
            z-index: 1;
        }
        @media(min-width: 640px) { .stats-grid { grid-template-columns: repeat(4, 1fr); } }
        .stat-item { text-align: center; padding: 0.75rem; }
        .stat-number {
            font-family: 'Syne';
            font-size: clamp(1.8rem, 4vw, 2.8rem);
            font-weight: 800;
            background: linear-gradient(135deg, var(--accent-light) 0%, var(--accent) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
            margin-bottom: 0.4rem;
        }
        .stat-label {
            font-size: 0.78rem;
            color: #b0b0b0;
            letter-spacing: 0.8px;
            text-transform: uppercase;
        }

        /* ============ SECTION COMMONS ============ */
        .section-label {
            display: inline-block;
            font-size: 0.72rem;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--accent);
            font-weight: 700;
            margin-bottom: 0.85rem;
        }
        .section-label::before { content: '— '; }
        .section-label::after { content: ' —'; }
        .section-header {
            text-align: center;
            margin-bottom: 3.5rem;
            max-width: 750px;
            margin-inline: auto;
        }
        .section-header h2 {
            font-size: clamp(1.6rem, 3.5vw, 2.6rem);
            margin-bottom: 0.85rem;
            line-height: 1.1;
        }
        .section-header p { color: var(--text-muted); font-size: 1.05rem; }

        /* ============ FEATURES ============ */
        .features {
            padding: 6rem 0;
            background: var(--bg-subtle);
        }
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1.75rem;
        }
        .feature-card {
            background: white;
            padding: 2.5rem 1.75rem;
            border-radius: 22px;
            transition: all 0.4s ease;
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }
        .feature-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 3px;
            background: linear-gradient(90deg, var(--accent), var(--accent-dark));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }
        .feature-card:hover { transform: translateY(-7px); box-shadow: var(--shadow-lg); border-color: rgba(201,169,97,0.3); }
        .feature-card:hover::before { transform: scaleX(1); }
        .feature-icon-wrap {
            width: 64px; height: 64px;
            background: linear-gradient(135deg, var(--bg-cream) 0%, var(--bg-subtle) 100%);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            transition: all 0.4s ease;
            border: 1px solid var(--border-color);
        }
        .feature-card:hover .feature-icon-wrap {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
            transform: rotate(-5deg) scale(1.05);
        }
        .feature-icon { font-size: 1.85rem; transition: transform 0.4s ease; }
        .feature-card:hover .feature-icon { filter: brightness(0) invert(1); }
        .feature-card h3 { font-size: 1.25rem; margin-bottom: 0.65rem; }
        .feature-card p { color: var(--text-muted); font-size: 0.92rem; line-height: 1.7; }
        .feature-number {
            position: absolute;
            top: 1.25rem; right: 1.25rem;
            font-family: 'Syne';
            font-size: 2.25rem;
            font-weight: 800;
            color: var(--bg-subtle);
            line-height: 1;
        }

        /* ============ PROCESS ============ */
        .process-section { padding: 6rem 0; background: var(--bg-white); }
        .process-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
            position: relative;
        }
        @media(min-width: 640px) { .process-grid { grid-template-columns: repeat(2, 1fr); } }
        @media(min-width: 1024px) { .process-grid { grid-template-columns: repeat(4, 1fr); } }
        .process-step { text-align: center; padding: 1.25rem; position: relative; }
        .process-step::after {
            content: '→';
            position: absolute;
            right: -12px; top: 2.75rem;
            color: var(--accent);
            font-size: 1.4rem;
            display: none;
        }
        @media(min-width: 1024px) { .process-step:not(:last-child)::after { display: block; } }
        .process-number {
            width: 76px; height: 76px;
            margin: 0 auto 1.25rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: var(--accent);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Syne';
            font-size: 1.85rem;
            font-weight: 800;
            box-shadow: var(--shadow-md);
            border: 3px solid white;
            position: relative;
        }
        .process-number::before {
            content: '';
            position: absolute;
            inset: -8px;
            border: 2px dashed var(--accent);
            border-radius: 50%;
            opacity: 0.3;
        }
        .process-step h4 { font-size: 1.05rem; margin-bottom: 0.45rem; }
        .process-step p { color: var(--text-muted); font-size: 0.88rem; }

        /* ============ GALLERY ============ */
        .gallery { padding: 6rem 0; background: var(--bg-cream); }
        .bento-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-auto-rows: 260px;
            gap: 1.25rem;
        }
        .bento-item {
            border-radius: 22px;
            overflow: hidden;
            position: relative;
            cursor: pointer;
            box-shadow: var(--shadow-sm);
            transition: all 0.4s ease;
            background: linear-gradient(135deg, #1a1a1a 0%, #c9a961 100%);
        }
        .bento-item:hover { transform: translateY(-5px); box-shadow: var(--shadow-lg); }
        .bento-item:nth-child(1) { grid-column: span 2; grid-row: span 2; }
        .bento-item:nth-child(2) { grid-column: span 2; }
        .bento-item:nth-child(3),
        .bento-item:nth-child(4) { grid-column: span 1; }
        .gallery-img {
            width: 100%; height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.6s ease;
        }
        .bento-item:hover .gallery-img { transform: scale(1.08); }
        .bento-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.2) 50%, transparent 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
            display: flex;
            align-items: flex-end;
            padding: 1.5rem;
            z-index: 2;
        }
        .bento-item:hover .bento-overlay { opacity: 1; }
        .bento-caption { color: white; transform: translateY(18px); transition: transform 0.4s ease; }
        .bento-item:hover .bento-caption { transform: translateY(0); }
        .bento-caption .tag {
            display: inline-block;
            background: var(--accent);
            color: var(--primary);
            padding: 0.2rem 0.65rem;
            border-radius: 100px;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            margin-bottom: 0.6rem;
        }
        .bento-caption h4 { font-size: 1.1rem; margin-bottom: 0.2rem; }
        .bento-caption p { font-size: 0.82rem; opacity: 0.9; }

        /* ============ COTIZADOR ============ */
        .cotizador-section {
            padding: 6rem 0;
            background: var(--primary);
            color: white;
            border-radius: 36px 36px 0 0;
            position: relative;
            overflow: hidden;
        }
        .cotizador-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 20% 30%, rgba(201,169,97,0.08) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(201,169,97,0.05) 0%, transparent 50%);
            pointer-events: none;
        }
        .cotizador-section .section-header p { color: #a0a0a0; }
        .cotizador-section .section-label { color: var(--accent-light); }
        .wizard-wrapper {
            max-width: 700px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }
        .wizard-form {
            background: white;
            border-radius: 26px;
            padding: 0.75rem;
            box-shadow: 0 30px 80px rgba(0,0,0,0.4);
            color: var(--primary);
        }
        .step-indicators {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            padding: 1.75rem 1.75rem 0;
        }
        .step-dot {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            flex: 1;
            max-width: 140px;
        }
        .step-dot .dot {
            width: 30px; height: 30px;
            border-radius: 50%;
            background: var(--bg-subtle);
            color: var(--text-muted);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Syne';
            font-weight: 700;
            font-size: 0.82rem;
            flex-shrink: 0;
            border: 2px solid var(--border-color);
            transition: all 0.3s ease;
        }
        .step-dot.active .dot {
            background: var(--primary);
            color: var(--accent);
            border-color: var(--primary);
            transform: scale(1.1);
        }
        .step-dot.completed .dot {
            background: var(--accent);
            color: white;
            border-color: var(--accent);
        }
        .step-dot .label {
            font-size: 0.72rem;
            color: var(--text-muted);
            font-weight: 600;
            display: none;
        }
        @media(min-width: 480px) { .step-dot .label { display: block; } }
        .step-dot.active .label { color: var(--primary); }
        .progress-container {
            width: calc(100% - 3.5rem);
            margin: 1.25rem auto 0;
            height: 3px;
            background: #f0f0f0;
            border-radius: 10px;
            overflow: hidden;
        }
        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--accent), var(--accent-dark));
            width: 33.33%;
            transition: width 0.4s ease;
            border-radius: 10px;
        }
        .step-content {
            display: none;
            padding: 2rem 2.25rem 2.75rem;
            animation: fadeIn 0.4s ease-out;
        }
        .step-content.active { display: block; }
        .step-title { font-size: 1.65rem; margin-bottom: 0.4rem; }
        .step-subtitle { color: var(--text-muted); margin-bottom: 1.75rem; font-size: 0.92rem; }
        .form-group { margin-bottom: 1.35rem; }
        .form-label {
            display: block;
            font-size: 0.82rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--primary);
            letter-spacing: 0.3px;
        }
        .form-input {
            width: 100%;
            padding: 1.05rem 1.15rem;
            border: 2px solid var(--border-color);
            border-radius: 13px;
            font-family: 'Outfit';
            font-size: 0.97rem;
            transition: all 0.3s;
            background: var(--bg-subtle);
            -webkit-appearance: none;
        }
        .form-input:focus {
            outline: none;
            border-color: var(--accent);
            background: white;
            box-shadow: 0 0 0 4px rgba(201,169,97,0.1);
        }
        .form-input::placeholder { color: #b5b5b5; }
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        @media(min-width: 520px) { .grid-2 { grid-template-columns: 1fr 1fr; gap: 1.25rem; } }
        .stepper-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--bg-subtle);
            padding: 0.4rem;
            border-radius: 13px;
            border: 2px solid var(--border-color);
            transition: all 0.3s;
        }
        .stepper-group:focus-within { border-color: var(--accent); }
        .btn-stepper {
            width: 42px; height: 42px;
            border-radius: 9px;
            border: none;
            background: white;
            font-size: 1.15rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: var(--shadow-sm);
            color: var(--primary);
            flex-shrink: 0;
            -webkit-tap-highlight-color: transparent;
        }
        .btn-stepper:hover { background: var(--primary); color: var(--accent); transform: scale(1.05); }
        .stepper-value {
            font-size: 1.25rem;
            font-weight: 700;
            width: 46px;
            text-align: center;
            border: none;
            background: transparent;
            pointer-events: none;
            color: var(--primary);
            font-family: 'Syne';
            flex-shrink: 0;
        }
        .wizard-footer {
            padding: 1.35rem 2.25rem;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 0.85rem;
            flex-wrap: wrap;
        }
        .btn {
            padding: 0.95rem 1.75rem;
            border-radius: 13px;
            font-family: 'Syne';
            font-weight: 700;
            font-size: 0.92rem;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            letter-spacing: 0.4px;
            -webkit-tap-highlight-color: transparent;
        }
        .btn-back {
            background: transparent;
            color: var(--text-muted);
            border: 2px solid var(--border-color);
        }
        .btn-back:hover { background: var(--border-color); color: var(--primary); }
        .btn-next, .btn-submit {
            background: var(--primary);
            color: white;
            flex: 1;
            min-width: 0;
            position: relative;
            overflow: hidden;
        }
        @media(min-width: 480px) { .btn-next, .btn-submit { flex: unset; min-width: 180px; } }
        .btn-next:hover, .btn-submit:hover {
            background: var(--accent);
            transform: translateY(-2px);
            box-shadow: var(--shadow-gold);
        }
        .btn-submit.loading { opacity: 0.7; cursor: wait; }
        .form-error { color: var(--error); font-size: 0.78rem; margin-top: 0.4rem; display: none; }
        .form-error.show { display: block; }
        .input-error { border-color: var(--error) !important; }

        /* ============ RESULTS ============ */
        .results-container {
            max-width: 1200px;
            margin: 3.5rem auto 0;
            padding: 0 1.5rem;
            display: none;
            position: relative;
            z-index: 1;
        }
        .results-container.visible { display: block; animation: fadeInUp 0.8s ease forwards; }
        .plans-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.75rem;
            margin-top: 2.5rem;
        }
        @media(min-width: 900px) { .plans-grid { grid-template-columns: repeat(3, 1fr); align-items: start; } }
        .plan-card {
            background: white;
            border-radius: 22px;
            padding: 2.25rem;
            border: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            color: var(--primary);
            transition: all 0.3s;
            position: relative;
        }
        .plan-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-lg); }
        .plan-card.experto {
            border: 2px solid var(--accent);
            box-shadow: 0 25px 55px rgba(0,0,0,0.28);
            background: linear-gradient(180deg, white 0%, var(--bg-cream) 100%);
        }
        @media(min-width: 900px) { .plan-card.experto { transform: scale(1.03); } }
        @media(min-width: 900px) { .plan-card.experto:hover { transform: scale(1.03) translateY(-5px); } }
        .plan-card.experto::before {
            content: '⭐ El Más Elegido';
            position: absolute;
            top: -14px; left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
            color: white;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 7px 18px;
            border-radius: 100px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            box-shadow: var(--shadow-gold);
            white-space: nowrap;
        }
        .plan-name { font-size: 1.4rem; margin-bottom: 0.2rem; text-transform: capitalize; }
        .plan-tagline { font-size: 0.82rem; color: var(--text-muted); margin-bottom: 1.25rem; }
        .plan-price {
            font-size: 2rem;
            margin-top: 0.4rem;
            letter-spacing: -0.8px;
            line-height: 1;
            color: var(--primary);
        }
        .plan-card.experto .plan-price {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .plan-price-m2 {
            font-size: 0.82rem;
            color: var(--text-muted);
            font-family: 'Outfit';
            margin-top: 0.4rem;
            margin-bottom: 1.75rem;
            padding-bottom: 1.25rem;
            border-bottom: 1px solid var(--border-color);
        }
        .plan-features { list-style: none; margin-bottom: 1.75rem; flex-grow: 1; }
        .plan-features li {
            display: flex;
            align-items: flex-start;
            gap: 0.65rem;
            margin-bottom: 0.85rem;
            font-size: 0.92rem;
            color: #444;
        }
        .plan-features li .check-icon {
            width: 19px; height: 19px;
            border-radius: 50%;
            background: rgba(201,169,97,0.15);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: var(--accent);
            font-size: 0.68rem;
        }
        
        .btn-ver-desglose {
            background: transparent;
            border: 1.5px solid var(--border-color);
            color: var(--primary);
            padding: 0.85rem 1rem;
            border-radius: 12px;
            font-family: 'Syne';
            font-weight: 700;
            font-size: 0.85rem;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s;
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-ver-desglose:hover {
            border-color: var(--accent);
            background: var(--bg-subtle);
            color: var(--accent-dark);
        }
        .plan-card.experto .btn-ver-desglose {
            border-color: var(--accent-light);
        }

        .btn-select-plan {
            padding: 1.05rem;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 13px;
            font-family: 'Syne';
            font-weight: 700;
            width: 100%;
            cursor: pointer;
            transition: 0.3s;
            letter-spacing: 0.4px;
            font-size: 0.92rem;
            -webkit-tap-highlight-color: transparent;
        }
        .btn-select-plan:hover { background: var(--accent); transform: translateY(-2px); box-shadow: var(--shadow-gold); }
        .plan-card.experto .btn-select-plan {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
            box-shadow: var(--shadow-gold);
        }
        .plan-card.experto .btn-select-plan:hover { background: var(--primary); }

        /* ============ MODAL DESGLOSE (PÁGINA COMPLETA) ============ */
        .modal-overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.75);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 1rem;
        }
        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        .modal-content {
            background: var(--bg-subtle);
            width: 100%;
            max-width: 1100px;
            max-height: 95vh;
            border-radius: 28px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.5);
            display: flex;
            flex-direction: column;
            transform: translateY(40px) scale(0.98);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            border: 1px solid rgba(201,169,97,0.3);
        }
        .modal-overlay.active .modal-content {
            transform: translateY(0) scale(1);
        }
        .modal-header {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            position: relative;
            z-index: 10;
        }
        .modal-header h3 {
            font-size: 1.5rem;
            color: var(--primary);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .modal-header h3 span {
            background: var(--accent);
            color: white;
            padding: 0.2rem 0.75rem;
            border-radius: 100px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .modal-close {
            background: var(--bg-cream);
            border: 1px solid var(--border-color);
            width: 42px; height: 42px;
            border-radius: 50%;
            font-size: 1.8rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            transition: all 0.3s ease;
            line-height: 1;
        }
        .modal-close:hover {
            background: var(--error);
            color: white;
            border-color: var(--error);
            transform: rotate(90deg);
        }
        .modal-body {
            padding: 2.5rem 2rem;
            overflow-y: auto;
            flex-grow: 1;
        }
        .modal-body::-webkit-scrollbar { width: 8px; }
        .modal-body::-webkit-scrollbar-track { background: var(--bg-subtle); }
        .modal-body::-webkit-scrollbar-thumb { background: var(--accent); border-radius: 10px; }
        
        .modal-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.25rem;
        }
        .modal-item-card {
            background: white;
            border-radius: 18px;
            padding: 1.25rem;
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
            display: flex;
            gap: 1.15rem;
            align-items: flex-start;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .modal-item-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
            border-color: rgba(201,169,97,0.4);
        }
        
        /* Imagen dentro del card con indicador de hover (lupa) */
        .modal-item-img {
            width: 75px; 
            height: 75px;
            background: var(--bg-cream);
            border-radius: 12px;
            flex-shrink: 0;
            border: 1px solid rgba(201,169,97,0.3);
            overflow: hidden;
            position: relative;
            cursor: pointer;
        }
        .modal-item-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .modal-item-img::after {
            content: '🔍';
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .modal-item-img:hover::after {
            opacity: 1;
        }
        
        .modal-item-text {
            flex: 1;
        }
        .modal-item-text h4 {
            font-size: 1.05rem;
            color: var(--primary);
            margin-bottom: 0.35rem;
            font-family: 'Syne';
            line-height: 1.2;
        }
        .modal-item-text p {
            font-size: 0.85rem;
            color: var(--text-muted);
            line-height: 1.5;
            margin: 0;
        }

        /* ============ LIGHTBOX (IMAGEN GIGANTE) ============ */
        .lightbox-overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.9);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            z-index: 10000; /* Siempre encima de todo */
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            padding: 1rem;
        }
        .lightbox-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        .lightbox-close {
            position: absolute;
            top: 20px; right: 20px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            width: 50px; height: 50px;
            border-radius: 50%;
            font-size: 2rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            z-index: 10001;
        }
        .lightbox-close:hover {
            background: var(--error);
            border-color: var(--error);
            transform: rotate(90deg);
        }
        .lightbox-content {
            position: relative;
            max-width: 90vw;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            transform: scale(0.95);
            transition: transform 0.3s ease;
        }
        .lightbox-overlay.active .lightbox-content {
            transform: scale(1);
        }
        .lightbox-content img {
            max-width: 100%;
            max-height: 75vh;
            object-fit: contain;
            border-radius: 12px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
            border: 2px solid var(--accent);
        }
        .lightbox-content h4 {
            color: white;
            margin-top: 1rem;
            font-size: 1.25rem;
            text-align: center;
            font-family: 'Syne';
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* ============ FAQ ============ */
        .faq-section { padding: 6rem 0; background: var(--bg-white); }
        .faq-container { max-width: 800px; margin: 0 auto; }
        .faq-item { border-bottom: 1px solid var(--border-color); padding: 1.35rem 0; }
        .faq-item summary {
            cursor: pointer;
            font-family: 'Syne';
            font-weight: 700;
            font-size: 1.05rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            list-style: none;
            padding: 0.4rem 0;
            transition: color 0.3s;
            gap: 1rem;
        }
        .faq-item summary::-webkit-details-marker { display: none; }
        .faq-item summary:hover { color: var(--accent); }
        .faq-item summary::after {
            content: '+';
            font-size: 1.7rem;
            color: var(--accent);
            font-weight: 300;
            line-height: 1;
            flex-shrink: 0;
        }
        .faq-item[open] summary::after { content: '−'; }
        .faq-answer { padding: 0.85rem 0 0.4rem; color: var(--text-muted); line-height: 1.72; font-size: 0.95rem; }

        /* ============ FINAL CTA ============ */
        .final-cta {
            padding: 5.5rem 0;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .final-cta::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 30% 30%, rgba(201,169,97,0.15) 0%, transparent 50%),
                radial-gradient(circle at 70% 70%, rgba(201,169,97,0.1) 0%, transparent 50%);
            pointer-events: none;
        }
        .final-cta-content {
            position: relative;
            z-index: 1;
            max-width: 680px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }
        .final-cta h2 { 
            font-size: clamp(1.65rem, 3.5vw, 2.65rem); 
            margin-bottom: 0.85rem; 
            line-height: 1.1; 
        }
        .final-cta p { color: #b0b0b0; font-size: 1.05rem; margin-bottom: 2.25rem; }

        /* ============ FOOTER ============ */
        footer { background: #050505; color: white; padding: 3.5rem 1.5rem 1.75rem; }
        .footer-grid {
            max-width: 1280px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr;
            gap: 2.5rem;
            margin-bottom: 2.5rem;
        }
        @media(min-width: 768px) { .footer-grid { grid-template-columns: 2fr 1fr 1fr 1fr; } }
        .footer-brand h3 { font-size: 1.4rem; margin-bottom: 0.4rem; }
        .footer-brand .tag { color: var(--accent); font-size: 0.72rem; letter-spacing: 2px; margin-bottom: 0.85rem; display: block; }
        .footer-brand p { color: #888; font-size: 0.87rem; line-height: 1.72; max-width: 310px; margin-bottom: 0.4rem; }
        .footer-col h4 { font-size: 0.87rem; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 1.25rem; color: var(--accent); }
        .footer-col ul { list-style: none; }
        .footer-col ul li { margin-bottom: 0.65rem; }
        .footer-col a { color: #aaa; text-decoration: none; font-size: 0.87rem; transition: color 0.3s; }
        .footer-col a:hover { color: var(--accent); }
        .footer-bottom {
            max-width: 1280px;
            margin: 0 auto;
            padding-top: 1.75rem;
            border-top: 1px solid #222;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .footer-bottom p { color: #666; font-size: 0.82rem; }
        .social-links { display: flex; gap: 0.85rem; }
        .social-links a {
            width: 38px; height: 38px;
            border-radius: 50%;
            background: #151515;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #888;
            transition: all 0.3s;
            border: 1px solid #222;
        }
        .social-links a:hover { background: var(--accent); color: var(--primary); transform: translateY(-2px); }

        /* ============ WHATSAPP FLOAT ============ */
        .whatsapp-float {
            position: fixed;
            bottom: 22px; right: 22px;
            width: 58px; height: 58px;
            background: #25D366;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            box-shadow: 0 8px 25px rgba(37,211,102,0.4);
            z-index: 999;
            transition: all 0.3s;
            animation: pulse-gold 2.5s infinite;
        }
        .whatsapp-float:hover { transform: scale(1.1); }
        .whatsapp-float svg { width: 28px; height: 28px; }

        /* ============================================================
           RESPONSIVE
        ============================================================ */
        @media(max-width: 1023px) {
            .hero { padding: 9rem 0 4rem; min-height: auto; }
            .hero-grid { grid-template-columns: 1fr; gap: 2.5rem; }
            .hero-visual { height: 420px; max-width: 600px; margin: 0 auto; width: 100%; }
            .cloud-bonus { top: -14px; right: 10px; padding: 0.85rem 1.2rem; border-radius: 36px; }
            .floating-badge { left: 10px; bottom: 12px; }
            
            .modal-content { max-height: 90vh; }
        }

        @media(max-width: 768px) {
            .container { padding: 0 1.1rem; }
            .top-bar { font-size: 0.7rem; padding: 0.5rem 0.75rem; line-height: 1.5; }
            .nav-container { padding: 0.8rem 1.1rem; }
            .brand-img { height: 36px; }
            .brand-text span:first-child { font-size: 1.08rem; }
            .hero { padding: 8.5rem 0 3rem; }
            .hero-content h1 { font-size: clamp(1.6rem, 7vw, 2.3rem); line-height: 1.12; letter-spacing: -0.02em; }
            .hero-content p { font-size: 0.97rem; max-width: 100%; }
            .hero-cta-group { flex-direction: column; align-items: stretch; gap: 0.75rem; }
            .hero-cta-group .btn-hero { width: 100%; padding: 0.95rem 1.25rem; font-size: 0.85rem; border-radius: 50px; }
            .hero-trust { gap: 1.25rem; justify-content: flex-start; }
            .trust-item .number { font-size: 1.55rem; }
            .trust-item .label { font-size: 0.72rem; }
            .hero-visual { height: 320px; border-radius: 20px; max-width: 100%; }
            .hero-visual .img-container { border-radius: 20px; }
            .cloud-bonus { top: -10px; right: 8px; padding: 0.65rem 0.95rem; gap: 0.55rem; border-radius: 24px; }
            .cloud-bonus .icon { font-size: 1.25rem; }
            .cloud-bonus .text strong { font-size: 0.85rem; }
            .cloud-bonus .text span { font-size: 0.62rem; }
            .floating-badge { left: 8px; bottom: 8px; padding: 0.65rem 0.9rem; border-radius: 14px; gap: 0.55rem; }
            .badge-icon { width: 34px; height: 34px; font-size: 0.95rem; border-radius: 9px; }
            .badge-text h4 { font-size: 0.75rem; }
            .badge-text p { font-size: 0.65rem; }
            .stats-bar { padding: 1.75rem 0; }
            .stats-grid { gap: 0.85rem; }
            .stat-number { font-size: 1.75rem; }
            .stat-label { font-size: 0.7rem; }
            .features { padding: 3.75rem 0; }
            .features-grid { grid-template-columns: 1fr; }
            .feature-card { padding: 1.85rem 1.4rem; }
            .feature-icon-wrap { width: 56px; height: 56px; margin-bottom: 1.15rem; }
            .feature-icon { font-size: 1.6rem; }
            .feature-card h3 { font-size: 1.12rem; }
            .process-section { padding: 3.75rem 0; }
            .process-grid { grid-template-columns: repeat(2, 1fr); gap: 1.25rem; }
            .process-number { width: 64px; height: 64px; font-size: 1.6rem; }
            .gallery { padding: 3.75rem 0; }
            .bento-overlay { padding: 1rem; }
            .bento-grid { grid-template-columns: 1fr 1fr; grid-auto-rows: 170px; gap: 0.65rem; }
            .bento-item:nth-child(1) { grid-column: span 2; grid-row: span 1; }
            .bento-item:nth-child(2) { grid-column: span 2; }
            .bento-item:nth-child(3), .bento-item:nth-child(4) { grid-column: span 1; }
            .bento-caption h4 { font-size: 0.88rem; }
            .bento-caption p { font-size: 0.75rem; }
            .section-header { margin-bottom: 2.25rem; }
            .section-header h2 { font-size: clamp(1.4rem, 5.5vw, 1.8rem); }
            .section-header p { font-size: 0.92rem; }
            .cotizador-section { padding: 3.75rem 0; border-radius: 24px 24px 0 0; }
            .step-indicators { padding: 1.25rem 0.85rem 0; }
            .step-content { padding: 1.4rem 1.15rem 2rem; }
            .wizard-form { padding: 0.4rem; }
            .step-title { font-size: 1.35rem; }
            .step-subtitle { font-size: 0.85rem; margin-bottom: 1.35rem; }
            .wizard-footer { padding: 1.1rem 1.15rem; gap: 0.65rem; }
            .btn-back { width: 100%; order: 2; text-align: center; }
            .btn-next, .btn-submit { width: 100%; order: 1; min-width: unset; }
            .results-container { padding: 0 1rem; }
            .plans-grid { grid-template-columns: 1fr; gap: 1.5rem; }
            .plan-card.experto { transform: none !important; margin-top: 1.25rem; }
            .plan-card { padding: 1.85rem 1.35rem; }
            .plan-price { font-size: 1.75rem; }
            .faq-section { padding: 3.75rem 0; }
            .faq-item summary { font-size: 0.97rem; }
            .final-cta { padding: 3.75rem 0; }
            .final-cta p { font-size: 0.92rem; }
            footer { padding: 2.75rem 1.1rem 1.5rem; }
            .footer-grid { grid-template-columns: 1fr; gap: 2rem; }
            .footer-bottom { flex-direction: column; text-align: center; align-items: center; }
            .whatsapp-float { width: 52px; height: 52px; bottom: 18px; right: 18px; }
            .whatsapp-float svg { width: 25px; height: 25px; }

            /* Modal Móvil */
            .modal-overlay { padding: 0; }
            .modal-content { max-height: 100vh; border-radius: 0; }
            .modal-header { padding: 1.25rem; }
            .modal-header h3 { font-size: 1.2rem; }
            .modal-body { padding: 1.5rem 1rem; }
            .modal-grid { grid-template-columns: 1fr; }
            
            /* Lightbox Móvil */
            .lightbox-close { top: 10px; right: 10px; width: 40px; height: 40px; font-size: 1.5rem; }
            .lightbox-content h4 { font-size: 1rem; }
        }

        @media(max-width: 480px) {
            .container { padding: 0 0.9rem; }
            .top-bar { font-size: 0.65rem; padding: 0.45rem 0.5rem; line-height: 1.55; }
            .brand-img { height: 30px; }
            .brand-text span:first-child { font-size: 0.95rem; }
            .brand-text span:last-child { font-size: 0.52rem; }
            .nav-container { padding: 0.7rem 0.9rem; }
            .hero { padding: 7.5rem 0 2.5rem; }
            .hero-content h1 { font-size: clamp(1.45rem, 6.5vw, 1.8rem); letter-spacing: -0.015em; }
            .hero-tag { font-size: 0.68rem; padding: 0.38rem 0.75rem; }
            .cloud-bonus { display: none; }
            .floating-badge { display: none; }
            .bento-grid { grid-template-columns: 1fr; grid-auto-rows: 200px; gap: 0.65rem; }
            .bento-item:nth-child(1), .bento-item:nth-child(2), .bento-item:nth-child(3), .bento-item:nth-child(4) { grid-column: span 1; grid-row: span 1; }
            .process-grid { grid-template-columns: 1fr; gap: 1rem; }
            .cotizador-section { border-radius: 16px 16px 0 0; }
            .step-content { padding: 1.15rem 0.85rem 1.65rem; }
            .step-title { font-size: 1.2rem; }
            .step-subtitle { font-size: 0.82rem; }
            .form-input { padding: 0.85rem 0.95rem; font-size: 0.88rem; }
            .wizard-footer { padding: 0.95rem 0.85rem; }
            .plan-card { padding: 1.5rem 1.1rem; }
            .plan-price { font-size: 1.55rem; }
            footer { padding: 2.25rem 0.9rem 1.35rem; }
            .whatsapp-float { width: 48px; height: 48px; bottom: 14px; right: 14px; }
            .whatsapp-float svg { width: 22px; height: 22px; }
        }
    </style>
</head>
<body>

    <header id="mainHeader">
        <div class="top-bar">
            <span>✨ <strong>Oferta especial:</strong> Cotización GRATIS + 5% de descuento en la línea Experto — Hasta fin de mes</span>
        </div>
        <div class="nav-container">
            <a href="/" class="brand-logo">
                <img src="{{ asset('construccion.ico') }}" alt="Escuadr Arq" class="brand-img">
                <div class="brand-text">
                    <span>Escuadr Arq</span>
                    <span>Constructora S.A.S.</span>
                </div>
            </a>
            <nav class="nav-links">
                <a href="{{ route('nuestra.experiencia') }}">Nuestra Experiencia</a>
                <a href="#ventajas">Nuestra Esencia</a>
                <a href="#proceso">Proceso</a>
                <a href="#galeria">Proyectos</a>
                <a href="#cotizador" class="btn-nav-cta"><span>Cotizar ahora</span></a>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <div class="hero-grid">
                <div class="hero-content">
                    <div class="hero-tag fade-in-up">Constructora certificada en Bogotá</div>

                    <h1 class="fade-in-up delay-100">
                        Tu apartamento en
                        <span class="serif-italic">obra gris,</span>
                        <br class="br-desktop" />
                        transformado en <span class="accent-text">hogar.</span>
                    </h1>

                    <p class="fade-in-up delay-200">
                        Diseñamos, presupuestamos y construimos los acabados de tu nuevo hogar con transparencia total. Sin sorpresas, sin estrés — sólo resultados impecables.
                    </p>

                    <div class="hero-cta-group fade-in-up delay-300">
                        <a href="#cotizador" class="btn-hero btn-hero-primary">
                            Acabados para tu apto nuevo en obra gris <span class="arrow">→</span>
                        </a>
                        <a href="https://wa.me/573224307053?text=Hola,%20me%20gustar%C3%ADa%20cotizar%20otro%20tipo%20de%20remodelaci%C3%B3n" target="_blank" class="btn-hero btn-hero-secondary">
                            Otro tipo de remodelación
                        </a>
                    </div>

                    <div class="hero-trust fade-in-up delay-400">
                        <div class="trust-item">
                            <span class="number accent-text">+27</span>
                            <span class="label">Proyectos entregados</span>
                        </div>
                        <div class="trust-item">
                            <span class="number accent-text">5+</span>
                            <span class="label">Años de trayectoria</span>
                        </div>
                        <div class="trust-item">
                            <span class="number accent-text">100%</span>
                            <span class="label">Transparencia</span>
                        </div>
                    </div>
                </div>

                <div class="hero-visual">
                    <div class="cloud-bonus">
                        <div class="icon">✨</div>
                        <div class="text">
                            <strong>Recibe un obsequio</strong>
                            <span>por contratar nuestros servicios</span>
                        </div>
                    </div>

                    <div class="img-container">
                        <img src="{{ asset('casa1.ico') }}" alt="Proyecto destacado Escuadr Arq">
                    </div>

                    <div class="floating-badge">
                        <div class="badge-icon">✓</div>
                        <div class="badge-text">
                            <h4>Garantía Escuadr Arq</h4>
                            <p>100% Calidad Asegurada</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="stats-bar">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">27+</div>
                    <div class="stat-label">Proyectos Entregados</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">5+</div>
                    <div class="stat-label">Años de Experiencia</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">48h</div>
                    <div class="stat-label">Respuesta Garantizada</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">100%</div>
                    <div class="stat-label">Transparencia Total</div>
                </div>
            </div>
        </div>
    </section>

    <section id="ventajas" class="features">
        <div class="container">
            <div class="section-header" style="max-width: 900px;">
                <span class="section-label">Nuestra Esencia</span>
                <h2>Construimos tu <span class="accent-text">futuro</span></h2>
                <p style="margin-bottom: 1rem; color: var(--primary);"><strong>Visión:</strong> Reconocimiento en toda Bogotá como solución a empresas que requieren la Promoción, gerencia, ventas, y construcción de proyectos inmobiliarios.</p>
                <p style="margin-bottom: 2rem; color: var(--primary);"><strong>Misión:</strong> Resolver necesidades en temas inmobiliarios y de construcción en Arquitectura e Ingeniería.</p>
                <p style="font-family: 'Playfair Display', serif; font-size: 1.25rem; color: var(--accent-dark); font-style: italic;">"Ser la mejor empresa, es asegurarse de tener los mejores clientes"</p>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-number">01</div>
                    <div class="feature-icon-wrap"><span class="feature-icon">⚡</span></div>
                    <h3>Cotización Instantánea</h3>
                    <p>No esperes días por un presupuesto. Nuestro algoritmo calcula el valor de tu obra basado en el área y volumetría en tiempo real.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-number">02</div>
                    <div class="feature-icon-wrap"><span class="feature-icon">📐</span></div>
                    <h3>Diseño a la Medida</h3>
                    <p>Tres líneas de acabados diseñadas por arquitectos expertos, desde lo esencial hasta detalles de alta gama en Quarztone y maderas.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-number">03</div>
                    <div class="feature-icon-wrap"><span class="feature-icon">🛡️</span></div>
                    <h3>Cero Imprevistos</h3>
                    <p>Nuestras propuestas son claras y directas. Lo que ves es lo que inviertes, sin costos ocultos de ningún tipo.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="proceso" class="process-section">
        <div class="container">
            <div class="section-header">
                <span class="section-label">Nuestro proceso</span>
                <h2>De la cotización a la <span class="accent-text">entrega</span></h2>
                <p>Un método probado, transparente y sin complicaciones.</p>
            </div>

            <div class="process-grid">
                <div class="process-step">
                    <div class="process-number">1</div>
                    <h4>Cotiza Online</h4>
                    <p>Completa el formulario en 3 pasos y recibe 3 propuestas al instante.</p>
                </div>
                <div class="process-step">
                    <div class="process-number">2</div>
                    <h4>Agendamos Visita</h4>
                    <p>Visitamos tu propiedad para validar detalles y afinar la propuesta.</p>
                </div>
                <div class="process-step">
                    <div class="process-number">3</div>
                    <h4>Firmamos Contrato</h4>
                    <p>Contrato transparente con cronograma, garantías y pagos definidos.</p>
                </div>
                <div class="process-step">
                    <div class="process-number">4</div>
                    <h4>Habita tu Hogar</h4>
                    <p>Construimos, entregamos y celebramos contigo tu nuevo espacio.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="galeria" class="gallery">
        <div class="container">
            <div class="section-header">
                <span class="section-label">Portafolio</span>
                <h2>Nuestros <span class="accent-text">Acabados</span></h2>
                <p>Espacios reales transformados por Escuadr Arq en Bogotá.</p>
            </div>

            <div class="bento-grid">
                <div class="bento-item">
                    <img src="{{ asset('casa5.ico') }}" alt="Cocina de lujo Escuadr Arq" class="gallery-img">
                    <div class="bento-overlay">
                        <div class="bento-caption">
                            <span class="tag">Línea Experto</span>
                            <h4>Cocina Integral en Quarztone</h4>
                            <p>Apartamento 85m²</p>
                        </div>
                    </div>
                </div>
                <div class="bento-item">
                    <img src="{{ asset('casa2.ico') }}" alt="Sala de estar moderna" class="gallery-img">
                    <div class="bento-overlay">
                        <div class="bento-caption">
                            <span class="tag">Línea Estándar</span>
                            <h4>Sala Contemporánea</h4>
                            <p>Apartamento 65m²</p>
                        </div>
                    </div>
                </div>
                <div class="bento-item">
                    <img src="{{ asset('casa4.ico') }}" alt="Baño de lujo con acabados premium" class="gallery-img">
                    <div class="bento-overlay">
                        <div class="bento-caption">
                            <span class="tag">Línea Experto</span>
                            <h4>Baño Premium</h4>
                        </div>
                    </div>
                </div>
                <div class="bento-item">
                    <img src="{{ asset('casa3.ico') }}" alt="Habitación con diseño contemporáneo" class="gallery-img">
                    <div class="bento-overlay">
                        <div class="bento-caption">
                            <span class="tag">Línea Estándar</span>
                            <h4>Habitación Principal</h4>
                            <p>Apartamento 55m²</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="cotizador" class="cotizador-section">
        <div class="container">
            <div class="section-header">
                <span class="section-label">Cotizador inteligente</span>
                <h2 style="color: white;">Descubre el valor de tu <span class="accent-text">obra</span></h2>
                <p>Completa estos 3 simples pasos y obtén 3 opciones de diseño instantáneas.</p>
            </div>

            <div id="wizard-box" class="wizard-wrapper">
                <div class="wizard-form">
                    <div class="step-indicators">
                        <div class="step-dot active" data-step-indicator="1">
                            <div class="dot">1</div>
                            <div class="label">Proyecto</div>
                        </div>
                        <div class="step-dot" data-step-indicator="2">
                            <div class="dot">2</div>
                            <div class="label">Distribución</div>
                        </div>
                        <div class="step-dot" data-step-indicator="3">
                            <div class="dot">3</div>
                            <div class="label">Contacto</div>
                        </div>
                    </div>
                    <div class="progress-container"><div class="progress-bar" id="progressBar"></div></div>

                    <form id="cotizacionForm">
                        @csrf
                        <div class="step-content active" data-step="1">
                            <h3 class="step-title">Sobre el proyecto</h3>
                            <p class="step-subtitle">Cuéntanos sobre la propiedad en obra gris.</p>

                            <div class="form-group">
                                <label class="form-label">Nombre del proyecto / conjunto</label>
                                <input type="text" name="nombre_proyecto" class="form-input" placeholder="Ej: Torres del Parque">
                            </div>

                            <div class="grid-2">
                                <div class="form-group">
                                    <label class="form-label">Área Privada (m²) <span style="color:var(--accent)">*</span></label>
                                    <input type="number" name="area_privada" class="form-input" placeholder="Ej: 55.5" step="0.01" required>
                                    <div class="form-error" data-field="area_privada"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Fecha inicio de obras</label>
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
                                        <button type="button" class="btn-stepper" onclick="updateStepper('num_habitaciones', -1)">−</button>
                                        <input type="text" name="num_habitaciones" id="num_habitaciones" class="stepper-value" value="1" readonly required>
                                        <button type="button" class="btn-stepper" onclick="updateStepper('num_habitaciones', 1)">+</button>
                                    </div>
                                    <div class="form-error" data-field="num_habitaciones"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Baños <span style="color:var(--accent)">*</span></label>
                                    <div class="stepper-group">
                                        <button type="button" class="btn-stepper" onclick="updateStepper('num_banos', -1)">−</button>
                                        <input type="text" name="num_banos" id="num_banos" class="stepper-value" value="1" readonly required>
                                        <button type="button" class="btn-stepper" onclick="updateStepper('num_banos', 1)">+</button>
                                    </div>
                                    <div class="form-error" data-field="num_banos"></div>
                                </div>
                            </div>
                        </div>

                        <div class="step-content" data-step="3">
                            <h3 class="step-title">¡Ya casi! 🎉</h3>
                            <p class="step-subtitle">Déjanos tus datos para mostrarte los presupuestos personalizados (Esta información no se enviará al WhatsApp).</p>

                            <div class="grid-2">
                                <div class="form-group">
                                    <label class="form-label">Nombre <span style="color:var(--accent)">*</span></label>
                                    <input type="text" name="nombre" class="form-input" placeholder="Tu nombre" required>
                                    <div class="form-error" data-field="nombre"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Apellido <span style="color:var(--accent)">*</span></label>
                                    <input type="text" name="apellido" class="form-input" placeholder="Tu apellido" required>
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
                            <button type="button" class="btn btn-back" id="btnPrev" style="display: none;">← Atrás</button>
                            <div style="flex-grow: 1;"></div>
                            <button type="button" class="btn btn-next" id="btnNext">Continuar →</button>
                            <button type="submit" class="btn btn-submit" id="btnSubmit" style="display: none;">Calcular Presupuestos ✨</button>
                        </div>
                    </form>
                </div>
            </div>

            <div id="resultados-container" class="results-container">
                <div class="section-header" style="margin-bottom: 2rem;">
                    <span class="section-label">Resultados</span>
                    <h2 style="color: white; font-size: clamp(1.6rem, 3.5vw, 2.2rem);">Tus Opciones de <span class="accent-text">Diseño</span></h2>
                    <p>Basado en las dimensiones de tu inmueble, estas son las propuestas:</p>
                </div>
                <div id="planes-list" class="plans-grid"></div>
            </div>
        </div>
    </section>

    <section class="faq-section">
        <div class="container">
            <div class="section-header">
                <span class="section-label">Preguntas frecuentes</span>
                <h2>Resolvemos tus <span class="accent-text">dudas</span></h2>
                <p>Todo lo que necesitas saber antes de empezar tu proyecto.</p>
            </div>

            <div class="faq-container">
                <details class="faq-item">
                    <summary>¿Qué incluye la obra gris que remodelo con ustedes?</summary>
                    <div class="faq-answer">Nos encargamos de todos los acabados que transforman tu obra gris en un apartamento listo para habitar: pisos, enchapes, carpintería, pintura, cocina, baños, iluminación, griferías y más. Según la línea que elijas, incluimos materiales desde elemental hasta experto.</div>
                </details>
                <details class="faq-item">
                    <summary>¿Cuánto tiempo toma el proceso completo?</summary>
                    <div class="faq-answer">La duración depende del tamaño y la línea seleccionada. En promedio, un apartamento de 55-65 m² toma entre 45 y 75 días calendario una vez firmado el contrato. Te entregamos un cronograma detallado al firmar.</div>
                </details>
                <details class="faq-item">
                    <summary>¿Ofrecen garantía sobre el trabajo realizado?</summary>
                    <div class="faq-answer">Sí. Ofrecemos garantía escrita sobre mano de obra y materiales. Los tiempos de garantía varían según el tipo de acabado, pero siempre cumplimos o superamos los estándares del sector construcción en Colombia.</div>
                </details>
                <details class="faq-item">
                    <summary>¿Puedo personalizar los materiales de la línea que elija?</summary>
                    <div class="faq-answer">Absolutamente. Las líneas (Elemental, Estándar y Experto) son puntos de partida. Durante la visita técnica afinamos cada detalle contigo: colores, texturas, marcas y cualquier preferencia personal.</div>
                </details>
                <details class="faq-item">
                    <summary>¿Trabajan en todo Bogotá y alrededores?</summary>
                    <div class="faq-answer">Nuestro equipo se enfoca y especializa en proyectos dentro de Bogotá. Sin embargo, si su solicitud se encuentra en municipios aledaños como Chía, Cajicá, La Calera, Mosquera, Madrid o Funza, estamos en total disposición de llegar a un acuerdo para atenderlo. Es importante tener en cuenta que, en estos casos, se adicionarán los costos de desplazamiento, lo cual generará un ajuste sobre el precio estimado inicialmente en la cotización del programa.</div>
                </details>
                <details class="faq-item">
                    <summary>¿Qué métodos de pago aceptan?</summary>
                    <div class="faq-answer">Para tu total comodidad, recibimos todo tipo de medios de pago: tarjetas de crédito, tarjetas de débito, transferencias bancarias y dinero en efectivo.</div>
                </details>
            </div>
        </div>
    </section>

    <section class="final-cta">
        <div class="final-cta-content">
            <span class="section-label" style="color: var(--accent-light);">Listo para empezar</span>
            <h2>Tu nuevo hogar está a <span class="accent-text">3 clics de distancia</span></h2>
            <p>Obtén 3 propuestas personalizadas gratis. Sin compromisos, sin letras pequeñas.</p>
            <a href="#cotizador" class="btn-hero btn-hero-primary" style="background: var(--accent); border-color: var(--accent); color: var(--primary);">
                Acabados para tu apto nuevo en obra gris <span class="arrow">→</span>
            </a>
            
            <div style="margin-top: 1.5rem; display: flex; align-items: center; justify-content: center; gap: 0.5rem; color: #e8d5a1; font-size: 0.95rem; font-weight: 500;">
                <span>💳</span>
                <span>Aceptamos todo tipo de pago: Tarjetas de crédito, débito y efectivo.</span>
            </div>
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
                    <li><a href="#ventajas">Por qué nosotros</a></li>
                    <li><a href="#proceso">Nuestro proceso</a></li>
                    <li><a href="#galeria">Portafolio</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Servicios</h4>
                <ul>
                    <li><a href="#cotizador">Línea Elemental</a></li>
                    <li><a href="#cotizador">Línea Estándar</a></li>
                    <li><a href="#cotizador">Línea Experto</a></li>
                    <li><a href="#cotizador">Cotización Online</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Contacto</h4>
                <ul>
                    <li><a href="tel:+573224307053">+57 322 4307053</a></li>
                    <li><a href="mailto:coordinador.proyectos85@gmail.com">coordinador.proyectos85@gmail.com</a></li>
                    <li><a href="#">Bogotá, Colombia</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Constructora Escuadr Arq S.A.S. — Todos los derechos reservados.</p>
            <div class="social-links">
               <a href="https://www.instagram.com/escuadra.disenoy?igsh=azV4OTM1bGtsZ3M5&utm_source=qr" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
    </svg>
</a>
                <a href="#" aria-label="Facebook">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                </a>
                <a href="https://wa.me/573224307053?text=Hola,%20quiero%20cotizar%20mi%20apartamento" aria-label="WhatsApp" target="_blank">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
    </a>
        </div>
    </footer>

    <!-- ============ BOTÓN WHATSAPP FLOTANTE ============ -->
    <a href="https://wa.me/573224307053?text=Hola,%20me%20gustar%C3%ADa%20obtener%20m%C3%A1s%20informaci%C3%B3n" class="whatsapp-float" target="_blank" aria-label="Chat en WhatsApp">
        <svg viewBox="0 0 24 24" fill="currentColor">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
    </a>

    <!-- ============ ESTRUCTURA DEL MODAL GIGANTE (DESGLOSE) ============ -->
    <div id="modalDesglose" class="modal-overlay" onclick="cerrarModal()">
        <div class="modal-content" onclick="event.stopPropagation()">
            <div class="modal-header">
                <h3>Desglose de Obra <span id="modalPlanBadge">Línea</span></h3>
                <button class="modal-close" onclick="cerrarModal()" title="Cerrar ventana">×</button>
            </div>
            <div class="modal-body">
                <div id="modalGrid" class="modal-grid">
                    <!-- Los items se inyectarán aquí vía JS -->
                </div>
            </div>
        </div>
    </div>

    <!-- ============ ESTRUCTURA DEL LIGHTBOX (IMAGEN EXPANDIDA) ============ -->
    <div id="modalImagenOverlay" class="lightbox-overlay" onclick="cerrarImagen()">
        <button class="lightbox-close" onclick="cerrarImagen()" title="Cerrar imagen">×</button>
        <div class="lightbox-content" onclick="event.stopPropagation()">
            <img id="lightboxImg" src="" alt="Vista detallada">
            <h4 id="lightboxTitle"></h4>
        </div>
    </div>

    {{-- ============ JAVASCRIPT ============ --}}
    <script>
        // Función mapeada según los textos e imágenes específicos enviados
        function obtenerImagenCategoria(categoria, descripcion, linea) {
            const desc = (descripcion || '').toLowerCase();
            const cat = (categoria || '').toLowerCase();

            // 1. REGLAS PARA PISOS (primera regla: la imagen que va en el primer recuadro de Pisos)
            if (desc.includes('suministro e instalación piso , nivelacion y cargue de pisos en mortero')) {
                return "{{ asset('pisosmaking.png') }}";
            }
            
            // 2. REGLA PARA LA SEGUNDA IMAGEN DE PISOS (la que estaba originalmente en el primer puesto)
            if (desc.includes('mano de obra instalacion de piso en ceramica y/o piso spc incluye guarda escobas')) {
                return "{{ asset('pisos2elemental.png') }}";
            }
            
            // 3. REGLA PARA MUROS CON LA NUEVA IMAGEN enchapes.png
            if (desc.includes('mano de obra instalacion de ceramica salpicadero de cocina, y zona de lavadero, cabina de ducha')) {
                return "{{ asset('enchapes.png') }}";
            }

            // 4. REGLAS EXCLUSIVAS DE EXPERTO / APARATOS / QUARZTONE
            if (desc.includes('mueble de ropas')) return "{{ asset('mublescuartoexperto.png') }}";
            if (desc.includes('estufa de empotrar')) return "{{ asset('estufaagasvidrio.png') }}";
            if (desc.includes('horno')) return "{{ asset('horno.png') }}";
            if (desc.includes('kit sanitario') || desc.includes('acoflex sanitario')) return "{{ asset('kitacoflex.png') }}";
            if (desc.includes('acoflex lavamanos')) return "{{ asset('kitacoflexlavamanos.png') }}";
            if (desc.includes('lavaplatos radiante')) return "{{ asset('lavaplatoradiante.png') }}";
            if (desc.includes('sencilla gus')) return "{{ asset('griferialavaplatossencilla.png') }}";
            if (desc.includes('kit de instalación completo')) return "{{ asset('kitgriferia.png') }}";
            if (cat.includes('incrustacion') && desc.includes('ducha monocontrol')) return "{{ asset('incrustaciongriferiaducha.png') }}";
            if (desc.includes('ducha monocontrol nott')) return "{{ asset('griferiaducharegadera.png') }}";
            if (desc.includes('mesón de cocina en quarztone')) return "{{ asset('quartzonemesoncocina.png') }}";
            if (desc.includes('barra auxiliar en quarztone')) return "{{ asset('barraauxiliarcocinaquarztone.png') }}";
            if (desc.includes('lavamanos tipo guitarra')) return "{{ asset('quartzonemesonlavamanos.png') }}";
            if (desc.includes('riel spot 3 luces')) return "{{ asset('ilumnacionriel.png') }}";

            // 5. REGLAS DE ESTÁNDAR (que aplican también a Experto si no cambiaron)
            if (desc.includes('closet habitaciones')) {
                // Si es la línea experto, usa la madera profesional, sino la estandar
                if (linea === 'experto') return "{{ asset('mueblesropaaglomeradoprofesional.png') }}";
                return "{{ asset('mueblremadera1estandar.png') }}";
            }
            if (desc.includes('mueble flotado de baño')) return "{{ asset('mueblebañoestandar.png') }}";
            if (desc.includes('división de baño')) return "{{ asset('mueblebañoestandar.png') }}";
            if (desc.includes('mueble alto de cocina')) return "{{ asset('mueblealtococinaestandar.png') }}";
            if (desc.includes('espejo flotado')) return "{{ asset('vidrioflotantebañoestandar.png') }}";
            if (desc.includes('puertas en madera')) return "{{ asset('puertaestandar.png') }}";
            if (desc.includes('barra auxiliar de cocina')) return "{{ asset('mueblealtococinaestandar.png') }}";
            if (desc.includes('campana extractora')) return "{{ asset('estractoraltococina.png') }}";

            // 6. REGLAS DE ELEMENTAL (que son la base para todas)
            if (desc.includes('nivelación y cargue de pisos')) return "{{ asset('pisos1elemental.png') }}";
            if (desc.includes('cerámica salpicadero') || desc.includes('cabina de ducha')) return "{{ asset('pisos2elemental.png') }}";
            if (desc.includes('piso en cerámica') || desc.includes('piso spc')) return "{{ asset('pisos2elemental.png') }}";
            if (desc.includes('drywall plano')) return "{{ asset('techos1elemental.png') }}";
            if (desc.includes('nivelación de paredes') || desc.includes('estuco y pintura')) return "{{ asset('muros2elemental.png') }}";
            if (desc.includes('aseo final') || desc.includes('escombros')) return "{{ asset('aseoelemental.png') }}";

            // 7. FALLBACKS DE SEGURIDAD (Por si el nombre en base de datos cambia un poco)
            if (cat.includes('piso') || desc.includes('piso')) return "{{ asset('pisos1elemental.png') }}";
            if (cat.includes('muro')) return "{{ asset('enchapes.png') }}";
            if (cat.includes('techo')) return "{{ asset('techos1elemental.png') }}";
            if (cat.includes('aseo')) return "{{ asset('aseoelemental.png') }}";
            if (cat.includes('madera') || cat.includes('carpintería')) return "{{ asset('mueblremadera1estandar.png') }}";
            if (cat.includes('cocina')) return "{{ asset('mueblealtococinaestandar.png') }}";
            if (cat.includes('baño') || cat.includes('aparato')) return "{{ asset('kitacoflex.png') }}";
            if (cat.includes('eléctric') || cat.includes('iluminación')) return "{{ asset('ilumnacionriel.png') }}";
            if (cat.includes('grifería')) return "{{ asset('griferiaducharegadera.png') }}";
            if (cat.includes('electrodoméstico')) return "{{ asset('estractoraltococina.png') }}";
            if (cat.includes('vidrio')) return "{{ asset('vidrioflotantebañoestandar.png') }}";
            
            // Si por alguna razón no coincide nada, foto por defecto
            return "{{ asset('foto_default.jpg') }}"; 
        }

        // Variables globales para el Modal
        window.propuestasGlobales = {};

        function abrirModal(tipoPlan) {
            const plan = window.propuestasGlobales[tipoPlan];
            if (!plan) return;

            const modal = document.getElementById('modalDesglose');
            const grid = document.getElementById('modalGrid');
            const badge = document.getElementById('modalPlanBadge');
            
            // Cambiar título
            badge.innerText = `Línea ${plan.tipo}`;
            if(plan.tipo === 'experto') {
                badge.style.background = 'linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%)';
            } else {
                badge.style.background = 'var(--primary)';
            }

            // Limpiar cuadrícula
            grid.innerHTML = '';

            // Generar contenido con IMÁGENES CLICKEABLES
            if (plan.detalle && plan.detalle.length > 0) {
                plan.detalle.forEach(item => {
                    // Pasamos la categoría, la descripción y el TIPO DE PLAN a la función
                    const imgSrc = obtenerImagenCategoria(item.categoria, item.descripcion, plan.tipo);
                    const card = document.createElement('div');
                    card.className = 'modal-item-card';
                    card.innerHTML = `
                        <div class="modal-item-img" onclick="abrirImagen('${imgSrc}', '${item.categoria}')" title="Ver imagen completa">
                            <img src="${imgSrc}" alt="${item.categoria}">
                        </div>
                        <div class="modal-item-text">
                            <h4>${item.categoria}</h4>
                            <p>${item.descripcion}</p>
                        </div>
                    `;
                    grid.appendChild(card);
                });
            } else {
                grid.innerHTML = '<p style="text-align:center; color:var(--text-muted); grid-column: 1 / -1;">No hay desglose disponible para esta línea.</p>';
            }

            // Mostrar Modal
            document.body.classList.add('modal-open'); 
            modal.classList.add('active');
        }

        function cerrarModal() {
            const modal = document.getElementById('modalDesglose');
            modal.classList.remove('active');
            
            // Solo quitar el bloqueo de scroll si la imagen expandida no está abierta
            if (!document.getElementById('modalImagenOverlay').classList.contains('active')) {
                document.body.classList.remove('modal-open');
            }
        }

        // --- FUNCIONES PARA EL LIGHTBOX ---
        function abrirImagen(src, titulo) {
            const overlay = document.getElementById('modalImagenOverlay');
            const img = document.getElementById('lightboxImg');
            const title = document.getElementById('lightboxTitle');
            
            img.src = src;
            title.innerText = titulo;
            
            overlay.classList.add('active');
        }

        function cerrarImagen() {
            const overlay = document.getElementById('modalImagenOverlay');
            overlay.classList.remove('active');
        }

        // Stepper
        function updateStepper(fieldId, change) {
            const input = document.getElementById(fieldId);
            let value = parseInt(input.value) || 1;
            value += change;
            if (value < 1) value = 1;
            if (value > 10) value = 10;
            input.value = value;
        }

        const header = document.getElementById('mainHeader');
        window.addEventListener('scroll', () => {
            header.classList.toggle('scrolled', window.scrollY > 50);
        });

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('cotizacionForm');
            const steps = Array.from(document.querySelectorAll('.step-content'));
            const stepDots = Array.from(document.querySelectorAll('[data-step-indicator]'));
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
                stepDots.forEach((dot, index) => {
                    dot.classList.remove('active', 'completed');
                    if (index < currentStep) {
                        dot.classList.add('completed');
                        dot.querySelector('.dot').innerHTML = '✓';
                    } else if (index === currentStep) {
                        dot.classList.add('active');
                        dot.querySelector('.dot').innerHTML = index + 1;
                    } else {
                        dot.querySelector('.dot').innerHTML = index + 1;
                    }
                });
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
                        mostrarPropuestas(result.propuestas);
                    } else if (response.status === 422) {
                        mostrarErrores(result.errors || result);
                    } else {
                        alert('Error: ' + (result.error || 'No se pudo generar la cotización'));
                    }
                } catch (error) {
                    alert('Hubo un problema de red.');
                } finally {
                    btnSubmit.classList.remove('loading');
                    btnSubmit.innerText = 'Calcular Presupuestos ✨';
                    btnSubmit.disabled = false;
                }
            });

            function mostrarPropuestas(propuestasObj) {
                // Guardar globalmente para que el Modal pueda acceder
                window.propuestasGlobales = propuestasObj; 

                planesList.innerHTML = '';
                const propuestas = Object.values(propuestasObj);

                const taglines = {
                    'elemental': 'Lo esencial, bien hecho',
                    'estandar': 'El equilibrio perfecto',
                    'experto': 'Acabados de alta gama'
                };

                propuestas.forEach((plan) => {
                    let features = `<li><span class="check-icon">✓</span> Diseño y Administración incluidos</li>`;
                    if (plan.tipo === 'elemental') {
                        features += `<li><span class="check-icon">✓</span> Muros, Pisos y Techos listos</li><li><span class="check-icon">✓</span> Aseo final especializado</li><li><span class="check-icon">✓</span> Entrega lista para habitar</li>`;
                    } else if (plan.tipo === 'estandar') {
                        features += `<li><span class="check-icon">✓</span> Todo lo de la línea Elemental</li><li><span class="check-icon">✓</span> Carpintería en madera</li><li><span class="check-icon">✓</span> Divisiones en vidrio</li><li><span class="check-icon">✓</span> Mayor variedad en materiales</li>`;
                    } else {
                        features += `<li><span class="check-icon">✓</span> Todo lo de la línea Estándar</li><li><span class="check-icon">✓</span> Mesones en Quarztone</li><li><span class="check-icon">✓</span> Griferías de Lujo</li><li><span class="check-icon">✓</span> Acabados de alta gama</li>`;
                    }

                    const card = document.createElement('div');
                    card.className = `plan-card ${plan.tipo === 'experto' ? 'experto' : ''}`;
                    
                    card.innerHTML = `
                        <h3 class="plan-name">Línea ${plan.tipo}</h3>
                        <p class="plan-tagline">${taglines[plan.tipo] || ''}</p>
                        <div class="plan-price">${plan.vr_total_formateado}</div>
                        <div class="plan-price-m2">Descubre tu bono de bienvenida : <strong></strong></div>
                        <ul class="plan-features">${features}</ul>
                        
                        <button type="button" class="btn-ver-desglose" onclick="abrirModal('${plan.tipo}')">
                            📄 Ver desglose completo de la obra
                        </button>

                        <button type="button" class="btn-select-plan"
                            onclick="seleccionarPlan('${plan.tipo}', '${plan.vr_total_formateado}', '${plan.precio_m2_formateado}', this)">
                            Me interesa esta línea →
                        </button>
                    `;
                    planesList.appendChild(card);
                });

                resultsContainer.classList.add('visible');
                setTimeout(() => {
                    document.getElementById('cotizador').scrollIntoView({ behavior: 'smooth' });
                }, 100);
            }

            window.seleccionarPlan = function(tipoPropuesta, vrTotal, vrM2, btnElement) {
                const formData = new FormData(document.getElementById('cotizacionForm'));
                const proyecto = formData.get('nombre_proyecto') || 'No especificado';
                const area = formData.get('area_privada') || '0';
                const fecha = formData.get('fecha_entrega') || 'No especificada';
                const habs = formData.get('num_habitaciones') || '1';
                const banos = formData.get('num_banos') || '1';

                const mensaje = `Hola, estoy cotizando mi inmueble.\n\nElegí la Línea: *${tipoPropuesta.toUpperCase()}*\n\n*Datos de mi proyecto:*\n- Proyecto/Conjunto: ${proyecto}\n- Área: ${area} m²\n- Habitaciones: ${habs}\n- Baños: ${banos}\n- Fecha inicio de obras: ${fecha}\n\n*Presupuesto Estimado:*\n- Inversión Total: ${vrTotal}`;

                const encodedMessage = encodeURIComponent(mensaje);
                const whatsappUrl = `https://wa.me/573224307053?text=${encodedMessage}`;

                const originalText = btnElement.innerText;
                btnElement.innerText = 'Abriendo WhatsApp...';
                btnElement.style.background = 'var(--success)';
                btnElement.style.color = 'white';

                window.open(whatsappUrl, '_blank');

                setTimeout(() => {
                    btnElement.innerText = originalText;
                    btnElement.style.background = tipoPropuesta !== 'experto'
                        ? 'var(--primary)'
                        : 'linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%)';
                    btnElement.style.color = '';
                }, 3000);
            };

            updateWizard();

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

            document.querySelectorAll('.feature-card, .process-step, .bento-item').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(30px)';
                el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(el);
            });
            
            // Mejor control del teclado para cerrar modales en orden
            document.addEventListener('keydown', function(event) {
                if (event.key === "Escape") {
                    const lightbox = document.getElementById('modalImagenOverlay');
                    if (lightbox.classList.contains('active')) {
                        cerrarImagen(); // Cierra primero la imagen grande
                    } else {
                        cerrarModal(); // Si no hay imagen grande, cierra el desglose
                    }
                }
            });
        });
    </script>
</body>
</html>