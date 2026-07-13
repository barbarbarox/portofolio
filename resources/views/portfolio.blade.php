<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="{{ $settings['meta_description'] ?? 'Akbar Maulana — Full Stack Developer & Cybersecurity Specialist. Portfolio showcasing web development, penetration testing, and AI projects.' }}">
<meta name="robots" content="index, follow">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ $settings['hero_name'] ?? 'Akbar Maulana' }} | Portfolio</title>

{{-- Fonts & Icons --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

{{-- CSS --}}
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
<link rel="stylesheet" href="{{ asset('css/animations.css') }}">

{{-- reCAPTCHA v3 --}}
<script src="https://www.google.com/recaptcha/api.js?render={{ env('RECAPTCHA_SITE_KEY') }}" async defer></script>
</head>
<body>

{{-- ─── Splash Screen ─────────────────────────────────────────── --}}
<div id="splash-screen">
  <div class="splash-logo">{{ $settings['hero_name'] ?? 'Akbar Maulana' }}</div>
  <div class="splash-text-container" id="splashText"></div>
  <div class="splash-bar"><div class="splash-bar-fill"></div></div>
</div>

{{-- ─── PillNav (Desktop) ───────────────────────────────────────── --}}
<div class="pill-nav-container">
  <nav class="pill-nav" aria-label="Main Navigation">
    {{-- Logo pill --}}
    <a href="#hero" class="pill-nav-logo" aria-label="Home">
      <span>&lt;ab/&gt;</span>
    </a>

    {{-- Desktop nav items --}}
    <div class="pill-nav-items">
      <ul class="pill-list" role="menubar">
        <li><a href="#hero"           class="pill" data-section="hero"           role="menuitem"><span class="hover-circle"></span><span class="label-stack"><span class="pill-label">Home</span><span class="pill-label-hover" aria-hidden="true">Home</span></span></a></li>
        <li><a href="#about"          class="pill" data-section="about"          role="menuitem"><span class="hover-circle"></span><span class="label-stack"><span class="pill-label">About</span><span class="pill-label-hover" aria-hidden="true">About</span></span></a></li>
        <li><a href="#skills"         class="pill" data-section="skills"         role="menuitem"><span class="hover-circle"></span><span class="label-stack"><span class="pill-label">Skills</span><span class="pill-label-hover" aria-hidden="true">Skills</span></span></a></li>
        <li><a href="#projects"       class="pill" data-section="projects"       role="menuitem"><span class="hover-circle"></span><span class="label-stack"><span class="pill-label">Projects</span><span class="pill-label-hover" aria-hidden="true">Projects</span></span></a></li>
        <li><a href="#lanyard-section" class="pill" data-section="lanyard-section" role="menuitem"><span class="hover-circle"></span><span class="label-stack"><span class="pill-label">ID Card</span><span class="pill-label-hover" aria-hidden="true">ID Card</span></span></a></li>
        <li><a href="#contact"        class="pill" data-section="contact"        role="menuitem"><span class="hover-circle"></span><span class="label-stack"><span class="pill-label">Contact</span><span class="pill-label-hover" aria-hidden="true">Contact</span></span></a></li>
      </ul>
    </div>

    {{-- CTA --}}
    <a href="#contact" class="pill-nav-cta">
      <i class="fas fa-paper-plane"></i> Hire Me
    </a>

    {{-- Hamburger (mobile) - hidden --}}
    <button class="pill-hamburger" id="pillHamburger" aria-label="Toggle menu" style="display:none;">
      <span class="hb-line"></span>
      <span class="hb-line"></span>
    </button>
  </nav>
</div>

{{-- Mobile Bottom Nav --}}
<div class="mobile-bottom-nav">
  <input hidden="" class="mb-mode" id="mb-theme-mode" type="checkbox" />
  <div class="mb-container">
    <div class="mb-wrap">
      <input hidden="" class="rd-1" name="radio" id="rd-1" type="radio" checked="" />
      <label style="--index: 0;" class="mb-label" for="rd-1" onclick="document.getElementById('about').scrollIntoView({behavior:'smooth'})"><span>About Me</span></label>

      <input hidden="" class="rd-2" name="radio" id="rd-2" type="radio" />
      <label style="--index: 1;" class="mb-label" for="rd-2" onclick="document.getElementById('skills').scrollIntoView({behavior:'smooth'})"><span>Summary</span></label>

      <input hidden="" class="rd-3" name="radio" id="rd-3" type="radio" />
      <label style="--index: 2;" class="mb-label" for="rd-3" onclick="document.getElementById('projects').scrollIntoView({behavior:'smooth'})"><span>Portfolio</span></label>

      <div class="mb-bar"></div>
      <div class="mb-slidebar"></div>

      <label for="mb-theme-mode" class="mb-theme">
        <span class="light"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2"><path d="M14.828 14.828a4 4 0 1 0 -5.656 -5.656a4 4 0 0 0 5.656 5.656z"></path><g data-g="high"><path d="M4 12h-3"></path><path d="M12 4v-3"></path><path d="M20 12h3"></path><path d="M12 20v3"></path></g><g data-g="low"><path d="M6.343 17.657l-1.414 1.414"></path><path d="M6.343 6.343l-1.414 -1.414"></path><path d="M17.657 6.343l1.414 -1.414"></path><path d="M17.657 17.657l1.414 1.414"></path></g></svg></span>
        <span class="dark"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="0"><path d="m4.8.69c0-.38-.31-.69-.69-.69s-.69.31-.69.69v1.03h-1.03c-.38,0-.69.31-.69.69s.31.69.69.69h1.03v1.03c0,.38.31.69.69.69s.69-.31.69-.69v-1.03h1.03c.38,0,.69-.31.69-.69s-.31-.69-.69-.69h-1.03V.69Zm5.14,5.14c0-.38-.31-.69-.69-.69s-.69.31-.69.69v1.03h-1.03c-.38,0-.69.31-.69.69s.31.69.69.69h1.03v1.03c0,.38.31.69.69.69s.69-.31.69-.69v-1.03h1.03c.38,0,.69-.31.69-.69s-.31-.69-.69-.69h-1.03v-1.03Zm-6.86,5.14c0-.38-.31-.69-.69-.69s-.69.31-.69.69v1.03H.69c-.38,0-.69.31-.69.69s.31.69.69.69h1.03v1.03c0,.38.31.69.69.69s.69-.31.69-.69v-1.03h1.03c.38,0,.69-.31.69-.69s-.31-.69-.69-.69h-1.03v-1.03ZM14.47,1.51l-.51-.07c-.37-.04-.58.38-.37.69.24.35.46.71.67,1.08.86,1.59,1.35,3.42,1.35,5.36,0,5.61-4.08,10.26-9.43,11.16-.41.07-.84.12-1.27.14-.37.02-.57.45-.31.71.12.12.24.24.36.35l.12.11.45.39.32.25.21.15.32.22.3.2c.21.13.42.25.64.37l.45.23.45.2.52.21.42.15c.23.08.46.14.7.21.18.05.36.09.54.13.22.04.43.08.65.12l.54.07.46.04c.22.01.44.02.66.02,6.25,0,11.31-5.07,11.31-11.31,0-.43-.02-.85-.07-1.27l-.06-.48c-.06-.38-.14-.76-.23-1.13-.12-.44-.26-.88-.43-1.3l-.19-.46-.13-.28-.13-.26c-.27-.53-.58-1.03-.93-1.51l-.26-.34-.34-.41-.28-.31-.2-.21-.28-.27-.38-.34-.55-.45-.42-.3-.5-.33-.55-.32-.56-.28-.19-.09-.41-.17-.47-.18-.43-.14-.56-.15-.45-.1-.5-.09Zm3.19,7.4c0-1.76-.35-3.43-.98-4.96,3.31,1.52,5.61,4.86,5.61,8.73,0,5.3-4.3,9.6-9.6,9.6-1.49,0-2.89-.34-4.15-.94,2.5-.79,4.67-2.3,6.27-4.3.23.32.61.53,1.04.53.71,0,1.29-.58,1.29-1.29,0-.61-.43-1.12-1-1.25.11-.2.21-.4.3-.61.33.2.71.32,1.13.32,1.18,0,2.14-.96,2.14-2.14s-.96-2.14-2.14-2.14c.06-.51.09-1.02.09-1.54Z" fill="currentColor" clip-rule="evenodd" fill-rule="evenodd"></path></svg></span>
      </label>
    </div>
  </div>
</div>

{{-- Mobile Radial Menu --}}
<div class="mobile-radial-menu">
  <nav class="menu">
    <input id="menu-open" name="menu-open" class="menu-open" href="#" type="checkbox" />
    <label for="menu-open" class="menu-open-button">
      <span class="lines line-1"></span>
      <span class="lines line-2"></span>
      <span class="lines line-3"></span>
    </label>
    <a class="menu-item blue" href="#hero"> <i class="fas fa-home"></i> </a>
    <a class="menu-item green" href="#about"> <i class="fas fa-user"></i> </a>
    <a class="menu-item red" href="#skills"> <i class="fas fa-star"></i> </a>
    <a class="menu-item purple" href="#projects"> <i class="fas fa-briefcase"></i> </a>
    <a class="menu-item orange" href="#lanyard-section"> <i class="fas fa-id-card"></i> </a>
    <a class="menu-item lightblue" href="#contact"> <i class="fas fa-envelope"></i> </a>
  </nav>
</div>


{{-- ══════ HERO SECTION ══════ --}}
<section id="hero">
  {{-- LightRays WebGL background --}}
  <div id="lightrays-bg" class="light-rays-container"></div>
  {{-- Gradient overlay to blend rays into page bg --}}
  <div class="hero-rays-overlay"></div>

  <div class="hero-content">
    {{-- Left: Text --}}
    <div class="hero-text">
      <div class="hero-badge">
        <i class="fas fa-terminal" style="font-size:0.8em"></i> Available for hire
      </div>

      <div class="hero-term-card">
        <div class="hero-term-wrap">
          <div class="hero-term-terminal">
            <hgroup class="hero-term-head" style="position: relative;">
              <div class="hero-term-mac-controls" style="display: flex; gap: 6px; margin-right: auto;">
                <span style="width: 12px; height: 12px; border-radius: 50%; background-color: #ff5f56; box-shadow: 0 0 5px rgba(255, 95, 86, 0.3);"></span>
                <span style="width: 12px; height: 12px; border-radius: 50%; background-color: #ffbd2e; box-shadow: 0 0 5px rgba(255, 189, 46, 0.3);"></span>
                <span style="width: 12px; height: 12px; border-radius: 50%; background-color: #27c93f; box-shadow: 0 0 5px rgba(39, 201, 63, 0.3);"></span>
              </div>

              <p class="hero-term-title" style="margin: 0; position: absolute; left: 50%; transform: translateX(-50%);">
                <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" height="16px" width="16px">
                  <path d="M7 15L10 12L7 9M13 15H17M7.8 21H16.2C17.8802 21 18.7202 21 19.362 20.673C19.9265 20.3854 20.3854 19.9265 20.673 19.362C21 18.7202 21 17.8802 21 16.2V7.8C21 6.11984 21 5.27976 20.673 4.63803C20.3854 4.07354 19.9265 3.6146 19.362 3.32698C18.7202 3 17.8802 3 16.2 3H7.8C6.11984 3 5.27976 3 4.63803 3.32698C4.07354 3.6146 3.6146 4.07354 3.32698 4.63803C3 5.27976 3 6.11984 3 7.8V16.2C3 17.8802 3 18.7202 3.32698 19.362C3.6146 19.9265 4.07354 20.3854 4.63803 20.673C5.27976 21 6.11984 21 7.8 21Z"></path>
                </svg>
                Terminal
              </p>

              <button type="button" tabindex="-1" class="hero-term-copy_toggle" style="margin-left: auto;">
                <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" height="16px" width="16px">
                  <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path>
                  <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path>
                </svg>
              </button>
            </hgroup>

            <div class="hero-term-body">
              <pre class="hero-term-pre">                <code>$&nbsp;</code>
                <code>whoami&nbsp;</code>
                <code data-cmd="Akbar Maulana" class="hero-term-cmd"></code>
              </pre>
              <pre class="hero-term-pre" style="margin-top: 0.75rem;">                <code>$&nbsp;</code>
                <code>role&nbsp;</code>
                <code style="color: #fff; font-weight: bold; margin-left: 0.5rem;"><span class="typed-text" data-words='["Full Stack Developer","Cybersecurity Specialist","Penetration Tester","Web App Architect","PHP Developer","React Developer"]'></span><span class="typed-cursor"></span></code>
              </pre>
            </div>
          </div>
        </div>
      </div>

      <p class="hero-desc">
        {{ $settings['hero_subtitle'] ?? 'Politeknik Negeri Bengkalis — Keamanan Sistem Informasi' }} — Membangun aplikasi web yang <strong>aman</strong>, <strong>skalabel</strong>, dan <strong>estetis</strong>. Mulai dari desain UI/UX hingga keamanan server.
      </p>

      <div class="hero-actions">
        <a href="#projects" class="btn-primary">
          <i class="fas fa-rocket"></i> Lihat Projects
        </a>
        <a href="#contact" class="btn-outline">
          <i class="fas fa-paper-plane"></i> Hubungi Saya
        </a>
        @foreach($socials->take(3) as $social)
        <a href="{{ $social->url }}" target="_blank" rel="noopener" class="btn-outline" style="padding:0.875rem 1rem;" title="{{ $social->label }}">
          <i class="{{ \App\Helpers\SocialIconHelper::fontAwesomeClass($social->platform) }}"></i>
        </a>
        @endforeach
      </div>

      <div class="hero-stats">
        <div class="hero-stat">
          <span class="hero-stat-num" data-count="{{ ($projects->count() ?? 0) + 7 }}" data-suffix="+">0</span>
          <span class="hero-stat-label">Projects</span>
        </div>
        <div class="hero-stat">
          <span class="hero-stat-num" data-count="3" data-suffix="+">0</span>
          <span class="hero-stat-label">Tahun Coding</span>
        </div>
        <div class="hero-stat">
          <span class="hero-stat-num" data-count="100" data-suffix="%">0</span>
          <span class="hero-stat-label">Dedikasi</span>
        </div>
      </div>
    </div>

    {{-- Right: ProfileCard 3D --}}
    <div class="hero-visuals">
      <div class="hero-card-wrap">
        <div class="pc-card-wrapper" style="--behind-glow-color:rgba(99,102,241,0.5);">
          <div class="pc-behind"></div>
          <div class="pc-card-shell">
            <section class="pc-card">
              <div class="pc-inside"></div>
              <div class="pc-shine"></div>
              <div class="pc-glare"></div>

              {{-- Avatar --}}
              <div class="pc-content pc-avatar-content">
                <img class="avatar" src="{{ asset('images/profile.png') }}" alt="{{ $settings['hero_name'] ?? 'Akbar Maulana' }}" loading="eager">
                {{-- User info bar --}}
                <div class="pc-user-info">
                  <div class="pc-user-details">
                    <div class="pc-mini-avatar">
                      <img src="{{ asset('images/profile.png') }}" alt="mini avatar">
                    </div>
                    <div class="pc-user-text">
                      <div class="pc-handle">@abarox</div>
                      <div class="pc-status">Online</div>
                    </div>
                  </div>
                  <a href="#contact" class="pc-contact-btn">Contact</a>
                </div>
              </div>

              {{-- Name overlay --}}
              <div class="pc-content">
                <div class="pc-details">
                  <h3>{{ $settings['hero_name'] ?? 'Akbar Maulana' }}</h3>
                  <p>FullStack &middot; CyberSec</p>
                </div>
              </div>
            </section>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Scroll indicator --}}
  <div class="scroll-down">
    <a href="#about">
      <i class="fas fa-chevron-down"></i>
    </a>
  </div>
