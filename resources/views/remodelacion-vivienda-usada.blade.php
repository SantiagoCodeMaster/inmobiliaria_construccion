<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Otro tipo de remodelación — Vivienda usada</title>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=Outfit:wght@400;500;600&display=swap" rel="stylesheet">
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<style>
:root{--primary:#1a1a1a;--accent:#d4af37;--accent-dark:#b8932f;--border:#e5e5e5;--bg:#f5f5f0;--text-muted:#8a8a8a}
*{box-sizing:border-box}body{margin:0;background:var(--bg);font-family:'Outfit',sans-serif;color:var(--primary)}
.page{max-width:1400px;margin:1.5rem auto;padding:0 1rem}
.card{background:#fff;border:1px solid var(--border);border-radius:16px;overflow:hidden;margin-bottom:1.5rem;box-shadow:0 10px 30px rgba(0,0,0,.06)}
.card-head{background:linear-gradient(135deg,#1a1a1a 0%,#2d2d2d 100%);padding:1.2rem 1.5rem;display:flex;justify-content:space-between;align-items:center;gap:1rem;flex-wrap:wrap}
.card-head h3{font-family:'Syne',sans-serif;color:#fff;margin:0;font-size:1.05rem}
.card-body{padding:1.5rem}
.tabs{display:flex;gap:.6rem;margin-bottom:1rem;flex-wrap:wrap}
.tab{padding:.65rem 1.1rem;border-radius:100px;border:1.5px solid var(--border);background:#fff;font-family:'Syne',sans-serif;font-weight:700;font-size:.8rem;cursor:pointer;transition:.2s}
.tab.active{background:var(--primary);color:#fff;border-color:var(--primary)}
.tab.active.cocina{background:var(--accent);color:var(--primary);border-color:var(--accent)}
.tab small{opacity:.7;font-weight:500;margin-left:.3rem}
.table-wrap{overflow:auto;border:1px solid var(--border);border-radius:10px}
table.items{width:100%;border-collapse:collapse;min-width:720px}
table.items th{background:#fafaf7;font-family:'Syne',sans-serif;font-size:.68rem;text-transform:uppercase;letter-spacing:.5px;color:#888;padding:.7rem .6rem;text-align:left;white-space:nowrap;border-bottom:1px solid var(--border)}
table.items td{padding:.55rem .6rem;border-bottom:1px solid #f0f0f0;font-size:.82rem;vertical-align:middle}
table.items tr.adicional{background:#fffbeb}
table.items input,table.items select{width:100%;padding:.4rem .5rem;border:1px solid var(--border);border-radius:6px;font-family:'Outfit',sans-serif;font-size:.82rem}
table.items input:focus{outline:none;border-color:var(--accent)}
.cell-desc{color:#555;min-width:220px}
.btn-icon{padding:.35rem .6rem;border-radius:6px;font-family:'Syne',sans-serif;font-size:.7rem;font-weight:700;cursor:pointer;border:1px solid var(--border);background:#fff}
.btn-icon.del{color:#ef4444;border-color:#ef4444}
.btn-icon.del:hover{background:#ef4444;color:#fff}
.add-form{display:grid;grid-template-columns:2fr 1fr 1fr 1fr auto;gap:.7rem;align-items:end;margin-top:1rem;padding:1.2rem;background:#f9f9f9;border-radius:10px}
@media(max-width:900px){.add-form{grid-template-columns:1fr 1fr}}
.add-form label{font-family:'Syne',sans-serif;font-size:.62rem;text-transform:uppercase;letter-spacing:.4px;color:#888;display:block;margin-bottom:.25rem}
.add-form input,.add-form select{padding:.5rem .6rem;border:1px solid var(--border);border-radius:6px;width:100%;font-size:.82rem}
.total-bar{display:flex;justify-content:flex-end;align-items:center;gap:1rem;margin-top:1.2rem;padding:1rem 1.2rem;background:var(--primary);color:#fff;border-radius:12px;flex-wrap:wrap}
.total-bar .label{font-family:'Syne',sans-serif;font-size:.75rem;letter-spacing:1px;text-transform:uppercase;opacity:.8}
.total-bar .val{font-family:'Syne',sans-serif;font-size:1.6rem;font-weight:800;color:var(--accent)}
.btn-back{padding:.6rem 1rem;background:#fff;border:1px solid var(--border);border-radius:8px;font-family:'Syne',sans-serif;font-weight:700;font-size:.78rem;text-decoration:none;color:var(--primary)}
.btn-cta{padding:.9rem 1.6rem;background:linear-gradient(135deg,var(--accent),var(--accent-dark));color:#fff;border:none;border-radius:10px;font-family:'Syne',sans-serif;font-weight:800;font-size:.85rem;cursor:pointer}
.badge-adicional{display:inline-block;padding:.12rem .4rem;background:#fef3c7;color:#92400e;font-size:.6rem;font-weight:700;border-radius:4px;text-transform:uppercase;margin-left:.4rem}
.empty{padding:2rem;text-align:center;color:#999;font-size:.85rem}
</style>
</head>
<body>
<div class="page" x-data="remodelacionApp()">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem;flex-wrap:wrap;gap:.6rem">
        <a href="/" class="btn-back">← Volver al inicio</a>
        <a :href="waLink()" target="_blank" class="btn-cta">💬 Cotizar por WhatsApp</a>
    </div>

    <div class="card">
        <div class="card-head">
            <h3>Remodelación vivienda usada — personaliza por espacio</h3>
            <span style="color:#fff;opacity:.8;font-size:.8rem">Cantidades en 0 — tú defines cada cantidad</span>
        </div>
        <div class="card-body">
            <p style="margin:0 0 1rem;color:var(--text-muted);font-size:.88rem">Elige <strong>Baño</strong>, <strong>Cocina</strong> o <strong>Habitaciones</strong>. Cada pestaña carga las actividades del catálogo categorizadas por palabras clave. Edita cantidad, valor unitario, elimina o agrega del catálogo. Solo verás el <strong>TOTAL</strong> final.</p>

            <div class="tabs">
                <button class="tab" :class="{active: tab==='bano'}" @click="tab='bano'">🛁 Baño <small x-text="'('+list('bano').length+')'"></small></button>
                <button class="tab cocina" :class="{active: tab==='cocina'}" @click="tab='cocina'">🍳 Cocina <small x-text="'('+list('cocina').length+')'"></small></button>
                <button class="tab" :class="{active: tab==='habitaciones'}" @click="tab='habitaciones'">🛏️ Habitaciones <small x-text="'('+list('habitaciones').length+')'"></small></button>
            </div>

            <template x-for="t in ['bano','cocina','habitaciones']" :key="t">
                <div x-show="tab===t">
                    <div class="table-wrap">
                        <table class="items">
                            <thead><tr><th>Categoría</th><th>Descripción</th><th>UND</th><th style="text-align:right">Cantidad</th><th style="text-align:right">V. Unitario</th><th style="text-align:right">V. Total</th><th></th></tr></thead>
                            <tbody>
                                <template x-if="list(t).length===0"><tr><td colspan="7" class="empty">Sin actividades en esta categoría. Agrega del catálogo.</td></tr></template>
                                <template x-for="(act, idx) in list(t)" :key="t+'-'+idx">
                                    <tr :class="{adicional: act.es_adicional}">
                                        <td><span x-text="act.categoria"></span><span x-show="act.es_adicional" class="badge-adicional">Adicional</span></td>
                                        <td class="cell-desc" x-text="act.descripcion"></td>
                                        <td><input type="text" x-model="act.unidad" @input="recalc(t, idx)"></td>
                                        <td><input type="number" step="0.01" min="0" x-model.number="act.cantidad" @input="recalc(t, idx)"></td>
                                        <td><input type="number" step="1" min="0" x-model.number="act.valor_unitario" @input="recalc(t, idx)"></td>
                                        <td style="text-align:right;font-weight:700" x-text="'$ '+formato(act.vr_total)"></td>
                                        <td><button class="btn-icon del" @click="eliminar(t, idx)">✕</button></td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>

                    <div style="display:flex;gap:.5rem;margin-top:1rem;flex-wrap:wrap">
                        <button @click="modoAgregar[t]='catalogo'" :style="modoAgregar[t]==='catalogo' ? 'background:var(--primary);color:#fff;border-color:var(--primary)' : ''" class="tab" style="font-size:.72rem">📋 Del Catálogo</button>
                        <button @click="modoAgregar[t]='extraordinaria'" :style="modoAgregar[t]==='extraordinaria' ? 'background:var(--accent);color:var(--primary);border-color:var(--accent)' : ''" class="tab" style="font-size:.72rem">⚡ Extraordinaria</button>
                    </div>

                    <div x-show="modoAgregar[t]==='catalogo'" class="add-form">
                        <div><label>Actividad del catálogo</label><select x-model="nueva[t].catalogo_id" @change="selCatalogo(t)"><option value="">— Seleccionar —</option><template x-for="c in catalogo" :key="c.id"><option :value="c.id" x-text="c.nombre+' — '+c.descripcion"></option></template></select></div>
                        <div><label>Categoría</label><input x-model="nueva[t].categoria"></div>
                        <div><label>UND</label><input x-model="nueva[t].unidad"></div>
                        <div><label>Cantidad</label><input type="number" step="0.01" min="0" x-model.number="nueva[t].cantidad"></div>
                        <div><label>V. Unitario</label><input type="number" step="1" min="0" x-model.number="nueva[t].valor_unitario"></div>
                        <div><button class="btn-icon" style="background:var(--primary);color:#fff;border:none;padding:.55rem 1rem" @click="agregar(t)">+ Agregar</button></div>
                    </div>
                    <div x-show="modoAgregar[t]==='extraordinaria'" class="add-form" style="border:2px solid var(--accent)">
                        <div><label>Descripción</label><input x-model="nueva[t].descripcion" placeholder="Ej: Derrumbe cocina..."></div>
                        <div><label>Categoría</label><input x-model="nueva[t].categoria" placeholder="Ej: Cocina"></div>
                        <div><label>UND</label><input x-model="nueva[t].unidad"></div>
                        <div><label>Cantidad</label><input type="number" step="0.01" min="0" x-model.number="nueva[t].cantidad"></div>
                        <div><label>V. Unitario</label><input type="number" step="1" min="0" x-model.number="nueva[t].valor_unitario"></div>
                        <div><button class="btn-icon" style="background:var(--accent);color:var(--primary);border:none;padding:.55rem 1rem;font-weight:800" @click="agregar(t)">+ Agregar</button></div>
                    </div>
                </div>
            </template>

            <div class="total-bar">
                <span class="label">Total remodelación</span>
                <span class="val" x-text="'$ '+formato(totalGeneral())"></span>
                <a :href="waLink()" target="_blank" class="btn-cta" style="background:#25D366">WhatsApp con total</a>
            </div>
            <p style="text-align:right;color:#999;font-size:.75rem;margin:.5rem 0 0">Solo se muestra el total final. Sin desglose de administración, imprevistos ni utilidad.</p>
        </div>
    </div>
</div>

<script>
function remodelacionApp(){
 return{
  tab:'bano',
  catalogo: @json($catalogo),
  datos: @json($categorizadas),
  modoAgregar:{bano:'catalogo',cocina:'catalogo',habitaciones:'catalogo'},
  nueva:{
    bano:{catalogo_id:'',categoria:'',descripcion:'',unidad:'UND',cantidad:1,valor_unitario:0},
    cocina:{catalogo_id:'',categoria:'',descripcion:'',unidad:'UND',cantidad:1,valor_unitario:0},
    habitaciones:{catalogo_id:'',categoria:'',descripcion:'',unidad:'UND',cantidad:1,valor_unitario:0},
  },
  list(t){ return this.datos[t] || [] },
  formato(n){ return new Intl.NumberFormat('es-CO').format(Math.round(n||0)) },
  recalc(t, idx){
    let a=this.datos[t][idx];
    a.vr_total=Math.round(parseFloat(a.cantidad||0)*parseFloat(a.valor_unitario||0));
  },
  eliminar(t, idx){ this.datos[t].splice(idx,1) },
  selCatalogo(t){
    let id=this.nueva[t].catalogo_id;
    let c=this.catalogo.find(x=>String(x.id)===String(id));
    if(c){ this.nueva[t].categoria=c.nombre; this.nueva[t].descripcion=c.descripcion; this.nueva[t].unidad=c.unidad; this.nueva[t].valor_unitario=c.valor_unitario; }
  },
  agregar(t){
    let n=this.nueva[t];
    if(!n.descripcion && !n.categoria) return alert('Selecciona una actividad o escribe descripción');
    let item={id:null,categoria:n.categoria||'—',descripcion:n.descripcion||'—',unidad:n.unidad||'UND',cantidad:parseFloat(n.cantidad||0),valor_unitario:parseInt(n.valor_unitario||0),vr_total:Math.round(parseFloat(n.cantidad||0)*parseFloat(n.valor_unitario||0)),es_adicional:n.catalogo_id==='' && !!n.descripcion};
    this.datos[t].push(item);
    this.nueva[t]={catalogo_id:'',categoria:'',descripcion:'',unidad:'UND',cantidad:1,valor_unitario:0};
  },
  totalGeneral(){
    let s=0;
    for(let k of ['bano','cocina','habitaciones']) for(let a of this.datos[k]) s+=parseFloat(a.vr_total||0);
    return s;
  },
  waLink(){
    let total=this.formato(this.totalGeneral());
    let detalle=[];
    for(let k of ['bano','cocina','habitaciones']){
      let arr=this.datos[k].filter(a=>parseFloat(a.cantidad)>0);
      if(arr.length) detalle.push(k.toUpperCase()+': '+arr.map(a=>a.descripcion+' ('+a.cantidad+' x $'+this.formato(a.valor_unitario)+')').join('; '));
    }
    let msg='Hola, me interesa cotizar remodelación vivienda usada. Total: $'+total+(detalle.length?' | '+detalle.join(' | '):'');
    return 'https://wa.me/573224307053?text='+encodeURIComponent(msg);
  }
 }
}
</script>
</body>
</html>
