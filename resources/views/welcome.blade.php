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

        /* Header */
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

        .brand-container {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
        }

        .brand-img {
            height: 40px;
            width: auto;
            display: block;
            object-fit: contain;
        }

        .brand-text-wrapper { display: flex; flex-direction: column; justify-content: center; }
        .brand-title { font-family: 'Syne', sans-serif; font-size: 1.25rem; font-weight: 800; color: var(--primary); line-height: 1.1; }
        .brand-subtitle { font-family: 'Outfit', sans-serif; font-size: 0.65rem; font-weight: 700; color: var(--accent-dark); letter-spacing: 2px; text-transform: uppercase; }

        .nav-desktop { display: none; gap: 3rem; font-size: 0.9rem; font-weight: 500; }
        .nav-desktop a { color: var(--primary); text-decoration: none; position: relative; }
        .nav-desktop a::after { content: ''; position: absolute; bottom: -4px; left: 0; width: 0; height: 2px; background: var(--accent); transition: width 0.3s ease; }
        .nav-desktop a:hover::after { width: 100%; }

        @media (min-width: 768px) { .nav-desktop { display: flex; } }

        .btn-secondary {
            padding: 0.65rem 1.5rem; border: 1px solid var(--border-color); border-radius: 8px;
            color: var(--primary); font-size: 0.85rem; font-weight: 600; text-decoration: none;
            transition: all 0.3s ease;
        }
        .btn-secondary:hover { border-color: var(--accent); color: var(--accent); background: rgba(212, 175, 55, 0.05); }

        /* Hero */
        .hero { max-width: 1400px; margin: 0 auto; padding: 4rem 2rem; text-align: center; position: relative; overflow: hidden; }
        .hero h1 { font-size: clamp(2.5rem, 6vw, 4rem); line-height: 1.1; margin-bottom: 1.5rem; font-weight: 800; }
        .hero-subtitle { font-size: 1.1rem; color: #666; max-width: 600px; margin: 0 auto 3rem; font-weight: 300; }
        .accent-text { background: linear-gradient(135deg, var(--accent) 0%, #f4d9a3 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }

        /* Formulario */
        .form-container {
            max-width: 1000px; margin: 0 auto; background: white; border-radius: 16px;
            border: 1px solid var(--border-color); box-shadow: 0 20px 60px rgba(0, 0, 0, 0.06); animation: slideUp 0.8s ease-out;
        }
        @keyframes slideUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }

        .form-header { background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); color: white; padding: 3rem 2rem; }
        .form-header h2 { font-size: 1.8rem; margin-bottom: 0.5rem; }
        .form-header p { font-size: 0.95rem; color: rgba(255, 255, 255, 0.8); }

        .form-content { padding: 3rem 2rem; }
        .form-section { margin-bottom: 2.5rem; background: var(--bg-subtle); padding: 2rem; border-radius: 12px; border: 1px solid #f0f0f0; }
        .form-section-title {
            font-family: 'Syne', sans-serif; font-size: 1rem; font-weight: 700; color: var(--primary);
            margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem; text-transform: uppercase;
        }
        .form-section-title::before { content: ''; width: 8px; height: 8px; background: var(--accent); border-radius: 50%; }

        .form-row { display: grid; grid-template-columns: 1fr; gap: 1.5rem; margin-bottom: 1.5rem; }
        @media (min-width: 768px) { .form-row { grid-template-columns: 1fr 1fr; } }
        .form-row.three-cols { grid-template-columns: 1fr; }
        @media (min-width: 768px) { .form-row.three-cols { grid-template-columns: 1fr 1fr 1fr; } }

        .form-group { display: flex; flex-direction: column; }
        .form-label { font-size: 0.9rem; font-weight: 600; margin-bottom: 0.7rem; color: var(--primary); }
        .form-label .required { color: var(--error); margin-left: 0.3rem; }
        .form-input, .form-select {
            padding: 0.85rem 1.2rem; border: 1px solid var(--border-color); border-radius: 8px; font-family: 'Outfit', sans-serif; background: white; transition: all 0.3s ease;
        }
        .form-input:focus, .form-select:focus { outline: none; border-color: var(--accent); box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1); }
        
        .form-error { color: var(--error); font-size: 0.8rem; margin-top: 0.4rem; display: none; }
        .form-error.show { display: block; }

        /* Estilo para los Toggles (Switches) */
        .toggle-container { display: flex; align-items: center; justify-content: space-between; padding: 0.85rem 1.2rem; background: white; border: 1px solid var(--border-color); border-radius: 8px; }
        .toggle-label { font-size: 0.9rem; font-weight: 500; }
        .switch { position: relative; display: inline-block; width: 44px; height: 24px; }
        .switch input { opacity: 0; width: 0; height: 0; }
        .slider { position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #ccc; transition: .4s; border-radius: 34px; }
        .slider:before { position: absolute; content: ""; height: 18px; width: 18px; left: 3px; bottom: 3px; background-color: white; transition: .4s; border-radius: 50%; }
        input:checked + .slider { background-color: var(--accent); }
        input:checked + .slider:before { transform: translateX(20px); }

        .btn-primary {
            padding: 1rem 2.5rem; background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white; border: none; border-radius: 8px; font-family: 'Syne', sans-serif; font-size: 1rem; font-weight: 700;
            cursor: pointer; transition: all 0.4s ease; text-transform: uppercase;
        }
        .btn-primary:hover:not(.loading) { transform: translateY(-2px); box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2); }
        .btn-primary.loading { opacity: 0.8; cursor: not-allowed; }

        /* Resultados */
        .results-container { max-width: 1200px; margin: 3rem auto 0; padding: 0 2rem; opacity: 0; transform: translateY(40px); transition: all 0.8s ease; pointer-events: none; display: none; }
        .results-container.visible { opacity: 1; transform: translateY(0); pointer-events: auto; display: block; }

        .plans-grid { display: grid; grid-template-columns: 1fr; gap: 2rem; margin-top: 2rem;}
        @media (min-width: 1024px) { .plans-grid { grid-template-columns: repeat(3, 1fr); } }

        .plan-card {
            border: 2px solid var(--border-color); border-radius: 12px; padding: 2rem; background: white;
            transition: all 0.4s ease; display: flex; flex-direction: column; position: relative; overflow: hidden;
        }
        .plan-card.experto { border-color: var(--accent); box-shadow: 0 10px 30px rgba(212, 175, 55, 0.15); }
        .plan-card.experto::before {
            content: 'Más Completo'; position: absolute; top: 12px; right: -30px; background: var(--accent);
            color: white; font-size: 0.7rem; font-weight: 700; padding: 4px 30px; transform: rotate(45deg); text-transform: uppercase;
        }
        
        .plan-header { margin-bottom: 1rem; }
        .plan-name { font-family: 'Syne', sans-serif; font-size: 1.5rem; font-weight: 800; color: var(--primary); text-transform: uppercase; }
        .plan-price { font-size: 2.5rem; font-weight: 800; color: var(--primary); margin-top: 0.5rem; letter-spacing: -1px; }
        .plan-price-m2 { font-size: 1rem; color: var(--accent-dark); font-weight: 600; margin-bottom: 1.5rem; padding-bottom: 1.5rem; border-bottom: 1px solid var(--border-color); }

        .plan-features { list-style: none; margin-bottom: 1.5rem; flex-grow: 1;}
        .plan-features li { display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.8rem; font-size: 0.9rem; color: #555; font-weight: 500;}
        .plan-features li i { color: var(--success); font-style: normal; font-weight: bold; }

        /* Acordeón de detalles */
        .plan-details-wrapper { margin-bottom: 1.5rem; }
        details.plan-accordion {
            background: var(--bg-subtle); border: 1px solid var(--border-color); border-radius: 8px; padding: 0.5rem 1rem;
        }
        details.plan-accordion summary {
            font-size: 0.85rem; font-weight: 700; color: var(--primary); cursor: pointer; list-style: none; display: flex; justify-content: space-between; align-items: center;
        }
        details.plan-accordion summary::-webkit-details-marker { display: none; }
        details.plan-accordion summary::after { content: '+'; font-size: 1.2rem; color: var(--accent); }
        details.plan-accordion[open] summary::after { content: '-'; }
        
        .details-list { margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #e0e0e0; max-height: 250px; overflow-y: auto; font-size: 0.8rem; }
        .details-list::-webkit-scrollbar { width: 4px; }
        .details-list::-webkit-scrollbar-thumb { background: var(--accent); border-radius: 4px; }
        .detail-item { display: flex; justify-content: space-between; margin-bottom: 0.5rem; padding-bottom: 0.5rem; border-bottom: 1px dashed #e5e5e5; }
        .detail-item-name { color: #444; max-width: 70%; line-height: 1.3;}
        .detail-item-price { font-weight: 600; color: var(--primary); }

        .btn-select-plan {
            padding: 1rem; background: var(--primary); color: white; border: none; border-radius: 8px;
            font-family: 'Syne', sans-serif; font-weight: 700; cursor: pointer; transition: all 0.3s ease; text-transform: uppercase; width: 100%;
        }
        .btn-select-plan:hover { background: var(--accent); box-shadow: 0 10px 20px rgba(212, 175, 55, 0.2); }
        .plan-card.experto .btn-select-plan { background: var(--accent); }
        .plan-card.experto .btn-select-plan:hover { background: var(--primary); }

        footer { background: var(--primary); color: white; margin-top: 6rem; padding: 3rem 2rem; text-align: center; font-size: 0.9rem; opacity: 0.9; }
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
        </div>
    </header>

    <section class="hero" id="inicio">
        <h1>Diseña tus espacios,<br><span class="accent-text">nosotros lo construimos</span></h1>
        <p class="hero-subtitle">Cotiza al instante la remodelación y acabados de tu apartamento en obra gris. Precisión, transparencia y diseño ajustado a tu medida.</p>
    </section>

    <main>
        <div class="form-container">
            <div class="form-header">
                <h2>Configurador de Proyecto</h2>
                <p>Ingresa los datos exactos de tu inmueble para un presupuesto preciso</p>
            </div>

            <form id="cotizacionForm" class="form-content">
                @csrf
                <div class="form-section">
                    <h3 class="form-section-title">1. Datos Personales</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Nombre <span class="required">*</span></label>
                            <input type="text" name="nombre" class="form-input" required>
                            <div class="form-error" data-field="nombre"></div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Apellido <span class="required">*</span></label>
                            <input type="text" name="apellido" class="form-input" required>
                            <div class="form-error" data-field="apellido"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Correo electrónico <span class="required">*</span></label>
                            <input type="email" name="email" class="form-input" required>
                            <div class="form-error" data-field="email"></div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Teléfono / WhatsApp <span class="required">*</span></label>
                            <input type="tel" name="telefono" class="form-input" required>
                            <div class="form-error" data-field="telefono"></div>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="form-section-title">2. Información del Inmueble (Obra Gris)</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Nombre del proyecto/conjunto</label>
                            <input type="text" name="nombre_proyecto" class="form-input" placeholder="Ej: Torres del Parque">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Fecha de entrega de la constructora</label>
                            <input type="date" name="fecha_entrega" class="form-input">
                        </div>
                    </div>
                    
                    <div class="form-row three-cols">
                        <div class="form-group">
                            <label class="form-label">Área Privada (m²) <span class="required">*</span></label>
                            <input type="number" name="area_privada" class="form-input" placeholder="Ej: 25" step="0.01" required>
                            <div class="form-error" data-field="area_privada"></div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Cant. de Habitaciones <span class="required">*</span></label>
                            <input type="number" name="num_habitaciones" class="form-input" value="1" min="1" required>
                            <div class="form-error" data-field="num_habitaciones"></div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Cant. de Baños <span class="required">*</span></label>
                            <input type="number" name="num_banos" class="form-input" value="1" min="1" required>
                            <div class="form-error" data-field="num_banos"></div>
                        </div>
                    </div>

                    <div class="form-row" style="margin-top: 1rem;">
                        <div class="toggle-container">
                            <span class="toggle-label">Mueble Alto Cocina</span>
                            <label class="switch">
                                <input type="checkbox" id="tiene_mueble_alto_cocina" checked>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="toggle-container">
                            <span class="toggle-label">Barra Auxiliar</span>
                            <label class="switch">
                                <input type="checkbox" id="tiene_barra_auxiliar" checked>
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div style="text-align: center;">
                    <button type="submit" class="btn-primary">
                        <span class="button-text">Calcular Presupuesto</span>
                    </button>
                </div>
            </form>
        </div>

        <div id="resultados-container" class="results-container">
            <h2 style="text-align: center; font-size: 2rem; font-family: 'Syne'; margin-bottom: 0.5rem;">Propuestas Generadas</h2>
            <p style="text-align: center; color: #666;">Basado en las características de tu apartamento</p>
            
            <div id="planes-list" class="plans-grid">
                </div>
        </div>
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Constructora Escuadr Arq S.A.S. - Expertos en acabados arquitectónicos.</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('cotizacionForm');
            const resultsContainer = document.getElementById('resultados-container');
            const planesList = document.getElementById('planes-list');
            const submitBtn = form.querySelector('button[type="submit"]');

            function limpiarErrores() {
                document.querySelectorAll('.form-error').forEach(d => { d.textContent = ''; d.classList.remove('show'); });
            }

            function mostrarErrores(errors) {
                Object.keys(errors).forEach(field => {
                    const div = document.querySelector(`[data-field="${field}"]`);
                    if (div) { div.textContent = errors[field][0]; div.classList.add('show'); }
                });
            }

            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                limpiarErrores();
                resultsContainer.classList.remove('visible');
                
                submitBtn.classList.add('loading'); 
                submitBtn.querySelector('.button-text').innerText = 'Calculando...';

                const formData = new FormData(form);
                const data = Object.fromEntries(formData.entries());
                
                // Mapeo de booleanos
                data.tiene_mueble_alto_cocina = document.getElementById('tiene_mueble_alto_cocina').checked ? 1 : 0;
                data.tiene_barra_auxiliar = document.getElementById('tiene_barra_auxiliar').checked ? 1 : 0;

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
                        mostrarPropuestas(result.propuestas, result.cotizacion.id);
                    } else if (response.status === 422) {
                        mostrarErrores(result.errors || result);
                    } else {
                        alert('Error: ' + (result.error || 'No se pudo generar la cotización'));
                    }
                } catch (error) {
                    alert('Error de conexión.');
                } finally {
                    submitBtn.classList.remove('loading');
                    submitBtn.querySelector('.button-text').innerText = 'Calcular Presupuesto';
                }
            });

            function formatCurrency(num) {
                return '$' + new Intl.NumberFormat('es-CO').format(num);
            }

            function mostrarPropuestas(propuestasObj, cotizacionId) {
                planesList.innerHTML = '';
                // Convertir el objeto {elemental: {}, estandar: {}, experto: {}} a un array
                const propuestas = Object.values(propuestasObj);

                propuestas.forEach((plan) => {
                    // Generar el HTML de los detalles de la obra
                    let detallesHTML = '';
                    if(plan.detalle && plan.detalle.length > 0) {
                        plan.detalle.forEach(item => {
                            detallesHTML += `
                                <div class="detail-item">
                                    <span class="detail-item-name"><strong>${item.categoria}:</strong> ${item.descripcion} (${item.cantidad} ${item.unidad})</span>
                                    <span class="detail-item-price">${formatCurrency(item.vr_total)}</span>
                                </div>
                            `;
                        });
                    }

                    // Definir beneficios rápidos según el tipo
                    let features = `<li><i>✓</i> Incluye Administración, Imprevistos y Utilidad</li>`;
                    if(plan.tipo === 'elemental') {
                        features += `<li><i>✓</i> Obra Blanca Básica (Muros, Pisos, Techos)</li><li><i>✓</i> Aseo final de obra</li>`;
                    } else if (plan.tipo === 'estandar') {
                        features += `<li><i>✓</i> Todo lo Elemental</li><li><i>✓</i> Carpintería de Madera</li><li><i>✓</i> Electrodomésticos y Vidrios</li>`;
                    } else {
                        features += `<li><i>✓</i> Todo lo Estándar</li><li><i>✓</i> Mesones en Quarztone</li><li><i>✓</i> Griferías y Aparatos Lujo</li><li><i>✓</i> Iluminación Especial</li>`;
                    }

                    const card = document.createElement('div');
                    card.className = `plan-card ${plan.tipo === 'experto' ? 'experto' : ''}`;
                    
                    card.innerHTML = `
                        <div class="plan-header">
                            <h3 class="plan-name">Propuesta ${plan.tipo}</h3>
                        </div>
                        <div class="plan-price">${plan.vr_total_formateado}</div>
                        <div class="plan-price-m2">Valor Ref: ${plan.precio_m2_formateado}</div>
                        
                        <ul class="plan-features">
                            ${features}
                        </ul>

                        <div class="plan-details-wrapper">
                            <details class="plan-accordion">
                                <summary>Ver desglose de la obra</summary>
                                <div class="details-list">
                                    ${detallesHTML}
                                    <div class="detail-item" style="border:none; margin-top:10px;">
                                        <span class="detail-item-name"><strong>A.I.U (19%)</strong></span>
                                        <span class="detail-item-price">${formatCurrency(plan.administracion_12pct + plan.imprevistos_3pct + plan.utilidad_4pct)}</span>
                                    </div>
                                    <div class="detail-item" style="border:none; margin-top:5px; padding-bottom:0;">
                                        <span class="detail-item-name"><strong>IVA sobre Utilidad (19%)</strong></span>
                                        <span class="detail-item-price">${formatCurrency(plan.iva_sobre_u_19pct)}</span>
                                    </div>
                                </div>
                            </details>
                        </div>

                        <button type="button" class="btn-select-plan" 
                            onclick="seleccionarPlan(${cotizacionId}, '${plan.tipo}', ${plan.vr_total}, ${plan.precio_oferta_m2}, this)">
                            Me interesa esta opción
                        </button>
                    `;
                    planesList.appendChild(card);
                });

                resultsContainer.classList.add('visible');
                setTimeout(() => { resultsContainer.scrollIntoView({ behavior: 'smooth', block: 'start' }); }, 300);
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
                        alert(`¡Excelente elección! Hemos notificado a nuestro equipo sobre tu interés en la propuesta ${tipoPropuesta.toUpperCase()}. Te contactaremos pronto vía WhatsApp.`);
                        btnElement.innerText = "¡Propuesta Enviada!";
                        btnElement.style.background = "var(--success)";
                    } else {
                        const err = await response.json();
                        alert('Error al seleccionar: ' + (err.error || 'Intenta de nuevo'));
                        btnElement.innerText = originalText;
                        btnElement.disabled = false;
                    }
                } catch (error) {
                    alert('Error de conexión.');
                    btnElement.innerText = originalText;
                    btnElement.disabled = false;
                }
            };
        });
    </script>
</body>
</html>