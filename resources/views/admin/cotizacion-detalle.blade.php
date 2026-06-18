<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" style="font-family: 'Syne', sans-serif;">
            Personalizar Cotización <span style="color:#d4af37;">#{{ $cotizacion->id }}</span>
        </h2>
    </x-slot>

    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <style>
        :root {
            --primary: #1a1a1a;
            --primary-light: #2d2d2d;
            --accent: #d4af37;
            --error: #ef4444;
            --success: #22c55e;
            --border: #e5e5e5;
            --bg-subtle: #f9f9f9;
        }
        * { box-sizing: border-box; }

        body { background: #f5f5f0; }

        .page { max-width: 1400px; margin: 2rem auto; padding: 0 1.5rem; font-family: 'Outfit', sans-serif; }

        .card { background: white; border-radius: 16px; border: 1px solid var(--border); box-shadow: 0 20px 60px rgba(0,0,0,0.06); overflow: hidden; margin-bottom: 2rem; }

        .card-head {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            padding: 1.5rem 2rem; display: flex; justify-content: space-between; align-items: center;
        }
        .card-head h3 { font-family: 'Syne', sans-serif; font-size: 1.1rem; margin: 0; color: white; }

        .card-body { padding: 2rem; }

        .info-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem; margin-bottom: 1.5rem; }
        .info-item { }
        .info-item label { font-family: 'Syne', sans-serif; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px; color: #888; display: block; margin-bottom: 0.2rem; }
        .info-item span { font-weight: 600; font-size: 0.95rem; color: var(--primary); }

        .tabs { display: flex; gap: 0.5rem; margin-bottom: 1.5rem; }
        .tab {
            padding: 0.7rem 1.5rem; border-radius: 8px; font-family: 'Syne', sans-serif;
            font-size: 0.8rem; font-weight: 700; cursor: pointer; text-transform: uppercase;
            letter-spacing: 0.5px; border: 2px solid var(--border); background: white; color: #888;
            transition: all 0.2s;
        }
        .tab:hover { border-color: var(--accent); color: var(--primary); }
        .tab.active { background: var(--primary); border-color: var(--primary); color: white; }

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
            <button class="btn-save" @click="guardar()" :disabled="saving">
                <span x-show="saving" class="spinner"></span>
                <span x-text="saving ? 'Guardando...' : 'Guardar Cambios'"></span>
            </button>
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

                <div class="tabs">
                    <template x-for="t in ['elemental','estandar','experto']" :key="t">
                        <button class="tab" :class="{ active: tipo === t }" x-text="'Línea ' + t" @click="cargar(t)"></button>
                    </template>
                </div>

                <div x-show="!cargado" class="empty-state">Selecciona una línea para editar sus actividades.</div>

                <template x-if="cargado">
                    <div>
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
                        <div class="add-form">
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
                                <button class="btn-icon" style="background:var(--primary);color:white;border:none;padding:0.55rem 1rem;" @click="agregar()" title="Agregar">+ Agregar</button>
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
                </template>
            </div>
        </div>

        <div class="toast" :class="{ show: toast }" x-text="toastMsg"></div>
    </div>

    <script>
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
                            body: JSON.stringify({ actividades: this.actividades })
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
