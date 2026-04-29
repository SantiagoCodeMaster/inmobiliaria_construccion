<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Código QR - Cotizador Escuadr Arq</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('Screenshot_1.ico') }}">

    <!-- Importación de las mismas fuentes de tu sitio web -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet" />

    <style>
        /* ============ VARIABLES DE TU DISEÑO ============ */
        :root {
            --primary: #0a0a0a;
            --primary-light: #1a1a1a;
            --accent: #c9a961;
            --accent-hover: #b89548;
            --accent-dark: #8a6f3a;
            --bg-white: #ffffff;
            --bg-cream: #f5f2ec;
            --text-muted: #6b6b6b;
            --border-color: #e8e6e1;
            --shadow-lg: 0 25px 50px rgba(0,0,0,0.12);
            --shadow-gold: 0 20px 40px rgba(201, 169, 97, 0.25);
        }

        /* ============ RESET Y BASE ============ */
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: linear-gradient(180deg, var(--bg-white) 0%, var(--bg-cream) 100%);
            color: var(--primary);
            display: flex;
            flex-direction: column;
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

        .accent-text {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ============ ANIMACIONES ============ */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ============ CONTENEDOR PRINCIPAL ============ */
        .qr-wrapper {
            background: white;
            max-width: 420px;
            width: 100%;
            border-radius: 26px;
            padding: 3rem 2rem;
            text-align: center;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.8s ease forwards;
        }

        /* Borde superior dorado decorativo */
        .qr-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--accent), var(--accent-dark));
        }

        /* ============ TIPOGRAFÍA Y TEXTOS ============ */
        .brand-tag {
            display: inline-block;
            font-size: 0.72rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--accent);
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .qr-title {
            font-size: 2.2rem;
            line-height: 1.1;
            margin-bottom: 0.8rem;
            color: var(--primary);
        }

        .qr-subtitle {
            font-size: 1rem;
            color: var(--text-muted);
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .qr-subtitle strong {
            color: var(--primary);
            font-weight: 600;
        }

        /* ============ ZONA DEL QR ============ */
        .qr-image-container {
            background: var(--bg-cream);
            padding: 1.5rem;
            border-radius: 22px;
            display: inline-block;
            margin-bottom: 2rem;
            border: 2px dashed var(--accent);
            box-shadow: inset 0 0 20px rgba(201,169,97,0.1);
            transition: transform 0.3s ease;
        }

        .qr-image-container:hover {
            transform: scale(1.03);
            border-style: solid;
        }

        .qr-image-container img {
            width: 220px;
            height: 220px;
            display: block;
            border-radius: 8px;
        }

        /* ============ BOTÓN ALTERNATIVO ============ */
        .btn-cta {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--primary);
            color: white;
            text-decoration: none;
            padding: 1rem 2rem;
            border-radius: 100px;
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-cta:hover {
            background: var(--accent);
            transform: translateY(-3px);
            box-shadow: var(--shadow-gold);
        }

        .logo-footer {
            margin-top: 1.5rem;
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 1rem;
            color: var(--primary-light);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2px;
        }

        .logo-footer span:last-child {
            font-size: 0.55rem;
            color: var(--accent);
            letter-spacing: 2px;
            font-family: 'Outfit', sans-serif;
        }

    </style>
</head>
<body>

    <div class="qr-wrapper">
        <span class="brand-tag">— Escuadr Arq —</span>
        
        <h1 class="qr-title">¡Escanea y <span class="accent-text">Cotiza Ya!</span></h1>
        
        <p class="qr-subtitle">
            Transformamos tu apartamento en <strong>obra gris</strong> en el hogar de tus sueños. Descubre el valor de tu remodelación al instante.
        </p>

        <div class="qr-image-container">
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data={{ urlencode('https://escuadrarq.com/#cotizador') }}" alt="Código QR Cotizador Obra Gris">
        </div>

        <a href="https://escuadrarq.com/#cotizador" class="btn-cta">
            O haz clic para cotizar aquí
        </a>

        <div class="logo-footer">
            <span>Escuadr Arq</span>
            <span>CONSTRUCTORA S.A.S.</span>
        </div>
    </div>

</body>
</html>