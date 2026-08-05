<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" style="font-family: 'Syne', sans-serif;">
            Personalizar Cotización <span style="color:#d4af37;">#{{ $cotizacion->id }}</span>
        </h2>
    </x-slot>

    @php
        $taglines = [
            'elemental' => 'Lo esencial, bien hecho',
            'estandar'  => 'El equilibrio perfecto',
            'experto'   => 'Acabados de alta gama',
            'maestro'   => 'El precio más accesible',
        ];
        $features = [
            'maestro' => [
                'Pisos, Muros y Techos esenciales',
                'Sin administración, imprevistos ni utilidad',
                'Aseo final incluido',
                'La opción más económica',
            ],
            'elemental' => [
                'Diseño y Administración incluidos',
                'Muros, Pisos y Techos listos',
                'Aseo final especializado',
                'Entrega lista para habitar',
            ],
            'estandar' => [
                'Diseño y Administración incluidos',
                'Todo lo de la línea Elemental',
                'Carpintería en madera',
                'Divisiones en vidrio',
                'Mayor variedad en materiales',
            ],
            'experto' => [
                'Diseño y Administración incluidos',
                'Todo lo de la línea Estándar',
                'Mesones en Quarztone',
                'Griferías de Lujo',
                'Acabados de alta gama',
            ],
        ];
    @endphp

    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <style>
        :root {
            --primary: #1a1a1a;
            --primary-light: #2d2d2d;
            --accent: #d4af37;
            --accent-dark: #b8932f;
            --accent-light: #ecd9a7;
            --error: #ef4444;
            --success: #22c55e;
            --border: #e5e5e5;
            --border-color: #e5e5e5;
            --text-muted: #8a8a8a;
            --bg-subtle: #f9f9f9;
            --bg-cream: #faf7f0;
            --shadow-sm: 0 2px 8px rgba(0,0,0,0.05);
            --shadow-md: 0 8px 24px rgba(0,0,0,0.08);
            --shadow-lg: 0 20px 50px rgba(0,0,0,0.14);
            --shadow-gold: 0 10px 25px rgba(212,175,55,0.35);
        }
        * { box-sizing: border-box; }

        body { background: #f5f5f0; }
        body.modal-open { overflow: hidden; }

        .page { max-width: 1400px; margin: 2rem auto; padding: 0 1.5rem; font-family: 'Outfit', sans-serif; }

        .card { background: white; border-radius: 16px; border: 1px solid var(--border); box-shadow: 0 20px 60px rgba(0,0,0,0.06); overflow: hidden; margin-bottom: 2rem; }

        .card-head {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            padding: 1.5rem 2rem; display: flex; justify-content: space-between; align-items: center; gap: 1rem;
        }
        .card-head h3 { font-family: 'Syne', sans-serif; font-size: 1.1rem; margin: 0; color: white; }

        .card-body { padding: 2rem; }

        .info-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem; margin-bottom: 1.5rem; }
        .info-item { }
        .info-item label { font-family: 'Syne', sans-serif; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px; color: #888; display: block; margin-bottom: 0.2rem; }
        .info-item span { font-weight: 600; font-size: 0.95rem; color: var(--primary); }

        /* ============ PLANES (igual que el cotizador) ============ */
        .plans-section { margin-bottom: 2rem; }
        .plans-title { font-family: 'Syne', sans-serif; font-size: 1.25rem; font-weight: 800; color: var(--primary); margin: 0 0 0.25rem; }
        .plans-sub { color: var(--text-muted); font-size: 0.9rem; margin: 0 0 1.5rem; }

        .plans-grid { display: grid; grid-template-columns: 1fr; gap: 1.75rem; }
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
            box-shadow: var(--shadow-sm);
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
            z-index: 2;
        }
        .plan-card.maestro {
            border: 2px dashed #3a7d44;
            background: linear-gradient(180deg, white 0%, #f4faf5 100%);
            box-shadow: var(--shadow-sm);
        }
        .plan-card.maestro::before {
            content: 'El Más Económico';
            position: absolute;
            top: -14px; left: 50%;
            transform: translateX(-50%);
            background: #3a7d44;
            color: white;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 7px 18px;
            border-radius: 100px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            box-shadow: 0 8px 20px rgba(58,125,68,0.35);
            white-space: nowrap;
            z-index: 2;
        }
        .plan-card.maestro .plan-price { color: #3a7d44; }
        .plan-name { font-size: 1.4rem; margin-bottom: 0.2rem; text-transform: capitalize; display: flex; align-items: center; gap: 0.6rem; }
        .badge-personalizada {
            display: inline-flex; align-items: center; gap: 0.3rem;
            background: #fef3c7; color: #92400e; border: 1px solid #f5d98c;
            font-size: 0.62rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.4px;
            padding: 0.2rem 0.55rem; border-radius: 100px; white-space: nowrap;
        }
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
        .plan-features { list-style: none; margin: 0 0 1.75rem; padding: 0; flex-grow: 1; }
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
        .plan-card.experto .btn-ver-desglose { border-color: var(--accent-light); }

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

        /* ============ MODAL DESGLOSE ============ */
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
        .modal-overlay.active { opacity: 1; visibility: visible; }
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
        .modal-overlay.active .modal-content { transform: translateY(0) scale(1); }
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
        .modal-item-img img { width: 100%; height: 100%; object-fit: cover; display: block; }
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
        .modal-item-img:hover::after { opacity: 1; }
        .modal-item-text { flex: 1; }
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

        /* ============ LIGHTBOX ============ */
        .lightbox-overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.9);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            z-index: 10000;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            padding: 1rem;
        }
        .lightbox-overlay.active { opacity: 1; visibility: visible; }
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
        .lightbox-overlay.active .lightbox-content { transform: scale(1); }
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

        /* ============ EDITOR ============ */
        .tabs { display: flex; gap: 0.5rem; margin-bottom: 1.5rem; }
        .tab {
            padding: 0.7rem 1.5rem; border-radius: 8px; font-family: 'Syne', sans-serif;
            font-size: 0.8rem; font-weight: 700; cursor: pointer; text-transform: uppercase;
            letter-spacing: 0.5px; border: 2px solid var(--border); background: white; color: #888;
            transition: all 0.2s;
        }
        .tab:hover { border-color: var(--accent); color: var(--primary); }

        .table-wrap { overflow-x: auto; }
        table.items { width: 100%; border-collapse: collapse; font-size: 0.85rem; }
        table.items th {
            font-family: 'Syne', sans-serif; font-size: 0.7rem; text-transform: uppercase;
            letter-spacing: 0.5px; color: var(--primary); padding: 0.7rem 0.6rem;
            border-bottom: 2px solid var(--accent); text-align: left; background: var(--bg-subtle); white-space: nowrap;
        }
        table.items td { padding: 0.5rem 0.6rem; border-bottom: 1px solid var(--border); vertical-align: middle; }
        table.items tr:hover td { background: #fafaf8; }
        table.items tr.adicional td { background: #fffbeb; }
        table.items input[type="number"] {
            width: 80px; padding: 0.4rem 0.5rem; border: 1px solid var(--border); border-radius: 6px;
            font-family: 'Outfit', sans-serif; font-size: 0.85rem; text-align: right;
        }
        table.items input[type="number"]:focus { outline: none; border-color: var(--accent); box-shadow: 0 0 0 3px rgba(212,175,55,0.12); }
        table.items input[type="text"] {
            width: 80px; padding: 0.4rem 0.5rem; border: 1px solid var(--border); border-radius: 6px;
            font-family: 'Outfit', sans-serif; font-size: 0.85rem;
        }
        table.items .cell-cat { font-weight: 600; font-size: 0.78rem; min-width: 120px; }
        table.items .cell-desc { font-size: 0.8rem; color: #555; min-width: 200px; }

        .btn-icon {
            padding: 0.35rem 0.6rem; border-radius: 6px; font-family: 'Syne', sans-serif;
            font-size: 0.7rem; font-weight: 700; cursor: pointer; transition: all 0.2s;
            text-transform: uppercase; border: 1px solid var(--border); background: transparent;
        }
        .btn-icon.del { color: var(--error); border-color: var(--error); }
        .btn-icon.del:hover { background: var(--error); color: white; }

        .resumen {
            background: var(--bg-subtle); border-radius: 12px; padding: 1.5rem; margin-top: 1.5rem;
            display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 1rem;
        }
        .resumen-item { text-align: center; }
        .resumen-item label { font-family: 'Syne', sans-serif; font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.5px; color: #888; }
        .resumen-item .val { font-size: 1.2rem; font-weight: 700; color: var(--primary); margin-top: 0.2rem; }
        .resumen-item .val.total { color: var(--accent); font-size: 1.5rem; }

        .add-form { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr auto; gap: 0.8rem; align-items: end; margin-top: 1.5rem; padding: 1.5rem; background: var(--bg-subtle); border-radius: 12px; }
        .add-form label { font-family: 'Syne', sans-serif; font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.5px; color: #888; display: block; margin-bottom: 0.3rem; }
        .add-form select, .add-form input {
            padding: 0.55rem 0.7rem; border: 1px solid var(--border); border-radius: 6px;
            font-family: 'Outfit', sans-serif; font-size: 0.82rem; width: 100%; background: white;
        }
        .add-form select:focus, .add-form input:focus { outline: none; border-color: var(--accent); }

        .btn-save {
            padding: 0.8rem 2rem; background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white; border: none; border-radius: 8px; font-family: 'Syne', sans-serif;
            font-size: 0.85rem; font-weight: 700; cursor: pointer; text-transform: uppercase;
            letter-spacing: 1px; transition: opacity 0.2s;
        }
        .btn-save:hover { opacity: 0.9; }
        .btn-save:disabled { opacity: 0.4; cursor: not-allowed; }

        .btn-save-light {
            padding: 0.8rem 1.5rem; background: white; color: var(--primary); border: none; border-radius: 8px;
            font-family: 'Syne', sans-serif; font-size: 0.8rem; font-weight: 700; cursor: pointer;
            text-transform: uppercase; letter-spacing: 1px; transition: opacity 0.2s; white-space: nowrap;
        }
        .btn-save-light:hover { opacity: 0.9; }
        .btn-save-light:disabled { opacity: 0.4; cursor: not-allowed; }

        .btn-ghost-light {
            padding: 0.7rem 1.2rem; background: transparent; border: 1px solid rgba(255,255,255,0.5);
            color: white; border-radius: 8px; font-family: 'Syne', sans-serif; font-size: 0.75rem;
            font-weight: 700; cursor: pointer; text-transform: uppercase; letter-spacing: 1px; white-space: nowrap;
        }
        .btn-ghost-light:hover { border-color: var(--accent); color: var(--accent); }

        .btn-back {
            padding: 0.7rem 1.4rem; background: white; border: 1px solid var(--border); border-radius: 8px;
            font-family: 'Syne', sans-serif; font-size: 0.8rem; font-weight: 700; cursor: pointer;
            text-transform: uppercase; text-decoration: none; color: var(--primary);
        }
        .btn-back:hover { border-color: var(--accent); }

        .empty-state { text-align: center; padding: 3rem; color: #999; font-size: 0.9rem; }

        .badge-adicional {
            display: inline-block; padding: 0.15rem 0.5rem; border-radius: 4px;
            background: #fef3c7; color: #92400e; font-size: 0.65rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.3px;
        }

        .toast {
            position: fixed; bottom: 2rem; right: 2rem; background: var(--success); color: white;
            padding: 1rem 1.5rem; border-radius: 10px; font-family: 'Syne', sans-serif;
            font-size: 0.85rem; font-weight: 600; box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            transform: translateY(100px); opacity: 0; transition: all 0.3s; z-index: 9999;
        }
        .toast.show { transform: translateY(0); opacity: 1; }

        .spinner { display: inline-block; width: 16px; height: 16px; border: 2px solid rgba(255,255,255,0.3); border-radius: 50%; border-top-color: white; animation: spin 0.6s linear infinite; vertical-align: middle; margin-right: 0.5rem; }
        @keyframes spin { to { transform: rotate(360deg); } }
    </style>

    <div class="page" x-data="detalleEditor()">

        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">
            <a href="{{ route('dashboard') }}" class="btn-back">← Volver al Dashboard</a>
        </div>

        {{-- INFO CLIENTE --}}
        <div class="card">
            <div class="card-head">
                <h3>Cotización #{{ $cotizacion->id }} — {{ $cotizacion->nombre }} {{ $cotizacion->apellido }}</h3>
            </div>
            <div class="card-body">
                <div class="info-grid">
                    <div class="info-item"><label>Proyecto</label><span>{{ $cotizacion->nombre_proyecto ?? '—' }}</span></div>
                    <div class="info-item"><label>Email</label><span>{{ $cotizacion->email }}</span></div>
                    <div class="info-item"><label>WhatsApp</label><span>{{ $cotizacion->telefono }}</span></div>
                    <div class="info-item"><label>Área</label><span>{{ number_format($cotizacion->area_privada, 1) }} m²</span></div>
                    <div class="info-item"><label>Habitaciones</label><span>{{ $cotizacion->num_habitaciones ?? '—' }}</span></div>
                    <div class="info-item"><label>Baños</label><span>{{ $cotizacion->num_banos ?? '—' }}</span></div>
                    <div class="info-item"><label>Entrega</label><span>{{ $cotizacion->fecha_entrega?->format('d/m/Y') ?? '—' }}</span></div>
                    <div class="info-item"><label>Mueble Cocina</label><span>{{ $cotizacion->tiene_mueble_alto_cocina ? 'Sí' : 'No' }}</span></div>
                    <div class="info-item"><label>Barra Aux.</label><span>{{ $cotizacion->tiene_barra_auxiliar ? 'Sí' : 'No' }}</span></div>
                </div>
            </div>
        </div>

        {{-- LÍNEAS (tarjetas idénticas al cotizador) --}}
        <div class="plans-section">
            <h3 class="plans-title">Líneas de acabados de esta cotización</h3>
            <p class="plans-sub">Revisa el desglose completo de cada línea o entra a personalizar sus actividades.</p>

            <div class="plans-grid">
                @foreach ($propuestas as $plan)
                    <div class="plan-card {{ $plan['tipo'] === 'experto' ? 'experto' : ($plan['tipo'] === 'maestro' ? 'maestro' : '') }}">
                        <h3 class="plan-name">
                            Línea {{ $plan['tipo'] }}
                            @if ($plan['usando_personalizadas'])
                                <span class="badge-personalizada">✏️ Personalizada</span>
                            @endif
                        </h3>
                        <p class="plan-tagline">{{ $taglines[$plan['tipo']] }}</p>
                        <div class="plan-price">{{ $plan['vr_total_formateado'] }}</div>
                        <div class="plan-price-m2">Descubre tu bono de bienvenida : <strong></strong></div>
                        <ul class="plan-features">
                            @foreach ($features[$plan['tipo']] as $feature)
                                <li><span class="check-icon">✓</span> {{ $feature }}</li>
                            @endforeach
                        </ul>

                        <button type="button" class="btn-ver-desglose" onclick="abrirModal('{{ $plan['tipo'] }}')">
                            🔍 Ver desglose completo de la obra
                        </button>

                        <button type="button" class="btn-select-plan" @click="cargar('{{ $plan['tipo'] }}')">
                            Personalizar esta línea →
                        </button>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- EDITOR DE ACTIVIDADES --}}
        <div class="card" id="editorSection" x-show="cargado" style="display:none;">
            <div class="card-head">
                <h3>Editor de Actividades — <span x-text="'Línea ' + tipo"></span></h3>
                <div style="display:flex; gap:0.75rem;">
                    <button class="btn-ghost-light" @click="cargado=false">← Ver líneas</button>
                    <button class="btn-save-light" @click="guardar()" :disabled="saving">
                        <span x-show="saving" class="spinner"></span>
                        <span x-text="saving ? 'Guardando...' : '💾 Guardar'"></span>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
                    <span style="font-family:'Syne',sans-serif;font-size:0.8rem;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;color:#888;">
                        <span x-text="actividades.length"></span> actividad(es)
                    </span>
                    <span style="font-size:0.78rem;color:#999;">
                        <template x-if="usandoPersonalizadas">✏️ Editadas</template>
                        <template x-if="!usandoPersonalizadas">📋 Estándar</template>
                    </span>
                </div>

                <div class="table-wrap">
                    <table class="items">
                        <thead>
                            <tr>
                                <th>Categoría</th>
                                <th>Descripción</th>
                                <th>UND</th>
                                <th style="text-align:right;">Cantidad</th>
                                <th style="text-align:right;">V. Unitario</th>
                                <th style="text-align:right;">V. Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="(act, idx) in actividades" :key="idx">
                                <tr :class="{ adicional: act.es_adicional }">
                                    <td class="cell-cat">
                                        <span x-text="act.categoria"></span>
                                        <span x-show="act.es_adicional" class="badge-adicional">Adicional</span>
                                    </td>
                                    <td class="cell-desc" x-text="act.descripcion"></td>
                                    <td><input type="text" x-model="act.unidad" style="width:60px;" @input="recalc(idx)"></td>
                                    <td><input type="number" step="0.01" min="0" x-model="act.cantidad" @input="recalc(idx)"></td>
                                    <td><input type="number" step="1" min="0" x-model="act.valor_unitario" @input="recalc(idx)"></td>
                                    <td style="text-align:right;font-weight:600;" x-text="'$ ' + formato(act.vr_total)"></td>
                                    <td>
                                        <button class="btn-icon del" @click="eliminar(idx)" title="Eliminar">✕</button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

                {{-- AGREGAR ACTIVIDAD --}}
                <div style="margin-top:1.5rem;">
                    <div style="display:flex;gap:0.5rem;margin-bottom:1rem;">
                        <button
                            @click="modoAgregar='catalogo'; nueva={catalogo_id:'',categoria:'',descripcion:'',unidad:'UND',cantidad:1,valor_unitario:0}"
                            :style="modoAgregar==='catalogo' ? 'background:var(--primary);color:white;border-color:var(--primary);' : ''"
                            class="tab" style="font-size:0.75rem;">
                            📋 Del Catálogo
                        </button>
                        <button
                            @click="modoAgregar='extraordinaria'; nueva={catalogo_id:'',categoria:'',descripcion:'',unidad:'UND',cantidad:1,valor_unitario:0}"
                            :style="modoAgregar==='extraordinaria' ? 'background:var(--accent);color:var(--primary);border-color:var(--accent);' : ''"
                            class="tab" style="font-size:0.75rem;">
                            ⚡ Actividad Extraordinaria
                        </button>
                    </div>

                    <div x-show="modoAgregar==='catalogo'" class="add-form">
                        <div>
                            <label>Actividad del catálogo</label>
                            <select x-model="nueva.catalogo_id" @change="selCatalogo()">
                                <option value="">— Seleccionar —</option>
                                <template x-for="cat in catalogo" :key="cat.id">
                                    <option :value="cat.id" x-text="cat.nombre + ' — ' + cat.descripcion"></option>
                                </template>
                            </select>
                        </div>
                        <div>
                            <label>Categoría</label>
                            <input x-model="nueva.categoria" placeholder="Ej: Iluminación">
                        </div>
                        <div>
                            <label>UND</label>
                            <input x-model="nueva.unidad" placeholder="UND">
                        </div>
                        <div>
                            <label>Cantidad</label>
                            <input type="number" step="0.01" min="0" x-model="nueva.cantidad">
                        </div>
                        <div>
                            <label>V. Unitario</label>
                            <input type="number" step="1" min="0" x-model="nueva.valor_unitario">
                        </div>
                        <div>
                            <button class="btn-icon" style="background:var(--primary);color:white;border:none;padding:0.55rem 1rem;" @click="agregar()">+ Agregar</button>
                        </div>
                    </div>

                    <div x-show="modoAgregar==='extraordinaria'" class="add-form" style="border:2px solid var(--accent);">
                        <div>
                            <label>Descripción de la actividad</label>
                            <input x-model="nueva.descripcion" placeholder="Ej: Derrumbe de cocina, Tejado, ...">
                        </div>
                        <div>
                            <label>Categoría</label>
                            <input x-model="nueva.categoria" placeholder="Ej: Cocina">
                        </div>
                        <div>
                            <label>UND</label>
                            <input x-model="nueva.unidad" placeholder="UND / m² / ml">
                        </div>
                        <div>
                            <label>Cantidad</label>
                            <input type="number" step="0.01" min="0" x-model="nueva.cantidad">
                        </div>
                        <div>
                            <label>V. Unitario</label>
                            <input type="number" step="1" min="0" x-model="nueva.valor_unitario">
                        </div>
                        <div>
                            <button class="btn-icon" style="background:var(--accent);color:var(--primary);border:none;padding:0.55rem 1rem;font-weight:700;" @click="agregar()">+ Agregar</button>
                        </div>
                    </div>
                </div>

                {{-- RESUMEN --}}
                <div class="resumen">
                    <div class="resumen-item"><label>Subtotal</label><div class="val" x-text="'$ ' + formato(resumen.subtotal)"></div></div>
                    <div class="resumen-item"><label>Admin (12%)</label><div class="val" x-text="'$ ' + formato(resumen.administracion_12pct)"></div></div>
                    <div class="resumen-item"><label>Imprevistos (3%)</label><div class="val" x-text="'$ ' + formato(resumen.imprevistos_3pct)"></div></div>
                    <div class="resumen-item"><label>Utilidad (4%)</label><div class="val" x-text="'$ ' + formato(resumen.utilidad_4pct)"></div></div>
                    <div class="resumen-item"><label>IVA Utilidad (19%)</label><div class="val" x-text="'$ ' + formato(resumen.iva_sobre_u_19pct)"></div></div>
                    <div class="resumen-item"><label>Precio / m²</label><div class="val" x-text="resumen.precio_m2_formateado"></div></div>
                    <div class="resumen-item"><label>TOTAL</label><div class="val total" x-text="resumen.vr_total_formateado"></div></div>
                </div>

                <div style="text-align:center; margin-top:1.5rem;">
                    <button @click="descargarPdf()"
                            style="display:inline-block;padding:0.8rem 2rem;background:#c9a961;color:var(--primary);border:none;border-radius:8px;font-family:'Syne',sans-serif;font-size:0.85rem;font-weight:700;cursor:pointer;text-transform:uppercase;letter-spacing:1px;transition:opacity 0.2s;">
                        <span x-show="downloadLoading" class="spinner"></span>
                        <span x-text="downloadLoading ? 'Guardando y descargando...' : '📄 Descargar PDF con estos datos'"></span>
                    </button>
                </div>
            </div>
        </div>

        <div class="toast" :class="{ show: toast }" x-text="toastMsg"></div>
    </div>

    {{-- MODAL DESGLOSE --}}
    <div id="modalDesglose" class="modal-overlay" onclick="cerrarModal()">
        <div class="modal-content" onclick="event.stopPropagation()">
            <div class="modal-header">
                <h3>Desglose de Obra <span id="modalPlanBadge">Línea</span></h3>
                <button class="modal-close" onclick="cerrarModal()" title="Cerrar ventana">×</button>
            </div>
            <div class="modal-body">
                <div id="modalGrid" class="modal-grid"></div>
            </div>
        </div>
    </div>

    {{-- LIGHTBOX --}}
    <div id="modalImagenOverlay" class="lightbox-overlay" onclick="cerrarImagen()">
        <button class="lightbox-close" onclick="cerrarImagen()" title="Cerrar imagen">×</button>
        <div class="lightbox-content" onclick="event.stopPropagation()">
            <img id="lightboxImg" src="" alt="Vista detallada">
            <h4 id="lightboxTitle"></h4>
        </div>
    </div>

    <script>
        window.propuestasAdmin = @json($propuestas);

        function _norm(s) {
            return (s || '')
                .toString()
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, ' ')
                .trim();
        }

        function obtenerImagenCategoria(categoria, descripcion, linea) {
            const desc = _norm(descripcion);
            const cat = _norm(categoria);

            if (desc.includes('suministro') && desc.includes('piso') && desc.includes('mortero')) {
                return "{{ asset('pisosmaking.png') }}";
            }
            if (desc.includes('piso') && (desc.includes('spc') || desc.includes('guarda escobas'))) {
                return "{{ asset('pisos1elemental.png') }}";
            }
            if (desc.includes('salpicadero') || desc.includes('cabina de ducha')) {
                return "{{ asset('enchapes.png') }}";
            }
            if (desc.includes('mueble de ropas')) return "{{ asset('mueble_ropas.png') }}";
            if (desc.includes('estufa de empotrar')) return "{{ asset('estufaagasvidrio.png') }}";
            if (desc.includes('horno')) return "{{ asset('horno.png') }}";
            if (desc.includes('kit sanitario') || desc.includes('acoflex sanitario')) return "{{ asset('kitacoflex.png') }}";
            if (desc.includes('acoflex lavamanos')) return "{{ asset('kitacoflexlavamanos.png') }}";
            if (desc.includes('lavaplatos radiante')) return "{{ asset('lavaplatoradiante.png') }}";
            if (desc.includes('sencilla gus')) return "{{ asset('griferialavaplatossencilla.png') }}";
            if (desc.includes('kit de instalacion completo')) return "{{ asset('kitgriferia.png') }}";
            if (cat.includes('incrustacion') && desc.includes('ducha monocontrol')) return "{{ asset('incrustaciongriferiaducha.png') }}";
            if (desc.includes('ducha monocontrol nott')) return "{{ asset('griferiaducharegadera.png') }}";
            if (desc.includes('meson de cocina en quarztone')) return "{{ asset('quartzonemesoncocina.png') }}";
            if (desc.includes('barra auxiliar en quarztone')) return "{{ asset('barraauxiliarcocinaquarztone.png') }}";
            if (desc.includes('lavamanos tipo guitarra')) return "{{ asset('quartzonemesonlavamanos.png') }}";
            if (desc.includes('riel spot 3 luces')) return "{{ asset('ilumnacionriel.png') }}";

            if (desc.includes('closet habitaciones')) {
                if (linea === 'experto') return "{{ asset('mueblesropaaglomeradoprofesional.png') }}";
                return "{{ asset('mueblremadera1estandar.png') }}";
            }
            if (desc.includes('mueble flotado de bano')) return "{{ asset('mueblebañoestandar.png') }}";
            if (desc.includes('division de bano')) return "{{ asset('divisionvidriobano1.png') }}";
            if (desc.includes('mueble alto de cocina')) return "{{ asset('mueblealtococinaestandar.png') }}";
            if (desc.includes('espejo flotado')) return "{{ asset('vidrioflotantebañoestandar.png') }}";
            if (desc.includes('puertas en madera')) return "{{ asset('puertaestandar.png') }}";
            if (desc.includes('barra auxiliar de cocina')) return "{{ asset('cocina_barra_auxiliar.png') }}";
            if (desc.includes('campana extractora')) return "{{ asset('estractoraltococina.png') }}";

            if (desc.includes('drywall')) return "{{ asset('techos1elemental.png') }}";
            if (desc.includes('nivelacion de paredes') || desc.includes('estuco y pintura')) return "{{ asset('muros2elemental.png') }}";
            if (desc.includes('aseo final') || desc.includes('escombros')) return "{{ asset('aseoelemental.png') }}";

            if (cat.includes('piso') || desc.includes('piso')) return "{{ asset('pisos1elemental.png') }}";
            if (cat.includes('muro')) return "{{ asset('enchapes.png') }}";
            if (cat.includes('techo')) return "{{ asset('techos1elemental.png') }}";
            if (cat.includes('aseo')) return "{{ asset('aseoelemental.png') }}";
            if (cat.includes('madera') || cat.includes('carpinteria')) return "{{ asset('mueblremadera1estandar.png') }}";
            if (cat.includes('cocina')) return "{{ asset('mueblealtococinaestandar.png') }}";
            if (cat.includes('bano') || cat.includes('aparato')) return "{{ asset('kitacoflex.png') }}";
            if (cat.includes('electric') || cat.includes('iluminacion')) return "{{ asset('ilumnacionriel.png') }}";
            if (cat.includes('griferia')) return "{{ asset('griferiaducharegadera.png') }}";
            if (cat.includes('electrodomestico')) return "{{ asset('estractoraltococina.png') }}";
            if (cat.includes('vidrio')) return "{{ asset('vidrioflotantebañoestandar.png') }}";

            return "{{ asset('aseoelemental.png') }}";
        }

        function abrirModal(tipoPlan) {
            const plan = window.propuestasAdmin[tipoPlan];
            if (!plan) return;

            const modal = document.getElementById('modalDesglose');
            const grid = document.getElementById('modalGrid');
            const badge = document.getElementById('modalPlanBadge');

            badge.innerText = 'Línea ' + plan.tipo;
            if (plan.tipo === 'experto') {
                badge.style.background = 'linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%)';
            } else if (plan.tipo === 'maestro') {
                badge.style.background = '#3a7d44';
            } else {
                badge.style.background = 'var(--primary)';
            }

            grid.innerHTML = '';

            if (plan.detalle && plan.detalle.length > 0) {
                plan.detalle.forEach(item => {
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

            document.body.classList.add('modal-open');
            modal.classList.add('active');
        }

        function cerrarModal() {
            const modal = document.getElementById('modalDesglose');
            modal.classList.remove('active');
            if (!document.getElementById('modalImagenOverlay').classList.contains('active')) {
                document.body.classList.remove('modal-open');
            }
        }

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

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const lightbox = document.getElementById('modalImagenOverlay');
                if (lightbox.classList.contains('active')) {
                    cerrarImagen();
                } else {
                    cerrarModal();
                }
            }
        });

        function detalleEditor() {
            return {
                tipo: '',
                actividades: [],
                catalogo: [],
                cargado: false,
                usandoPersonalizadas: false,
                saving: false,
                downloadLoading: false,
                toast: false,
                toastMsg: '',
                resumen: {
                    subtotal: 0,
                    administracion_12pct: 0,
                    imprevistos_3pct: 0,
                    utilidad_4pct: 0,
                    iva_sobre_u_19pct: 0,
                    vr_total: 0,
                    vr_total_formateado: '$0',
                    precio_m2_formateado: '$0/m²',
                },
                nueva: {
                    catalogo_id: '',
                    categoria: '',
                    descripcion: '',
                    unidad: 'UND',
                    cantidad: 1,
                    valor_unitario: 0,
                },
                modoAgregar: 'catalogo',

                async cargar(tipo) {
                    this.tipo = tipo;
                    this.cargado = false;

                    try {
                        const res = await fetch(`/admin/cotizaciones/{{ $cotizacion->id }}/detalle/data/${tipo}`);
                        const json = await res.json();
                        this.actividades = json.detalle.map(a => ({
                            ...a,
                            _original_cantidad: a.cantidad,
                            _original_vu: a.valor_unitario,
                        }));
                        this.usandoPersonalizadas = json.usando_personalizadas;
                        this.cargado = true;
                        this.recalcularTodo();
                        this.$nextTick(() => {
                            const el = document.getElementById('editorSection');
                            if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        });
                    } catch (e) {
                        alert('Error al cargar actividades.');
                    }

                    if (this.catalogo.length === 0) {
                        try {
                            const r = await fetch('/admin/cotizaciones/catalogo');
                            this.catalogo = await r.json();
                        } catch (e) {}
                    }
                },

                recalc(idx) {
                    const a = this.actividades[idx];
                    a.vr_total = Math.round(parseFloat(a.cantidad || 0) * parseFloat(a.valor_unitario || 0));
                    this.recalcularTodo();
                },

                async recalcularTodo() {
                    const total = this.actividades.reduce((s, a) => s + parseFloat(a.vr_total || 0), 0);
                    this.resumen.subtotal = total;

                    try {
                        const res = await fetch('/admin/cotizaciones/{{ $cotizacion->id }}/detalle/recalcular', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ actividades: this.actividades, tipo: this.tipo })
                        });
                        const json = await res.json();
                        this.resumen = json;
                    } catch (e) {}
                },

                eliminar(idx) {
                    this.actividades.splice(idx, 1);
                    this.recalcularTodo();
                },

                selCatalogo() {
                    const id = this.nueva.catalogo_id;
                    if (!id) return;
                    const cat = this.catalogo.find(c => c.id == id);
                    if (!cat) return;
                    this.nueva.categoria = cat.nombre;
                    this.nueva.descripcion = cat.descripcion;
                    this.nueva.unidad = cat.unidad;
                    this.nueva.valor_unitario = cat.valor_unitario;
                },

                agregar() {
                    const n = this.nueva;
                    if (!n.categoria || !n.descripcion) {
                        alert('Completa la categoría y descripción de la actividad.');
                        return;
                    }
                    const cant = parseFloat(n.cantidad) || 0;
                    const vu = parseFloat(n.valor_unitario) || 0;
                    this.actividades.push({
                        id: null,
                        categoria: n.categoria,
                        descripcion: n.descripcion,
                        unidad: n.unidad || 'UND',
                        cantidad: cant,
                        valor_unitario: vu,
                        vr_total: Math.round(cant * vu),
                        es_adicional: true,
                    });
                    this.nueva = { catalogo_id: '', categoria: '', descripcion: '', unidad: 'UND', cantidad: 1, valor_unitario: 0 };
                    this.recalcularTodo();
                },

                async guardar() {
                    if (this.saving) return;
                    this.saving = true;

                    try {
                        const res = await fetch('/admin/cotizaciones/{{ $cotizacion->id }}/detalle/save/' + this.tipo, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ actividades: this.actividades })
                        });
                        const json = await res.json();
                        this.usandoPersonalizadas = true;
                        this.toastMsg = json.mensaje || 'Guardado correctamente.';
                        this.toast = true;
                        setTimeout(() => this.toast = false, 3000);
                        return res.ok;
                    } catch (e) {
                        alert('Error al guardar.');
                        return false;
                    } finally {
                        this.saving = false;
                    }
                },

                async descargarPdf() {
                    if (this.downloadLoading) return;
                    this.downloadLoading = true;

                    const ok = await this.guardar();
                    if (ok) {
                        const url = `/cotizacion/{{ $cotizacion->id }}/pdf/${this.tipo}?h={{ $cotizacion->num_habitaciones ?? 1 }}`;
                        window.open(url, '_blank');
                    }
                    this.downloadLoading = false;
                },

                formato(n) {
                    if (n === undefined || n === null) return '0';
                    return Math.round(n).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                }
            }
        }
    </script>
</x-app-layout>
