<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Constructora Escuadr Arq S.A.S. - Transformamos apartamentos en obra gris en hogares de ensueño. Promoción, gerencia, ventas y construcción.">
    <title>Constructora Escuadr Arq S.A.S. | Acabados de Lujo en Bogotá</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('Screenshot_1.ico') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif

<style>
:root {
  --primary: #0a0a0a;
  --primary-light: #1a1a1a;
  --accent: #c9a961;
  --accent-hover: #b89548;
  --accent-light: #e8d5a1;
  --accent-dark: #8a6f3a;
  --bg-white: #ffffff;
  --bg-subtle: #faf9f6;
  --bg-cream: #f5f2ec;
  --border-color: #e8e6e1;
  --text-muted: #6b6b6b;
  --shadow-sm: 0 2px 8px rgba(0,0,0,0.04);
  --shadow-md: 0 10px 30px rgba(0,0,0,0.08);
  --shadow-lg: 0 25px 50px rgba(0,0,0,0.12);
  --shadow-gold: 0 20px 40px rgba(201,169,97,0.25);
}
*,*::before,*::after {
  margin:0;
  padding:0;
  box-sizing:border-box;
}
html {
  scroll-behavior:smooth;
}
body {
  font-family:'Outfit',sans-serif;
  background:var(--bg-white);
  color:var(--primary);
  line-height:1.6;
  -webkit-font-smoothing:antialiased;
  overflow-x:hidden;
}
h1,h2,h3,h4 {
  font-family:'Syne',sans-serif;
  font-weight:800;
  letter-spacing:-0.03em;
}
.serif-italic {
  font-family:'Playfair Display',serif;
  font-style:italic;
  font-weight:400;
}
.container {
  width:100%;
  max-width:1280px;
  margin:0 auto;
  padding:0 1.5rem;
}
.accent-text {
  background:linear-gradient(135deg,var(--accent) 0%,var(--accent-dark) 100%);
  -webkit-background-clip:text;
  -webkit-text-fill-color:transparent;
  background-clip:text;
}
@keyframes fadeInUp {
  from {opacity:0; transform:translateY(30px);}
  to {opacity:1; transform:translateY(0);}
}
@keyframes shimmer {
  0% {background-position:-200% center;}
  100% {background-position:200% center;}
}
@keyframes pulse-gold {
  0%,100% {box-shadow:0 0 0 0 rgba(201,169,97,0.4);}
  50% {box-shadow:0 0 0 12px rgba(201,169,97,0);}
}

/* HEADER */
header {
  position:fixed;
  top:0;
  width:100%;
  z-index:1000;
  background:rgba(255,255,255,0.95);
  backdrop-filter:blur(20px);
  border-bottom:1px solid rgba(0,0,0,0.04);
  transition:all 0.3s;
  display:flex;
  flex-direction:column;
}
header.scrolled {
  background:rgba(255,255,255,0.98);
  box-shadow:var(--shadow-sm);
}
.top-bar {
  background:var(--primary);
  color:white;
  padding:0.55rem 1rem;
  text-align:center;
  font-size:0.78rem;
  font-weight:500;
  letter-spacing:0.4px;
  position:relative;
  overflow:hidden;
  transition:all 0.3s;
  max-height:50px;
}
.top-bar::before {
  content:'';
  position:absolute;
  inset:0;
  background:linear-gradient(90deg,transparent,rgba(201,169,97,0.15),transparent);
  background-size:200% 100%;
  animation:shimmer 4s linear infinite;
}
.top-bar span {
  position:relative;
  z-index:1;
}
.top-bar strong {
  color:var(--accent);
}
header.scrolled .top-bar {
  max-height:0;
  padding-top:0;
  padding-bottom:0;
  opacity:0;
}
.nav-container {
  display:flex;
  justify-content:space-between;
  align-items:center;
  padding:0.9rem 1.5rem;
  max-width:1400px;
  margin:0 auto;
  width:100%;
}
.brand-logo {
  display:flex;
  align-items:center;
  gap:0.75rem;
  text-decoration:none;
  transition:transform 0.3s;
}
.brand-logo:hover {
  transform:scale(1.02);
}
.brand-img {
  height: 40px; 
  filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
}
.brand-icon {
  width:42px;
  height:42px;
  background:linear-gradient(135deg,var(--primary) 0%,var(--primary-light) 100%);
  border-radius:10px;
  display:flex;
  align-items:center;
  justify-content:center;
  color:var(--accent);
  font-family:'Syne';
  font-weight:800;
  font-size:1rem;
  flex-shrink:0;
}
.brand-text {
  display:flex;
  flex-direction:column;
}
.brand-text span:first-child {
  font-family:'Syne';
  font-weight:800;
  color:var(--primary);
  font-size:1.2rem;
  line-height:1;
}
.brand-text span:last-child {
  font-size:0.58rem;
  color:var(--accent);
  font-weight:700;
  letter-spacing:2.5px;
  margin-top:3px;
}
.nav-links {
  display:none;
  gap:2rem;
  align-items:center;
}
@media(min-width:768px) {
  .nav-links {display:flex;}
}
.nav-links a {
  color:var(--primary);
  text-decoration:none;
  font-weight:500;
  font-size:0.92rem;
  transition:color 0.3s;
  position:relative;
  white-space:nowrap;
}
.nav-links a:not(.btn-nav-cta)::after {
  content:'';
  position:absolute;
  bottom:-4px;
  left:0;
  width:0;
  height:2px;
  background:var(--accent);
  transition:width 0.3s;
}
.nav-links a:not(.btn-nav-cta):hover::after {
  width:100%;
}
.nav-links a:hover {
  color:var(--accent);
}
.btn-nav-cta {
  background:var(--primary);
  color:white!important;
  padding:0.7rem 1.6rem;
  border-radius:100px;
  font-family:'Syne';
  font-weight:700;
  font-size:0.88rem;
  transition:all 0.3s;
  position:relative;
  overflow:hidden;
}
.btn-nav-cta::before {
  content:'';
  position:absolute;
  inset:0;
  background:var(--accent);
  transform:translateY(100%);
  transition:transform 0.3s;
}
.btn-nav-cta span {
  position:relative;
  z-index:1;
}
.btn-nav-cta:hover::before {
  transform:translateY(0);
}
.btn-nav-cta:hover {
  transform:translateY(-2px);
  box-shadow:var(--shadow-gold);
}

