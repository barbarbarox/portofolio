<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Semua proyek karya {{ $settings['hero_name'] ?? 'Akbar Maulana' }} — Full Stack Developer & Cybersecurity Specialist.">
  <title>Projects — {{ $settings['hero_name'] ?? 'Akbar Maulana' }}</title>

  {{-- Google Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
  {{-- FontAwesome --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    /* ── Variables & Reset ─────────────────────────────────── */
    :root {
      --bg:       #0a0a10;
      --bg2:      #111118;
      --border:   rgba(255,255,255,0.08);
      --text:     #f1f5f9;
      --text2:    #94a3b8;
      --accent:   #8ed500;
      --accent2:  #00d4ff;
      --card-dark:#141414;
      --mono:     'JetBrains Mono', monospace;
      --sans:     'Inter', sans-serif;
    }
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; overflow-x: hidden; }
    body {
      font-family: var(--sans);
      background: var(--bg);
      color: var(--text);
      line-height: 1.6;
      overflow-x: hidden;
      -webkit-font-smoothing: antialiased;
    }
    a { color: inherit; text-decoration: none; }

    /* ── Noise / grain overlay ─────────────────────────────── */
    body::before {
      content: '';
      position: fixed;
      inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E");
      pointer-events: none;
      z-index: 0;
      opacity: 0.4;
    }

    /* ── Nav ───────────────────────────────────────────────── */
    .nav {
      position: sticky;
      top: 0;
      z-index: 100;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 1rem 2rem;
      background: rgba(10,10,16,0.85);
      backdrop-filter: blur(16px);
      border-bottom: 1px solid var(--border);
    }
    .nav-logo {
      font-family: var(--mono);
      font-size: 1rem;
      font-weight: 700;
      color: var(--accent);
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    .nav-logo span { color: var(--text2); }
    .nav-back {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 0.85rem;
      color: var(--text2);
      padding: 0.4rem 1rem;
      border: 1px solid var(--border);
      border-radius: 100px;
      transition: all 0.25s;
    }
    .nav-back:hover { color: var(--accent); border-color: var(--accent); }

    /* ── Page Header ───────────────────────────────────────── */
    .page-header {
      position: relative;
      z-index: 1;
      text-align: center;
      padding: 5rem 2rem 3rem;
    }
    .page-header-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
      font-family: var(--mono);
      font-size: 0.78rem;
      color: var(--accent);
      background: rgba(142,213,0,0.08);
      border: 1px solid rgba(142,213,0,0.25);
      border-radius: 100px;
      padding: 0.35rem 0.9rem;
      margin-bottom: 1.5rem;
    }
    .page-header-badge::before {
      content: '';
      width: 6px; height: 6px;
      border-radius: 50%;
      background: var(--accent);
      animation: pulse 2s ease-in-out infinite;
    }
    @keyframes pulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:0.5;transform:scale(0.8)} }
    .page-title {
      font-size: clamp(2.2rem, 6vw, 4rem);
      font-weight: 900;
      letter-spacing: -0.03em;
      line-height: 1.1;
      margin-bottom: 1rem;
    }
    .page-title span {
      background: linear-gradient(90deg, var(--accent) 0%, var(--accent2) 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    .page-subtitle {
      color: var(--text2);
      font-size: 1rem;
      max-width: 520px;
      margin: 0 auto 2rem;
    }
    .project-count-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
      font-family: var(--mono);
      font-size: 0.8rem;
      color: var(--text2);
      background: rgba(255,255,255,0.04);
      border: 1px solid var(--border);
      border-radius: 100px;
      padding: 0.3rem 0.9rem;
    }

    /* ── Filter Tabs ───────────────────────────────────────── */
    .filter-bar {
      position: relative;
      z-index: 1;
      display: flex;
      flex-wrap: wrap;
      gap: 0.5rem;
      justify-content: center;
      padding: 0 2rem 3rem;
    }
    .filter-btn {
      font-family: var(--mono);
      font-size: 0.78rem;
      font-weight: 700;
      cursor: pointer;
      padding: 0.4rem 1rem;
      border-radius: 100px;
      border: 1px solid var(--border);
      background: transparent;
      color: var(--text2);
      transition: all 0.25s;
    }
    .filter-btn:hover, .filter-btn.active {
      background: var(--accent);
      border-color: var(--accent);
      color: var(--card-dark);
    }

    /* ── Grid ──────────────────────────────────────────────── */
    .projects-grid {
      position: relative;
      z-index: 1;
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
      gap: 2rem;
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 2rem 6rem;
    }

    /* ── 3D Card (adapted from Uiverse by imtausef) ────────── */
    .proj-parent {
      perspective: 1000px;
    }
    .proj-card {
      position: relative;
      padding-top: 50px;
      border: 3px solid var(--card-dark);
      transform-style: preserve-3d;
      background:
        linear-gradient(135deg, #0000 18.75%, rgba(255,255,255,0.03) 0 31.25%, #0000 0),
        repeating-linear-gradient(45deg, rgba(255,255,255,0.02) -6.25% 6.25%, var(--card-dark) 0 18.75%);
      background-size: 60px 60px;
      background-color: var(--card-dark);
      width: 100%;
      box-shadow: rgba(0,0,0,0.5) 0px 30px 30px -10px;
      transition: all 0.5s ease-in-out;
      border-radius: 12px;
      overflow: hidden;
    }
    .proj-card:hover {
      background-position: -100px 100px, -100px 100px;
      transform: rotate3d(0.5, 1, 0, 30deg);
    }

    .proj-content-box {
      padding: 60px 25px 25px 25px;
      transform-style: preserve-3d;
      transition: all 0.5s ease-in-out;
    }
    /* accent color applied dynamically via inline style */

    .proj-icon-badge {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 44px;
      height: 44px;
      border-radius: 10px;
      background: rgba(0,0,0,0.25);
      border: 1px solid rgba(255,255,255,0.15);
      margin-bottom: 0.75rem;
      transform: translate3d(0, 0, 50px);
      transition: transform 0.5s ease-in-out;
    }
    .proj-icon-badge i { font-size: 1.25rem; color: rgba(0,0,0,0.75); }
    .proj-card:hover .proj-icon-badge { transform: translate3d(0, 0, 70px); }

    .proj-title {
      display: inline-block;
      color: var(--card-dark);
      font-size: 1.25rem;
      font-weight: 900;
      line-height: 1.2;
      margin-bottom: 0.5rem;
      transition: all 0.5s ease-in-out;
      transform: translate3d(0, 0, 50px);
    }
    .proj-card:hover .proj-title { transform: translate3d(0, 0, 65px); }

    .proj-description {
      margin-top: 8px;
      font-size: 0.82rem;
      font-weight: 600;
      color: rgba(20,20,20,0.75);
      line-height: 1.6;
      transition: all 0.5s ease-in-out;
      transform: translate3d(0, 0, 30px);
    }
    .proj-card:hover .proj-description { transform: translate3d(0, 0, 50px); }

    .proj-tags {
      display: flex;
      flex-wrap: wrap;
      gap: 0.35rem;
      margin-top: 0.75rem;
      transform: translate3d(0, 0, 25px);
      transition: transform 0.5s ease-in-out;
    }
    .proj-card:hover .proj-tags { transform: translate3d(0, 0, 45px); }
    .proj-tag {
      font-family: var(--mono);
      font-size: 0.68rem;
      font-weight: 700;
      padding: 0.2rem 0.6rem;
      background: rgba(20,20,20,0.2);
      color: var(--card-dark);
      border-radius: 4px;
    }

    .proj-actions {
      display: flex;
      gap: 0.5rem;
      margin-top: 1.25rem;
      transform: translate3d(0, 0, 20px);
      transition: transform 0.5s ease-in-out;
    }
    .proj-card:hover .proj-actions { transform: translate3d(0, 0, 60px); }
    .proj-btn {
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 0.35rem;
      font-family: var(--mono);
      font-weight: 900;
      font-size: 0.72rem;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      background: var(--card-dark);
      padding: 0.5rem 0.8rem;
      border-radius: 6px;
      transition: all 0.3s;
    }
    .proj-btn:hover { filter: brightness(1.2); transform: translateY(-2px); }

    /* Date box — shows month/year of creation */
    .proj-date-box {
      position: absolute;
      top: 14px;
      right: 14px;
      height: 58px;
      width: 58px;
      background: var(--card-dark);
      border: 1px solid;
      border-radius: 8px;
      padding: 8px;
      transform: translate3d(0, 0, 80px);
      box-shadow: rgba(0,0,0,0.4) 0px 17px 10px -10px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }
    .proj-date-box .proj-month {
      display: block;
      font-family: var(--mono);
      font-size: 0.6rem;
      font-weight: 700;
      text-align: center;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }
    .proj-date-box .proj-year {
      display: block;
      font-family: var(--mono);
      font-size: 1rem;
      font-weight: 900;
      text-align: center;
    }

    /* ── Empty state ───────────────────────────────────────── */
    .empty-state {
      grid-column: 1 / -1;
      text-align: center;
      padding: 5rem 2rem;
      color: var(--text2);
    }
    .empty-state i { font-size: 3rem; margin-bottom: 1rem; opacity: 0.3; display: block; }

    /* ── Footer ────────────────────────────────────────────── */
    .page-footer {
      position: relative;
      z-index: 1;
      text-align: center;
      padding: 2rem;
      border-top: 1px solid var(--border);
      color: var(--text2);
      font-size: 0.82rem;
      font-family: var(--mono);
    }

    /* ── Reveal animation ──────────────────────────────────── */
    .proj-parent {
      opacity: 0;
      transform: translateY(28px);
      transition: opacity 0.5s ease, transform 0.5s ease;
    }
    .proj-parent.visible {
      opacity: 1;
      transform: translateY(0);
    }

    /* ── Show/hide per breakpoint ──────────────────────────── */
    .proj-desktop { display: block; }
    .proj-mobile  { display: none;  }

    @media (max-width: 768px) {
      .proj-desktop { display: none; }
      .proj-mobile  { display: block; }
    }

    /* ── Mobile Card (Smit-Prajapati, adapted) ─────────────── */
    .pm-card {
      width: 100%;
      border-radius: 20px;
      background: #1b233d;
      padding: 5px;
      overflow: hidden;
      box-shadow: rgba(0,0,0,0.5) 0px 12px 30px -8px;
      transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .pm-card:hover { transform: scale(1.02); }

    .pm-top {
      height: 140px;
      border-radius: 15px;
      display: flex;
      flex-direction: column;
      position: relative;
      overflow: hidden;
    }
    .pm-top::after {
      content: '';
      position: absolute;
      inset: 0;
      background: rgba(0,0,0,0.15);
    }
    .pm-border {
      border-bottom-right-radius: 10px;
      height: 30px;
      width: 130px;
      background: #1b233d;
      position: relative;
      transform: skew(-40deg);
      box-shadow: -10px -10px 0 0 #1b233d;
      z-index: 2;
    }
    .pm-border::before {
      content: "";
      position: absolute;
      width: 15px; height: 15px;
      top: 0; right: -15px;
      background: rgba(255,255,255,0);
      border-top-left-radius: 10px;
      box-shadow: -5px -5px 0 2px #1b233d;
    }
    .pm-top::before {
      content: "";
      position: absolute;
      top: 30px; left: 0;
      background: rgba(255,255,255,0);
      height: 15px; width: 15px;
      border-top-left-radius: 15px;
      box-shadow: -5px -5px 0 2px #1b233d;
      z-index: 2;
    }
    .pm-icons {
      position: absolute;
      top: 0; width: 100%; height: 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      z-index: 3;
    }
    .pm-icon-badge {
      height: 100%;
      display: flex;
      align-items: center;
      padding: 2px 0 2px 14px;
      font-size: 1.1rem;
    }
    .pm-icon-badge i { color: rgba(0,0,0,0.65); font-size: 1.1rem; }
    .pm-links {
      height: 100%;
      padding: 4px 12px;
      display: flex;
      gap: 8px;
      align-items: center;
    }
    .pm-link {
      color: #1b233d;
      font-size: 0.78rem;
      transition: color 0.2s;
    }
    .pm-link:hover { color: white; }

    .pm-bottom {
      padding: 12px 8px 8px;
    }
    .pm-title {
      display: block;
      font-size: 1rem;
      font-weight: 900;
      color: white;
      letter-spacing: 1px;
      margin-bottom: 4px;
    }
    .pm-desc {
      font-size: 0.78rem;
      color: rgba(170,222,243,0.7);
      line-height: 1.5;
      margin-bottom: 10px;
    }
    .pm-tags {
      display: flex;
      flex-wrap: wrap;
      gap: 0.35rem;
      margin-bottom: 10px;
    }
    .pm-tag {
      font-family: var(--mono);
      font-size: 0.6rem;
      font-weight: 700;
      padding: 0.2rem 0.5rem;
      border-radius: 4px;
      color: white;
    }
    .pm-row {
      display: flex;
      justify-content: space-between;
      margin-top: 10px;
      border-top: 1px solid rgba(255,255,255,0.08);
      padding-top: 8px;
    }
    .pm-action {
      flex: 1;
      text-align: center;
      padding: 4px;
      color: rgba(170,222,243,0.8);
      font-family: var(--mono);
      font-size: 0.72rem;
      font-weight: 700;
      transition: color 0.2s;
    }
    .pm-action:hover { color: white; }
    .pm-action + .pm-action {
      border-left: 1px solid rgba(255,255,255,0.1);
    }
    .pm-action-private {
      opacity: 0.4;
      cursor: default;
    }
    .pm-action i { display: block; font-size: 1rem; margin-bottom: 2px; }

    /* ── Responsive ────────────────────────────────────────── */
    @media (max-width: 600px) {
      .nav { padding: 0.75rem 1rem; }
      .page-header { padding: 3.5rem 1rem 2rem; }
      .filter-bar { padding: 0 1rem 2rem; }
      .projects-grid { padding: 0 1rem 4rem; gap: 1.25rem; }
    }
  </style>
</head>
<body>

  {{-- Nav --}}
  <nav class="nav">
    <div class="nav-logo">
      <i class="fas fa-terminal"></i>
      <span>~/</span>projects
    </div>
    <a href="{{ route('home') }}" class="nav-back">
      <i class="fas fa-arrow-left"></i> Kembali
    </a>
  </nav>

  {{-- Page Header --}}
  <header class="page-header">
    <div class="page-header-badge">All Projects</div>
    <h1 class="page-title">Semua <span>Projects</span></h1>
    <p class="page-subtitle">Kumpulan proyek yang pernah saya bangun — dari web application, cybersecurity tools, hingga integrasi AI.</p>
    <div class="project-count-badge">
      <i class="fas fa-layer-group"></i>
      {{ $projects->count() }} Projects
    </div>
  </header>

  {{-- Filter Bar --}}
  @php
    $allTags = $projects->flatMap(fn($p) => $p->tags ?? [])->unique()->sort()->values();
  @endphp
  @if($allTags->count() > 0)
  <div class="filter-bar" id="filter-bar">
    <button class="filter-btn active" data-filter="all">All</button>
    @foreach($allTags as $tag)
      <button class="filter-btn" data-filter="{{ Str::slug($tag) }}">{{ $tag }}</button>
    @endforeach
  </div>
  @endif

  {{-- Projects Grid --}}
  <main class="projects-grid" id="projects-grid">
    @forelse($projects as $project)
      @php
        $accent = $project->accent_color ?: '#8ed500';
        $tags   = $project->tags ?? [];
        $tagSlugs = implode(' ', array_map(fn($t) => Str::slug($t), $tags));
        $dt = $project->created_at;
        $month = strtoupper($dt->format('M'));
        $year  = $dt->format('Y');
      @endphp
      <div class="proj-parent" data-tags="{{ $tagSlugs }}">

        {{-- ── DESKTOP: 3D card ──────────────────────────── --}}
        <div class="proj-desktop">
          <div class="proj-card">
            <div class="proj-date-box" style="border-color: {{ $accent }};">
              <span class="proj-month" style="color: {{ $accent }};">{{ $month }}</span>
              <span class="proj-year" style="color: {{ $accent }};">{{ $year }}</span>
            </div>
            <div class="proj-content-box" style="background: {{ $accent }};">
              <div class="proj-icon-badge"><i class="fas fa-code-branch"></i></div>
              <span class="proj-title">{{ $project->title }}</span>
              <p class="proj-description">{{ $project->description }}</p>
              @if(!empty($tags))
              <div class="proj-tags">
                @foreach($tags as $tag)
                  <span class="proj-tag">{{ $tag }}</span>
                @endforeach
              </div>
              @endif
              <div class="proj-actions">
                @if(!empty($project->github_url))
                  <a href="{{ $project->github_url }}" target="_blank" rel="noopener" class="proj-btn" style="color: {{ $accent }};">
                    <i class="fab fa-github"></i> GitHub
                  </a>
                @endif
                @if(!empty($project->live_url))
                  <a href="{{ $project->live_url }}" target="_blank" rel="noopener" class="proj-btn" style="color: {{ $accent }};">
                    <i class="fas fa-external-link-alt"></i> Live
                  </a>
                @endif
                @if(empty($project->github_url) && empty($project->live_url))
                  <span class="proj-btn" style="color: {{ $accent }}; opacity: 0.6; cursor: default;">
                    <i class="fas fa-lock"></i> Private
                  </span>
                @endif
              </div>
            </div>
          </div>
        </div>

        {{-- ── MOBILE: Flat card (Smit-Prajapati) ────────── --}}
        <div class="proj-mobile">
          <div class="pm-card">
            {{-- Top section with accent gradient --}}
            <div class="pm-top" style="background: linear-gradient(135deg, {{ $accent }}cc 0%, {{ $accent }}66 100%);">
              <div class="pm-border"></div>
              <div class="pm-icons">
                <div class="pm-icon-badge"><i class="fas fa-code-branch"></i></div>
                <div class="pm-links">
                  @if(!empty($project->github_url))
                    <a href="{{ $project->github_url }}" target="_blank" rel="noopener" class="pm-link" title="GitHub">
                      <i class="fab fa-github" style="font-size:1rem;"></i>
                    </a>
                  @endif
                  @if(!empty($project->live_url))
                    <a href="{{ $project->live_url }}" target="_blank" rel="noopener" class="pm-link" title="Live Demo">
                      <i class="fas fa-external-link-alt" style="font-size:0.9rem;"></i>
                    </a>
                  @endif
                </div>
              </div>
            </div>

            {{-- Bottom section --}}
            <div class="pm-bottom">
              <span class="pm-title">{{ $project->title }}</span>
              <p class="pm-desc">{{ $project->description }}</p>

              @if(!empty($tags))
              <div class="pm-tags">
                @foreach($tags as $tag)
                  <span class="pm-tag" style="background: {{ $accent }}44; color: {{ $accent }};">{{ $tag }}</span>
                @endforeach
              </div>
              @endif

              <div class="pm-row">
                <div class="pm-action" style="color: {{ $accent }}; font-family: var(--mono); font-size: 0.7rem;">
                  <i class="fas fa-calendar-alt"></i>
                  {{ $month }} {{ $year }}
                </div>
                @if(!empty($project->github_url))
                  <a href="{{ $project->github_url }}" target="_blank" rel="noopener" class="pm-action">
                    <i class="fab fa-github"></i> GitHub
                  </a>
                @endif
                @if(!empty($project->live_url))
                  <a href="{{ $project->live_url }}" target="_blank" rel="noopener" class="pm-action">
                    <i class="fas fa-globe"></i> Live
                  </a>
                @endif
                @if(empty($project->github_url) && empty($project->live_url))
                  <span class="pm-action pm-action-private">
                    <i class="fas fa-lock"></i> Private
                  </span>
                @endif
              </div>
            </div>
          </div>
        </div>

      </div>
    @empty
      <div class="empty-state">
        <i class="fas fa-folder-open"></i>
        <p>Belum ada project yang ditampilkan.</p>
      </div>
    @endforelse
  </main>

  {{-- Footer --}}
  <footer class="page-footer">
    &copy; {{ date('Y') }} {{ $settings['hero_name'] ?? 'Akbar Maulana' }} &mdash; Built with Laravel &amp; Vanilla CSS
  </footer>

  <script>
    // ── Scroll-reveal cards ──────────────────────────────────
    const cards = document.querySelectorAll('.proj-parent');
    const io = new IntersectionObserver((entries) => {
      entries.forEach((e, i) => {
        if (e.isIntersecting) {
          setTimeout(() => e.target.classList.add('visible'), i * 60);
          io.unobserve(e.target);
        }
      });
    }, { threshold: 0.1 });
    cards.forEach(c => io.observe(c));

    // ── Tag filter ───────────────────────────────────────────
    const filterBtns = document.querySelectorAll('.filter-btn');
    filterBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        filterBtns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const filter = btn.dataset.filter;
        document.querySelectorAll('.proj-parent').forEach(card => {
          if (filter === 'all' || card.dataset.tags.includes(filter)) {
            card.style.display = '';
          } else {
            card.style.display = 'none';
          }
        });
      });
    });
  </script>
</body>
</html>
