<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login — Akbar Maulana</title>
@vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-[#030712] min-h-screen flex items-center justify-center grid-bg">
<div class="w-full max-w-md px-6">
  <div class="text-center mb-8">
    <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl mb-4 text-3xl" style="background:rgba(0,212,255,0.1);border:1px solid rgba(0,212,255,0.3)">⚡</div>
    <h1 class="text-2xl font-bold text-white font-mono">&lt;ADMIN /&gt;</h1>
    <p class="text-slate-500 text-sm mt-1">Akbar Maulana Portfolio Panel</p>
  </div>

  <div class="card neon-border p-8">
    <p class="text-xs font-mono text-cyan-500 mb-6">// authenticate_admin.sh</p>

    @if(session('error'))
    <div class="mb-4 p-3 rounded-lg text-xs font-mono" style="background:rgba(255,80,80,0.1);border:1px solid rgba(255,80,80,0.3);color:#ff5050">
      ❌ {{ session('error') }}
    </div>
    @endif

    <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-5">
      @csrf
      <div>
        <label class="block text-xs font-mono text-slate-500 mb-2">// email</label>
        <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@akbarmaulana.dev"
               class="cyber-input @error('email') border-red-500 @enderror" autofocus required>
        @error('email')<p class="text-red-400 text-xs mt-1 font-mono">{{ $message }}</p>@enderror
      </div>
      <div>
        <label class="block text-xs font-mono text-slate-500 mb-2">// password</label>
        <input type="password" name="password" placeholder="••••••••"
               class="cyber-input @error('password') border-red-500 @enderror" required>
        @error('password')<p class="text-red-400 text-xs mt-1 font-mono">{{ $message }}</p>@enderror
      </div>
      <button type="submit" class="btn-glow w-full justify-center py-3 mt-2">
        <span>🔐</span> Login ke Admin Panel
      </button>
    </form>
  </div>

  <p class="text-center text-slate-700 text-xs mt-6 font-mono">
    <a href="{{ route('home') }}" class="hover:text-cyan-500 transition">← Kembali ke Portfolio</a>
  </p>
</div>
</body>
</html>
