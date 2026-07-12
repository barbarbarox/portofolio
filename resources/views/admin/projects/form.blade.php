@extends('admin.layout')
@section('title', $project->exists ? 'Edit Project' : 'Tambah Project')
@section('subtitle', $project->exists ? 'Update data project' : 'Buat project baru')

@section('content')
<div class="max-w-2xl">
  <a href="{{ route('admin.projects.index') }}" class="text-xs text-slate-500 hover:text-cyan-400 transition font-mono mb-6 inline-block">← Kembali</a>

  <div class="card neon-border p-8 rounded-xl">
    <form method="POST"
          action="{{ $project->exists ? route('admin.projects.update',$project) : route('admin.projects.store') }}">
      @csrf
      @if($project->exists) @method('PUT') @endif

      <div class="grid grid-cols-2 gap-5 mb-5">
        <div>
          <label class="block text-xs font-mono text-slate-500 mb-2">// emoji</label>
          <input type="text" name="emoji" value="{{ old('emoji',$project->emoji ?? '🚀') }}" class="cyber-input" required>
        </div>
        <div>
          <label class="block text-xs font-mono text-slate-500 mb-2">// accent color</label>
          <div class="flex gap-2">
            <input type="color" name="accent_color" value="{{ old('accent_color',$project->accent_color ?? '#00d4ff') }}"
                   class="w-12 h-10 rounded cursor-pointer border-0 bg-transparent">
            <input type="text" id="colorText" value="{{ old('accent_color',$project->accent_color ?? '#00d4ff') }}"
                   class="cyber-input flex-1 font-mono" onchange="document.querySelector('[name=accent_color]').value=this.value">
          </div>
        </div>
      </div>

      <div class="mb-5">
        <label class="block text-xs font-mono text-slate-500 mb-2">// title *</label>
        <input type="text" name="title" value="{{ old('title',$project->title) }}" class="cyber-input @error('title') border-red-500 @enderror" required>
        @error('title')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
      </div>

      <div class="mb-5">
        <label class="block text-xs font-mono text-slate-500 mb-2">// description *</label>
        <textarea name="description" rows="4" class="cyber-input resize-none @error('description') border-red-500 @enderror" required>{{ old('description',$project->description) }}</textarea>
        @error('description')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
      </div>

      <div class="mb-5">
        <label class="block text-xs font-mono text-slate-500 mb-2">// tech stack</label>
        <input type="text" name="tech_stack" value="{{ old('tech_stack',$project->tech_stack) }}" class="cyber-input" placeholder="Laravel, Tailwind CSS, MySQL">
      </div>

      <div class="mb-5">
        <label class="block text-xs font-mono text-slate-500 mb-2">// tags (pisah dengan koma)</label>
        <input type="text" name="tags" value="{{ old('tags', $project->exists ? implode(', ', $project->tags ?? []) : '') }}" class="cyber-input" placeholder="Laravel, Backend, MySQL">
      </div>

      <div class="grid grid-cols-2 gap-5 mb-5">
        <div>
          <label class="block text-xs font-mono text-slate-500 mb-2">// github url</label>
          <input type="url" name="github_url" value="{{ old('github_url',$project->github_url) }}" class="cyber-input" placeholder="https://github.com/...">
        </div>
        <div>
          <label class="block text-xs font-mono text-slate-500 mb-2">// live url</label>
          <input type="url" name="live_url" value="{{ old('live_url',$project->live_url) }}" class="cyber-input" placeholder="https://...">
        </div>
      </div>

      <div class="grid grid-cols-2 gap-5 mb-6">
        <div>
          <label class="block text-xs font-mono text-slate-500 mb-2">// sort order</label>
          <input type="number" name="sort_order" value="{{ old('sort_order',$project->sort_order ?? 0) }}" class="cyber-input" min="0">
        </div>
        <div class="flex items-end pb-1">
          <label class="flex items-center gap-3 cursor-pointer">
            <div class="relative">
              <input type="checkbox" name="is_featured" value="1" class="sr-only peer" {{ old('is_featured', $project->is_featured ?? true) ? 'checked' : '' }}>
              <div class="w-10 h-5 rounded-full transition peer-checked:bg-cyan-500 bg-slate-700 peer-focus:ring-2 peer-focus:ring-cyan-500/30"></div>
              <div class="absolute top-0.5 left-0.5 w-4 h-4 rounded-full bg-white transition peer-checked:translate-x-5"></div>
            </div>
            <span class="text-sm text-slate-300">Tampilkan di portfolio</span>
          </label>
        </div>
      </div>

      <div class="flex gap-3">
        <button type="submit" class="btn-glow flex-1 justify-center py-3">
          <span>{{ $project->exists ? '💾' : '🚀' }}</span>
          {{ $project->exists ? 'Update Project' : 'Simpan Project' }}
        </button>
        <a href="{{ route('admin.projects.index') }}" class="px-6 py-3 rounded-lg text-slate-400 hover:text-white transition text-sm" style="border:1px solid rgba(255,255,255,0.1)">Batal</a>
      </div>
    </form>
  </div>
</div>

<script>
document.querySelector('[name=accent_color]').addEventListener('input', function() {
  document.getElementById('colorText').value = this.value;
});
</script>
@endsection
