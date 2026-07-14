<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CV — {{ $settings['hero_name'] ?? 'Akbar Maulana' }}</title>
<meta name="robots" content="noindex">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
/* ─── Reset & Base ───────────────────────────────────────────── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
  --bg:           #0a0d14;
  --bg-card:      #111827;
  --bg-card2:     #0f172a;
  --border:       rgba(99,102,241,0.22);
  --border-glow:  rgba(99,102,241,0.45);
  --accent:       #6366f1;
  --accent2:      #22d3ee;
  --accent3:      #10b981;
  --text:         #e2e8f0;
  --text-muted:   #94a3b8;
  --text-dim:     #64748b;
  --red:          #ef4444;
  --amber:        #f59e0b;
  --purple:       #a855f7;
  --green:        #10b981;
  --cyan:         #22d3ee;
  --font-mono:    'JetBrains Mono', monospace;
  --font-sans:    'Inter', sans-serif;
  --r:            10px;
}

body {
  background: var(--bg);
  color: var(--text);
  font-family: var(--font-sans);
  font-size: 14px;
  line-height: 1.6;
  min-height: 100vh;
}

a { color: var(--accent2); text-decoration: none; }
a:hover { text-decoration: underline; }

/* ─── Action Bar ─────────────────────────────────────────────── */
.action-bar {
  position: fixed;
  top: 0; left: 0; right: 0;
  z-index: 1000;
  background: rgba(10,13,20,0.9);
  backdrop-filter: blur(16px);
  border-bottom: 1px solid var(--border);
  padding: 12px 24px;
  display: flex;
  align-items: center;
  gap: 12px;
  flex-wrap: wrap;
}

.action-bar-left { display: flex; align-items: center; gap: 10px; flex: 1; }
.action-bar-title {
  font-family: var(--font-mono);
  font-size: 13px;
  color: var(--accent2);
  font-weight: 600;
}
.action-bar-title span { color: var(--text-muted); font-weight: 400; }

.btn-action {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 8px 18px;
  border-radius: 8px;
  font-size: 13px;
  font-weight: 600;
  font-family: var(--font-sans);
  cursor: pointer;
  transition: all 0.2s;
  border: none;
  outline: none;
  white-space: nowrap;
}
.btn-back {
  background: transparent;
  border: 1px solid var(--border-glow);
  color: var(--text-muted);
}
.btn-back:hover { background: rgba(99,102,241,0.1); color: var(--text); }

.btn-pdf {
  background: linear-gradient(135deg, #6366f1, #8b5cf6);
  color: #fff;
  box-shadow: 0 4px 15px rgba(99,102,241,0.4);
}
.btn-pdf:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(99,102,241,0.5); }

.btn-png {
  background: linear-gradient(135deg, #0ea5e9, #22d3ee);
  color: #fff;
  box-shadow: 0 4px 15px rgba(14,165,233,0.4);
}
.btn-png:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(14,165,233,0.5); }

.btn-loading {
  opacity: 0.7;
  cursor: wait;
  transform: none !important;
}

/* ─── CV Page Wrapper ─────────────────────────────────────────── */
.cv-page {
  max-width: 860px;
  margin: 0 auto;
  padding: 100px 24px 60px;
}

/* ─── CV Container (what gets exported) ─────────────────────────*/
#cv-content {
  background: var(--bg-card);
  border: 1px solid var(--border);
  border-radius: var(--r);
  overflow: hidden;
  box-shadow: 0 0 80px rgba(99,102,241,0.08);
}

/* ─── CV Header ──────────────────────────────────────────────── */
.cv-header {
  background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%);
  border-bottom: 1px solid var(--border);
  padding: 40px;
  display: grid;
  grid-template-columns: auto 1fr;
  gap: 32px;
  align-items: center;
  position: relative;
  overflow: hidden;
}
.cv-header::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(ellipse 60% 80% at 80% 50%, rgba(99,102,241,0.12) 0%, transparent 70%);
  pointer-events: none;
}
.cv-header-grid-bg {
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(99,102,241,0.04) 1px, transparent 1px),
    linear-gradient(90deg, rgba(99,102,241,0.04) 1px, transparent 1px);
  background-size: 30px 30px;
  pointer-events: none;
}