/* HERO EXPERIENCIA */
.hero-exp {
  padding:10rem 0 5rem;
  min-height:60vh;
  display:flex;
  align-items:center;
  background:linear-gradient(180deg,var(--bg-white) 0%,var(--bg-cream) 100%);
  position:relative;
  overflow:hidden;
}
.hero-exp::before {
  content:'';
  position:absolute;
  top:10%;
  right:-10%;
  width:500px;
  height:500px;
  background:radial-gradient(circle,rgba(201,169,97,0.08) 0%,transparent 70%);
  border-radius:50%;
  filter:blur(40px);
  pointer-events:none;
}
.hero-tag {
  display:inline-flex;
  align-items:center;
  gap:0.5rem;
  background:rgba(201,169,97,0.1);
  color:var(--accent-dark);
  padding:0.45rem 0.9rem;
  border-radius:100px;
  font-size:0.75rem;
  font-weight:600;
  letter-spacing:1px;
  text-transform:uppercase;
  margin-bottom:1.25rem;
  border:1px solid rgba(201,169,97,0.2);
}
.hero-tag::before {
  content:'';
  width:7px;
  height:7px;
  background:var(--accent);
  border-radius:50%;
  animation:pulse-gold 2s infinite;
  flex-shrink:0;
}
.hero-exp h1 {
  font-size:clamp(2rem,5vw,4rem);
  line-height:1.08;
  margin-bottom:1.25rem;
}
.hero-exp p {
  font-size:1.1rem;
  color:var(--text-muted);
  max-width:580px;
  line-height:1.75;
}

/* STATS BAR */
.stats-bar {
  background:var(--primary);
  color:white;
  padding:2.75rem 0;
  position:relative;
  overflow:hidden;
}
.stats-bar::before {
  content:'';
  position:absolute;
  inset:0;
  background:radial-gradient(circle at 20% 50%,rgba(201,169,97,0.15) 0%,transparent 50%),radial-gradient(circle at 80% 50%,rgba(201,169,97,0.1) 0%,transparent 50%);
}
.stats-grid {
  display:grid;
  grid-template-columns:repeat(2,1fr);
  gap:1.5rem;
  position:relative;
  z-index:1;
}
@media(min-width:640px) {
  .stats-grid {grid-template-columns:repeat(4,1fr);}
}
.stat-item {
  text-align:center;
  padding:0.75rem;
}
.stat-number {
  font-family:'Syne';
  font-size:clamp(1.8rem,4vw,2.8rem);
  font-weight:800;
  background:linear-gradient(135deg,var(--accent-light) 0%,var(--accent) 100%);
  -webkit-background-clip:text;
  -webkit-text-fill-color:transparent;
  background-clip:text;
  line-height:1;
  margin-bottom:0.4rem;
}
.stat-label {
  font-size:0.78rem;
  color:#b0b0b0;
  letter-spacing:0.8px;
  text-transform:uppercase;
}

/* SECTION COMMONS */
.section-label {
  display:inline-block;
  font-size:0.72rem;
  letter-spacing:3px;
  text-transform:uppercase;
  color:var(--accent);
  font-weight:700;
  margin-bottom:0.85rem;
}
.section-label::before {content:'— ';}
.section-label::after {content:' —';}
.section-header {
  text-align:center;
  margin-bottom:3.5rem;
  max-width:750px;
  margin-inline:auto;
}
.section-header h2 {
  font-size:clamp(1.6rem,3.5vw,2.6rem);
  margin-bottom:0.85rem;
  line-height:1.1;
}
.section-header p {
  color:var(--text-muted);
  font-size:1.05rem;
}

/* OBJETO SOCIAL / MISIÓN / VISIÓN */
.empresa-section {
  padding:6rem 0;
  background:var(--bg-subtle);
}
.empresa-grid {
  display:grid;
  grid-template-columns:1fr;
  gap:2rem;
}
@media(min-width:768px) {
  .empresa-grid {grid-template-columns:repeat(3,1fr);}
}
.empresa-card {
  background:white;
  padding:2.5rem 2rem;
  border-radius:22px;
  border:1px solid var(--border-color);
  transition:all 0.4s;
  position:relative;
  overflow:hidden;
}
.empresa-card::before {
  content:'';
  position:absolute;
  top:0;
  left:0;
  width:100%;
  height:3px;
  background:linear-gradient(90deg,var(--accent),var(--accent-dark));
  transform:scaleX(0);
  transform-origin:left;
  transition:transform 0.4s;
}
.empresa-card:hover {
  transform:translateY(-6px);
  box-shadow:var(--shadow-lg);
  border-color:rgba(201,169,97,0.3);
}
.empresa-card:hover::before {
  transform:scaleX(1);
}
.empresa-card .icon-wrap {
  width:60px;
  height:60px;
  background:linear-gradient(135deg,var(--accent) 0%,var(--accent-dark) 100%);
  border-radius:16px;
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:1.6rem;
  margin-bottom:1.5rem;
  box-shadow:var(--shadow-gold);
}
.empresa-card h3 {
  font-size:1.1rem;
  margin-bottom:0.65rem;
  text-transform:uppercase;
  letter-spacing:1px;
  color:var(--accent-dark);
}
.empresa-card p {
  color:var(--text-muted);
  font-size:0.92rem;
  line-height:1.7;
}
.quote-section {
  background:var(--primary);
  padding:4rem 0;
  text-align:center;
}
.quote-text {
  font-family:'Playfair Display',serif;
  font-style:italic;
  font-size:clamp(1.3rem,3vw,1.9rem);
  color:var(--accent-light);
  max-width:700px;
  margin:0 auto;
  line-height:1.5;
}
.quote-text::before,.quote-text::after {
  color:var(--accent);
  font-size:2rem;
}

