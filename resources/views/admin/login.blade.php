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
    <div class="mb-6 p-3 rounded-lg text-xs font-mono" style="background:rgba(255,80,80,0.1);border:1px solid rgba(255,80,80,0.3);color:#ff5050">
      {{ session('error') }}
    </div>
    @endif

    <div class="text-center">
      <p class="text-slate-500 text-xs font-mono mb-6">// Hanya akun administrator yang diizinkan masuk</p>

      <a href="{{ route('admin.auth.google') }}"
         class="btn-glow w-full justify-center py-3 inline-flex items-center gap-3 rounded-lg font-semibold text-sm transition-all"
         style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.15);color:#fff;text-decoration:none;">
        <svg width="20" height="20" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
          <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
          <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/>
          <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
        </svg>
        Sign in with Google
      </a>
    </div>
  </div>

  <p class="text-center text-slate-700 text-xs mt-6 font-mono">
    <a href="{{ route('home') }}" class="hover:text-cyan-500 transition">← Kembali ke Portfolio</a>
  </p>
</div>
</body>
</html>
