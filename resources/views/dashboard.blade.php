<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" style="font-family: 'Syne', sans-serif;">
            Administración | <span style="background: linear-gradient(135deg, #d4af37 0%, #f4d9a3 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Escuadrarq</span>
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
        [x-cloak] { display: none !important; }

        .dash { font-family: 'Outfit', sans-serif; color: var(--primary); max-width: 1400px; margin: 3rem auto; padding: 0 1.5rem; }

        .card { background: white; border-radius: 16px; border: 1px solid var(--border-color); box-shadow: 0 20px 60px rgba(0,0,0,0.06); overflow: hidden; margin-bottom: 3rem; }

        .card-head {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            padding: 2rem; display: flex; justify-content: space-between; align-items: center;
            position: relative; overflow: hidden;
        }
        .card-head::before {
            content: ''; position: absolute; top: 0; right: 0; width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(212,175,55,0.15) 0%, transparent 70%); border-radius: 50%;
        }
        .card-head h2 { font-family: 'Syne', sans-serif; font-size: 1.4rem; margin: 0; color: white; position: relative; z-index: 1; }
        .card-head small { font-size: 0.85rem; opacity: 0.7; display: block; margin-top: 0.3rem; position: relative; z-index: 1; color: white; }

        .btn-refresh {
            padding: 0.7rem 1.4rem; background: white; color: var(--primary); border: none;
            border-radius: 8px; font-family: 'Syne', sans-serif; font-size: 0.8rem; font-weight: 700;
            cursor: pointer; text-transform: uppercase; letter-spacing: 0.5px; text-decoration: none;
            position: relative; z-index: 1; transition: opacity 0.2s;
        }
        .btn-refresh:hover { opacity: 0.85; }

        .tbl { width: 100%; border-collapse: collapse; }
        .tbl th {
            font-family: 'Syne', sans-serif; font-size: 0.78rem; text-transform: uppercase;
            letter-spacing: 1px; color: var(--primary); padding: 1rem;
            border-bottom: 2px solid var(--accent); text-align: left; background: var(--bg-subtle); white-space: nowrap;
        }
        .tbl td { padding: 0.9rem 1rem; border-bottom: 1px solid var(--border-color); font-size: 0.88rem; vertical-align: middle; }
        .tbl tr:last-child td { border-bottom: none; }
        .tbl tr:hover td { background: #fafaf8; }

        .badge { display: inline-block; padding: 0.25rem 0.7rem; border-radius: 20px; font-size: 0.72rem; font-weight: 600; font-family: 'Syne', sans-serif; }
        .badge-obra { background: #eff6ff; color: #2563eb; }

        .btn-edit {
            padding: 0.4rem 0.9rem; border-radius: 6px; font-family: 'Syne', sans-serif;
            font-size: 0.72rem; font-weight: 700; cursor: pointer; transition: all 0.2s;
            text-transform: uppercase; background: transparent; border: 1px solid var(--accent); color: #b8941f;
        }
        .btn-edit:hover { background: var(--accent); color: white; }

        .btn-del {
            padding: 0.4rem 0.9rem; border-radius: 6px; font-family: 'Syne', sans-serif;
            font-size: 0.72rem; font-weight: 700; cursor: pointer; transition: all 0.2s;
            text-transform: uppercase; background: transparent; border: 1px solid var(--error); color: var(--error); margin-left: 0.4rem;
        }
        .btn-del:hover { background: var(--error); color: white; }

        .alert-ok { background: #d1fae5; border: 1px solid #a7f3d0; color: #065f46; padding: 1rem 1.5rem; border-radius: 10px; margin-bottom: 1.5rem; font-size: 0.9rem; }

        /* MODAL */
        .overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.55); display: flex; align-items: center; justify-content: center; z-index: 1000; padding: 1rem; }
        .modal { background: white; border-radius: 16px; width: 100%; max-width: 700px; max-height: 90vh; overflow-y: auto; box-shadow: 0 40px 80px rgba(0,0,0,0.25); }
        .modal-head {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            padding: 1.5rem 2rem; display: flex; justify-content: space-between; align-items: center;
            border-radius: 16px 16px 0 0;
        }
        .modal-head h3 { font-family: 'Syne', sans-serif; font-size: 1.1rem; margin: 0; color: white; }
        .modal-x { background: transparent; border: none; color: white; font-size: 1.5rem; cursor: pointer; opacity: 0.8; line-height: 1; }
        .modal-x:hover { opacity: 1; }
        .modal-body { padding: 2rem; }
        .grid2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1.2rem; }
        @media(max-width:600px){ .grid2 { grid-template-columns: 1fr; } }
        .fg { display: flex; flex-direction: column; }
        .fg label { font-family: 'Syne', sans-serif; font-size: 0.78rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.4rem; }
        .fi { padding: 0.75rem 1rem; border: 1px solid var(--border-color); border-radius: 8px; font-family: 'Outfit', sans-serif; font-size: 0.9rem; background: var(--bg-subtle); width: 100%; box-sizing: border-box; transition: all 0.2s; }
        .fi:focus { outline: none; border-color: var(--accent); background: white; box-shadow: 0 0 0 3px rgba(212,175,55,0.12); }
        .modal-foot { padding: 1.2rem 2rem; border-top: 1px solid var(--border-color); display: flex; justify-content: flex-end; gap: 0.8rem; }
        .btn-cancel { padding: 0.7rem 1.4rem; background: var(--bg-subtle); border: 1px solid var(--border-color); border-radius: 8px; font-family: 'Syne', sans-serif; font-size: 0.82rem; font-weight: 700; cursor: pointer; text-transform: uppercase; }
        .btn-save { padding: 0.7rem 1.8rem; background: linear-gradient(135deg, var(--primary), var(--primary-light)); color: white; border: none; border-radius: 8px; font-family: 'Syne', sans-serif; font-size: 0.82rem; font-weight: 700; cursor: pointer; text-transform: uppercase; }
        .btn-save:hover { opacity: 0.9; }
        .empty { text-align: center; padding: 3rem; color: #999; font-size: 0.95rem; }
    </style>

    <script>
        const COTS = @json($cotizaciones);
    </script>

    <div class="dash" x-data="dash()">

        @if(session('success'))
            <div class="alert-ok">✓ {{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-head">
                <div>
                    <h2>Cotizaciones Recibidas</h2>
                    <small>{{ $cotizaciones->count() }} registro{{ $cotizaciones->count() !== 1 ? 's' : '' }} en total</small>
                </div>
                <a href="{{ route('dashboard') }}" class="btn-refresh">↻ Actualizar</a>
            </div>

            <div style="overflow-x:auto;">
                <table class="tbl">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Tipo de Obra</th>
                            <th>Proyecto</th>
                            <th>Área m²</th>
                            <th>Entrega</th>
                            <th>Recibida</th>
                            <th style="text-align:right;">Acciones</th>
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
                                    @else —
                                    @endif
                                </td>
                                <td>{{ $cot->nombre_proyecto ?? '-' }}</td>
                                <td>{{ $cot->area_privada ? number_format($cot->area_privada, 0, ',', '.') : '-' }}</td>
                                <td>{{ $cot->fecha_entrega ? $cot->fecha_entrega->format('d/m/Y') : '-' }}</td>
                                <td style="color:#888; font-size:0.82rem;">{{ $cot->created_at->format('d/m/Y H:i') }}</td>
                                <td style="text-align:right; white-space:nowrap;">
                                    <button type="button" class="btn-edit" @click="open({{ $cot->id }})">Editar</button>
                                    <form method="POST" action="{{ route('admin.cotizaciones.destroy', $cot->id) }}" style="display:inline;" @submit.prevent="del($event)">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-del">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="10" class="empty">No hay cotizaciones registradas aún.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- MODAL EDITAR --}}
        <div class="overlay" x-show="show" x-cloak @click.self="close()">
            <div class="modal" @click.stop>
                <div class="modal-head">
                    <h3>Editar Cotización <span x-text="c ? '#'+c.id : ''"></span></h3>
                    <button class="modal-x" @click="close()">✕</button>
                </div>
                <form method="POST" :action="url" class="modal-body">
                    @csrf
                    @method('PUT')
                    <div class="grid2">
                        <div class="fg">
                            <label>Nombre *</label>
                            <input type="text" name="nombre" class="fi" :value="c?.nombre" required>
                        </div>
                        <div class="fg">
                            <label>Apellido *</label>
                            <input type="text" name="apellido" class="fi" :value="c?.apellido" required>
                        </div>
                        <div class="fg">
                            <label>Email *</label>
                            <input type="email" name="email" class="fi" :value="c?.email" required>
                        </div>
                        <div class="fg">
                            <label>Teléfono *</label>
                            <input type="text" name="telefono" class="fi" :value="c?.telefono">
                        </div>
                        <div class="fg">
                            <label>Tipo de Obra</label>
                            <input type="text" name="tipo_obra" class="fi" :value="c?.tipo_obra">
                        </div>
                        <div class="fg">
                            <label>Nombre del Proyecto</label>
                            <input type="text" name="nombre_proyecto" class="fi" :value="c?.nombre_proyecto">
                        </div>
                        <div class="fg">
                            <label>Área Privada (m²)</label>
                            <input type="number" step="0.01" name="area_privada" class="fi" :value="c?.area_privada">
                        </div>
                        <div class="fg">
                            <label>Fecha de Entrega</label>
                            <input type="date" name="fecha_entrega" class="fi" :value="c?.fecha_entrega ? c.fecha_entrega.substring(0,10) : ''">
                        </div>
                        <div class="fg">
                            <label>N° de Baños</label>
                            <input type="number" min="0" name="num_banos" class="fi" :value="c?.num_banos">
                        </div>
                        <div class="fg">
                            <label>Mueble Alto Cocina</label>
                            <select name="tiene_mueble_alto_cocina" class="fi">
                                <option value="0" :selected="c && !c.tiene_mueble_alto_cocina">No</option>
                                <option value="1" :selected="c && c.tiene_mueble_alto_cocina">Sí</option>
                            </select>
                        </div>
                        <div class="fg">
                            <label>Barra Auxiliar</label>
                            <select name="tiene_barra_auxiliar" class="fi">
                                <option value="0" :selected="c && !c.tiene_barra_auxiliar">No</option>
                                <option value="1" :selected="c && c.tiene_barra_auxiliar">Sí</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-foot" style="padding:1.2rem 0 0; margin-top:1.5rem;">
                        <button type="button" class="btn-cancel" @click="close()">Cancelar</button>
                        <button type="submit" class="btn-save">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script>
        function dash() {
            return {
                show: false,
                c: null,
                url: '',
                open(id) {
                    this.c = COTS.find(x => x.id === id) || null;
                    this.url = '/admin/cotizaciones/' + id;
                    this.show = true;
                    document.body.style.overflow = 'hidden';
                },
                close() {
                    this.show = false;
                    this.c = null;
                    document.body.style.overflow = '';
                },
                del(e) {
                    if (confirm('¿Eliminar esta cotización permanentemente? No se puede deshacer.')) {
                        e.target.submit();
                    }
                }
            }
        }
    </script>
</x-app-layout>
