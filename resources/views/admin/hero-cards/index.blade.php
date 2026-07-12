@extends('admin.layout')
@section('title','Hero Cards')
@section('subtitle','Kelola kartu galeri di Hero Section')

@section('content')
{{-- Add Card Form --}}
<div class="card neon-border p-6 rounded-xl mb-8">
  <h3 class="font-bold text-white mb-4 font-mono text-sm">+ Tambah Card Baru</h3>
  <form method="POST" action="{{ route('admin.hero-cards.store') }}">
    @csrf
    <div class="grid grid-cols-2 md:grid-cols-5 gap-3 items-end">
      <div class="md:col-span-2">
        <label class="text-xs font-mono text-slate-500 mb-1 block">// judul</label>
        <input type="text" name="title" class="cyber-input" placeholder="Cybersecurity" required>
      </div>
      <div class="md:col-span-2">
        <label class="text-xs font-mono text-slate-500 mb-1 block">// subtitle</label>
        <input type="text" name="subtitle" class="cyber-input" placeholder="Penetration Testing & SecOps">
      </div>
      <div>
        <label class="text-xs font-mono text-slate-500 mb-1 block">// accent</label>
        <div class="flex gap-2">
          <input type="color" id="addColor" value="#00d4ff" class="w-10 h-10 rounded cursor-pointer border-0 flex-shrink-0"
                 oninput="document.getElementById('addColorText').value=this.value">
          <input type="text" name="accent_color" id="addColorText" value="#00d4ff" class="cyber-input font-mono flex-1">
        </div>
      </div>
      <div>
        <label class="text-xs font-mono text-slate-500 mb-1 block">// bg color</label>
        <input type="text" name="bg_color" value="#0d1117" class="cyber-input font-mono" placeholder="#0d1117">
      </div>
      <div>
        <label class="text-xs font-mono text-slate-500 mb-1 block">// urutan</label>
        <input type="number" name="sort_order" value="0" class="cyber-input">
      </div>
      <div class="flex items-end">
        <button type="submit" class="btn-glow w-full justify-center py-2.5 text-sm">+ Tambah</button>
      </div>
    </div>
  </form>
</div>

{{-- Preview Note --}}
<div class="mb-6 p-4 rounded-xl text-xs font-mono" style="background:rgba(0,212,255,0.05);border:1px solid rgba(0,212,255,0.15);color:#00d4ff">
  Kartu-kartu ini akan tampil sebagai animasi CardSwap di Hero Section portfolio.
</div>

{{-- Cards List --}}
<div class="space-y-3">
  @forelse($cards as $card)
  <div class="card neon-border p-5 rounded-xl" style="border-color:{{ $card->accent_color }}33">
    <form method="POST" action="{{ route('admin.hero-cards.update', $card) }}">
      @csrf @method('PUT')
      <div class="grid grid-cols-2 md:grid-cols-6 gap-3 items-end">
        <div class="md:col-span-2">
          <label class="text-xs font-mono text-slate-500 mb-1 block">Judul</label>
          <input type="text" name="title" value="{{ $card->title }}" class="cyber-input text-sm py-2" required>
        </div>
        <div class="md:col-span-2">
          <label class="text-xs font-mono text-slate-500 mb-1 block">Subtitle</label>
          <input type="text" name="subtitle" value="{{ $card->subtitle }}" class="cyber-input text-sm py-2">
        </div>
        <div>
          <label class="text-xs font-mono text-slate-500 mb-1 block">Accent</label>
          <div class="flex gap-1">
            <input type="color" value="{{ $card->accent_color }}" class="w-10 h-10 rounded border-0 cursor-pointer flex-shrink-0"
                   oninput="this.nextElementSibling.value=this.value">
            <input type="text" name="accent_color" value="{{ $card->accent_color }}" class="cyber-input text-sm py-2 font-mono flex-1">
          </div>
        </div>
        <div>
          <label class="text-xs font-mono text-slate-500 mb-1 block">BG Color</label>
          <input type="text" name="bg_color" value="{{ $card->bg_color }}" class="cyber-input text-sm py-2 font-mono">
        </div>
        <div>
          <label class="text-xs font-mono text-slate-500 mb-1 block">Urutan</label>
          <input type="number" name="sort_order" value="{{ $card->sort_order }}" class="cyber-input text-sm py-2">
        </div>
        <div class="flex items-center gap-2">
          <label class="flex items-center gap-2 text-xs text-slate-400 cursor-pointer">
            <input type="checkbox" name="is_active" value="1" {{ $card->is_active?'checked':'' }}> Aktif
          </label>
        </div>
        <div class="flex gap-2">
          <button type="submit" class="btn-glow text-xs py-2 px-4">Simpan</button>
        </div>
      </div>
    </form>
    <div class="mt-3 flex justify-end">
      <form method="POST" action="{{ route('admin.hero-cards.destroy', $card) }}" onsubmit="return confirm('Hapus card ini?')">
        @csrf @method('DELETE')
        <button class="text-xs px-3 py-1.5 rounded-lg text-red-400 hover:bg-red-500/10 transition" style="border:1px solid rgba(255,80,80,0.2)">Hapus</button>
      </form>
    </div>
  </div>
  @empty
  <div class="text-center py-12 text-slate-600 font-mono">Belum ada card. Tambah card pertama di atas.</div>
  @endforelse
</div>
@endsection