.cv-avatar-wrap {
  position: relative;
  width: 110px;
  height: 110px;
  flex-shrink: 0;
}
.cv-avatar-wrap::before {
  content: '';
  position: absolute;
  inset: -3px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--accent), var(--accent2));
  z-index: 0;
}
.cv-avatar {
  width: 100%;
  height: 100%;
  border-radius: 50%;
  object-fit: cover;
  position: relative;
  z-index: 1;
  border: 3px solid var(--bg-card);
}
.cv-avatar-placeholder {
  width: 100%;
  height: 100%;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--accent), var(--accent2));
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 40px;
  font-weight: 800;
  color: #fff;
  position: relative;
  z-index: 1;
}

.cv-header-info { position: relative; z-index: 1; }
.cv-name {
  font-size: 32px;
  font-weight: 800;
  color: #fff;
  letter-spacing: -0.5px;
  line-height: 1.2;
  margin-bottom: 6px;
}
.cv-title {
  font-family: var(--font-mono);
  font-size: 13px;
  color: var(--accent2);
  margin-bottom: 16px;
  display: flex;
  align-items: center;
  gap: 8px;
}
.cv-title::before { content: '> '; color: var(--accent); }

.cv-contacts {
  display: flex;
  flex-wrap: wrap;
  gap: 10px 20px;
  margin-top: 4px;
}
.cv-contact-item {
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 12.5px;
  color: var(--text-muted);
}
.cv-contact-item i {
  color: var(--accent2);
  font-size: 11px;
  width: 16px;
  text-align: center;
}
.cv-contact-item a { color: var(--text-muted); }
.cv-contact-item a:hover { color: var(--accent2); }

.cv-badges {
  display: flex;
  gap: 8px;
  flex-wrap: wrap;
  margin-top: 14px;
}
.cv-badge {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  padding: 3px 10px;
  border-radius: 99px;
  font-size: 11px;
  font-weight: 600;
  border: 1px solid;
  font-family: var(--font-mono);
}
.badge-green { color: var(--green); border-color: rgba(16,185,129,0.3); background: rgba(16,185,129,0.08); }
.badge-purple { color: var(--purple); border-color: rgba(168,85,247,0.3); background: rgba(168,85,247,0.08); }
.badge-cyan { color: var(--cyan); border-color: rgba(34,211,238,0.3); background: rgba(34,211,238,0.08); }

/* ─── CV Body ─────────────────────────────────────────────────── */
.cv-body {
  padding: 0;
  display: grid;
  grid-template-columns: 260px 1fr;
}

.cv-sidebar {
  background: var(--bg-card2);
  border-right: 1px solid var(--border);
  padding: 32px 24px;
  display: flex;
  flex-direction: column;
  gap: 32px;
}

.cv-main {
  padding: 32px;
  display: flex;
  flex-direction: column;
  gap: 32px;
}

/* ─── Section Header ─────────────────────────────────────────── */
.cv-section-title {
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  color: var(--accent);
  font-family: var(--font-mono);
  margin-bottom: 14px;
  display: flex;
  align-items: center;
  gap: 8px;
}
.cv-section-title::after {
  content: '';
  flex: 1;
  height: 1px;
  background: linear-gradient(90deg, var(--border-glow), transparent);
}

/* ─── About / Summary ────────────────────────────────────────── */
.cv-about-text {
  font-size: 13.5px;
  color: var(--text);
  line-height: 1.75;
}

/* ─── Skills ─────────────────────────────────────────────────── */
.cv-skill-category { margin-bottom: 20px; }
.cv-skill-category:last-child { margin-bottom: 0; }

.cv-skill-cat-header {
  font-size: 11px;
  font-weight: 700;
  color: var(--text-muted);
  text-transform: uppercase;
  letter-spacing: 0.8px;
  margin-bottom: 10px;
  display: flex;
  align-items: center;
  gap: 6px;
}

