@extends('admin.layout')
@section('title','Site Settings')
@section('subtitle','Kelola konten teks dan info portfolio')

@section('content')
<form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-8">
  @csrf
  @php $s = fn($k,$d='') => old($k, $settings[$k]->value ?? $d); @endphp

  {{-- Hero Section --}}
  <div class="card neon-border p-6 rounded-xl">
    <h3 class="font-bold text-white mb-5 flex items-center gap-2 font-mono">🦸 Hero Section</h3>
    <div class="space-y-4">
      <div>
        <label class="text-xs font-mono text-slate-500 mb-2 block">// nama</label>
        <input type="text" name="hero_name" value="{{ $s('hero_name','Akbar Maulana') }}" class="cyber-input">
      </div>
      <div>
        <label class="text-xs font-mono text-slate-500 mb-2 block">// tagline</label>
        <input type="text" name="hero_tagline" value="{{ $s('hero_tagline','Information System Security Enthusiast & Full-Stack Web Developer') }}" class="cyber-input">
      </div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach([1,2,3] as $i)
        <div>
          <label class="text-xs font-mono text-slate-500 mb-2 block">// terminal line {{ $i }}</label>
          <input type="text" name="hero_terminal_{{ $i }}" value="{{ $s('hero_terminal_'.$i) }}" class="cyber-input font-mono text-sm" placeholder="> text...">
        </div>
        @endforeach
      </div>
    </div>
  </div>

  {{-- About Section --}}
  <div class="card neon-border p-6 rounded-xl">
    <h3 class="font-bold text-white mb-5 flex items-center gap-2 font-mono">👤 About Me</h3>
    <div class="space-y-4">
      <div>
        <label class="text-xs font-mono text-slate-500 mb-2 block">// deskripsi</label>
        <textarea name="about_description" rows="4" class="cyber-input resize-none">{{ $s('about_description') }}</textarea>
      </div>
      <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        <div>
          <label class="text-xs font-mono text-slate-500 mb-2 block">// lokasi</label>
          <input type="text" name="about_location" value="{{ $s('about_location','Bengkalis, Riau') }}" class="cyber-input">
        </div>
        <div>
          <label class="text-xs font-mono text-slate-500 mb-2 block">// institusi</label>
          <input type="text" name="about_institution" value="{{ $s('about_institution','Poltek Negeri Bengkalis') }}" class="cyber-input">
        </div>
        <div>
          <label class="text-xs font-mono text-slate-500 mb-2 block">// fokus</label>
          <input type="text" name="about_focus" value="{{ $s('about_focus','Cybersecurity & Dev') }}" class="cyber-input">
        </div>
      </div>
    </div>
  </div>

  {{-- Contact Info --}}
  <div class="card neon-border p-6 rounded-xl">
    <h3 class="font-bold text-white mb-5 flex items-center gap-2 font-mono">📡 Contact Info</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="text-xs font-mono text-slate-500 mb-2 block">// nomor whatsapp (tanpa +)</label>
        <input type="text" name="whatsapp_number" value="{{ $s('whatsapp_number','089636926578') }}" class="cyber-input font-mono" placeholder="6289636926578">
        <p class="text-xs text-slate-600 mt-1 font-mono">Contoh: 6289636926578 (format wa.me)</p>
      </div>
      <div>
        <label class="text-xs font-mono text-slate-500 mb-2 block">// email address</label>
        <input type="email" name="email_address" value="{{ $s('email_address','akbarmaulana@dev.id') }}" class="cyber-input">
      </div>
    </div>
  </div>

  <button type="submit" class="btn-glow py-3 px-8">
    <span>💾</span> Simpan Semua Pengaturan
  </button>
</form>
@endsection