</section>


{{-- ══════ ABOUT SECTION ══════ --}}
<section id="about" class="section">
  <div class="container">
    <div class="section-header reveal">
      <div class="section-tag">about_me</div>
      <h2 class="section-title">Tentang Saya</h2>
      <p class="section-subtitle">Mengenal lebih jauh tentang perjalanan, keahlian, dan passion saya di dunia teknologi.</p>
    </div>

    <div class="about-grid">
      {{-- Photo (Tilted Card) --}}
      <div class="about-image-wrap reveal">
        <figure class="tilted-card-figure" id="aboutTiltedCard"
                onmousemove="tiltCardMove(event,this)"
                onmouseenter="tiltCardEnter(this)"
                onmouseleave="tiltCardLeave(this)">
          <div class="tilted-card-inner">
            <img src="{{ asset('images/abarox.png') }}"
                 alt="{{ $settings['hero_name'] ?? 'Akbar Maulana' }}"
                 class="tilted-card-img">
            <div class="tilted-card-overlay">
              <p class="tilted-card-overlay-text">Akbar Maulana</p>
            </div>
          </div>
          <figcaption class="tilted-card-caption">Full Stack Developer</figcaption>
        </figure>

        <div class="about-badge-float">
          <div class="icon"><i class="fas fa-graduation-cap"></i></div>
          <div class="text">
            <p>Mahasiswa Aktif</p>
            <strong>Politeknik Negeri Bengkalis</strong>
          </div>
        </div>
      </div>

      {{-- Text Content --}}
      <div class="about-content reveal reveal-delay-2">
        <h3>Full Stack Developer &amp; <span class="gradient-text">Cybersecurity Specialist</span></h3>
        <p>{{ $settings['about_text'] ?? 'Saya adalah mahasiswa Keamanan Sistem Informasi di Politeknik Negeri Bengkalis yang bersemangat dalam dunia teknologi. Dengan keahlian yang mencakup seluruh spektrum pengembangan perangkat lunak dari desain frontend yang indah hingga arsitektur backend yang kuat dan keamanan siber tingkat lanjut, saya siap memberikan solusi digital yang tidak hanya bekerja dengan baik, tetapi juga aman.' }}</p>
        <p>Selain coding, saya aktif dalam kegiatan CTF (Capture The Flag), penetration testing, dan selalu mengikuti perkembangan terbaru di dunia cybersecurity. Saya percaya bahwa keamanan bukan tambahan, melainkan fondasi dari setiap sistem yang baik.</p>

        <div style="display:flex;gap:1rem;flex-wrap:wrap;margin-top:1.25rem;">
          @foreach($socials->take(2) as $social)
          <a href="{{ $social->url }}" target="_blank" rel="noopener" class="btn-outline" style="padding:0.625rem 1.25rem;font-size:0.875rem;">
            <i class="{{ \App\Helpers\SocialIconHelper::fontAwesomeClass($social->platform) }}"></i> {{ $social->label }}
          </a>
          @endforeach
          <a href="#contact" class="btn-primary" style="padding:0.625rem 1.25rem;font-size:0.875rem;">
            <i class="fas fa-envelope"></i> Let's Talk
          </a>
        </div>
      </div>
    </div>

    {{-- Terminal Box --}}
    <div style="margin-top:4rem;position:relative;z-index:10;" class="reveal reveal-delay-2">
      <div class="terminal-box">
        <div class="terminal-toolbar">
          <div class="terminal-dots">
            <span class="terminal-dot red"></span>
            <span class="terminal-dot"></span>
            <span class="terminal-dot"></span>
          </div>
          <span class="terminal-toolbar-title">abarox@portfolio:~</span>
          <span></span>
        </div>
        <div class="terminal-body">
          <div class="terminal-line">
            <span class="terminal-user">abarox@portfolio</span>
            <span class="terminal-prompt">:</span>
            <span class="terminal-path">~</span>
            <span class="terminal-prompt">$</span>
            <span style="color:#e6e6e6;margin-left:6px;">whoami</span>
          </div>
          <div class="terminal-output">{{ $settings['hero_name'] ?? 'Akbar Maulana' }} — Full Stack &amp; CyberSec</div>
          <div class="terminal-line">
            <span class="terminal-user">abarox@portfolio</span>
            <span class="terminal-prompt">:</span>
            <span class="terminal-path">~</span>
            <span class="terminal-prompt">$</span>
            <span style="color:#e6e6e6;margin-left:6px;">cat skills.txt</span>
          </div>
          <div class="terminal-output">Laravel · React · PHP · Node.js · MySQL · PostgreSQL</div>
          <div class="terminal-output">Penetration Testing · OWASP Top 10 · Linux Admin · CTF</div>
          <div class="terminal-line">
            <span class="terminal-user">abarox@portfolio</span>
            <span class="terminal-prompt">:</span>
            <span class="terminal-path">~</span>
            <span class="terminal-prompt">$</span>
            <span class="terminal-cursor-span"></span>
          </div>
        </div>
      </div>
    </div>

    {{-- SVG Filters for spin animation --}}
    <svg style="position:absolute;width:0;height:0;overflow:hidden;" aria-hidden="true">
      <filter id="unopaq" y="-100%" height="300%" x="-100%" width="300%">
        <feColorMatrix values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 5 0"></feColorMatrix>
      </filter>
      <filter id="unopaq2" y="-100%" height="300%" x="-100%" width="300%">
        <feColorMatrix values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 10 0"></feColorMatrix>
      </filter>
      <filter id="unopaq3" y="-100%" height="300%" x="-100%" width="300%">
        <feColorMatrix values="1 0 0 1 0  0 1 0 1 0  0 0 1 1 0  0 0 0 2 0"></feColorMatrix>
      </filter>
    </svg>

    {{-- GitHub Spin Card (menggantikan MagicBento) --}}
    <div class="bento-wrap">
      <div class="bento-spin-wrap reveal">
        <div class="spin-card-container">
          <div class="spin spin-blur"></div>
          <div class="spin spin-intense"></div>
          <div class="backdrop"></div>
          <div class="card-border">
            <div class="spin spin-inside"></div>
          </div>
          <div class="spin-card">
            <div class="spin-card-header">
              <div class="spin-card-top-header">
                <div class="sc-icon">
                  <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"><path d="M1 2.75A.75.75 0 0 1 1.75 2h12.5a.75.75 0 0 1 0 1.5H1.75A.75.75 0 0 1 1 2.75Zm0 5A.75.75 0 0 1 1.75 7h12.5a.75.75 0 0 1 0 1.5H1.75A.75.75 0 0 1 1 7.75ZM1.75 12h12.5a.75.75 0 0 1 0 1.5H1.75a.75.75 0 0 1 0-1.5Z"></path></svg>
                </div>
                @php $ghUrl = $socials->firstWhere('platform', 'GitHub')?->url ?? '#'; @endphp
                <a class="sc-gh-icon" href="{{ $ghUrl }}" target="_blank" rel="noopener">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,2A10,10 0 0,0 2,12C2,16.42 4.87,20.17 8.84,21.5C9.34,21.58 9.5,21.27 9.5,21C9.5,20.77 9.5,20.14 9.5,19.31C6.73,19.91 6.14,17.97 6.14,17.97C5.68,16.81 5.03,16.5 5.03,16.5C4.12,15.88 5.1,15.9 5.1,15.9C6.1,15.97 6.63,16.93 6.63,16.93C7.5,18.45 8.97,18 9.54,17.76C9.63,17.11 9.89,16.67 10.17,16.42C7.95,16.17 5.62,15.31 5.62,11.5C5.62,10.39 6,9.5 6.65,8.79C6.55,8.54 6.2,7.5 6.75,6.15C6.75,6.15 7.59,5.88 9.5,7.17C10.29,6.95 11.15,6.84 12,6.84C12.85,6.84 13.71,6.95 14.5,7.17C16.41,5.88 17.25,6.15 17.25,6.15C17.8,7.5 17.45,8.54 17.35,8.79C18,9.5 18.38,10.39 18.38,11.5C18.38,15.32 16.04,16.16 13.81,16.41C14.17,16.72 14.5,17.33 14.5,18.26C14.5,19.6 14.5,20.68 14.5,21C14.5,21.27 14.66,21.59 15.17,21.5C19.14,20.16 22,16.42 22,12A10,10 0 0,0 12,2Z"></path></svg>
                </a>
                <div class="sc-repo">
                  <a class="sc-repo-owner" href="{{ $ghUrl }}" target="_blank" rel="noopener">{{ $settings['hero_name'] ?? 'abarox' }}</a>
                  <span class="sc-repo-slash">/</span>
                  <a class="sc-repo-name" href="{{ $ghUrl }}" target="_blank" rel="noopener">portfolio</a>
                </div>
                <div class="sc-space"></div>
                <div class="sc-icon">
                  <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"><path d="M1.5 3.25a2.25 2.25 0 1 1 3 2.122v5.256a2.251 2.251 0 1 1-1.5 0V5.372A2.25 2.25 0 0 1 1.5 3.25Zm5.677-.177L9.573.677A.25.25 0 0 1 10 .854V2.5h1A2.5 2.5 0 0 1 13.5 5v5.628a2.251 2.251 0 1 1-1.5 0V5a1 1 0 0 0-1-1h-1v1.646a.25.25 0 0 1-.427.177L7.177 3.427a.25.25 0 0 1 0-.354ZM3.75 2.5a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5Zm0 9.5a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5Zm8.25.75a.75.75 0 1 0 1.5 0 .75.75 0 0 0-1.5 0Z"></path></svg>
                </div>
                <div class="sc-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="M2.8 2.06A1.75 1.75 0 0 1 4.41 1h7.18c.7 0 1.333.417 1.61 1.06l2.74 6.395c.04.093.06.194.06.295v4.5A1.75 1.75 0 0 1 14.25 15H1.75A1.75 1.75 0 0 1 0 13.25v-4.5c0-.101.02-.202.06-.295Zm1.61.44a.25.25 0 0 0-.23.152L1.887 8H4.75a.75.75 0 0 1 .6.3L6.625 10h2.75l1.275-1.7a.75.75 0 0 1 .6-.3h2.863L11.82 2.652a.25.25 0 0 0-.23-.152Zm10.09 7h-2.875l-1.275 1.7a.75.75 0 0 1-.6.3h-3.5a.75.75 0 0 1-.6-.3L4.375 9.5H1.5v3.75c0 .138.112.25.25.25h12.5a.25.25 0 0 0 .25-.25Z"></path></svg>
                </div>
                <div class="sc-pfp"></div>
              </div>
              <div class="sc-btm-header">
                <div class="sc-tab">
                  <div class="sc-tab-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="m11.28 3.22 4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.749.749 0 0 1-1.275-.326.749.749 0 0 1 .215-.734L13.94 8l-3.72-3.72a.749.749 0 0 1 .326-1.275.749.749 0 0 1 .734.215Zm-6.56 0a.751.751 0 0 1 1.042.018.751.751 0 0 1 .018 1.042L2.06 8l3.72 3.72a.749.749 0 0 1-.326 1.275.749.749 0 0 1-.734-.215L.47 8.53a.75.75 0 0 1 0-1.06Z"></path></svg></div>
                  <div class="sc-tab-text">Code</div>
                </div>
                <div class="sc-tab">
                  <div class="sc-tab-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z"></path><path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0ZM1.5 8a6.5 6.5 0 1 0 13 0 6.5 6.5 0 0 0-13 0Z"></path></svg></div>
                  <div class="sc-tab-text">Issues</div>
                </div>
                <div class="sc-tab sc-tab--active">
                  <div class="sc-tab-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="M1.5 3.25a2.25 2.25 0 1 1 3 2.122v5.256a2.251 2.251 0 1 1-1.5 0V5.372A2.25 2.25 0 0 1 1.5 3.25Zm5.677-.177L9.573.677A.25.25 0 0 1 10 .854V2.5h1A2.5 2.5 0 0 1 13.5 5v5.628a2.251 2.251 0 1 1-1.5 0V5a1 1 0 0 0-1-1h-1v1.646a.25.25 0 0 1-.427.177L7.177 3.427a.25.25 0 0 1 0-.354ZM3.75 2.5a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5Zm0 9.5a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5Zm8.25.75a.75.75 0 1 0 1.5 0 .75.75 0 0 0-1.5 0Z"></path></svg></div>
                  <div class="sc-tab-text">Pull Requests</div>
                </div>
              </div>
            </div>
            <div class="spin-card-content">
              <div class="sc-prs">
                <div class="sc-pr">
                  <div class="sc-pr-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="#63d188"><path d="M1.5 3.25a2.25 2.25 0 1 1 3 2.122v5.256a2.251 2.251 0 1 1-1.5 0V5.372A2.25 2.25 0 0 1 1.5 3.25Zm5.677-.177L9.573.677A.25.25 0 0 1 10 .854V2.5h1A2.5 2.5 0 0 1 13.5 5v5.628a2.251 2.251 0 1 1-1.5 0V5a1 1 0 0 0-1-1h-1v1.646a.25.25 0 0 1-.427.177L7.177 3.427a.25.25 0 0 1 0-.354ZM3.75 2.5a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5Zm0 9.5a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5Zm8.25.75a.75.75 0 1 0 1.5 0 .75.75 0 0 0-1.5 0Z"></path></svg></div>
                  <div class="sc-pr-text">
                    <div class="sc-pr-title">Full Stack Portfolio — Laravel + Neon DB</div>
                    <div class="sc-pr-desc">#{{ $projects->count() + 1 }} opened just now &middot; deployed to production</div>
                  </div>
                </div>
                <div class="sc-pr">
                  <div class="sc-pr-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="#63d188"><path d="M1.5 3.25a2.25 2.25 0 1 1 3 2.122v5.256a2.251 2.251 0 1 1-1.5 0V5.372A2.25 2.25 0 0 1 1.5 3.25Zm5.677-.177L9.573.677A.25.25 0 0 1 10 .854V2.5h1A2.5 2.5 0 0 1 13.5 5v5.628a2.251 2.251 0 1 1-1.5 0V5a1 1 0 0 0-1-1h-1v1.646a.25.25 0 0 1-.427.177L7.177 3.427a.25.25 0 0 1 0-.354ZM3.75 2.5a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5Zm0 9.5a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5Zm8.25.75a.75.75 0 1 0 1.5 0 .75.75 0 0 0-1.5 0Z"></path></svg></div>
                  <div class="sc-pr-text">
                    <div class="sc-pr-title">Cybersecurity: Penetration Testing Toolkit</div>
                    <div class="sc-pr-desc">#{{ $projects->count() }} &middot; OWASP Top 10 &middot; SQLi &middot; XSS &middot; CSRF</div>
                  </div>
                </div>
                <div class="sc-pr">
                  <div class="sc-pr-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="#63d188"><path d="M1.5 3.25a2.25 2.25 0 1 1 3 2.122v5.256a2.251 2.251 0 1 1-1.5 0V5.372A2.25 2.25 0 0 1 1.5 3.25Zm5.677-.177L9.573.677A.25.25 0 0 1 10 .854V2.5h1A2.5 2.5 0 0 1 13.5 5v5.628a2.251 2.251 0 1 1-1.5 0V5a1 1 0 0 0-1-1h-1v1.646a.25.25 0 0 1-.427.177L7.177 3.427a.25.25 0 0 1 0-.354ZM3.75 2.5a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5Zm0 9.5a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5Zm8.25.75a.75.75 0 1 0 1.5 0 .75.75 0 0 0-1.5 0Z"></path></svg></div>
                  <div class="sc-pr-text">
                    <div class="sc-pr-title">AI Integration: LLM API Wrapper</div>
                    <div class="sc-pr-desc">#{{ max($projects->count() - 1, 1) }} &middot; Python &middot; FastAPI &middot; OpenAI</div>
                  </div>
                </div>
                @foreach($projects->take(5) as $p)
                <div class="sc-pr">
                  <div class="sc-pr-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="#63d188"><path d="M1.5 3.25a2.25 2.25 0 1 1 3 2.122v5.256a2.251 2.251 0 1 1-1.5 0V5.372A2.25 2.25 0 0 1 1.5 3.25Zm5.677-.177L9.573.677A.25.25 0 0 1 10 .854V2.5h1A2.5 2.5 0 0 1 13.5 5v5.628a2.251 2.251 0 1 1-1.5 0V5a1 1 0 0 0-1-1h-1v1.646a.25.25 0 0 1-.427.177L7.177 3.427a.25.25 0 0 1 0-.354ZM3.75 2.5a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5Zm0 9.5a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5Zm8.25.75a.75.75 0 1 0 1.5 0 .75.75 0 0 0-1.5 0Z"></path></svg></div>
                  <div class="sc-pr-text">
                    <div class="sc-pr-title">{{ Str::limit($p->title, 55) }}</div>
                    <div class="sc-pr-desc">{{ $p->tech_stack ?? 'Web Project' }} &middot; {{ $loop->iteration > 1 ? $loop->iteration.' days ago' : 'recently' }}</div>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>{{-- end bento-spin-wrap --}}
    </div>{{-- end bento-wrap --}}

  </div>
