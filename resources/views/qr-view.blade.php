<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotizador Escuadr Arq</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('Screenshot_1.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>

    <style>
        :root {
            --primary: #0a0a0a;
            --accent: #c9a961;
            --accent-hover: #b89548;
            --accent-dark: #8a6f3a;
            --bg-cream: #f5f2ec;
            --text-muted: #6b6b6b;
        }

        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: #e0ddd6;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 1.5rem;
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3 {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            letter-spacing: -0.03em;
        }

        /* ============ FLYER PRINCIPAL ============ */
        .flyer {
            width: 100%;
            max-width: 440px;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(0,0,0,0.18);
            position: relative;
            animation: flyerIn 0.7s ease forwards;
        }

        /* ============ HERO CON IMAGEN ============ */
        .flyer-hero {
            position: relative;
            width: 100%;
            height: 260px;
            overflow: hidden;
            background: var(--primary);
        }

        .flyer-hero img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            display: block;
            filter: brightness(0.5) contrast(1.15) saturate(1.1);
        }

        .flyer-hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(
                180deg,
                rgba(10,10,10,0.05) 0%,
                rgba(10,10,10,0.4) 45%,
                rgba(10,10,10,0.93) 100%
            );
        }

        .hero-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1.5rem 1.8rem;
            z-index: 2;
        }

        .hero-tag {
            display: inline-block;
            background: var(--accent);
            color: var(--primary);
            font-size: 0.62rem;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            padding: 5px 14px;
            border-radius: 100px;
            margin-bottom: 0.7rem;
        }

        .hero-title {
            font-size: 1.85rem;
            line-height: 1.08;
            color: white;
            margin-bottom: 0.35rem;
        }

        .hero-title .gold {
            color: var(--accent);
        }

        .hero-sub {
            font-size: 0.88rem;
            color: rgba(255,255,255,0.7);
            font-weight: 300;
            line-height: 1.4;
        }

        /* ============ CUERPO ============ */
        .flyer-body {
            padding: 1.8rem;
            text-align: center;
        }

        .benefits {
            display: flex;
            justify-content: center;
            gap: 1.2rem;
            margin-bottom: 1.8rem;
        }

        .benefit {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.4rem;
            flex: 1;
        }

        .benefit-icon {
            width: 46px;
            height: 46px;
            border-radius: 14px;
            background: var(--bg-cream);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            border: 1px solid rgba(201,169,97,0.2);
        }

        .benefit-label {
            font-size: 0.68rem;
            font-weight: 600;
            color: var(--primary);
            line-height: 1.3;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .divider {
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, var(--accent), var(--accent-dark));
            border-radius: 10px;
            margin: 0 auto 1.5rem;
        }

        .scan-text {
            font-size: 0.82rem;
            color: var(--text-muted);
            margin-bottom: 1.2rem;
            line-height: 1.5;
        }

        .scan-text strong {
            color: var(--primary);
            font-weight: 700;
        }

        /* ============ QR GRANDE ============ */
        .qr-block {
            position: relative;
            display: inline-block;
            margin-bottom: 1.6rem;
        }

        .qr-frame {
            padding: 16px;
            background: white;
            border: 2.5px solid var(--accent);
            border-radius: 20px;
            position: relative;
            box-shadow: 0 12px 40px rgba(201,169,97,0.2);
        }

        .qr-frame::before,
        .qr-frame::after {
            content: '';
            position: absolute;
            width: 28px;
            height: 28px;
            border-color: var(--accent-dark);
            border-style: solid;
            border-width: 0;
        }

        .qr-frame::before {
            top: -5px;
            left: -5px;
            border-top-width: 3.5px;
            border-left-width: 3.5px;
            border-radius: 6px 0 0 0;
        }

        .qr-frame::after {
            bottom: -5px;
            right: -5px;
            border-bottom-width: 3.5px;
            border-right-width: 3.5px;
            border-radius: 0 0 6px 0;
        }

        .corner-tr, .corner-bl {
            position: absolute;
            width: 28px;
            height: 28px;
            border-color: var(--accent-dark);
            border-style: solid;
            border-width: 0;
        }

        .corner-tr {
            top: -5px;
            right: -5px;
            border-top-width: 3.5px;
            border-right-width: 3.5px;
            border-radius: 0 6px 0 0;
        }

        .corner-bl {
            bottom: -5px;
            left: -5px;
            border-bottom-width: 3.5px;
            border-left-width: 3.5px;
            border-radius: 0 0 0 6px;
        }

        .qr-frame img {
            width: 240px;
            height: 240px;
            display: block;
            border-radius: 10px;
        }

        .qr-instruction {
            position: absolute;
            bottom: -28px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--primary);
            color: white;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 5px 18px;
            border-radius: 100px;
            white-space: nowrap;
        }

        /* ============ CTA ============ */
        .cta-area {
            margin-top: 2rem;
        }

        .btn-cta {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: var(--accent);
            color: var(--primary);
            text-decoration: none;
            padding: 0.95rem 2rem;
            border-radius: 100px;
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 0.85rem;
            letter-spacing: 0.3px;
            transition: all 0.3s ease;
            width: 100%;
            box-shadow: 0 8px 30px rgba(201,169,97,0.35);
        }

        .btn-cta:hover {
            background: var(--accent-hover);
            transform: translateY(-2px);
            box-shadow: 0 14px 40px rgba(201,169,97,0.45);
        }

        .btn-cta svg {
            width: 16px;
            height: 16px;
        }

        /* ============ FOOTER ============ */
        .flyer-footer {
            background: var(--bg-cream);
            padding: 1rem 1.8rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid rgba(201,169,97,0.15);
        }

        .footer-brand {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 0.9rem;
            color: var(--primary);
        }

        .footer-brand small {
            display: block;
            font-family: 'Outfit', sans-serif;
            font-weight: 500;
            font-size: 0.55rem;
            color: var(--accent-dark);
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-top: 1px;
        }

        .footer-web {
            font-size: 0.72rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* ============ ANIMACIÓN ============ */
        @keyframes flyerIn {
            from { opacity: 0; transform: translateY(30px) scale(0.97); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* ============ IMPRESIÓN ============ */
        @media print {
            body {
                background: white;
                padding: 0;
            }
            .flyer {
                box-shadow: none;
                border-radius: 0;
                max-width: 100%;
            }
            .btn-cta {
                box-shadow: none;
            }
            @page {
                margin: 0;
                size: 440px 780px;
            }
        }

        /* ============ RESPONSIVE ============ */
        @media (max-width: 460px) {
            .flyer-hero { height: 220px; }
            .hero-title { font-size: 1.55rem; }
            .qr-frame img { width: 200px; height: 200px; }
            .flyer-body { padding: 1.4rem; }
            .benefits { gap: 0.8rem; }
            .benefit-icon { width: 40px; height: 40px; font-size: 1rem; }
        }
    </style>
</head>
<body>

    <div class="flyer">
        <!-- HERO CON TU IMAGEN -->
        <div class="flyer-hero">
            <img src="{{ asset('casa5.ico') }}" alt="Remodelación Escuadr Arq">
            <div class="hero-content">
                <span class="hero-tag">Escuadr Arq</span>
                <h1 class="hero-title">tu hogar empieza  <span class="gold"> aquí</span></h1>
                <p class="hero-sub">Convierte tu obra gris en el lugar que siempre soñaste</p>
            </div>
        </div>

        <!-- CUERPO -->
        <div class="flyer-body">

            <div class="benefits">
                <div class="benefit">
                    <div class="benefit-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#c9a961" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <span class="benefit-label">Cotización<br>instantánea</span>
                </div>
                <div class="benefit">
                    <div class="benefit-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#c9a961" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <span class="benefit-label">Precios<br>transparentes</span>
                </div>
                <div class="benefit">
                    <div class="benefit-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#c9a961" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    </div>
                    <span class="benefit-label">Diseño<br>profesional</span>
                </div>
            </div>

            <div class="divider"></div>

            <p class="scan-text">
                <strong>Escanea el código</strong> y descubre cuánto vale transformar tu apartamento en minutos.
            </p>

            <div class="qr-block">
                <div class="qr-frame">
                    <div class="corner-tr"></div>
                    <div class="corner-bl"></div>
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=400x400&data={{ urlencode('https://escuadrarq.com/#cotizador') }}" alt="Código QR Cotizador Escuadr Arq">
                </div>
                <span class="qr-instruction">Apunta la cámara aquí</span>
            </div>

            <div class="cta-area">
                <a href="https://escuadrarq.com/#cotizador" class="btn-cta">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                    Ir al cotizador ahora
                </a>
            </div>
        </div>

        <div class="flyer-footer">
            <div class="footer-brand">
                Escuadr Arq
                <small>Constructora S.A.S.</small>
            </div>
            <span class="footer-web">escuadrarq.com</span>
        </div>
    </div>

</body>
</html>