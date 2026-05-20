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
            --error: #ef4444;
            --border-color: #e5e5e5;
            --bg-subtle: #f9f9f9;
        }

        .dalpor-dashboard {
            font-family: 'Outfit', sans-serif;
            color: var(--primary);
            max-width: 1400px;
            margin: 3rem auto;
            padding: 0 1.5rem;
        }

        .form-container {
            background: white;
            border-radius: 16px;
            border: 1px solid var(--border-color);
            box-shadow: 0 20px 60px rgba(0,0,0,0.06);
            overflow: hidden;
            margin-bottom: 3rem;
        }

        .form-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            padding: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .form-header::before {
            content: '';
            position: absolute;
            top: 0; right: 0;
            width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(212,175,55,0.15) 0%, transparent 70%);
            border-radius: 50%;
        }

        .form-header h2 {
            font-family: 'Syne', sans-serif;
            font-size: 1.4rem;
            margin: 0;
            position: relative;
            z-index: 1;
        }

        .form-header small {
            font-size: 0.85rem;
            opacity: 0.7;
            display: block;
            margin-top: 0.3rem;
            position: relative;
            z-index: 1;
        }

        .btn-refresh {
            padding: 0.7rem 1.4rem;
            background: white;
            color: var(--primary);
            border: none;
            border-radius: 8px;
            font-family: 'Syne', sans-serif;
            font-size: 0.8rem;
            font-weight: 700;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-decoration: none;
            position: relative;
            z-index: 1;
            transition: opacity 0.2s;
        }
        .btn-refresh:hover { opacity: 0.85; }

        .admin-table { width: 100%; border-collapse: collapse; }

        .admin-table th {
            font-family: 'Syne', sans-serif;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--primary);
            padding: 1rem;
            border-bottom: 2px solid var(--accent);
            text-align: left;
            background: var(--bg-subtle);
            white-space: nowrap;
        }

        .admin-table td {
            padding: 0.9rem 1rem;
            border-bottom: 1px solid var(--border-color);
            font-size: 0.88rem;
            vertical-align: middle;
        }

        .admin-table tr:last-child td { border-bottom: none; }
        .admin-table tr:hover td { background: #fafaf8; }

        .badge {
            display: inline-block;
            padding: 0.25rem 0.7rem;
            border-radius: 20px;
            font-size: 0.72rem;
            font-weight: 600;
            font-family: 'Syne', sans-serif;
        }
        .badge-obra { background: #eff6ff; color: #2563eb; }

        .btn-action {
            padding: 0.4rem 0.9rem;
            border-radius: 6px;
            font-family: 'Syne', sans-serif;
            font-size: 0.72rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            border: 1px solid transparent;
        }
        .btn-edit {
            background: transparent;
            border-color: var(--accent);
            color: #b8941f;
        }
        .btn-edit:hover { background: var(--accent); color: white; }

        .btn-delete {
            background: transparent;
            border-color: var(--error);
            color: var(--error);
            margin-left: 0.4rem;
        }
        .btn-delete:hover { background: var(--error); color: white; }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #999;
            font-size: 0.95rem;
        }

        [x-cloak] { display: none !important; }

        /* ALERT */
        .alert-success {
            background: #d1fae5;
            border: 1px solid #a7f3d0;
            color: #065f46;
            padding: 1rem 1.5rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            font-family: 'Outfit', sans-serif;
        }

        /* MODAL */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.55);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            padding: 1rem;
        }

        .modal-box {
            background: white;
            border-radius: 16px;
            width: 100%;
            max-width: 700px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 40px 80px rgba(0,0,0,0.25);
        }

        .modal-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 16px 16px 0 0;
        }

        .modal-header h3 {
            font-family: 'Syne', sans-serif;
            font-size: 1.1rem;
            margin: 0;
        }

        .modal-close {
            background: transparent;
            border: none;
            color: white;
            font-size: 1.4rem;
            cursor: pointer;
            line-height: 1;
            opacity: 0.8;
            transition: opacity 0.2s;
        }
        .modal-close:hover { opacity: 1; }

        .modal-body { padding: 2rem; }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.2rem;
        }
        @media (max-width: 600px) { .form-grid { grid-template-columns: 1fr; } }

        .form-group { display: flex; flex-direction: column; }
        .form-group.full { grid-column: 1 / -1; }

        .form-label {
            font-family: 'Syne', sans-serif;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-input {
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-family: 'Outfit', sans-serif;
            font-size: 0.9rem;
            background: var(--bg-subtle);
            color: var(--primary);
            transition: all 0.2s;
            width: 100%;
            box-sizing: border-box;
        }
        .form-input:focus {
            outline: none;
            border-color: var(--accent);
            background: white;
            box-shadow: 0 0 0 3px rgba(212,175,55,0.12);
        }

        .modal-footer {
            padding: 1.2rem 2rem;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: flex-end;
            gap: 0.8rem;
        }

        .btn-cancel {
            padding: 0.7rem 1.4rem;
            background: var(--bg-subtle);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-family: 'Syne', sans-serif;
            font-size: 0.82rem;
            font-weight: 700;
            cursor: pointer;
            text-transform: uppercase;
        }

        .btn-save {
            padding: 0.7rem 1.8rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-family: 'Syne', sans-serif;
            font-size: 0.82rem;
            font-weight: 700;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        .btn-save:hover { opacity: 0.9; }
    </style>

    {{-- Datos de cotizaciones como JSON para Alpine --}}
    <script>
        const cotizacionesData = @json($cotizaciones);
    </script>

    <div class="dalpor-dashboard" x-data="adminDashboard()">

        @if(session('success'))
            <div class="alert-success">✓ {{ session('success') }}</div>
        @endif

        <div class="form-container">
            <div class="form-header">
                <div>
                    <h2>Cotizaciones Recibidas</h2>
                    <small>{{ $cotizaciones->count() }} registro{{ $cotizaciones->count() !== 1 ? 's' : '' }} en total</small>
                </div>
                <a href="{{ route('dashboard') }}" class="btn-refresh">↻ Actualizar</a>
            </div>

            <div style="overflow-x: auto;">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Tipo de Obra</th>
                            <th>Proyecto</th>
                            <th>Área (m²)</th>
                            <th>Fecha Entrega</th>
                            <th>Recibida</th>
                            @if(auth()->user()->is_admin)
                                <th style="text-align:right;">Acciones</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cotizaciones as $cot)
                            <tr>
                                <td><strong>#{{ $cot->id }}</strong></td>
                                <td><strong>{{ $cot->nombre }} {{ $cot->apellido }}</strong></td>
                                <td style="color:#555;">{{ $cot->email }}</td>
                                <td style="color:#555;">{{ $cot->telefono ?? '-' }}</td>
                                <td>
                                    @if($cot->tipo_obra)
                                        <span class="badge badge-obra">{{ $cot->tipo_obra }}</span>
                                    @else
                                        <span style="color:#aaa;">—</span>
                                    @endif
                                </td>
                                <td>{{ $cot->nombre_proyecto ?? '-' }}</td>
                                <td>{{ $cot->area_privada ? number_format($cot->area_privada, 0, ',', '.') : '-' }}</td>
                                <td>{{ $cot->fecha_entrega ? $cot->fecha_entrega->format('d/m/Y') : '-' }}</td>
                                <td style="color:#888; font-size:0.82rem;">{{ $cot->created_at->format('d/m/Y H:i') }}</td>
                                @if(auth()->user()->is_admin)
                                    <td style="text-align:right; white-space:nowrap;">
                                        {{-- Botón Editar --}}
                                        <button
                                            type="button"
                                            class="btn-action btn-edit"
                                            @click="openEdit({{ $cot->id }})"
                                        >Editar</button>

                                        {{-- Botón Eliminar --}}
                                        <form
                                            method="POST"
                                            action="{{ route('admin.cotizaciones.destroy', $cot->id) }}"
                                            style="display:inline;"
                                            @submit.prevent="confirmDelete($event)"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete">Eliminar</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ auth()->user()->is_admin ? 10 : 9 }}" class="empty-state">
                                    No hay cotizaciones registradas aún.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- MODAL DE EDICIÓN --}}
        <div class="modal-overlay" x-show="showModal" x-cloak @click.self="closeModal()">
            <div class="modal-box" @click.stop>
                <div class="modal-header">
                    <h3>Editar Cotización <span x-text="editing ? '#' + editing.id : ''"></span></h3>
                    <button class="modal-close" @click="closeModal()">✕</button>
                </div>

                <form method="POST" :action="editAction" class="modal-body">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="_method" value="PUT">

                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Nombre <span style="color:#ef4444">*</span></label>
                            <input type="text" name="nombre" class="form-input" :value="editing?.nombre" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Apellido <span style="color:#ef4444">*</span></label>
                            <input type="text" name="apellido" class="form-input" :value="editing?.apellido" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email <span style="color:#ef4444">*</span></label>
                            <input type="email" name="email" class="form-input" :value="editing?.email" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Teléfono <span style="color:#ef4444">*</span></label>
                            <input type="text" name="telefono" class="form-input" :value="editing?.telefono">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tipo de Obra</label>
                            <input type="text" name="tipo_obra" class="form-input" :value="editing?.tipo_obra">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nombre del Proyecto</label>
                            <input type="text" name="nombre_proyecto" class="form-input" :value="editing?.nombre_proyecto">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Área Privada (m²)</label>
                            <input type="number" step="0.01" name="area_privada" class="form-input" :value="editing?.area_privada">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Fecha de Entrega</label>
                            <input type="date" name="fecha_entrega" class="form-input" :value="editing?.fecha_entrega ? editing.fecha_entrega.substring(0,10) : ''">
                        </div>
                        <div class="form-group">
                            <label class="form-label">N° de Baños</label>
                            <input type="number" min="0" name="num_banos" class="form-input" :value="editing?.num_banos">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Mueble Alto Cocina</label>
                            <select name="tiene_mueble_alto_cocina" class="form-input">
                                <option value="0" :selected="editing && !editing.tiene_mueble_alto_cocina">No</option>
                                <option value="1" :selected="editing && editing.tiene_mueble_alto_cocina">Sí</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Barra Auxiliar</label>
                            <select name="tiene_barra_auxiliar" class="form-input">
                                <option value="0" :selected="editing && !editing.tiene_barra_auxiliar">No</option>
                                <option value="1" :selected="editing && editing.tiene_barra_auxiliar">Sí</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer" style="padding: 1.2rem 0 0 0; margin-top: 1.5rem;">
                        <button type="button" class="btn-cancel" @click="closeModal()">Cancelar</button>
                        <button type="submit" class="btn-save">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script>
        function adminDashboard() {
            return {
                showModal: false,
                editing: null,
                editAction: '',

                openEdit(id) {
                    this.editing = cotizacionesData.find(c => c.id === id) || null;
                    this.editAction = `/admin/cotizaciones/${id}`;
                    this.showModal = true;
                    document.body.style.overflow = 'hidden';
                },

                closeModal() {
                    this.showModal = false;
                    this.editing = null;
                    document.body.style.overflow = '';
                },

                confirmDelete(event) {
                    if (confirm('¿Eliminar esta cotización permanentemente? Esta acción no se puede deshacer.')) {
                        event.target.submit();
                    }
                }
            }
        }
    </script>
</x-app-layout>