</section>


{{-- ══════ SKILLS SECTION ══════ --}}
<section id="skills" class="section section-alt">
  <div class="container">
    <div class="section-header reveal">
      <div class="section-tag">tech_stack</div>
      <h2 class="section-title">Skills &amp; Teknologi</h2>
      <p class="section-subtitle">Teknologi yang saya kuasai dalam pengembangan aplikasi dan keamanan sistem.</p>
    </div>

    {{-- Terminal Skills Grid --}}
    <div class="terminal-skills-grid" id="terminalSkillsGrid">
      @php
        $brands = ['fa-html5','fa-css3-alt','fa-js','fa-react','fa-vuejs','fa-angular','fa-sass','fa-bootstrap','fa-php','fa-python','fa-java','fa-node-js','fa-laravel','fa-docker','fa-linux','fa-git-alt','fa-github','fa-gitlab'];

        /* ── Group categories into 3 terminal boxes via keyword matching ── */
        $webDevCats   = [];
        $cyberSecCats = [];
        $othersCats   = [];

        foreach ($skills as $cat => $catSkills) {
          $lower = strtolower($cat);
          if (str_contains($lower, 'web') || str_contains($lower, 'frontend') || str_contains($lower, 'front-end') || str_contains($lower, 'backend') || str_contains($lower, 'back-end') || str_contains($lower, 'database') || str_contains($lower, 'fullstack') || str_contains($lower, 'full stack') || str_contains($lower, 'development')) {
            $webDevCats[$cat] = $catSkills;
          } elseif (str_contains($lower, 'cyber') || str_contains($lower, 'security') || str_contains($lower, 'hacking') || str_contains($lower, 'pentest') || str_contains($lower, 'ctf')) {
            $cyberSecCats[$cat] = $catSkills;
          } else {
            $othersCats[$cat] = $catSkills;
          }
        }

        /* ── Build 3 terminal boxes in fixed order ── */
        $terminalBoxes = [];
        if (!empty($webDevCats))   $terminalBoxes[] = ['label'=>'web-dev@skills:~',  'cmd'=>'ls skills/webdev/',   'color'=>'#63f5a8', 'cats'=>$webDevCats,   'title'=>'Web Development'];
        if (!empty($cyberSecCats)) $terminalBoxes[] = ['label'=>'cybersec@skills:~', 'cmd'=>'ls skills/security/', 'color'=>'#f56363', 'cats'=>$cyberSecCats, 'title'=>'Cybersecurity'];
        if (!empty($othersCats))   $terminalBoxes[] = ['label'=>'others@skills:~',   'cmd'=>'ls skills/tools/',    'color'=>'#f5c063', 'cats'=>$othersCats,   'title'=>'Others & Tools'];

        /* ── Fallback: if nothing matched, put all into one box ── */
        if (empty($terminalBoxes)) {
          $allCats = [];
          foreach ($skills as $cat => $catSkills) { $allCats[$cat] = $catSkills; }
          $terminalBoxes[] = ['label'=>'skills:~', 'cmd'=>'cat skills.list', 'color'=>'#63f5a8', 'cats'=>$allCats, 'title'=>'All Skills'];
        }
      @endphp


      @foreach($terminalBoxes as $box)
      <div class="term-skill-card reveal" data-term-index="{{ $loop->index }}">
        {{-- Terminal Titlebar --}}
        <div class="term-skill-bar">
          <div class="term-skill-dots">
            <span class="tsd red"></span>
            <span class="tsd yellow"></span>
            <span class="tsd green"></span>
          </div>
          <span class="term-skill-title">{{ $box['label'] }}</span>
          <span></span>
        </div>

        {{-- Terminal Body --}}
        <div class="term-skill-body">
          {{-- Command line --}}
          <div class="term-skill-line">
            <span class="term-skill-prompt" style="color:{{ $box['color'] }}">{{ $box['label'] }}$</span>
            <span class="term-skill-cmd">{{ $box['cmd'] }}</span>
          </div>

          {{-- Output: category header + skill bars --}}
          @foreach($box['cats'] as $category => $catSkills)
          <div class="term-skill-line term-cat-header">
            <span style="color:{{ $box['color'] }};font-weight:700;"># {{ $category }}</span>
          </div>
          @foreach($catSkills as $skill)
          @php
            $icon   = $skill->icon ?? '';
            $name   = $skill->name ?? '';
            $pct    = (int)($skill->level ?? 80);
            $filled = (int)round($pct / 5);  // 20 total chars
            $empty  = 20 - $filled;
            $prefix = in_array($icon, $brands) ? 'fab' : 'fas';
            $hashBar = str_repeat('#', $filled) . str_repeat(' ', $empty);
          @endphp
          <div class="term-skill-item" data-pct="{{ $pct }}">
            <div class="term-skill-name-row">
              @if($icon)<i class="{{ $prefix }} {{ $icon }}" style="color:{{ $box['color'] }};margin-right:6px;font-size:0.8rem;"></i>@endif
              <span class="term-skill-name">{{ $name }}</span>
            </div>
            <div class="term-skill-bar-row">
              <span class="term-hash-bar" data-filled="{{ $filled }}" data-empty="{{ $empty }}" data-color="{{ $box['color'] }}">[<span class="term-hash-fill" style="color:{{ $box['color'] }}"></span><span class="term-hash-empty"></span>]</span>
              <span class="term-pct-label">{{ $pct }}%</span>
            </div>
          </div>
          @endforeach
          @endforeach

          {{-- Blinking cursor --}}
          <div class="term-skill-line" style="margin-top:8px;">
            <span class="term-skill-prompt" style="color:{{ $box['color'] }}">{{ $box['label'] }}$</span>
            <span class="term-cursor-blink"></span>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>