/* PORTAFOLIO SERVICIOS */
.servicios-section {
  padding:6rem 0;
  background:var(--bg-white);
}
.servicios-grid {
  display:grid;
  grid-template-columns:1fr;
  gap:1.5rem;
}
@media(min-width:640px) {
  .servicios-grid {grid-template-columns:repeat(2,1fr);}
}
@media(min-width:1024px) {
  .servicios-grid {grid-template-columns:repeat(3,1fr);}
}
.servicio-item {
  display:flex;
  align-items:flex-start;
  gap:1rem;
  padding:1.5rem;
  border-radius:16px;
  border:1px solid var(--border-color);
  transition:all 0.3s;
}
.servicio-item:hover {
  background:var(--bg-subtle);
  border-color:rgba(201,169,97,0.3);
  transform:translateX(4px);
}
.servicio-dot {
  width:10px;
  height:10px;
  background:var(--accent);
  border-radius:50%;
  flex-shrink:0;
  margin-top:6px;
}
.servicio-item p {
  font-size:0.95rem;
  color:var(--primary);
  line-height:1.5;
}

/* CLIENTES LOGOS */
.clientes-section {
  padding:6rem 0;
  background:var(--bg-cream);
}
.logos-grid {
  display:grid;
  grid-template-columns:repeat(2,1fr);
  gap:2rem;
  align-items:center;
}
@media(min-width:640px) {
  .logos-grid {grid-template-columns:repeat(4,1fr);}
}
.logo-item {
  background:white;
  padding:1.5rem;
  border-radius:16px;
  border:1px solid var(--border-color);
  display:flex;
  align-items:center;
  justify-content:center;
  transition:all 0.3s;
  min-height:100px;
}
.logo-item:hover {
  transform:translateY(-4px);
  box-shadow:var(--shadow-md);
  border-color:rgba(201,169,97,0.3);
}
.logo-item img {
  max-height:70px;
  max-width:100%;
  object-fit:contain;
  filter:grayscale(30%);
  transition:filter 0.3s;
}
.logo-item:hover img {
  filter:grayscale(0%);
}
.nit-badge {
  text-align:center;
  margin-top:0.6rem;
  font-size:0.68rem;
  color:var(--text-muted);
  letter-spacing:0.5px;
}

/* PROYECTOS */
.proyectos-section {
  padding:6rem 0;
  background:var(--bg-white);
}
.proyecto-block {
  margin-bottom:5rem;
}
.proyecto-header {
  display:flex;
  align-items:center;
  gap:1.25rem;
  margin-bottom:2rem;
  padding-bottom:1rem;
  border-bottom:2px solid var(--bg-cream);
}
.proyecto-year {
  background:var(--primary);
  color:var(--accent);
  padding:0.35rem 0.9rem;
  border-radius:100px;
  font-family:'Syne';
  font-size:0.8rem;
  font-weight:700;
  white-space:nowrap;
}
.proyecto-header h3 {
  font-size:clamp(1.1rem,2.5vw,1.5rem);
  line-height:1.2;
}
.foto-grid {
  display:grid;
  gap:1rem;
}
.foto-grid.cols-2 {grid-template-columns:repeat(2,1fr);}
.foto-grid.cols-3 {grid-template-columns:repeat(3,1fr);}
.foto-grid.cols-4 {grid-template-columns:repeat(2,1fr);}
@media(min-width:640px) {
  .foto-grid.cols-4 {grid-template-columns:repeat(4,1fr);}
}
.foto-grid.bento {
  grid-template-columns:repeat(3,1fr);
  grid-auto-rows:200px;
}
@media(min-width:640px) {
  .foto-grid.bento {
    grid-template-columns:repeat(3,1fr);
    grid-auto-rows:240px;
  }
}
.foto-item {
  border-radius:16px;
  overflow:hidden;
  position:relative;
  cursor:pointer;
}
.foto-item.big {
  grid-column:span 2;
  grid-row:span 2;
}
.foto-item img {
  width:100%;
  height:100%;
  object-fit:cover;
  display:block;
  transition:transform 0.5s;
}
.foto-item:hover img {
  transform:scale(1.06);
}
.foto-item::after {
  content:'';
  position:absolute;
  inset:0;
  background:linear-gradient(to top,rgba(0,0,0,0.5),transparent 60%);
  opacity:0;
  transition:opacity 0.3s;
}
.foto-item:hover::after {
  opacity:1;
}
.foto-label {
  position:absolute;
  bottom:0;
  left:0;
  right:0;
  padding:0.8rem 1rem;
  color:white;
  font-size:0.8rem;
  font-weight:600;
  transform:translateY(100%);
  transition:transform 0.3s;
  z-index:2;
}
.foto-item:hover .foto-label {
  transform:translateY(0);
}
.proyecto-desc {
  margin-top:1rem;
  padding:1.25rem 1.5rem;
  background:var(--bg-subtle);
  border-radius:14px;
  border-left:3px solid var(--accent);
}
.proyecto-desc p {
  font-size:0.9rem;
  color:var(--text-muted);
  line-height:1.6;
}
.proyecto-tags {
  display:flex;
  flex-wrap:wrap;
  gap:0.5rem;
  margin-top:0.75rem;
}
.tag-pill {
  background:rgba(201,169,97,0.1);
  color:var(--accent-dark);
  padding:0.25rem 0.75rem;
  border-radius:100px;
  font-size:0.72rem;
  font-weight:600;
  letter-spacing:0.4px;
  border:1px solid rgba(201,169,97,0.2);
}

