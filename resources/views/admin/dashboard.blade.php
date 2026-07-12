@extends('admin.layout')
@section('title','Dashboard')

@section('content')
{{-- Stats Grid --}}
<div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
  @php
  $statCards = [
    ['icon'=>'💬','label'=>'Total Pesan','value'=>$stats['messages'],'color'=>'#00d4ff'],
    ['icon'=>'🔴','label'=>'Belum Dibaca','value'=>$stats['unread'],'color'=>'#ff5050'],
    ['icon'=>'🚀','label'=>'Projects','value'=>$stats['projects'],'color'=>'#00ff88'],
    ['icon'=>'⚡','label'=>'Skills','value'=>$stats['skills'],'color'=>'#b44fff'],
    ['icon'=>'🔗','label'=>'Social Links','value'=>$stats['socials'],'color'=>'#f59e0b'],
  ];
  @endphp
  @foreach($statCards as $s)
  <div class="card p-5 rounded-xl" style="border:1px solid {{ $s['color'] }}22;background:#0d1117">
    <div class="text-2xl mb-2">{{ $s['icon'] }}</div>
    <p class="text-3xl font-bold font-mono" style="color:{{ $s['color'] }}">{{ $s['value'] }}</p>
    <p class="text-xs text-slate-500 mt-1">{{ $s['label'] }}</p>
  </div>
  @endforeach
</div>

{{-- Quick Actions --}}
<div class="grid md:grid-cols-2 gap-6 mb-8">
  <div class="card neon-border p-6 rounded-xl">
    <h3 class="font-bold text-white mb-4 flex items-center gap-2"><span>⚡</span> Quick Actions</h3>
    <div class="grid grid-cols-2 gap-3">
      @foreach([['🚀','Tambah Project','admin.projects.create'],['⚡','Kelola Skills','admin.skills.index'],['🔗','Social Links','admin.social-links.index'],['⚙️','Settings','admin.settings.index']] as $a)
      <a href="{{ route($a[2]) }}" class="flex items-center gap-2 p-3 rounded-lg text-sm transition hover:bg-white/5" style="border:1px solid rgba(255,255,255,0.06)">
        <span>{{ $a[0] }}</span><span class="text-slate-300">{{ $a[1] }}</span>
      </a>
      @endforeach
    </div>
  </div>

  <div class="card neon-border p-6 rounded-xl">
    <h3 class="font-bold text-white mb-4 flex items-center gap-2"><span>💬</span> Pesan Terbaru</h3>
    @forelse($recentMessages as $msg)
    <a href="{{ route('admin.messages.show',$msg) }}" class="flex items-start gap-3 p-3 rounded-lg hover:bg-white/5 transition mb-1 group">
      <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm flex-shrink-0"
           style="background:rgba(0,212,255,0.1);border:1px solid rgba(0,212,255,0.2)">
        {{ strtoupper(substr($msg->name,0,1)) }}
      </div>
      <div class="flex-1 min-w-0">
        <div class="flex items-center gap-2">
          <p class="text-sm font-medium text-slate-200 truncate">{{ $msg->name }}</p>
          @if(!$msg->is_read)<span class="w-2 h-2 rounded-full bg-cyan-500 flex-shrink-0"></span>@endif
        </div>
        <p class="text-xs text-slate-500 truncate">{{ Str::limit($msg->message,50) }}</p>
      </div>
      <span class="text-xs text-slate-600 flex-shrink-0">{{ $msg->created_at->diffForHumans() }}</span>
    </a>
    @empty
    <p class="text-slate-600 text-sm font-mono text-center py-4">Belum ada pesan.</p>
    @endforelse
    @if($stats['messages'] > 5)
    <a href="{{ route('admin.messages.index') }}" class="text-xs text-cyan-500 hover:text-cyan-400 mt-2 block text-center">Lihat semua →</a>
    @endif
  </div>
</div>

{{-- Terminal info --}}
<div class="terminal rounded-xl">
  <div class="terminal-header">
    <div class="terminal-dot bg-red-500"></div>
    <div class="terminal-dot bg-yellow-500"></div>
    <div class="terminal-dot bg-green-500"></div>
    <span class="ml-2 text-xs text-slate-500 font-mono">system_info.sh</span>
  </div>
  <div class="p-5 font-mono text-sm space-y-1">
    <p><span class="text-slate-600">$</span> <span class="text-cyan-400">date</span> <span class="text-slate-300">→ {{ now()->format('D, d M Y H:i:s') }}</span></p>
    <p><span class="text-slate-600">$</span> <span class="text-cyan-400">uptime</span> <span class="text-slate-300">→ Laravel {{ app()->version() }} | PHP {{ phpversion() }}</span></p>
    <p><span class="text-slate-600">$</span> <span class="text-green-400">status</span> <span class="text-slate-300">→ All systems operational ✅</span></p>
  </div>
</div>
@endsection