{{-- ══════ PROJECTS SECTION ══════ --}}
<section id="projects" class="section">
  <div class="container">
    <div class="section-header reveal">
      <div class="section-tag">my_work</div>
      <h2 class="section-title">Projects</h2>
      <p class="section-subtitle">Kumpulan proyek yang pernah saya kerjakan — dari web app, AI, hingga keamanan sistem.</p>
    </div>

    @php
      $featuredProjects = $projects->where('is_featured', true)->take(4);
      if ($featuredProjects->isEmpty()) $featuredProjects = $projects->take(4);
    @endphp

    @if($featuredProjects->isNotEmpty())
    {{-- CardSwap — Featured Projects --}}
    <div class="projects-featured-wrap reveal">
      {{-- Left text --}}
      <div class="projects-featured-text">
        <div class="projects-featured-badge">
          <span class="mono">Featured</span>
        </div>
        <h3 style="font-size:1.75rem;font-weight:800;line-height:1.2;margin-bottom:1rem;">
          <span class="gradient-text">Featured</span><br>Projects
        </h3>
        <p style="color:var(--clr-text-2);line-height:1.7;font-size:0.9rem;text-align:justify;">
          Proyek-proyek terbaik yang menampilkan kemampuan full stack dan keamanan web saya. Dibangun dengan standar produksi.
        </p>
      </div>

      {{-- Right: CardSwap container --}}
      <div class="projects-featured-slider">
        <div class="card-swap-container"
             data-card-distance="60"
             data-vertical-distance="70"
             data-delay="5000"
             data-skew="6"
             data-easing="elastic">
          @foreach($featuredProjects as $proj)
          <div class="cs-card">
            <div class="swap-card-inner">
              <div>
                <div class="swap-card-tag">Featured Project</div>
                <div class="swap-card-title">{{ $proj->title }}</div>
                <div class="swap-card-desc">{{ Str::limit($proj->description ?? '', 140) }}...</div>
              </div>
              <div class="swap-card-footer">
                <span class="swap-card-stack mono">{{ Str::limit($proj->tech_stack ?? '', 40) }}</span>
                <div style="display:flex;gap:0.5rem;">
                  @if(!empty($proj->live_url))
                  <a href="{{ $proj->live_url }}" target="_blank" rel="noopener" class="project-link project-link-demo" style="font-size:0.75rem;padding:0.3rem 0.7rem;">
                    <i class="fas fa-external-link-alt"></i> Demo
                  </a>
                  @endif
                  @if(!empty($proj->github_url))
                  <a href="{{ $proj->github_url }}" target="_blank" rel="noopener" class="project-link project-link-github" style="font-size:0.75rem;padding:0.3rem 0.7rem;">
                    <i class="fab fa-github"></i>
                  </a>
                  @endif
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    @endif

    {{-- View All Projects Button --}}
    <div style="text-align:center; margin-top: 2rem;">
      <a href="{{ url('/projects') }}" class="btn-primary" style="padding: 0.875rem 2rem; font-size: 1rem;">
        Lihat Semua Project <i class="fas fa-arrow-right" style="margin-left: 0.5rem;"></i>
      </a>
    </div>

  </div>
