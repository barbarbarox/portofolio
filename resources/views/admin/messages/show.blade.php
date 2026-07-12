@extends('admin.layout')
@section('title','Detail Pesan')
@section('subtitle','{{ $contact->name }} — {{ $contact->created_at->format(\'d M Y H:i\') }}')

@section('content')
<div class="max-w-2xl">
  <a href="{{ route('admin.messages.index') }}" class="text-xs text-slate-500 hover:text-cyan-400 transition font-mono mb-6 inline-block">← Kembali ke Inbox</a>

  <div class="card neon-border p-8 rounded-xl">
    <div class="flex items-center gap-4 mb-6">
      <div class="w-14 h-14 rounded-full flex items-center justify-center text-xl font-bold" style="background:rgba(0,212,255,0.1);border:1px solid rgba(0,212,255,0.3);color:#00d4ff">
        {{ strtoupper(substr($contact->name,0,1)) }}
      </div>
      <div>
        <h2 class="font-bold text-white text-lg">{{ $contact->name }}</h2>
        <p class="text-sm text-slate-500 font-mono">{{ $contact->email }}</p>
        <p class="text-xs text-slate-600 mt-0.5">{{ $contact->created_at->format('l, d F Y — H:i') }}</p>
      </div>
    </div>

    @if($contact->subject)
    <div class="mb-4 p-3 rounded-lg" style="background:rgba(0,212,255,0.05);border:1px solid rgba(0,212,255,0.1)">
      <p class="text-xs font-mono text-slate-500 mb-1">// subject</p>
      <p class="text-sm font-semibold text-slate-200">{{ $contact->subject }}</p>
    </div>
    @endif

    <div class="p-5 rounded-lg mb-6" style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.06)">
      <p class="text-xs font-mono text-slate-500 mb-3">// message</p>
      <p class="text-slate-300 leading-relaxed whitespace-pre-wrap">{{ $contact->message }}</p>
    </div>

    <div class="flex gap-3">
      <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" class="btn-glow py-2.5 px-6 text-sm">
        📧 Balas via Email
      </a>
      <a href="https://wa.me/{{ preg_replace('/\D/','',$contact->email) }}" class="btn-glow py-2.5 px-6 text-sm" style="border-color:rgba(37,211,102,0.4);color:#25d366">
        💬 WhatsApp
      </a>
      <form method="POST" action="{{ route('admin.messages.destroy',$contact) }}" onsubmit="return confirm('Hapus pesan ini permanen?')" class="ml-auto">
        @csrf @method('DELETE')
        <button class="text-sm px-4 py-2.5 rounded-lg text-red-400 hover:bg-red-500/10 transition" style="border:1px solid rgba(255,80,80,0.2)">🗑️ Hapus</button>
      </form>
    </div>
  </div>
</div>
@endsection
