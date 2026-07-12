@extends('admin.layout')
@section('title','Pesan Masuk')
@section('subtitle','Semua pesan dari form contact portfolio')

@section('content')
<div class="space-y-3">
  @forelse($messages as $msg)
  <a href="{{ route('admin.messages.show',$msg) }}"
     class="flex items-start gap-4 p-5 rounded-xl transition block"
     style="background:#0d1117;border:1px solid {{ $msg->is_read ? 'rgba(255,255,255,0.06)' : 'rgba(0,212,255,0.2)' }}">
    <div class="w-10 h-10 rounded-full flex items-center justify-center text-base font-bold flex-shrink-0"
         style="background:rgba(0,212,255,0.1);border:1px solid rgba(0,212,255,0.2);color:#00d4ff">
      {{ strtoupper(substr($msg->name,0,1)) }}
    </div>
    <div class="flex-1 min-w-0">
      <div class="flex items-center gap-2 mb-1">
        <p class="font-semibold text-sm {{ $msg->is_read ? 'text-slate-300' : 'text-white' }}">{{ $msg->name }}</p>
        @if(!$msg->is_read)
        <span class="text-xs px-2 py-0.5 rounded-full font-mono" style="background:rgba(0,212,255,0.15);color:#00d4ff">Baru</span>
        @endif
        @if($msg->subject)
        <span class="text-xs text-slate-500 font-mono">— {{ $msg->subject }}</span>
        @endif
      </div>
      <p class="text-xs text-slate-500 mb-1">{{ $msg->email }}</p>
      <p class="text-sm text-slate-400 truncate">{{ Str::limit($msg->message, 80) }}</p>
    </div>
    <div class="flex flex-col items-end gap-2 flex-shrink-0">
      <span class="text-xs text-slate-600 font-mono">{{ $msg->created_at->format('d M Y H:i') }}</span>
      <form method="POST" action="{{ route('admin.messages.destroy',$msg) }}" onsubmit="return confirm('Hapus pesan ini?')">
        @csrf @method('DELETE')
        <button class="text-xs px-2 py-1 rounded text-red-400 hover:bg-red-500/10 transition" style="border:1px solid rgba(255,80,80,0.2)">🗑️</button>
      </form>
    </div>
  </a>
  @empty
  <div class="text-center py-16 text-slate-600 font-mono">
    <p class="text-4xl mb-3">📭</p>
    <p>Belum ada pesan masuk.</p>
  </div>
  @endforelse
</div>
{{ $messages->links() }}
@endsection