.cv-skill-item { margin-bottom: 9px; }
.cv-skill-meta {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 4px;
}
.cv-skill-name {
  font-size: 12px;
  font-weight: 500;
  color: var(--text);
}
.cv-skill-pct {
  font-size: 11px;
  font-family: var(--font-mono);
  color: var(--text-dim);
}
.cv-skill-bar-bg {
  height: 4px;
  background: rgba(255,255,255,0.06);
  border-radius: 99px;
  overflow: hidden;
}
.cv-skill-bar-fill {
  height: 100%;
  border-radius: 99px;
  transition: width 1.2s cubic-bezier(0.4,0,0.2,1);
}
.bar-blue  { background: linear-gradient(90deg, #3b82f6, #6366f1); }
.bar-green { background: linear-gradient(90deg, #10b981, #22d3ee); }
.bar-purple{ background: linear-gradient(90deg, #a855f7, #ec4899); }

/* ─── Education (sidebar) ────────────────────────────────────── */
.cv-edu-item {
  padding: 12px;
  background: rgba(99,102,241,0.06);
  border: 1px solid var(--border);
  border-radius: 8px;
}
.cv-edu-degree {
  font-size: 12.5px;
  font-weight: 600;
  color: var(--text);
  margin-bottom: 3px;
}
.cv-edu-inst {
  font-size: 12px;
  color: var(--accent2);
  margin-bottom: 3px;
}
.cv-edu-year {
  font-size: 11px;
  color: var(--text-dim);
  font-family: var(--font-mono);
}

/* ─── Contacts sidebar ───────────────────────────────────────── */
.cv-sidebar-contact {
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.cv-sidebar-contact-item {
  display: flex;
  align-items: flex-start;
  gap: 8px;
  font-size: 12px;
  color: var(--text-muted);
}
.cv-sidebar-contact-item i {
  color: var(--accent);
  font-size: 11px;
  width: 14px;
  margin-top: 2px;
  flex-shrink: 0;
}
.cv-sidebar-contact-item a { color: var(--text-muted); word-break: break-all; }
.cv-sidebar-contact-item a:hover { color: var(--accent2); }

/* ─── Projects ───────────────────────────────────────────────── */
.cv-project-item {
  padding: 14px 16px;
  background: rgba(255,255,255,0.02);
  border: 1px solid var(--border);
  border-radius: 8px;
  margin-bottom: 10px;
  position: relative;
  overflow: hidden;
  transition: border-color 0.2s;
}
.cv-project-item:last-child { margin-bottom: 0; }
.cv-project-item::before {
  content: '';
  position: absolute;
  left: 0; top: 0; bottom: 0;
  width: 3px;
  background: var(--project-color, var(--accent));
}
.cv-project-item:hover { border-color: var(--border-glow); }

.cv-project-header {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 8px;
  margin-bottom: 5px;
}
.cv-project-title-wrap {
  display: flex;
  align-items: center;
  gap: 8px;
}
.cv-project-icon {
  width: 28px;
  height: 28px;
  border-radius: 6px;
  background: rgba(99,102,241,0.15);
  border: 1px solid rgba(99,102,241,0.3);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}
.cv-project-icon i { font-size: 12px; color: var(--accent); }
.cv-project-name {
  font-size: 13.5px;
  font-weight: 700;
  color: var(--text);
}
.cv-project-links {
  display: flex;
  gap: 8px;
  flex-shrink: 0;
}
.cv-project-link {
  font-size: 10.5px;
  padding: 2px 8px;
  border-radius: 4px;
  background: rgba(99,102,241,0.1);
  border: 1px solid var(--border);
  color: var(--text-muted);
  display: inline-flex;
  align-items: center;
  gap: 4px;
  white-space: nowrap;
}
.cv-project-link:hover { color: var(--accent2); border-color: var(--accent2); text-decoration: none; }

.cv-project-desc {
  font-size: 12px;
  color: var(--text-muted);
  line-height: 1.6;
  margin-bottom: 8px;
}
.cv-project-tech {
  display: flex;
  flex-wrap: wrap;
  gap: 5px;
}
.cv-tech-tag {
  font-size: 10.5px;
  font-family: var(--font-mono);
  padding: 2px 7px;
  border-radius: 4px;
  background: rgba(34,211,238,0.08);
  border: 1px solid rgba(34,211,238,0.2);
  color: var(--accent2);
}

/* ─── Divider ────────────────────────────────────────────────── */
.cv-divider {
  height: 1px;
  background: var(--border);
  margin: 0;
}

/* ─── Footer ─────────────────────────────────────────────────── */
.cv-footer {
  padding: 16px 40px;
  background: var(--bg-card2);
  border-top: 1px solid var(--border);
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 8px;
}
.cv-footer-text {
  font-size: 11px;
  font-family: var(--font-mono);
  color: var(--text-dim);
}
.cv-footer-text strong { color: var(--accent); }
.cv-footer-socials {
  display: flex;
  gap: 10px;
}
.cv-footer-social-link {
  font-size: 11px;
  color: var(--text-dim);
  display: flex;
  align-items: center;
  gap: 4px;
}
.cv-footer-social-link:hover { color: var(--accent2); }
.cv-footer-social-link i { font-size: 10px; }

/* ─── Print / Export Helpers ─────────────────────────────────── */
@media print {
  @page { size: A4 portrait; margin: 0; }
  .action-bar { display: none !important; }
  html, body { background: #111827 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; color-adjust: exact; }
  .cv-page { padding: 0 !important; max-width: 100% !important; }
  #cv-content { border: none !important; box-shadow: none !important; border-radius: 0 !important; }
  .cv-project-item { break-inside: avoid; }
  .cv-skill-item { break-inside: avoid; }
}

/* ─── Responsive ─────────────────────────────────────────────── */
@media (max-width: 700px) {
  .cv-header { grid-template-columns: 1fr; gap: 20px; padding: 24px; }
  .cv-avatar-wrap { width: 80px; height: 80px; }
  .cv-name { font-size: 24px; }
  .cv-body { grid-template-columns: 1fr; }
  .cv-sidebar { border-right: none; border-bottom: 1px solid var(--border); }
  .cv-main { padding: 24px; }
  .action-bar { gap: 8px; }
  .btn-action { padding: 8px 12px; font-size: 12px; }
}
</style>
</head>
<body>

{{-- ─── Action Bar ─────────────────────────────────────────────── --}}
<div class="action-bar" id="action-bar">
  <div class="action-bar-left">
    <span class="action-bar-title">
      <i class="fas fa-file-code" style="color:var(--accent);"></i>
      curriculum-vitae.pdf <span>— {{ $settings['hero_name'] ?? 'Akbar Maulana' }}</span>
    </span>
  </div>
  <a href="{{ route('home') }}" class="btn-action btn-back">
    <i class="fas fa-arrow-left"></i> Kembali
  </a>
  <button class="btn-action btn-pdf" id="btn-pdf" onclick="downloadPDF()">
    <i class="fas fa-file-pdf"></i> Download PDF
  </button>
  <button class="btn-action btn-png" id="btn-png" onclick="downloadPNG()">
    <i class="fas fa-image"></i> Download PNG
  </button>
</div>

{{-- ─── CV Page ─────────────────────────────────────────────────── --}}
<div class="cv-page">
<div id="cv-content">

  {{-- ══ HEADER ══ --}}
  <div class="cv-header">
    <div class="cv-header-grid-bg"></div>

    {{-- Avatar --}}
    <div class="cv-avatar-wrap">
      @if(file_exists(public_path('images/profile.png')))
        <img class="cv-avatar"
             src="{{ asset('images/profile.png') }}"
             alt="{{ $settings['hero_name'] ?? 'Akbar Maulana' }}"
             crossorigin="anonymous">
      @else
        <div class="cv-avatar-placeholder">
          {{ strtoupper(substr($settings['hero_name'] ?? 'A', 0, 1)) }}
        </div>
      @endif
    </div>

    {{-- Header Info --}}
    <div class="cv-header-info">
      <h1 class="cv-name">{{ $settings['hero_name'] ?? 'Akbar Maulana' }}</h1>
      <div class="cv-title">{{ $settings['hero_tagline'] ?? 'Full Stack Developer & Cybersecurity Specialist' }}</div>

      <div class="cv-contacts">
        @if($settings['about_location'] ?? false)
        <div class="cv-contact-item">
          <i class="fas fa-map-marker-alt"></i>
          {{ $settings['about_location'] }}
        </div>
        @endif
        @if($settings['email_address'] ?? false)
        <div class="cv-contact-item">
          <i class="fas fa-envelope"></i>
          <a href="mailto:{{ $settings['email_address'] }}">{{ $settings['email_address'] }}</a>
        </div>
        @endif
        @if($settings['whatsapp_number'] ?? false)
        <div class="cv-contact-item">
          <i class="fab fa-whatsapp"></i>
          <a href="https://wa.me/62{{ ltrim($settings['whatsapp_number'], '0') }}" target="_blank">
            +62 {{ $settings['whatsapp_number'] }}
          </a>
        </div>
        @endif
        @foreach($socials->take(3) as $s)
        <div class="cv-contact-item">
          <i class="{{ \App\Helpers\SocialIconHelper::fontAwesomeClass($s->platform) }}"></i>
          <a href="{{ $s->url }}" target="_blank" rel="noopener">{{ $s->label }}</a>
        </div>
        @endforeach
      </div>

      <div class="cv-badges">
        <span class="cv-badge badge-green">
          <i class="fas fa-circle" style="font-size:6px;"></i> Available for Hire
        </span>
        @if($settings['about_focus'] ?? false)
        <span class="cv-badge badge-purple">{{ $settings['about_focus'] }}</span>
        @endif
        @if($settings['about_institution'] ?? false)
        <span class="cv-badge badge-cyan">{{ $settings['about_institution'] }}</span>
        @endif
      </div>
    </div>
  </div>

  {{-- ══ BODY ══ --}}
  <div class="cv-body">

    {{-- ── SIDEBAR ── --}}
    <aside class="cv-sidebar">

      {{-- Education --}}
      <div>
        <div class="cv-section-title">
          <i class="fas fa-graduation-cap"></i> Pendidikan
        </div>
        <div class="cv-edu-item">
          <div class="cv-edu-degree">D.IV Keamanan Sistem Informasi</div>
          <div class="cv-edu-inst">{{ $settings['about_institution'] ?? 'Politeknik Negeri Bengkalis' }}</div>
          <div class="cv-edu-year">2022 — Sekarang · {{ $settings['about_location'] ?? 'Bengkalis, Riau' }}</div>
        </div>
      </div>

      {{-- Skills --}}
      @foreach($skills as $category => $categorySkills)
      <div>
        <div class="cv-section-title">
          <i class="fas fa-layer-group"></i> {{ $category }}
        </div>
        @foreach($categorySkills as $skill)
        <div class="cv-skill-item">
          <div class="cv-skill-meta">
            <span class="cv-skill-name">{{ $skill->name }}</span>
            <span class="cv-skill-pct">{{ $skill->level }}%</span>
          </div>
          <div class="cv-skill-bar-bg">
            <div class="cv-skill-bar-fill bar-{{ $skill->color }}"
                 style="width: {{ $skill->level }}%"></div>
          </div>
        </div>
        @endforeach
      </div>
      @endforeach

      {{-- Contact Info --}}
      <div>
        <div class="cv-section-title">
          <i class="fas fa-address-card"></i> Kontak
        </div>
        <div class="cv-sidebar-contact">
          @if($settings['email_address'] ?? false)
          <div class="cv-sidebar-contact-item">
            <i class="fas fa-envelope"></i>
            <a href="mailto:{{ $settings['email_address'] }}">{{ $settings['email_address'] }}</a>
          </div>
          @endif
          @if($settings['whatsapp_number'] ?? false)
          <div class="cv-sidebar-contact-item">
            <i class="fab fa-whatsapp"></i>
            <span>+62 {{ $settings['whatsapp_number'] }}</span>
          </div>
          @endif
          @foreach($socials as $s)
          <div class="cv-sidebar-contact-item">
            <i class="{{ \App\Helpers\SocialIconHelper::fontAwesomeClass($s->platform) }}"></i>
            <a href="{{ $s->url }}" target="_blank" rel="noopener">{{ $s->label }}</a>
          </div>
          @endforeach
        </div>
      </div>

    </aside>

    {{-- ── MAIN ── --}}
    <main class="cv-main">

      {{-- Summary --}}
      <div>
        <div class="cv-section-title">
          <i class="fas fa-user-circle"></i> Profil Profesional
        </div>
        <p class="cv-about-text">
          {{ $settings['about_description'] ?? 'Mahasiswa Keamanan Sistem Informasi di Politeknik Negeri Bengkalis. Memiliki fokus pada manual penetration testing, bug bounty, dan pengembangan aplikasi web yang aman.' }}
          Berpengalaman dalam membangun solusi web fullstack menggunakan Laravel, React, serta melakukan analisis keamanan aplikasi. Berkomitmen untuk menghadirkan produk digital yang aman, skalabel, dan berdampak nyata.
        </p>
      </div>

      {{-- Projects --}}
      <div>
        <div class="cv-section-title">
          <i class="fas fa-code-branch"></i> Proyek & Portofolio
        </div>

        @foreach($projects as $project)
        @php
          $techItems = array_map('trim', explode(',', $project->tech_stack ?? ''));
        @endphp
        <div class="cv-project-item"
             style="--project-color: {{ $project->accent_color ?? '#6366f1' }};">
          <div class="cv-project-header">
            <div class="cv-project-title-wrap">
              <div class="cv-project-icon"><i class="fas fa-code-branch"></i></div>
              <span class="cv-project-name">{{ $project->title }}</span>
            </div>
            <div class="cv-project-links">
              @if($project->github_url)
              <a href="{{ $project->github_url }}" target="_blank" rel="noopener" class="cv-project-link">
                <i class="fab fa-github"></i> GitHub
              </a>
              @endif
              @if($project->live_url)
              <a href="{{ $project->live_url }}" target="_blank" rel="noopener" class="cv-project-link">
                <i class="fas fa-external-link-alt"></i> Live
              </a>
              @endif
            </div>
          </div>
          <p class="cv-project-desc">{{ $project->description }}</p>
          @if($project->tech_stack)
          <div class="cv-project-tech">
            @foreach($techItems as $tech)
            <span class="cv-tech-tag">{{ $tech }}</span>
            @endforeach
          </div>
          @endif
        </div>
        @endforeach
      </div>

    </main>
  </div>

  {{-- ══ FOOTER ══ --}}
  <div class="cv-footer">
    <span class="cv-footer-text">
      Generated from <strong>{{ config('app.url') }}</strong> · {{ now()->format('d M Y') }}
    </span>
    <div class="cv-footer-socials">
      @foreach($socials->take(4) as $s)
      <a href="{{ $s->url }}" target="_blank" rel="noopener" class="cv-footer-social-link">
        <i class="{{ \App\Helpers\SocialIconHelper::fontAwesomeClass($s->platform) }}"></i>
        {{ $s->platform }}
      </a>
      @endforeach
    </div>
  </div>

</div>{{-- #cv-content --}}
</div>{{-- .cv-page --}}

{{-- ─── html2canvas (unpkg — no integrity check to avoid CORS block) ──── --}}
<script src="https://unpkg.com/html2canvas@1.4.1/dist/html2canvas.min.js"></script>

<script>
const CV_NAME = '{{ Str::slug($settings["hero_name"] ?? "akbar-maulana") }}';

// ─── Download PDF (browser native print — 100% reliable) ─────────
function downloadPDF() {
  const btn = document.getElementById('btn-pdf');
  btn.classList.add('btn-loading');
  btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Membuka print dialog...';

  // Give browser time to update UI before triggering print
  setTimeout(() => {
    window.print();
    btn.classList.remove('btn-loading');
    btn.innerHTML = '<i class="fas fa-file-pdf"></i> Download PDF';
  }, 300);
}

// ─── Download PNG (html2canvas) ───────────────────────────────────
function downloadPNG() {
  const btn = document.getElementById('btn-png');
  btn.classList.add('btn-loading');
  btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Generating...';

  if (typeof html2canvas === 'undefined') {
    btn.classList.remove('btn-loading');
    btn.innerHTML = '<i class="fas fa-image"></i> Download PNG';
    alert('Library belum termuat. Periksa koneksi internet dan coba lagi.');
    return;
  }

  const el = document.getElementById('cv-content');

  html2canvas(el, {
    scale:           2,
    useCORS:         true,
    allowTaint:      true,
    backgroundColor: '#111827',
    logging:         false,
    scrollX:         0,
    scrollY:         0,
    windowWidth:     el.scrollWidth,
    windowHeight:    el.scrollHeight,
    ignoreElements:  (node) => node.id === 'action-bar',
  }).then(canvas => {
    // Use blob for more reliable download
    canvas.toBlob(blob => {
      const url  = URL.createObjectURL(blob);
      const link = document.createElement('a');
      link.href     = url;
      link.download = `CV-${CV_NAME}.png`;
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
      URL.revokeObjectURL(url);

      btn.classList.remove('btn-loading');
      btn.innerHTML = '<i class="fas fa-image"></i> Download PNG';
    }, 'image/png');
  }).catch(err => {
    console.error('html2canvas error:', err);
    btn.classList.remove('btn-loading');
    btn.innerHTML = '<i class="fas fa-image"></i> Download PNG';
    alert('Gagal generate PNG: ' + err.message);
  });
}
</script>

</body>
</html>
