<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" style="font-family: 'Syne', sans-serif;">
            Administración | <span style="background: linear-gradient(135deg, #d4af37 0%, #f4d9a3 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Dalpor</span>
        </h2>
    </x-slot>

    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
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

        .dalpor-dashboard {
            font-family: 'Outfit', sans-serif;
            color: var(--primary);
            max-width: 1200px;
            margin: 3rem auto;
            padding: 0 1.5rem;
            letter-spacing: 0.3px;
        }

        .dalpor-dashboard h1, 
        .dalpor-dashboard h2, 
        .dalpor-dashboard h3 { 
            font-family: 'Syne', sans-serif; 
        }

        /* NAVEGACIÓN DE PESTAÑAS */
        .tabs-nav {
            display: flex;
            gap: 2rem;
            margin-bottom: 2rem;
            justify-content: center;
            border-bottom: 1px solid var(--border-color);
        }

        .tab-btn {
            background: transparent;
            border: none;
            color: #666;
            font-family: 'Syne', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            padding-bottom: 1rem;
        }

        .tab-btn.active { color: var(--primary); }
        .tab-btn:hover { color: var(--accent); }

        .tab-btn::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 0;
            height: 3px;
            background: var(--accent);
            transition: width 0.3s ease;
        }
        .tab-btn.active::after { width: 100%; }

        .tab-content { display: none; animation: slideUp 0.5s ease-out; }
        .tab-content.active { display: block; }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* CONTENEDORES PREMIUM */
        .form-container {
            background: white;
            border-radius: 16px;
            border: 1px solid var(--border-color);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            margin-bottom: 3rem;
        }

        .form-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            padding: 2.5rem 2rem;
            position: relative;
            overflow: hidden;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .form-header::before {
            content: '';
            position: absolute;
            top: 0; right: 0;
            width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.15) 0%, transparent 70%);
            border-radius: 50%;
        }

        .form-header h2 { font-size: 1.5rem; position: relative; z-index: 1; margin: 0; }
        .form-content { padding: 2rem; }

        /* TABLAS PREMIUM */
        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }

        .admin-table th {
            font-family: 'Syne', sans-serif;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--primary);
            padding: 1rem;
            border-bottom: 2px solid var(--accent);
            text-align: left;
            background: var(--bg-subtle);
        }

        .admin-table td {
            padding: 1.2rem 1rem;
            border-bottom: 1px solid var(--border-color);
            font-size: 0.95rem;
        }

        /* BOTONES */
        .btn-primary {
            padding: 0.8rem 1.5rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-family: 'Syne', sans-serif;
            font-size: 0.85rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.4s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            color: var(--accent);
        }

        .btn-select-plan {
            padding: 0.5rem 1rem;
            background: transparent;
            border: 1px solid var(--accent);
            color: var(--accent);
            border-radius: 6px;
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.75rem;
            text-transform: uppercase;
        }
        .btn-select-plan:hover { background: var(--accent); color: white; }
        
        .btn-danger { border-color: var(--error); color: var(--error); }
        .btn-danger:hover { background: var(--error); color: white; }

        /* FORMULARIO INTERNO */
        .form-group { margin-bottom: 1.5rem; display: flex; flex-direction: column; }
        .form-label {
            font-family: 'Syne', sans-serif;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 0.7rem;
            text-transform: capitalize;
        }
        .form-input {
            padding: 0.85rem 1.2rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-family: 'Outfit', sans-serif;
            background: var(--bg-subtle);
            color: var(--primary);
            transition: all 0.3s ease;
            width: 100%;
            box-sizing: border-box;
        }
        .form-input:focus {
            outline: none;
            border-color: var(--accent);
            background: white;
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        @media (min-width: 768px) {
            .form-grid { grid-template-columns: 1fr 1fr; }
        }
    </style>

    <div class="dalpor-dashboard">
        <div class="tabs-nav">
            <button class="tab-btn active" onclick="switchTab('productos')">Gestión de Productos</button>
            <button class="tab-btn" onclick="switchTab('cotizaciones')">Cotizaciones Recibidas</button>
        </div>

        <div id="tab-productos" class="tab-content active">
            
            <div class="form-container">
                <div class="form-header">
                    <h2 id="form-title" style="color: white;">✨ Crear Nuevo Producto</h2>
                    <button type="button" class="btn-select-plan" onclick="resetForm()" style="background: white;">Limpiar Formulario</button>
                </div>
                
                <form id="productoForm" class="form-content">
                    <input type="hidden" id="producto_id">
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Tipo de obra <span style="color:#ef4444">*</span></label>
                            <input type="text" id="tipo_obra" class="form-input" placeholder="Ej: Obra gris" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Precio Base (COP) <span style="color:#ef4444">*</span></label>
                            <input type="number" id="precio" class="form-input" placeholder="Ej: 15000000" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Planes / Descripción <span style="color:#ef4444">*</span></label>
                        <input type="text" id="planes" class="form-input" placeholder="Ej: Plan Básico con acabados estándar" required>
                    </div>

                    <div style="text-align: right; margin-top: 1rem;">
                        <button type="submit" class="btn-primary" id="btn-save">Guardar Producto</button>
                    </div>
                </form>
            </div>

            <div class="form-container">
                <div class="form-header" style="background: var(--primary-light);">
                    <h2 style="color: white;">Productos Disponibles</h2>
                </div>
                <div class="form-content" style="padding: 0; overflow-x: auto;">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tipo de Obra</th>
                                <th>Descripción / Plan</th>
                                <th>Precio</th>
                                <th style="text-align: right;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="productos-tbody">
                            <tr><td colspan="5" style="text-align: center; padding: 2rem;">Cargando...</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div id="tab-cotizaciones" class="tab-content">
            <div class="form-container">
                <div class="form-header">
                    <h2 style="color: white;">Historial de Cotizaciones</h2>
                    <button class="btn-primary" onclick="loadCotizaciones()" style="background: white; color: var(--primary);">Actualizar Lista</button>
                </div>
                <div class="form-content" style="padding: 0; overflow-x: auto;">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Email</th>
                                <th>Proyecto / Obra</th>
                                <th>Área</th>
                                <th>Entrega</th>
                            </tr>
                        </thead>
                        <tbody id="cotizaciones-tbody">
                            <tr><td colspan="6" style="text-align: center; padding: 2rem;">Cargando cotizaciones...</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <script>
        // CONFIGURACIÓN MAESTRA PARA BREEZE / SANCTUM
        const fetchConfig = {
            // Esto le dice a JS que agarre la cookie de sesión de tu login de Breeze 
            // y la mande al backend de forma segura en cada petición API.
            credentials: 'same-origin', 
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
            }
        };

        const formatCOP = (value) => new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP', minimumFractionDigits: 0 }).format(value);

        document.addEventListener('DOMContentLoaded', () => {
            loadProductos();
            loadCotizaciones();
            
            document.getElementById('productoForm').addEventListener('submit', async (e) => {
                e.preventDefault();
                await saveProducto();
            });
        });

        window.switchTab = (tabId) => {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
            document.getElementById('tab-' + tabId).classList.add('active');
            event.currentTarget.classList.add('active');
        };

        // ==========================================
        // APIS: PRODUCTOS
        // ==========================================
        async function loadProductos() {
            try {
                // Fíjate cómo paso el fetchConfig con las credenciales activadas
                const res = await fetch('/api/productos/crear', { method: 'GET', ...fetchConfig });
                
                if (!res.ok) throw new Error(`HTTP error! status: ${res.status}`);
                
                const json = await res.json();
                const tbody = document.getElementById('productos-tbody');
                tbody.innerHTML = '';

                const productos = json.data || json;
                if(!productos.length) {
                    tbody.innerHTML = '<tr><td colspan="5" style="text-align:center;">No hay productos.</td></tr>';
                    return;
                }

                productos.forEach(prod => {
                    tbody.innerHTML += `
                        <tr>
                            <td><strong>#${prod.id}</strong></td>
                            <td><span style="color: var(--success); font-weight: bold;">${prod.tipo_obra}</span></td>
                            <td>${prod.planes}</td>
                            <td><strong>${formatCOP(prod.precio)}</strong></td>
                            <td style="text-align: right; white-space: nowrap;">
                                <button class="btn-select-plan" onclick="editProducto(${prod.id})">Editar</button>
                                <button class="btn-select-plan btn-danger" onclick="deleteProducto(${prod.id})" style="margin-left: 0.5rem;">Eliminar</button>
                            </td>
                        </tr>
                    `;
                });
            } catch (error) { 
                console.error("Error GET Productos:", error); 
                document.getElementById('productos-tbody').innerHTML = '<tr><td colspan="5" style="text-align:center; color: red;">Error 401: No autorizado (Revisa tu sesión)</td></tr>';
            }
        }

        async function saveProducto() {
            const id = document.getElementById('producto_id').value;
            const payload = {
                tipo_obra: document.getElementById('tipo_obra').value,
                planes: document.getElementById('planes').value,
                precio: document.getElementById('precio').value
            };

            const method = id ? 'PUT' : 'POST';
            const url = id ? `/api/productos/crear/${id}` : '/api/productos/crear';

            const btn = document.getElementById('btn-save');
            btn.textContent = 'Procesando...';
            btn.disabled = true;

            try {
                const res = await fetch(url, { 
                    method: method, 
                    ...fetchConfig, 
                    body: JSON.stringify(payload) 
                });
                
                if(res.ok) {
                    resetForm();
                    loadProductos();
                    alert(id ? 'Actualizado con éxito' : 'Creado con éxito');
                } else {
                    const err = await res.json();
                    alert('Error en validación: ' + JSON.stringify(err));
                }
            } catch (error) { 
                console.error("Error Guardando:", error); 
            } finally { 
                btn.textContent = 'Guardar Producto'; btn.disabled = false; 
            }
        }

        async function editProducto(id) {
            try {
                const res = await fetch(`/api/productos/crear/${id}`, { method: 'GET', ...fetchConfig });
                const json = await res.json();
                const prod = json.data || json;

                document.getElementById('producto_id').value = prod.id;
                document.getElementById('tipo_obra').value = prod.tipo_obra;
                document.getElementById('planes').value = prod.planes;
                document.getElementById('precio').value = prod.precio;
                
                document.getElementById('form-title').textContent = `✏️ Editando Producto #${prod.id}`;
                window.scrollTo({ top: 0, behavior: 'smooth' });
            } catch (error) { console.error("Error GET Show:", error); }
        }

        async function deleteProducto(id) {
            if(!confirm('¿Eliminar definitivamente este producto?')) return;
            try {
                const res = await fetch(`/api/productos/crear/${id}`, { method: 'DELETE', ...fetchConfig });
                if(res.ok) loadProductos();
            } catch (error) { console.error("Error DELETE:", error); }
        }

        function resetForm() {
            document.getElementById('productoForm').reset();
            document.getElementById('producto_id').value = '';
            document.getElementById('form-title').textContent = '✨ Crear Nuevo Producto';
        }

        // ==========================================
        // APIS: COTIZACIONES
        // ==========================================
        async function loadCotizaciones() {
            try {
                const res = await fetch('/api/cotizacion/index', { method: 'GET', ...fetchConfig });
                
                if (!res.ok) throw new Error(`HTTP error! status: ${res.status}`);

                const cotizaciones = await res.json();
                const tbody = document.getElementById('cotizaciones-tbody');
                tbody.innerHTML = '';

                if(!cotizaciones.length) {
                    tbody.innerHTML = '<tr><td colspan="6" style="text-align:center;">No hay cotizaciones registradas.</td></tr>';
                    return;
                }

                cotizaciones.forEach(cot => {
                    tbody.innerHTML += `
                        <tr>
                            <td>#${cot.id}</td>
                            <td><strong>${cot.nombre} ${cot.apellido || ''}</strong><br><small style="color:#666;">${cot.telefono}</small></td>
                            <td>${cot.email}</td>
                            <td><span style="color: var(--info); font-weight: bold;">${cot.tipo_obra || 'N/A'}</span><br><small>${cot.nombre_proyecto || ''}</small></td>
                            <td>${cot.area_privada ? cot.area_privada + ' m²' : '-'}</td>
                            <td>${cot.fecha_entrega || '-'}</td>
                        </tr>
                    `;
                });
            } catch (error) { 
                console.error("Error GET Cotizaciones:", error); 
                document.getElementById('cotizaciones-tbody').innerHTML = '<tr><td colspan="6" style="text-align:center; color: red;">Error 401 al cargar cotizaciones</td></tr>';
            }
        }
    </script>
</x-app-layout>