</section>


{{-- ══════ LANYARD SECTION ══════ --}}
<section id="lanyard-section">
  <div class="container">
    <div class="lanyard-section-header reveal">
      <div class="section-tag">id_card</div>
      <h2 class="section-title">My Digital ID Card</h2>
      <p class="section-subtitle">Drag me around! Kartu identitas digital interaktif — tarik talinya!</p>
    </div>
    <div style="display:flex;justify-content:center;align-items:center;position:relative;z-index:1;">
      <div class="lanyard-canvas-wrap">
        <div id="lanyard-root"
             data-front-image="{{ asset('images/logo.svg') }}"
             data-lanyard-image="{{ asset('lanyard/lanyard.png') }}"
             data-lanyard-width="1.5">
        </div>
      </div>
    </div>
    <p class="lanyard-desc reveal" style="margin-top:1.5rem;">
      <i class="fas fa-hand-pointer"></i> &nbsp;Drag the card &middot; Physics-based simulation
    </p>
  </div>
</section>


{{-- ══════ CONTACT SECTION ══════ --}}
<section id="contact" class="section section-alt">
  <div class="container">
    <div class="section-header reveal">
      <div class="section-tag">get_in_touch</div>
      <h2 class="section-title">Hubungi Saya</h2>
      <p class="section-subtitle">Punya project menarik? Ingin berkolaborasi? Atau sekadar ngobrol tentang teknologi? Saya siap mendengarkan!</p>
    </div>

    <div class="contact-grid">
      {{-- Contact Info --}}
      <div class="contact-info reveal">
        <h3>Mari <span class="gradient-text">Berkolaborasi!</span></h3>
        <p>Saya selalu terbuka untuk peluang baru — freelance, project kolaborasi, magang, atau diskusi tentang cybersecurity dan full stack development.</p>

        @if(!empty($settings['contact_email']))
        <div class="contact-item">
          <div class="contact-icon"><i class="fas fa-envelope"></i></div>
          <div>
            <div class="contact-item-label">Email</div>
            <div class="contact-item-value" data-copy-email="{{ $settings['contact_email'] }}" style="cursor:pointer;" title="Klik untuk copy">
              {{ $settings['contact_email'] }}
            </div>
          </div>
        </div>
        @endif

        @if(!empty($settings['contact_location']))
        <div class="contact-item">
          <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
          <div>
            <div class="contact-item-label">Lokasi</div>
            <div class="contact-item-value">{{ $settings['contact_location'] }}</div>
          </div>
        </div>
        @endif

        <div class="contact-item">
          <div class="contact-icon"><i class="fas fa-clock"></i></div>
          <div>
            <div class="contact-item-label">Response Time</div>
            <div class="contact-item-value">&lt; 24 jam (biasanya lebih cepat)</div>
          </div>
        </div>

        {{-- Social Links from DB --}}
        @if($socials->isNotEmpty())
        <div class="social-links-tooltip-row">
          @foreach($socials as $social)
          @php
            $platformKey = strtolower($social->platform);
            $color = $social->accent_color ?? '#00d4ff';
          @endphp
          <div class="tooltip-container" style="--social-color: {{ $color }};">
            <div class="tooltip">
              <div class="profile" style="background: {{ $color }}22; border-color: {{ $color }}55;">
                <div class="user">
                  <div class="img" style="border-color: {{ $color }}; color: {{ $color }};">
                    {{ \App\Helpers\SocialIconHelper::initials($social->platform) }}
                  </div>
                  <div class="details">
                    <div class="name" style="color: {{ $color }};">{{ $social->platform }}</div>
                    <div class="username">{{ $social->label }}</div>
                  </div>
                </div>
                <div class="about">Temukan saya di {{ $social->platform }}</div>
              </div>
            </div>
            <div class="text">
              <a class="icon" href="{{ $social->url }}" target="_blank" rel="noopener">
                <div class="layer" style="border-color: {{ $color }}; box-shadow: 0 0 15px {{ $color }}99, 0 0 20px {{ $color }}66;">
                  <span style="border-color: {{ $color }};" ></span>
                  <span style="border-color: {{ $color }};" ></span>
                  <span style="border-color: {{ $color }};" ></span>
                  <span style="border-color: {{ $color }};" ></span>
                  <span class="social-platform-icon" style="background: {{ $color }}; border-radius: 50%; display:flex; align-items:center; justify-content:center;">
                    {!! \App\Helpers\SocialIconHelper::svg($social->platform) !!}
                  </span>
                </div>
                <div class="text" style="color: {{ $color }};">{{ $social->platform }}</div>
              </a>
            </div>
          </div>
          @endforeach
        </div>
        @endif
      </div>

      {{-- Contact Form --}}
      <div class="contact-form reveal reveal-delay-2">
        @if(session('success'))
          <div class="alert alert-success">
            <i class="fas fa-circle-check"></i>
            {{ session('success') }}
          </div>
        @endif
        @if(session('error'))
          <div class="alert alert-error">
            <i class="fas fa-circle-exclamation"></i>
            {{ session('error') }}
          </div>
        @endif

        <form id="contact-form" method="POST" action="{{ route('contact.store') }}"
              data-recaptcha="contact"
              data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}">
          @csrf
          <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">

          <div class="form-row">
            <div class="form-group">
              <label class="form-label" for="contact-name">Nama Lengkap *</label>
              <input type="text" id="contact-name" name="name" class="form-control @error('name') border-red @enderror"
                     placeholder="{{ $settings['hero_name'] ?? 'Muhammad Farel' }}" required maxlength="100" autocomplete="name" value="{{ old('name') }}">
              @error('name')<p style="color:var(--clr-danger);font-size:0.78rem;margin-top:4px;">{{ $message }}</p>@enderror
            </div>
            <div class="form-group">
              <label class="form-label" for="contact-email">Email *</label>
              <input type="email" id="contact-email" name="email" class="form-control @error('email') border-red @enderror"
                     placeholder="anda@email.com" required maxlength="255" autocomplete="email" value="{{ old('email') }}">
              @error('email')<p style="color:var(--clr-danger);font-size:0.78rem;margin-top:4px;">{{ $message }}</p>@enderror
            </div>
          </div>

          <div class="form-group">
            <label class="form-label" for="contact-subject">Subjek *</label>
            <input type="text" id="contact-subject" name="subject" class="form-control"
                   placeholder="Kolaborasi Project / Pertanyaan / Freelance..." required maxlength="200" value="{{ old('subject') }}">
          </div>

          <div class="form-group">
            <label class="form-label" for="contact-message">Pesan *</label>
            <textarea id="contact-message" name="message" class="form-control @error('message') border-red @enderror"
                      placeholder="Ceritakan tentang project atau kebutuhan Anda..." required
                      minlength="10" maxlength="2000" rows="5">{{ old('message') }}</textarea>
            @error('message')<p style="color:var(--clr-danger);font-size:0.78rem;margin-top:4px;">{{ $message }}</p>@enderror
          </div>

          <button type="submit" class="form-submit" id="contactSubmit">
            <i class="fas fa-paper-plane"></i> Kirim Pesan
          </button>

          <p style="font-size:0.7rem;color:var(--clr-text-3);text-align:center;margin-top:0.75rem;">
            Protected by reCAPTCHA.
            <a href="https://policies.google.com/privacy" style="color:var(--clr-primary-2);">Privacy</a> &amp;
            <a href="https://policies.google.com/terms"   style="color:var(--clr-primary-2);">Terms</a>.
          </p>
        </form>
      </div>
    </div>
  </div>
