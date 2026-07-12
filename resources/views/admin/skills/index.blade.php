@extends('admin.layout')
@section('title','Skills')
@section('subtitle','Kelola skills & level keahlian')

@section('content')
{{-- Add Skill --}}
<div class="card neon-border p-6 rounded-xl mb-8">
  <h3 class="font-bold text-white mb-4 font-mono text-sm">➕ Tambah Skill Baru</h3>
  <form method="POST" action="{{ route('admin.skills.store') }}">
    @csrf
    <div class="grid grid-cols-2 md:grid-cols-6 gap-3 items-end">
      <div class="md:col-span-2">
        <label class="text-xs font-mono text-slate-500 mb-1 block">// category</label>
        <select name="category" class="cyber-input" required>
          @foreach(['Web Development'=>'🌐','Cybersecurity'=>'🔐','Others'=>'🤖'] as $cat=>$emoji)
          <option value="{{ $cat }}">{{ $emoji }} {{ $cat }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label class="text-xs font-mono text-slate-500 mb-1 block">// emoji</label>
        <input type="text" name="category_emoji" value="⚡" class="cyber-input" required maxlength="4">
      </div>
      <div class="md:col-span-2">
        <label class="text-xs font-mono text-slate-500 mb-1 block">// nama skill</label>
        <input type="text" name="name" class="cyber-input" placeholder="e.g. Vue.js" required>
      </div>
      <div>
        <label class="text-xs font-mono text-slate-500 mb-1 block">// level %</label>
        <input type="number" name="level" min="0" max="100" value="75" class="cyber-input" required>
      </div>
      <div>
        <label class="text-xs font-mono text-slate-500 mb-1 block">// warna</label>
        <select name="color" class="cyber-input" required>
          <option value="blue">🔵 Blue</option>
          <option value="green">🟢 Green</option>
          <option value="purple">🟣 Purple</option>
        </select>
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

{{-- Skills by Category --}}
@foreach($skills as $category => $categorySkills)
@php $first = $categorySkills->first(); @endphp
<div class="card neon-border p-6 rounded-xl mb-5">
  <h3 class="font-bold text-white mb-4 flex items-center gap-2">
    <span>{{ $first->category_emoji }}</span> {{ $category }}
  </h3>
  <div class="space-y-3">
    @foreach($categorySkills as $skill)
    <form method="POST" action="{{ route('admin.skills.update', $skill) }}" class="flex items-center gap-3">
      @csrf @method('PUT')
      <div class="flex-1 grid grid-cols-4 gap-3">
        <input type="text" name="name" value="{{ $skill->name }}" class="cyber-input text-sm py-2">
        <div class="flex items-center gap-2">
          <input type="number" name="level" value="{{ $skill->level }}" min="0" max="100" class="cyber-input text-sm py-2 w-20">
          <div class="flex-1 progress-bar">
            <div class="progress-fill"
                 style="width:{{ $skill->level }}%;background:{{ $skill->color === 'green' ? 'linear-gradient(90deg,#00ff88,#00d4ff)' : ($skill->color === 'purple' ? 'linear-gradient(90deg,#b44fff,#00d4ff)' : 'linear-gradient(90deg,#00d4ff,#00ff88)') }}">
            </div>
          </div>
        </div>
        <select name="color" class="cyber-input text-sm py-2">
          <option value="blue" {{ $skill->color==='blue'?'selected':'' }}>🔵 Blue</option>
          <option value="green" {{ $skill->color==='green'?'selected':'' }}>🟢 Green</option>
          <option value="purple" {{ $skill->color==='purple'?'selected':'' }}>🟣 Purple</option>
        </select>
        <input type="number" name="sort_order" value="{{ $skill->sort_order }}" class="cyber-input text-sm py-2">
      </div>
      <button type="submit" class="text-xs px-3 py-2 rounded-lg text-cyan-400 flex-shrink-0 hover:bg-cyan-500/10 transition" style="border:1px solid rgba(0,212,255,0.2)">💾</button>
    </form>
    <form method="POST" action="{{ route('admin.skills.destroy',$skill) }}" onsubmit="return confirm('Hapus skill {{ $skill->name }}?')" class="hidden" id="del-{{ $skill->id }}">
      @csrf @method('DELETE')
    </form>
    <button onclick="document.getElementById('del-{{ $skill->id }}').submit()" class="text-xs px-3 py-2 rounded-lg text-red-400 flex-shrink-0 hover:bg-red-500/10 transition" style="border:1px solid rgba(255,80,80,0.2)">🗑️</button>
    @endforeach
  </div>
</div>
@endforeach
@endsection
