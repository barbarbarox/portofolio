<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Panel — @yield('title','Dashboard')</title>
@vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-[#030712] text-slate-200 font-sans min-h-screen flex">

{{-- SIDEBAR --}}
<aside class="w-64 min-h-screen fixed left-0 top-0 z-40 flex flex-col" style="background:#0d1117;border-right:1px solid rgba(0,212,255,0.1)">
  <div class="p-6 border-b" style="border-color:rgba(0,212,255,0.1)">
    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
      <div class="w-9 h-9 rounded-lg flex items-center justify-center text-lg" style="background:rgba(0,212,255,0.1);border:1px solid rgba(0,212,255,0.3)">⚡</div>
      <div>
        <p class="font-bold text-sm text-white font-mono">ADMIN</p>
        <p class="text-xs text-cyan-500 font-mono">Akbar Maulana</p>
      </div>
    </a>
  </div>

  <nav class="flex-1 p-4 space-y-1">
    @php
    $navItems = [
      ['route'=>'admin.dashboard','icon'=>'grid','label'=>'Dashboard'],
      ['route'=>'admin.projects.index','icon'=>'code','label'=>'Projects'],
      ['route'=>'admin.skills.index','icon'=>'zap','label'=>'Skills'],
      ['route'=>'admin.social-links.index','icon'=>'link','label'=>'Social Links'],
      ['route'=>'admin.hero-cards.index','icon'=>'layers','label'=>'Hero Cards'],
      ['route'=>'admin.settings.index','icon'=>'settings','label'=>'Site Settings'],
      ['route'=>'admin.messages.index','icon'=>'mail','label'=>'Pesan Masuk'],
    ];
    @endphp
    @foreach($navItems as $item)
    @php $active = request()->routeIs($item['route'].'*'); @endphp
    <a href="{{ route($item['route']) }}"
       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all duration-200
              {{ $active ? 'text-cyan-400' : 'text-slate-400 hover:text-slate-200' }}"
       style="{{ $active ? 'background:rgba(0,212,255,0.1);border:1px solid rgba(0,212,255,0.2)' : '' }}">
      <span class="w-4 text-xs font-mono opacity-60">#</span>
      <span class="font-medium">{{ $item['label'] }}</span>
      @if($item['route'] === 'admin.messages.index')
        @php $unread = \App\Models\Contact::where('is_read',false)->count(); @endphp
        @if($unread > 0)
        <span class="ml-auto text-xs px-2 py-0.5 rounded-full font-mono" style="background:rgba(255,80,80,0.2);color:#ff5050;border:1px solid rgba(255,80,80,0.3)">{{ $unread }}</span>
        @endif
      @endif
    </a>
    @endforeach
  </nav>

  <div class="p-4 border-t" style="border-color:rgba(0,212,255,0.1)">
    <a href="{{ route('home') }}" class="flex items-center gap-2 text-xs text-slate-500 hover:text-cyan-400 transition mb-3">
      <span>🌐</span> Lihat Portfolio
    </a>
    <form method="POST" action="{{ route('admin.logout') }}">
      @csrf
      <button class="w-full flex items-center gap-2 text-xs px-3 py-2 rounded-lg text-slate-400 hover:text-red-400 hover:bg-red-500/10 transition">
        <span>🚪</span> Logout
      </button>
    </form>
  </div>
</aside>

{{-- MAIN CONTENT --}}
<div class="ml-64 flex-1 min-h-screen">
  {{-- Topbar --}}
  <header class="sticky top-0 z-30 px-8 py-4 flex items-center justify-between" style="background:rgba(3,7,18,0.9);backdrop-filter:blur(12px);border-bottom:1px solid rgba(0,212,255,0.08)">
    <div>
      <h1 class="text-lg font-bold text-white">@yield('title','Dashboard')</h1>
      <p class="text-xs text-slate-600 font-mono">@yield('subtitle',date('l, d F Y'))</p>
    </div>
    <div class="flex items-center gap-3">
      <div class="flex items-center gap-2 text-xs">
        <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
        <span class="text-slate-500 font-mono">Online</span>
      </div>
    </div>
  </header>

  <main class="p-8">
    {{-- Alert messages --}}
    @if(session('success'))
    <div class="mb-6 p-4 rounded-lg border text-sm font-mono flex items-center gap-2"
         style="background:rgba(0,255,136,0.08);border-color:rgba(0,255,136,0.3);color:#00ff88">
      ✅ {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="mb-6 p-4 rounded-lg border text-sm font-mono flex items-center gap-2"
         style="background:rgba(255,80,80,0.08);border-color:rgba(255,80,80,0.3);color:#ff5050">
      ❌ {{ session('error') }}
    </div>
    @endif

    @yield('content')
  </main>
</div>
</body>
</html>
