# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Laravel 12 fullstack web application for managing construction project quotes (*cotizaciones*). Clients submit quote requests, the system calculates pricing plans, clients select a plan, and the admin receives a WhatsApp notification.

## Commands

**Initial setup:**
```bash
composer setup   # install, copy .env, key:generate, migrate, npm install, npm run build
```

**Development (all services in parallel):**
```bash
composer dev     # php artisan serve + queue + pail log viewer + Vite HMR
```

**Production build:**
```bash
npm run build
```

**Tests:**
```bash
composer test    # clears config cache, then runs PHPUnit (SQLite in-memory)
php artisan test --filter TestClassName   # single test class
```

**Code style:**
```bash
./vendor/bin/pint   # Laravel Pint (PSR-12)
```

## Architecture

### Request Flow

1. **Public web** — Blade + TailwindCSS + Alpine.js, session auth via Breeze
2. **API** — JSON responses, Sanctum token auth (guard `sanctum`)
3. **Admin gate** — `GlobalPolicy` (`app/Policies/GlobalPolicy.php`) checks `is_admin == 1` on all protected API routes

### Core Domain

- **Cotizacion** (`app/Models/Cotizacion.php`) — quote entity (nombre, apellido, email, telefono, tipo_obra, area_privada, nombre_proyecto, fecha_entrega). Has named scopes: `search`, `ofTipoObra`, `entreFechas`, `recent`.
- **Producto** (`app/Models/Producto.php`) — pricing plan per obra type (custom PK: `id_producto`, columns: tipo_obra, planes, descripcion, precio).
- **CotizacionService** (`app/Services/CotizacionService.php`) — pricing engine: base price + 1% per m² above 50m² + 20% surcharge if delivery < 30 days → returns 3 formatted plans.

### Key API Routes (`routes/api.php`)

| Method | URI | Auth | Action |
|--------|-----|------|--------|
| POST | `/api/login` | public | Returns Sanctum token + user |
| POST | `/api/cotizacion/store` | public | Create quote |
| POST | `/api/cotizacion/{id}/seleccionar` | public | Select plan → WhatsApp notification |
| GET | `/api/cotizacion/index` | sanctum + admin | List all quotes |
| * | `/api/productos/crear/*` | sanctum + admin | Product CRUD |

### WhatsApp Integration

When a client selects a plan, `CotizacionController` calls the WhatsApp Cloud API (`https://graph.facebook.com/v17.0/{WHATSAPP_PHONE_ID}/messages`) to notify the admin. Requires these `.env` variables:
- `WHATSAPP_TOKEN`
- `WHATSAPP_PHONE_ID`
- `WHATSAPP_ADMIN_PHONE`

### Database

MySQL (`diseño_construccion`). Run `php artisan migrate` after cloning. Tests use SQLite in-memory (configured in `phpunit.xml`).

Key tables: `users` (+ `is_admin`), `cotizaciones`, `productos` (PK: `id_producto`), `personal_access_tokens`.
