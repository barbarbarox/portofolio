@extends('admin.layout')
@section('title','Projects')
@section('subtitle','Kelola semua project portfolio')

@section('content')
<div class="flex items-center justify-between mb-6">
  <div></div>
  <a href="{{ route('admin.projects.create') }}" class="btn-glow"><span>➕</span> Tambah Project</a>
</div>

<div class="grid gap-4">
  @forelse($projects as $project)
  <div class="card neon-border p-5 rounded-xl flex items-start gap-4">
    <div class="text-3xl w-12 h-12 flex items-center justify-center rounded-xl flex-shrink-0"
         style="background:{{ $project->accent_color }}15;border:1px solid {{ $project->accent_color }}33">
      {{ $project->emoji }}
    </div>
    <div class="flex-1 min-w-0">
      <div class="flex items-center gap-2 mb-1">
        <h3 class="font-bold text-white">{{ $project->title }}</h3>
        @if($project->is_featured)
        <span class="text-xs px-2 py-0.5 rounded-full font-mono" style="background:rgba(0,212,255,0.1);color:#00d4ff;border:1px solid rgba(0,212,255,0.2)">Featured</span>
        @endif
      </div>
      <p class="text-sm text-slate-400 mb-2 line-clamp-2">{{ $project->description }}</p>
      <p class="text-xs text-slate-600 font-mono">{{ $project->tech_stack }}</p>
      @if($project->tags)
      <div class="flex flex-wrap gap-1 mt-2">
        @foreach($project->tags as $tag)
        <span class="text-xs px-2 py-0.5 rounded font-mono" style="background:{{ $project->accent_color }}10;color:{{ $project->accent_color }};border:1px solid {{ $project->accent_color }}25">{{ $tag }}</span>
        @endforeach
      </div>
      @endif
    </div>
    <div class="flex items-center gap-2 flex-shrink-0">
      @if($project->github_url)
      <a href="{{ $project->github_url }}" target="_blank" class="text-xs px-3 py-1.5 rounded-lg text-slate-400 hover:text-cyan-400 transition" style="border:1px solid rgba(255,255,255,0.08)">🐙 GitHub</a>
      @endif
      @if($project->live_url)
      <a href="{{ $project->live_url }}" target="_blank" class="text-xs px-3 py-1.5 rounded-lg text-slate-400 hover:text-emerald-400 transition" style="border:1px solid rgba(255,255,255,0.08)">🌐 Live</a>
      @endif
      <a href="{{ route('admin.projects.edit', $project) }}" class="text-xs px-3 py-1.5 rounded-lg text-cyan-400 transition" style="background:rgba(0,212,255,0.1);border:1px solid rgba(0,212,255,0.2)">✏️ Edit</a>
      <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" onsubmit="return confirm('Hapus project ini?')">
        @csrf @method('DELETE')
        <button class="text-xs px-3 py-1.5 rounded-lg text-red-400 hover:bg-red-500/10 transition" style="border:1px solid rgba(255,80,80,0.2)">🗑️</button>
      </form>
    </div>
  </div>
  @empty
  <div class="text-center py-16 text-slate-600 font-mono">
    <p class="text-4xl mb-3">🚀</p>
    <p>Belum ada project. <a href="{{ route('admin.projects.create') }}" class="text-cyan-500">Tambah sekarang →</a></p>
  </div>
  @endforelse
</div>
@endsection
