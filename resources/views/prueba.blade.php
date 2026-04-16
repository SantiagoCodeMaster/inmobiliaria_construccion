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

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { scroll-behavior: smooth; }

        body {
            font-family: 'Outfit', sans-serif;
            background: #ffffff;
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
            background: rgba(255, 255, 255, 0.98);
            border-bottom: 1px solid var(--border-color);
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        }

        .header-container {
            display: flex; justify-content: space-between; align-items: center;
            padding: 1rem 2rem; max-width: 1400px; margin: 0 auto;
        }

        .brand-container { display: flex; align-items: center; gap: 0.75rem; text-decoration: none; }
        .brand-img { height: 40px; width: auto; display: block; object-fit: contain; }
        .brand-text-wrapper { display: flex; flex-direction: column; justify-content: center; }
        .brand-title { font-family: 'Syne', sans-serif; font-size: 1.25rem; font-weight: 800; color: var(--primary); line-height: 1.1; }
        .brand-subtitle { font-family: 'Outfit', sans-serif; font-size: 0.65rem; font-weight: 700; color: var(--accent-dark); letter-spacing: 2px; text-transform: uppercase; }

        /* Wizard Container */
        .wizard-wrapper {
            max-width: 800px;
            margin: 3rem auto;
            padding: 0 1.5rem;
        }

        .wizard-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        
        .wizard-header h1 {
            font-size: clamp(2rem, 4vw, 3rem);
            margin-bottom: 1rem;
        }
        
        .accent-text {
            background: linear-gradient(135deg, var(--accent) 0%, #f4d9a3 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Progress Bar */
        .progress-container {
            width: 100%;
            height: 6px;
            background: var(--border-color);
            border-radius: 10px;
            margin-bottom: 3rem;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background: var(--accent);
            width: 33.33%;
            transition: width 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Form Steps */
        .wizard-form {
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.04);
            overflow: hidden;
            position: relative;
            min-height: 400px;
        }

        .step-content {
            display: none;
            padding: 3rem;
            animation: fadeIn 0.5s ease-out forwards;
        }

        .step-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .step-title {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            color: var(--primary);
        }
        
        .step-subtitle {
            color: #666;
            margin-bottom: 2rem;
            font-size: 0.95rem;
        }

        /* Inputs & Interactive elements */
        .form-group { margin-bottom: 1.5rem; }
        .form-label { display: block; font-size: 0.95rem; font-weight: 600; margin-bottom: 0.5rem; color: var(--primary); }
        .form-label .required { color: var(--accent-dark); }
        
        .form-input {
            width: 100%;
            padding: 1rem 1.2rem;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            font-family: 'Outfit', sans-serif;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: var(--bg-subtle);
        }
        
        .form-input:focus {
            outline: none;
            border-color: var(--accent);
            background: white;
            box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.1);
        }

        /* Number Stepper UI */
        .stepper-group {
            display: flex;
            align-items: center;
            gap: 1rem;
            background: var(--bg-subtle);
            padding: 0.5rem;
            border-radius: 12px;
            border: 2px solid var(--border-color);
            width: fit-content;
        }

        .btn-stepper {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            border: none;
            background: white;
            color: var(--primary);
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            transition: all 0.2s;
        }

        .btn-stepper:hover { background: var(--accent); color: white; }
        .stepper-value { font-size: 1.2rem; font-weight: 700; width: 40px; text-align: center; border: none; background: transparent; pointer-events: none;}

        .grid-2 { display: grid; grid-template-columns: 1fr; gap: 1.5rem; }
        @media (min-width: 600px) { .grid-2 { grid-template-columns: 1fr 1fr; } }

        /* Navigation Buttons */
        .wizard-footer {
            padding: 1.5rem 3rem;
            background: var(--bg-subtle);
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn {
            padding: 0.8rem 2rem;
            border-radius: 10px;
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-back {
            background: transparent;
            color: #666;
            border: 2px solid var(--border-color);
        }
        
        .btn-back:hover { background: var(--border-color); color: var(--primary); }

        .btn-next, .btn-submit {
            background: var(--primary);
            color: white;
        }
        
        .btn-next:hover, .btn-submit:hover {
            background: var(--accent);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(212, 175, 55, 0.2);
        }

        .btn-submit.loading { opacity: 0.7; cursor: wait; }

        /* Error styling */
        .form-error { color: var(--error); font-size: 0.85rem; margin-top: 0.5rem; display: none; }
        .form-error.show { display: block; }
        .input-error { border-color: var(--error) !important; }

        /* Resultados */
        .results-container { max-width: 1200px; margin: 3rem auto 5rem; padding: 0 2rem; display: none; opacity: 0; }
        .results-container.visible { display: block; animation: slideUp 0.8s ease-out forwards; }
        
        @keyframes slideUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }

        .plans-grid { display: grid; grid-template-columns: 1fr; gap: 2rem; margin-top: 3rem; }
        @media (min-width: 1024px) { .plans-grid { grid-template-columns: repeat(3, 1fr); } }

        .plan-card {
            border: 2px solid var(--border-color); border-radius: 16px; padding: 2.5rem 2rem; background: white;
            transition: all 0.4s ease; display: flex; flex-direction: column; position: relative; overflow: hidden;
        }
        .plan-card:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,0.08); }
        .plan-card.experto { border-color: var(--accent); border-width: 3px; box-shadow: 0 10px 30px rgba(212, 175, 55, 0.15); }
        .plan-card.experto::before {
            content: 'El Más Elegido'; position: absolute; top: 20px; right: -35px; background: var(--accent);
            color: white; font-size: 0.75rem; font-weight: 700; padding: 6px 40px; transform: rotate(45deg); text-transform: uppercase;
        }
        
        .plan-name { font-family: 'Syne', sans-serif; font-size: 1.4rem; font-weight: 800; color: var(--primary); text-transform: uppercase; margin-bottom: 0.5rem; }
        .plan-price { font-size: 2.5rem; font-weight: 800; color: var(--primary); margin-top: 0.5rem; letter-spacing: -1px; }
        .plan-price-m2 { font-size: 0.9rem; color: var(--accent-dark); font-weight: 600; margin-bottom: 1.5rem; padding-bottom: 1.5rem; border-bottom: 1px solid var(--border-color); }

        .plan-features { list-style: none; margin-bottom: 1.5rem; }
        .plan-features li { display: flex; align-items: flex-start; gap: 0.75rem; margin-bottom: 1rem; font-size: 0.95rem; color: #555; font-weight: 500;}
        .plan-features li i { color: var(--accent); font-style: normal; font-weight: bold; margin-top: 2px; }

        /* Acordeón de detalles rediseñado */
        .plan-details-wrapper { margin-bottom: 2rem; flex-grow: 1; }
        details.plan-accordion {
            background: var(--bg-subtle); border: 1px solid var(--border-color); border-radius: 12px; padding: 1rem;
        }
        details.plan-accordion summary {
            font-size: 0.95rem; font-weight: 700; color: var(--primary); cursor: pointer; list-style: none; display: flex; justify-content: space-between; align-items: center;
        }
        details.plan-accordion summary::-webkit-details-marker { display: none; }
        details.plan-accordion summary::after { content: '+'; font-size: 1.4rem; color: var(--accent); transition: transform 0.3s ease; }
        details.plan-accordion[open] summary::after { content: '-'; }
        
        .details-list { margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #e0e0e0; max-height: 280px; overflow-y: auto; font-size: 0.85rem; }
        .details-list::-webkit-scrollbar { width: 4px; }
        .details-list::-webkit-scrollbar-thumb { background: var(--accent); border-radius: 4px; }
        
        /* Modificado para no mostrar precio y alinear a la izquierda */
        .detail-item { display: flex; align-items: flex-start; gap: 0.5rem; margin-bottom: 0.8rem; padding-bottom: 0.8rem; border-bottom: 1px dashed #e5e5e5; }
        .detail-item:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }
        .detail-item i { color: var(--success); font-weight: bold; font-style: normal; margin-top: 1px;}
        .detail-item-name { color: #444; line-height: 1.4; width: 100%; }

        .btn-select-plan {
            padding: 1.2rem; background: var(--primary); color: white; border: none; border-radius: 12px;
            font-family: 'Syne', sans-serif; font-weight: 700; font-size: 1rem; cursor: pointer; transition: all 0.3s ease; text-transform: uppercase; width: 100%;
        }
        .btn-select-plan:hover { background: var(--accent); }
        .plan-card.experto .btn-select-plan { background: var(--accent); color: white; }
        .plan-card.experto .btn-select-plan:hover { background: var(--primary); }

        footer { background: var(--primary); color: white; padding: 2rem; text-align: center; font-size: 0.9rem; margin-top: auto; }
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
        </div>
    </header>

    <main class="wizard-wrapper" id="cotizador-section">
        <div class="wizard-header">
            <h1>Personaliza tu <span class="accent-text">Obra Gris</span></h1>
            <p>Descubre el valor exacto de tus acabados en menos de 1 minuto.</p>
        </div>

        <div class="progress-container">
            <div class="progress-bar" id="progressBar"></div>
        </div>

        <form id="cotizacionForm" class="wizard-form">
            @csrf

            <div class="step-content active" data-step="1">
                <h2 class="step-title">Sobre el proyecto</h2>
                <p class="step-subtitle">Empecemos con lo básico de tu inmueble.</p>

                <div class="form-group">
                    <label class="form-label">Nombre del proyecto/conjunto</label>
                    <input type="text" name="nombre_proyecto" class="form-input" placeholder="Ej: Torres del Parque">
                </div>
                
                <div class="grid-2">
                    <div class="form-group">
                        <label class="form-label">Área Privada (m²) <span class="required">*</span></label>
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
                <h2 class="step-title">Distribución</h2>
                <p class="step-subtitle">¿Cómo está dividido el espacio?</p>

                <div class="grid-2">
                    <div class="form-group">
                        <label class="form-label">Habitaciones <span class="required">*</span></label>
                        <div class="stepper-group">
                            <button type="button" class="btn-stepper" onclick="updateStepper('num_habitaciones', -1)">-</button>
                            <input type="text" name="num_habitaciones" id="num_habitaciones" class="stepper-value" value="1" readonly required>
                            <button type="button" class="btn-stepper" onclick="updateStepper('num_habitaciones', 1)">+</button>
                        </div>
                        <div class="form-error" data-field="num_habitaciones"></div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Baños <span class="required">*</span></label>
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
                <h2 class="step-title">¿A dónde enviamos tu presupuesto?</h2>
                <p class="step-subtitle">Tus resultados están listos. Déjanos tus datos para mostrártelos.</p>

                <div class="grid-2">
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

                <div class="grid-2">
                    <div class="form-group">
                        <label class="form-label">WhatsApp <span class="required">*</span></label>
                        <input type="tel" name="telefono" class="form-input" placeholder="Ej: 300 123 4567" required>
                        <div class="form-error" data-field="telefono"></div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Correo electrónico <span class="required">*</span></label>
                        <input type="email" name="email" class="form-input" placeholder="tu@email.com" required>
                        <div class="form-error" data-field="email"></div>
                    </div>
                </div>
            </div>

            <div class="wizard-footer">
                <button type="button" class="btn btn-back" id="btnPrev" style="display: none;">Volver</button>
                <div style="flex-grow: 1;"></div> <button type="button" class="btn btn-next" id="btnNext">Continuar</button>
                <button type="submit" class="btn btn-submit" id="btnSubmit" style="display: none;">Ver Presupuestos</button>
            </div>
        </form>
    </main>

    <section id="resultados-container" class="results-container">
        <h2 style="text-align: center; font-size: 2.5rem; margin-bottom: 0.5rem; color: var(--primary);">Tus Opciones de Acabados</h2>
        <p style="text-align: center; color: #666; font-size: 1.1rem;">Hemos calculado 3 escenarios basados en la volumetría de tu apartamento.</p>
        
        <div id="planes-list" class="plans-grid"></div>
    </section>

    <footer>
        <p>&copy; {{ date('Y') }} Constructora Escuadr Arq S.A.S. - Transformamos tu obra gris en un hogar.</p>
    </footer>

    <script>
        // Logica del Stepper (+ / -)
        function updateStepper(fieldId, change) {
            const input = document.getElementById(fieldId);
            let value = parseInt(input.value) || 1;
            value += change;
            if (value < 1) value = 1;
            input.value = value;
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Referencias DOM Wizard
            const form = document.getElementById('cotizacionForm');
            const steps = Array.from(document.querySelectorAll('.step-content'));
            const btnNext = document.getElementById('btnNext');
            const btnPrev = document.getElementById('btnPrev');
            const btnSubmit = document.getElementById('btnSubmit');
            const progressBar = document.getElementById('progressBar');
            
            // Referencias DOM Resultados
            const resultsContainer = document.getElementById('resultados-container');
            const planesList = document.getElementById('planes-list');
            const cotizadorSection = document.getElementById('cotizador-section');

            let currentStep = 0;

            function updateWizard() {
                // Actualizar vistas
                steps.forEach((step, index) => {
                    step.classList.toggle('active', index === currentStep);
                });

                // Actualizar botones
                btnPrev.style.display = currentStep > 0 ? 'block' : 'none';
                
                if (currentStep === steps.length - 1) {
                    btnNext.style.display = 'none';
                    btnSubmit.style.display = 'block';
                } else {
                    btnNext.style.display = 'block';
                    btnSubmit.style.display = 'none';
                }

                // Actualizar barra de progreso
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
                    // Feedback visual sutil (Shake)
                    activeStep.style.transform = 'translateX(5px)';
                    setTimeout(() => activeStep.style.transform = 'translateX(-5px)', 100);
                    setTimeout(() => activeStep.style.transform = 'translateX(0)', 200);
                }

                return isValid;
            }

            btnNext.addEventListener('click', () => {
                if (validateCurrentStep()) {
                    currentStep++;
                    updateWizard();
                }
            });

            btnPrev.addEventListener('click', () => {
                currentStep--;
                updateWizard();
            });

            // Errores desde el backend
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

            // Envio del formulario
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                if (!validateCurrentStep()) return;

                limpiarErrores();
                
                btnSubmit.classList.add('loading'); 
                btnSubmit.innerText = 'Calculando...';
                btnSubmit.disabled = true;

                const formData = new FormData(form);
                const data = Object.fromEntries(formData.entries());
                
                // Forzamos los valores de la cocina
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
                        // Ocultar wizard y mostrar resultados
                        cotizadorSection.style.display = 'none';
                        mostrarPropuestas(result.propuestas, result.cotizacion.id);
                    } else if (response.status === 422) {
                        mostrarErrores(result.errors || result);
                    } else {
                        alert('Error: ' + (result.error || 'No se pudo generar la cotización'));
                    }
                } catch (error) {
                    alert('Hubo un problema de conexión. Intenta de nuevo.');
                } finally {
                    btnSubmit.classList.remove('loading');
                    btnSubmit.innerText = 'Ver Presupuestos';
                    btnSubmit.disabled = false;
                }
            });

            function mostrarPropuestas(propuestasObj, cotizacionId) {
                planesList.innerHTML = '';
                const propuestas = Object.values(propuestasObj);

                propuestas.forEach((plan) => {
                    // Generar la lista detallada SIN PRECIOS
                    let detallesHTML = '';
                    if(plan.detalle && plan.detalle.length > 0) {
                        plan.detalle.forEach(item => {
                            detallesHTML += `
                                <div class="detail-item">
                                    <i>✓</i>
                                    <span class="detail-item-name"><strong>${item.categoria}:</strong> ${item.descripcion} (${item.cantidad} ${item.unidad})</span>
                                </div>
                            `;
                        });
                    }

                    // Resumen rápido de viñetas
                    let features = `<li><i>✓</i> Diseño, Administración y A.I.U incluido</li>`;
                    if(plan.tipo === 'elemental') {
                        features += `<li><i>✓</i> Muros, Pisos y Techos listos</li><li><i>✓</i> Aseo final especializado</li>`;
                    } else if (plan.tipo === 'estandar') {
                        features += `<li><i>✓</i> Todo lo Elemental</li><li><i>✓</i> Carpintería arquitectónica en madera</li><li><i>✓</i> Electrodomésticos y divisiones en vidrio</li>`;
                    } else {
                        features += `<li><i>✓</i> Todo lo Estándar</li><li><i>✓</i> Mesones en Quarztone</li><li><i>✓</i> Griferías y Aparatos de Lujo</li><li><i>✓</i> Iluminación Especializada</li>`;
                    }

                    const card = document.createElement('div');
                    card.className = `plan-card ${plan.tipo === 'experto' ? 'experto' : ''}`;
                    
                    card.innerHTML = `
                        <div>
                            <h3 class="plan-name">Línea ${plan.tipo}</h3>
                            <div class="plan-price">${plan.vr_total_formateado}</div>
                            <div class="plan-price-m2">Valor estimado por m²: ${plan.precio_m2_formateado}</div>
                            
                            <ul class="plan-features">
                                ${features}
                            </ul>
                        </div>

                        <div class="plan-details-wrapper">
                            <details class="plan-accordion">
                                <summary>Ver todo lo que incluye</summary>
                                <div class="details-list">
                                    ${detallesHTML}
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
                window.scrollTo({ top: 0, behavior: 'smooth' });
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
                        alert(`¡Excelente elección! Hemos registrado tu interés en la línea ${tipoPropuesta.toUpperCase()}. Uno de nuestros asesores te contactará vía WhatsApp para afinar los detalles.`);
                        btnElement.innerText = "¡Solicitud Enviada!";
                        btnElement.style.background = "var(--success)";
                        btnElement.style.color = "white";
                    } else {
                        const err = await response.json();
                        alert('Error al seleccionar: ' + (err.error || 'Intenta de nuevo'));
                        btnElement.innerText = originalText;
                        btnElement.disabled = false;
                    }
                } catch (error) {
                    alert('Error de red. Verifica tu conexión.');
                    btnElement.innerText = originalText;
                    btnElement.disabled = false;
                }
            };
            
            // Inicializar estado del wizard
            updateWizard();
        });
    </script>
</body>
</html>