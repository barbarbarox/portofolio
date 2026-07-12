@extends('admin.layout')
@section('title','Social Links')
@section('subtitle','Kelola link media sosial yang tampil di portfolio')

@section('content')
{{-- Add Link --}}
<div class="card neon-border p-6 rounded-xl mb-8">
  <h3 class="font-bold text-white mb-4 font-mono text-sm">➕ Tambah Social Link</h3>
  <form method="POST" action="{{ route('admin.social-links.store') }}">
    @csrf
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-4">
      <div>
        <label class="text-xs font-mono text-slate-500 mb-1 block">// platform</label>
        <input type="text" name="platform" class="cyber-input" placeholder="GitHub, Instagram, TikTok..." required>
      </div>
      <div>
        <label class="text-xs font-mono text-slate-500 mb-1 block">// emoji</label>
        <input type="text" name="emoji" value="🔗" class="cyber-input" required maxlength="4">
      </div>
      <div>
        <label class="text-xs font-mono text-slate-500 mb-1 block">// label tampil</label>
        <input type="text" name="label" class="cyber-input" placeholder="@username atau URL display" required>
      </div>
      <div class="md:col-span-2">
        <label class="text-xs font-mono text-slate-500 mb-1 block">// url / link</label>
        <input type="text" name="url" class="cyber-input" placeholder="https://... atau mailto:... atau wa.me/..." required>
      </div>
      <div>
        <label class="text-xs font-mono text-slate-500 mb-1 block">// accent color</label>
        <div class="flex gap-2">
          <input type="color" id="newColor" value="#00d4ff" class="w-10 h-10 rounded cursor-pointer border-0 bg-transparent flex-shrink-0"
                 oninput="document.getElementById('newColorText').value=this.value">
          <input type="text" name="accent_color" id="newColorText" value="#00d4ff" class="cyber-input font-mono">
        </div>
      </div>
    </div>
    <button type="submit" class="btn-glow py-2.5 text-sm">+ Tambah Link</button>
  </form>
</div>

{{-- Links List --}}
<div class="space-y-3">
  @forelse($links as $link)
  <div class="card neon-border p-5 rounded-xl" style="border-color:{{ $link->accent_color }}33">
    <form method="POST" action="{{ route('admin.social-links.update', $link) }}">
      @csrf @method('PUT')
      <div class="grid grid-cols-2 md:grid-cols-6 gap-3 items-end">
        <div>
          <label class="text-xs font-mono text-slate-500 mb-1 block">Platform</label>
          <input type="text" name="platform" value="{{ $link->platform }}" class="cyber-input text-sm py-2">
        </div>
        <div class="w-20">
          <label class="text-xs font-mono text-slate-500 mb-1 block">Emoji</label>
          <input type="text" name="emoji" value="{{ $link->emoji }}" class="cyber-input text-sm py-2">
        </div>
        <div>
          <label class="text-xs font-mono text-slate-500 mb-1 block">Label</label>
          <input type="text" name="label" value="{{ $link->label }}" class="cyber-input text-sm py-2">
        </div>
        <div class="md:col-span-2">
          <label class="text-xs font-mono text-slate-500 mb-1 block">URL</label>
          <input type="text" name="url" value="{{ $link->url }}" class="cyber-input text-sm py-2 font-mono">
        </div>
        <div class="flex gap-2 items-end">
          <input type="color" value="{{ $link->accent_color }}" class="w-10 h-10 rounded cursor-pointer border-0 flex-shrink-0"
                 oninput="this.nextElementSibling.value=this.value">
          <input type="text" name="accent_color" value="{{ $link->accent_color }}" class="cyber-input text-sm py-2 font-mono flex-1">
        </div>
        <div class="flex items-center gap-2">
          <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="is_active" value="1" class="w-4 h-4 rounded" {{ $link->is_active?'checked':'' }}>
            <span class="text-xs text-slate-400">Aktif</span>
          </label>
        </div>
        <input type="hidden" name="sort_order" value="{{ $link->sort_order }}">
        <div class="flex gap-2">
          <button type="submit" class="btn-glow text-xs py-2 px-4">💾 Simpan</button>
        </div>
      </div>
    </form>
    <div class="mt-3 flex justify-end">
      <form method="POST" action="{{ route('admin.social-links.destroy',$link) }}" onsubmit="return confirm('Hapus {{ $link->platform }}?')">
        @csrf @method('DELETE')
        <button class="text-xs px-3 py-1.5 rounded-lg text-red-400 hover:bg-red-500/10 transition" style="border:1px solid rgba(255,80,80,0.2)">🗑️ Hapus</button>
      </form>
    </div>
  </div>
  @empty
  <div class="text-center py-12 text-slate-600 font-mono">Belum ada social link.</div>
  @endforelse
</div>
@endsection