/* LICENCIAS */
.licencias-section {
  padding:5rem 0;
  background:var(--bg-cream);
}
/* FACTURACION NOTE */
.facturacion-section {
  padding:4rem 0;
  background:var(--primary);
  color:white;
}
.facturacion-section h2 {color:white;}
.facturacion-section p {color:#b0b0b0;}

/* CTA FINAL */
.final-cta {
  padding:5.5rem 0;
  background:linear-gradient(135deg,var(--primary) 0%,var(--primary-light) 100%);
  color:white;
  text-align:center;
  position:relative;
  overflow:hidden;
}
.final-cta::before {
  content:'';
  position:absolute;
  inset:0;
  background:radial-gradient(circle at 30% 30%,rgba(201,169,97,0.15) 0%,transparent 50%),radial-gradient(circle at 70% 70%,rgba(201,169,97,0.1) 0%,transparent 50%);
}
.final-cta-content {
  position:relative;
  z-index:1;
  max-width:680px;
  margin:0 auto;
  padding:0 1.5rem;
}
.final-cta h2 {
  font-size:clamp(1.65rem,3.5vw,2.65rem);
  margin-bottom:0.85rem;
  line-height:1.1;
  color:white;
}
.final-cta p {
  color:#b0b0b0;
  font-size:1.05rem;
  margin-bottom:2.25rem;
}
.btn-hero {
  padding:1rem 2rem;
  border-radius:100px;
  font-family:'Syne';
  font-weight:700;
  font-size:0.92rem;
  cursor:pointer;
  transition:all 0.3s;
  text-decoration:none;
  display:inline-flex;
  align-items:center;
  gap:0.5rem;
}
.btn-primary {
  background:var(--accent);
  color:var(--primary);
  border:2px solid var(--accent);
  box-shadow:var(--shadow-gold);
}
.btn-primary:hover {
  background:white;
  border-color:white;
  transform:translateY(-3px);
}
.btn-secondary {
  background:transparent;
  color:white;
  border:2px solid rgba(255,255,255,0.3);
  margin-left:1rem;
}
.btn-secondary:hover {
  background:white;
  color:var(--primary);
  border-color:white;
}

/* FOOTER */
footer {
  background:#050505;
  color:white;
  padding:3.5rem 1.5rem 1.75rem;
}
.footer-grid {
  max-width:1280px;
  margin:0 auto;
  display:grid;
  grid-template-columns:1fr;
  gap:2.5rem;
  margin-bottom:2.5rem;
}
@media(min-width:768px) {
  .footer-grid {grid-template-columns:2fr 1fr 1fr;}
}
.footer-brand h3 {
  font-size:1.4rem;
  margin-bottom:0.4rem;
}
.footer-brand .tag {
  color:var(--accent);
  font-size:0.72rem;
  letter-spacing:2px;
  margin-bottom:0.85rem;
  display:block;
}
.footer-brand p {
  color:#888;
  font-size:0.87rem;
  line-height:1.72;
  max-width:310px;
  margin-bottom:0.4rem;
}
.footer-col h4 {
  font-size:0.87rem;
  letter-spacing:2px;
  text-transform:uppercase;
  margin-bottom:1.25rem;
  color:var(--accent);
}
.footer-col ul {
  list-style:none;
}
.footer-col ul li {
  margin-bottom:0.65rem;
}
.footer-col a {
  color:#aaa;
  text-decoration:none;
  font-size:0.87rem;
  transition:color 0.3s;
}
.footer-col a:hover {
  color:var(--accent);
}
.footer-bottom {
  max-width:1280px;
  margin:0 auto;
  padding-top:1.75rem;
  border-top:1px solid #222;
  display:flex;
  justify-content:space-between;
  align-items:center;
  flex-wrap:wrap;
  gap:1rem;
}
.footer-bottom p {
  color:#666;
  font-size:0.82rem;
}
.social-links {
  display:flex;
  gap:0.85rem;
}
.social-links a {
  width:38px;
  height:38px;
  border-radius:50%;
  background:#151515;
  display:flex;
  align-items:center;
  justify-content:center;
  color:#888;
  transition:all 0.3s;
  border:1px solid #222;
}
.social-links a:hover {
  background:var(--accent);
  color:var(--primary);
  transform:translateY(-2px);
}

/* WHATSAPP */
.whatsapp-float {
  position:fixed;
  bottom:22px;
  right:22px;
  width:58px;
  height:58px;
  background:#25D366;
  color:white;
  border-radius:50%;
  display:flex;
  align-items:center;
  justify-content:center;
  text-decoration:none;
  box-shadow:0 8px 25px rgba(37,211,102,0.4);
  z-index:999;
  transition:all 0.3s;
  animation:pulse-gold 2.5s infinite;
}
.whatsapp-float:hover {
  transform:scale(1.1);
}

/* LIGHTBOX */
.lightbox {
  position:fixed;
  top:0;
  left:0;
  width:100%;
  height:100%;
  background:rgba(0,0,0,0.9);
  z-index:9999;
  display:flex;
  align-items:center;
  justify-content:center;
  opacity:0;
  visibility:hidden;
  transition:all 0.3s;
  padding:1rem;
}
.lightbox.active {
  opacity:1;
  visibility:visible;
}
.lightbox-inner {
  max-width:90vw;
  max-height:90vh;
  position:relative;
}
.lightbox-inner img {
  max-width:100%;
  max-height:80vh;
  object-fit:contain;
  border-radius:12px;
  border:2px solid var(--accent);
}
.lightbox-close {
  position:absolute;
  top:-20px;
  right:-20px;
  background:rgba(255,255,255,0.1);
  border:1px solid rgba(255,255,255,0.3);
  color:white;
  width:44px;
  height:44px;
  border-radius:50%;
  font-size:1.5rem;
  cursor:pointer;
  display:flex;
  align-items:center;
  justify-content:center;
  transition:all 0.3s;
}
.lightbox-close:hover {
  background:red;
}

/* ANIMATE ON SCROLL */
.reveal {
  opacity:0;
  transform:translateY(30px);
  transition:opacity 0.7s ease,transform 0.7s ease;
}
.reveal.visible {
  opacity:1;
  transform:translateY(0);
}
@media(max-width:768px) {
  .foto-grid.bento {grid-template-columns:repeat(2,1fr); grid-auto-rows:160px;}
  .foto-item.big {grid-column:span 2; grid-row:span 1;}
  .empresa-card {padding:1.75rem 1.25rem;}
  .proyecto-header {flex-wrap:wrap;}
}
@media(max-width:480px) {
  .foto-grid.cols-2,.foto-grid.cols-3,.foto-grid.cols-4 {grid-template-columns:1fr;}
  .foto-grid.bento {grid-template-columns:1fr; grid-auto-rows:180px;}
  .foto-item.big {grid-column:span 1;}
  .logos-grid {grid-template-columns:repeat(2,1fr);}
  .btn-secondary {display:none;}
}
</style>
</head>
<body>

<!-- HEADER -->
<header id="mainHeader">
    <div class="top-bar">
        <span>✨ <strong>Oferta especial:</strong> Cotización GRATIS + 5% de descuento en la línea Experto — Hasta fin de mes</span>
    </div>
    <div class="nav-container">
        <a href="/" class="brand-logo">
            <img src="{{ asset('construccion.ico') }}" alt="Escuadr Arq" class="brand-img">
            <div class="brand-text">
                <span>Escuadr Arq</span>
                <span>Constructora S.A.S.</span>
            </div>
        </a>
        <nav class="nav-links">
            <a href="{{ route('nuestra.experiencia') }}">Nuestra Experiencia</a>
            <a href="#ventajas">Nuestra Esencia</a>
            <a href="#proceso">Proceso</a>
            <a href="#galeria">Proyectos</a>
            <a href="#cotizador" class="btn-nav-cta"><span>Cotizar ahora</span></a>
        </nav>
    </div>
</header>

<!-- HERO NUESTRA EXPERIENCIA -->
<section class="hero-exp">
  <div class="container">
    <div class="hero-tag">Portafolio Institucional</div>
    <h1>Nuestra <span class="accent-text">Experiencia</span><br><span class="serif-italic">en Construcción</span></h1>
    <p style="margin-top:1rem;">Más de 5 años transformando espacios en Bogotá. Desde licencias de construcción hasta acabados de lujo, conozca el alcance de nuestro trabajo.</p>
    <div style="margin-top:2rem;display:flex;gap:1rem;flex-wrap:wrap;">
      <a href="#proyectos" class="btn-hero btn-primary">Ver Proyectos →</a>
      <a href="https://wa.me/573163034447" target="_blank" class="btn-hero btn-secondary">Contáctenos</a>
    </div>
  </div>
</section>

<!-- STATS BAR -->
<section class="stats-bar">
  <div class="container">
    <div class="stats-grid">
      <div class="stat-item reveal">
        <div class="stat-number">27+</div>
        <div class="stat-label">Proyectos Entregados</div>
      </div>
      <div class="stat-item reveal">
        <div class="stat-number">5+</div>
        <div class="stat-label">Años de Experiencia</div>
      </div>
      <div class="stat-item reveal">
        <div class="stat-number">8</div>
        <div class="stat-label">Clientes Corporativos</div>
      </div>
      <div class="stat-item reveal">
        <div class="stat-number">100%</div>
        <div class="stat-label">Transparencia Total</div>
      </div>
    </div>
  </div>
</section>

<!-- OBJETO SOCIAL / MISIÓN / VISIÓN -->
<section id="empresa" class="empresa-section">
  <div class="container">
    <div class="section-header reveal">
      <span class="section-label">Quiénes Somos</span>
      <h2>Objeto Social, <span class="accent-text">Misión y Visión</span></h2>
      <p>Constructora Escuadr Arq S.A.S. — NIT: 901.794.009-0</p>
    </div>
    <div class="empresa-grid">
      <div class="empresa-card reveal">
        <div class="icon-wrap">🏗️</div>
        <h3>Objeto Social</h3>
        <p>Gerencia, Promoción, Ventas y Construcción de proyectos inmobiliarios propios y en asociación con terceros.</p>
      </div>
      <div class="empresa-card reveal">
        <div class="icon-wrap">🎯</div>
        <h3>Misión</h3>
        <p>Resolver necesidades en temas inmobiliarios y de construcción en Arquitectura e Ingeniería.</p>
      </div>
      <div class="empresa-card reveal">
        <div class="icon-wrap">🌟</div>
        <h3>Visión</h3>
        <p>Reconocimiento en toda Bogotá como solución a empresas que requieren la Promoción, Gerencia, Ventas y Construcción de proyectos inmobiliarios.</p>
      </div>
    </div>
  </div>
</section>

<!-- QUOTE -->
<div class="quote-section">
  <div class="container">
    <p class="quote-text reveal">"Ser la mejor empresa, es asegurarse de tener los mejores clientes"</p>
  </div>
</div>

<!-- PORTAFOLIO DE SERVICIOS -->
<section id="servicios" class="servicios-section">
  <div class="container">
    <div class="section-header reveal">
      <span class="section-label">Lo que hacemos</span>
      <h2>Portafolio de <span class="accent-text">Servicios</span></h2>
      <p>Soluciones integrales en arquitectura, ingeniería e inmobiliaria.</p>
    </div>
    <div class="servicios-grid reveal">
      <div class="servicio-item">
        <div class="servicio-dot"></div>
        <p><strong>Diseños y Licencias de Construcción</strong></p>
      </div>
      <div class="servicio-item">
        <div class="servicio-dot"></div>
        <p><strong>Consultoría y Supervisión Técnica</strong></p>
      </div>
      <div class="servicio-item">
        <div class="servicio-dot"></div>
        <p><strong>Construcción Civil y Arquitectónica</strong></p>
      </div>
      <div class="servicio-item">
        <div class="servicio-dot"></div>
        <p><strong>Asesoría en Norma Urbana</strong></p>
      </div>
      <div class="servicio-item">
        <div class="servicio-dot"></div>
        <p><strong>Promoción, Compra y Venta de Bienes Inmuebles</strong> — Nuevos y Usados</p>
      </div>
      <div class="servicio-item">
        <div class="servicio-dot"></div>
        <p><strong>Estudios de Títulos</strong></p>
      </div>
      <div class="servicio-item">
        <div class="servicio-dot"></div>
        <p><strong>Avalúo de Inmuebles</strong></p>
      </div>
      <div class="servicio-item">
        <div class="servicio-dot"></div>
        <p><strong>Asesoramiento Legal Inmobiliario</strong></p>
      </div>
    </div>
  </div>
</section>

<!-- CLIENTES / LOGOS -->
<section id="clientes" class="clientes-section">
  <div class="container">
    <div class="section-header reveal">
      <span class="section-label">Nuestra Experiencia</span>
      <h2>Clientes que <span class="accent-text">Confían</span> en Nosotros</h2>
      <p>Empresas y organizaciones con quienes hemos construido proyectos en Bogotá.</p>
    </div>
    <div class="logos-grid reveal">
      <div class="logo-item">
        <div style="text-align:center;">
          <img src="{{ asset('rd.png') }}" alt="RD Studio">
        </div>
      </div>
      <div class="logo-item">
        <div style="text-align:center;">
          <img src="{{ asset('AVINGCO.png') }}" alt="AVINGCO">
        </div>
      </div>
      <div class="logo-item">
        <div style="text-align:center;">
          <img src="{{ asset('terranvm.png') }}" alt="Terranvm">
        </div>
      </div>
      <div class="logo-item">
        <div style="text-align:center;">
          <img src="{{ asset('Riaño.png') }}" alt="Riaño">
        </div>
      </div>
      <div class="logo-item">
        <div style="text-align:center;">
          <img src="{{ asset('condival.png') }}" alt="Condival">
        </div>
      </div>
      <div class="logo-item">
        <div style="text-align:center;">
          <img src="{{ asset('makro.png') }}" alt="Cliente A">
        </div>
      </div>
      <div class="logo-item">
        <div style="text-align:center;">
          <img src="{{ asset('arpro.png') }}" alt="Constructora">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- PROYECTOS -->
<section id="proyectos" class="proyectos-section">
  <div class="container">
    <div class="section-header reveal">
      <span class="section-label">Portafolio</span>
      <h2>Proyectos <span class="accent-text">Ejecutados</span></h2>
      <p>Una muestra de nuestro trabajo en Bogotá, desde remodelaciones hasta obra nueva.</p>
    </div>

    <!-- PROYECTO 1: TAYRONA -->
    <div class="proyecto-block reveal">
      <div class="proyecto-header">
        <span class="proyecto-year">Año 2020</span>
        <h3>Apto 130 m² — Remodelación Tayrona · Barrio Nicolás de Federman</h3>
      </div>
      <div class="foto-grid bento">
        <div class="foto-item big" onclick="openLightbox(this)">
          <img src="{{ asset('tayrona-3.png') }}" alt="Tayrona interior">
          <div class="foto-label">Interior remodelado</div>
        </div>
        <div class="foto-item" onclick="openLightbox(this)">
          <img src="{{ asset('tayrona-1.png') }}" alt="Tayrona cocina">
          <div class="foto-label">construccion en proceso</div>
        </div>
        <div class="foto-item" onclick="openLightbox(this)">
    <img 
        src="{{ asset('tayrona-2.png') }}" 
        alt="Tayrona habitación"
        style="
            width: 100%;
            height: 100%;
            object-fit: contain;
        "
    >
    <div class="foto-label">resultado</div>
</div>
       
      </div>
      <div class="proyecto-desc">
        <p>Remodelación completa de apartamento de 130 m² en el barrio Nicolás de Federman. Intervención integral de cocina, baños, habitaciones y zonas comunes.</p>
        <div class="proyecto-tags">
          <span class="tag-pill">Remodelación</span>
          <span class="tag-pill">130 m²</span>
          <span class="tag-pill">Bogotá</span>
        </div>
      </div>
    </div>

    <!-- PROYECTO 2: EDIFICIO EMANUEL -->
    <div class="proyecto-block reveal">
      <div class="proyecto-header">
        <span class="proyecto-year">Año 2021–2022</span>
        <h3>Proyecto Edificio Emanuel — Av. Américas con Av. Boyacá</h3>
      </div>
      <div class="foto-grid bento">
        <div class="foto-item big" onclick="openLightbox(this)">
          <img src="{{ asset('edificio_manuel3.png') }}" alt="Emanuel estructura">
          <div class="foto-label">Estructura y fachada</div>
        </div>
        <div class="foto-item" onclick="openLightbox(this)">
          <img src="{{ asset('edificio_manuel1.png') }}" alt="Emanuel antes">
          <div class="foto-label">Cimentación</div>
        </div>
        <div class="foto-item" onclick="openLightbox(this)">
          <img src="{{ asset('edificio_manuel2.png') }}" alt="Emanuel después">
          <div class="foto-label">Estructura</div>
        </div>
        <div class="foto-item" onclick="openLightbox(this)">
          <img src="{{ asset('edificio_manuel3.png') }}" alt="Emanuel terminado">
          <div class="foto-label">Resultado final</div>
        </div>
      </div>
      <div class="proyecto-desc">
        <p>Demolición total y obra nueva. Proyecto que abarcó cimentación, sótano, estructura, instalaciones eléctricas e hidrosanitarias, mampostería, pañetes, cubierta, ventanería en aluminio y carpintería metálica.</p>
        <div class="proyecto-tags">
          <span class="tag-pill">Obra Nueva</span>
          <span class="tag-pill">Demolición Total</span>
          <span class="tag-pill">Estructura</span>
          <span class="tag-pill">Cubierta</span>
          <span class="tag-pill">Carpintería Metálica</span>
        </div>
      </div>
    </div>

   
   <!-- PROYECTO 4: MAKRO-ARPRO -->
<div class="proyecto-block reveal">
    
    <div class="proyecto-header">
        <span class="proyecto-year">Año 2023</span>
        <h3>Makro – Arpro · Remates de Estructura</h3>
    </div>

    <div class="foto-grid cols-2">

        <div 
            class="foto-item" 
            style="
                height: 420px;
                overflow: hidden;
            "
            onclick="openLightbox(this)"
        >
            <img 
                src="{{ asset('makro1.png') }}" 
                alt="Makro estructura"
                style="
                    width: 100%;
                    height: 100%;
                    object-fit: contain;
                "
            >

            <div class="foto-label">
                Remates de estructura
            </div>
        </div>

        <div 
            class="foto-item" 
            style="
                height: 420px;
                overflow: hidden;
            "
            onclick="openLightbox(this)"
        >
            <img 
                src="{{ asset('makro2.png') }}" 
                alt="Makro obra"
                style="
                    width: 100%;
                    height: 100%;
                    object-fit: contain;
                "
            >

            <div class="foto-label">
                Proceso constructivo
            </div>
        </div>

    </div>

    <div class="proyecto-desc">
        <p>
            Trabajos de remates de estructura para Makro – Arpro. 
            Intervención especializada en elementos estructurales.
        </p>

        <div class="proyecto-tags">
            <span class="tag-pill">Remates de Estructura</span>
            <span class="tag-pill">Industrial</span>
        </div>
    </div>

</div>

   <!-- PROYECTO 5: BAVIERA II -->
<div class="proyecto-block reveal">

    <div class="proyecto-header">
        <span class="proyecto-year">Año 2023</span>
        <h3>Apto 68 m² — Remodelación Baviera II · Colina Campestre</h3>
    </div>

    <div 
        class="foto-grid cols-2" 
        style="
            display:grid;
            grid-template-columns:repeat(2,1fr);
            gap:18px;
            align-items:start;
        "
    >

        <!-- FOTO 1 -->
        <div 
            class="foto-item"
            style="
                height:420px;
                overflow:hidden;
                border-radius:16px;
            "
            onclick="openLightbox(this)"
        >
            <img 
                src="{{ asset('baviera1.png') }}" 
                alt="Baviera II"
                style="
                    width:100%;
                    height:100%;
                    object-fit:contain;
                    display:block;
                "
            >

            <div class="foto-label">
                Interior remodelado
            </div>
        </div>

        <!-- FOTO 2 -->
        <div 
            class="foto-item"
            style="
                height:420px;
                overflow:hidden;
                border-radius:16px;
            "
            onclick="openLightbox(this)"
        >
            <img 
                src="{{ asset('baviera2.png') }}" 
                alt="Proyecto Baviera 2"
                style="
                    width:100%;
                    height:100%;
                    object-fit:contain;
                    display:block;
                "
            >

            <div class="foto-label">
                Cocina remodelada
            </div>
        </div>

    </div>

    <div class="proyecto-desc">
        <p>
            Remodelación integral de apartamento en Baviera II – Colina Campestre.
            Intervención en interiores, cocina y acabados modernos.
        </p>

        <div class="proyecto-tags">
            <span class="tag-pill">Remodelación</span>
            <span class="tag-pill">Interiorismo</span>
            <span class="tag-pill">Residencial</span>
        </div>
    </div>

</div>
      

    <!-- PROYECTO 6: CASAS AV 1RA MAYO -->
    <div class="proyecto-block reveal">
      <div class="proyecto-header">
        <span class="proyecto-year">Año 2023</span>
        <h3>Remodelación Casas 2 Pisos 300 m² — Av. 1ra de Mayo</h3>
      </div>
      <div class="foto-grid cols-3">
        <div class="foto-item" style="height:250px;" onclick="openLightbox(this)">
          <img src="{{ asset('mayo1.png') }}" alt="Mayo interior">
          <div class="foto-label">Interior</div>
        </div>
        <div class="foto-item" style="height:250px;" onclick="openLightbox(this)">
          <img src="{{ asset('mayo2.png') }}" alt="Mayo fachada">
          <div class="foto-label">Fachada</div>
        </div>
        <div class="foto-item" style="height:250px;" onclick="openLightbox(this)">
          <img src="{{ asset('mayo3.png') }}" alt="Mayo exterior">
          <div class="foto-label">Exterior</div>
        </div>
      </div>
      <div class="proyecto-desc">
        <p>Remodelación integral de casas de 2 pisos con 300 m² en la Av. 1ra de Mayo. Intervención en fachadas, interiores y acabados generales.</p>
        <div class="proyecto-tags">
          <span class="tag-pill">Remodelación</span>
          <span class="tag-pill">300 m²</span>
          <span class="tag-pill">2 Pisos</span>
        </div>
      </div>
    </div>

    <!-- PROYECTO 7: NATURA LIVING -->
    <div class="proyecto-block reveal">
      <div class="proyecto-header">
        <span class="proyecto-year">Año 2024</span>
        <h3>Acabados Aptos Natura Living — Colina Campestre (35 m²)</h3>
      </div>
      <div class="foto-grid cols-4">
        <div class="foto-item" style="height:220px;" onclick="openLightbox(this)">
          <img src="{{ asset('colina1.png') }}" alt="Natura cocina">
          <div class="foto-label">Cocina</div>
        </div>
        <div class="foto-item" style="height:220px;" onclick="openLightbox(this)">
          <img src="{{ asset('colina2.png') }}" alt="Natura sala">
          <div class="foto-label">Sala-comedor</div>
        </div>
        <div class="foto-item" style="height:220px;" onclick="openLightbox(this)">
          <img src="{{ asset('colina3.png') }}" alt="Natura habitación">
          <div class="foto-label">Habitación</div>
        </div>
        <div class="foto-item" style="height:220px;" onclick="openLightbox(this)">
          <img src="{{ asset('colina1.png') }}" alt="Natura baño">
          <div class="foto-label">Baño</div>
        </div>
      </div>
      <div class="proyecto-desc">
        <p>Acabados de alta calidad en apartamentos de 35 m² del proyecto Natura Living en Colina Campestre. Materiales premium y diseño contemporáneo.</p>
        <div class="proyecto-tags">
          <span class="tag-pill">Acabados</span>
          <span class="tag-pill">35 m²</span>
          <span class="tag-pill">Natura Living</span>
          <span class="tag-pill">Colina Campestre</span>
        </div>
      </div>
    </div>

    <!-- PROYECTO 8: VERAMONTE LIVING -->
    <div class="proyecto-block reveal">
      <div class="proyecto-header">
        <span class="proyecto-year">Año 2024</span>
        <h3>Acabados Aptos Veramonte Living — Colina Campestre (35 m²)</h3>
      </div>
      <div class="foto-grid cols-3">
        <div class="foto-item" style="height:250px;" onclick="openLightbox(this)">
          <img src="{{ asset('colina2.png') }}" alt="Veramonte">
          <div class="foto-label">Instalaciones</div>
        </div>
        <div class="foto-item" style="height:250px;" onclick="openLightbox(this)">
          <img src="{{ asset('colina3.png') }}" alt="Veramonte interior">
          <div class="foto-label">Interior</div>
        </div>
        <div class="foto-item" style="height:250px;" onclick="openLightbox(this)">
          <img src="{{ asset('colina1.png') }}" alt="Veramonte acabados">
          <div class="foto-label">Acabados</div>
        </div>
      </div>
      <div class="proyecto-desc">
        <p>Acabados completos en apartamentos de 35 m² del proyecto Veramonte Living, Colina Campestre. Diseño moderno y materiales de calidad.</p>
        <div class="proyecto-tags">
          <span class="tag-pill">Acabados</span>
          <span class="tag-pill">35 m²</span>
          <span class="tag-pill">Veramonte Living</span>
        </div>
      </div>
    </div>

    <!-- PROYECTO 9: EDIFICIO CALVO SUR -->
    <div class="proyecto-block reveal">
      <div class="proyecto-header">
        <span class="proyecto-year">Año 2025</span>
        <h3>Remodelación Edificio Calvo Sur — 5 Pisos (500 m²)</h3>
      </div>
      <div class="foto-grid cols-2">
        <div class="foto-item" style="height:300px;" onclick="openLightbox(this)">
          <img src="{{ asset('calvo5.png') }}" alt="Calvo Sur">
          <div class="foto-label">Fachada edificio</div>
        </div>
        <div class="foto-item" style="height:300px;border-radius:16px;overflow:hidden;">
    <img 
        src="{{ asset('Corp1.png') }}" 
        alt="Proyecto Corporativo"
        style="width:100%;height:100%;object-fit:cover;display:block;"
    >
</div>
      </div>
      <div class="proyecto-desc">
        <p>Remodelación de edificio de 5 pisos con un área total de 500 m². Intervención integral que abarcó fachadas, interiores y acabados generales.</p>
        <div class="proyecto-tags">
          <span class="tag-pill">Remodelación</span>
          <span class="tag-pill">500 m²</span>
          <span class="tag-pill">5 Pisos</span>
        </div>
      </div>
    </div>

   
  </div>
</section>

<!-- CTA FINAL -->
<section class="final-cta">
  <div class="final-cta-content">
    <span class="section-label" style="color:var(--accent-light);">¿Listo para empezar?</span>
    <h2>Construyamos juntos tu <span class="accent-text">próximo proyecto</span></h2>
    <p>Cotización gratuita, transparencia total y un equipo comprometido con la calidad.</p>
    <div>
      <a href="/" class="btn-hero btn-primary">Cotizar Ahora →</a>
      <a href="https://wa.me/573163034447" target="_blank" class="btn-hero btn-secondary">WhatsApp</a>
    </div>
    <div style="margin-top:1.5rem;display:flex;align-items:center;justify-content:center;gap:0.5rem;color:#e8d5a1;font-size:0.9rem;">
      <span>💳</span>
      <span>Aceptamos tarjetas de crédito, débito y efectivo</span>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer>
  <div class="footer-grid">
    <div class="footer-brand">
      <h3>Escuadr Arq</h3>
      <span class="tag">CONSTRUCTORA S.A.S.</span>
      <p>Nit: 901.794.009-0 | Régimen Común</p>
      <p>Arl: Sura | Caja de Compensación: Cafam</p>
      <p style="margin-top:10px;font-style:italic;color:var(--accent);">"Ser la mejor empresa, es asegurarse de tener los mejores clientes"</p>
      <div style="margin-top:1rem;display:flex;gap:0.5rem;flex-wrap:wrap;">
        <span style="color:#666;font-size:0.78rem;">📘 escuadra.diseñoyconstruccion</span><br>
        <span style="color:#666;font-size:0.78rem;">📷 escuadra.diseñoy</span>
      </div>
    </div>
    <div class="footer-col">
      <h4>Empresa</h4>
      <ul>
        <li><a href="#empresa">Objeto Social</a></li>
        <li><a href="#servicios">Portafolio de Servicios</a></li>
        <li><a href="#clientes">Nuestros Clientes</a></li>
        <li><a href="#proyectos">Proyectos</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Contacto</h4>
      <ul>
        <li><a href="tel:+573163034447">316 703 44 47</a></li>
        <li><a href="mailto:Proyectos.escuadrarq@gmail.com">Proyectos.escuadrarq@gmail.com</a></li>
        <li><a href="#">Calle 10 No 80-41, Bogotá</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    <p>© 2026 Constructora Escuadr Arq S.A.S. — Todos los derechos reservados.</p>
    <div class="social-links">
      <a href="#" aria-label="Instagram">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
      </a>
      <a href="https://wa.me/573163034447" aria-label="WhatsApp" target="_blank">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
      </a>
    </div>
  </div>
</footer>

<!-- WHATSAPP FLOAT -->
<a href="https://wa.me/573163034447?text=Hola,%20quiero%20más%20información" class="whatsapp-float" target="_blank">
  <svg viewBox="0 0 24 24" fill="currentColor" width="28" height="28"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
</a>

<!-- LIGHTBOX -->
<div id="lightbox" class="lightbox" onclick="closeLightbox()">
  <button class="lightbox-close" onclick="closeLightbox()">×</button>
  <div class="lightbox-inner" onclick="event.stopPropagation()">
    <img id="lightboxImg" src="" alt="">
  </div>
</div>

<script>
const header = document.getElementById('mainHeader');
window.addEventListener('scroll', () => header.classList.toggle('scrolled', window.scrollY > 50));

// Reveal on scroll
const observer = new IntersectionObserver((entries) => {
  entries.forEach(e => { if(e.isIntersecting) e.target.classList.add('visible'); });
}, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });
document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

// Lightbox
function openLightbox(el) {
  const img = el.querySelector('img');
  if (!img) return;
  document.getElementById('lightboxImg').src = img.src;
  document.getElementById('lightbox').classList.add('active');
  document.body.style.overflow = 'hidden';
}

function closeLightbox() {
  document.getElementById('lightbox').classList.remove('active');
  document.body.style.overflow = '';
}

document.addEventListener('keydown', e => { if(e.key === 'Escape') closeLightbox(); });
</script>

</body>
</html>