</section>


{{-- ─── Footer ──────────────────────────────────────────── --}}
<footer>
  <div class="container">
    <p>
      {{ $settings['footer_text'] ?? '&copy; ' . date('Y') . ' ' . ($settings['hero_name'] ?? 'Akbar Maulana') . '. Dibuat dengan Laravel &amp; Vanilla JS' }}
    </p>
  </div>
</footer>


{{-- ─── Scripts ─────────────────────────────────────────── --}}
{{-- GSAP (required by PillNav + CardSwap) --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

{{-- Profile Card --}}
<script src="{{ asset('js/profile-card.js') }}"></script>

{{-- CardSwap (requires GSAP) --}}
<script src="{{ asset('js/card-swap.js') }}"></script>

{{-- MagicBento --}}
<script src="{{ asset('js/magic-bento.js') }}"></script>

{{-- Main (LightRays + nav + typed + reveal + etc.) --}}
<script src="{{ asset('js/main.js') }}"></script>

{{-- Lanyard Bundle --}}
<link rel="stylesheet" href="{{ asset('lanyard/lanyard-bundle.css') }}">
<script type="module" src="{{ asset('lanyard/lanyard-bundle.js') }}"></script>

<script>
// ─── reCAPTCHA v3 ───────────────────────────────────────────────────────────
const contactForm = document.getElementById('contact-form');
if (contactForm) {
  contactForm.addEventListener('submit', function(e) {
    e.preventDefault();
    if (typeof grecaptcha === 'undefined') { contactForm.submit(); return; }
    grecaptcha.ready(() => {
      grecaptcha.execute('{{ env('RECAPTCHA_SITE_KEY') }}', { action: 'submit' }).then(token => {
        document.getElementById('g-recaptcha-response').value = token;
        contactForm.submit();
      });
    });
  });
}
</script>
</body>
</html>
