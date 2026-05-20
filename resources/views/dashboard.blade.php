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
            --border-color: #e5e5e5;
            --bg-subtle: #f9f9f9;
        }

        .dalpor-dashboard {
            font-family: 'Outfit', sans-serif;
            color: var(--primary);
            max-width: 1300px;
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
            padding: 2rem 2rem;
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
            font-size: 0.8rem;
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
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
            font-size: 0.9rem;
            vertical-align: middle;
        }

        .admin-table tr:last-child td { border-bottom: none; }
        .admin-table tr:hover td { background: #fafaf8; }

        .badge {
            display: inline-block;
            padding: 0.25rem 0.7rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            font-family: 'Syne', sans-serif;
        }

        .badge-obra { background: #eff6ff; color: #2563eb; }
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #999;
            font-size: 0.95rem;
        }
    </style>

    <div class="dalpor-dashboard">
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
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cotizaciones as $cot)
                            <tr>
                                <td><strong>#{{ $cot->id }}</strong></td>
                                <td>
                                    <strong>{{ $cot->nombre }} {{ $cot->apellido }}</strong>
                                </td>
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
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="empty-state">No hay cotizaciones registradas aún.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
