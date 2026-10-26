@extends('layouts.admin')

@section('title', 'Detail Pesan')
@section('page_title', 'Detail Pesan Masuk')

@section('content')
<div class="row">
    <div class="col-lg-9 mx-auto">
        <div class="card-admin p-4 p-md-5">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-light border">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Inbox
                </a>
                <div class="d-flex gap-2">
                    <form action="{{ route('admin.messages.toggle-read', $message->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-sm btn-light border">
                            <i class="bi {{ $message->is_read ? 'bi-envelope' : 'bi-envelope-open' }} me-1"></i>
                            {{ $message->is_read ? 'Tandai Belum Dibaca' : 'Tandai Sudah Dibaca' }}
                        </button>
                    </form>
                    <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pesan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">
                            <i class="bi bi-trash me-1"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>

            <!-- Message Info Header -->
            <div class="mb-4">
                <h3 class="fw-bold text-dark mb-3">{{ $message->subject }}</h3>
                <div class="d-flex flex-wrap align-items-center gap-3 p-3 rounded-3 bg-light border">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold fs-5" style="width: 48px; height: 48px;">
                        {{ strtoupper(substr($message->name, 0, 1)) }}
                    </div>
                    <div>
                        <div class="fw-bold text-dark">{{ $message->name }}</div>
                        <div class="text-muted small">
                            Email: <a href="mailto:{{ $message->email }}" class="text-decoration-none">{{ $message->email }}</a>
                        </div>
                    </div>
                    <div class="ms-md-auto text-md-end small text-muted">
                        <i class="bi bi-clock me-1"></i> {{ $message->created_at->translatedFormat('d F Y, H:i') }} ({{ $message->created_at->diffForHumans() }})
                    </div>
                </div>
            </div>

            <!-- Message Content -->
            <div class="p-4 rounded-3 border bg-white mb-4" style="line-height: 1.8; font-size: 1.05rem; white-space: pre-wrap;">{{ $message->message }}</div>

            <!-- Action Buttons -->
            <div class="d-flex flex-wrap gap-2 pt-3 border-top">
                <a href="mailto:{{ $message->email }}?subject=Re: {{ rawurlencode($message->subject) }}" class="btn btn-primary-custom d-inline-flex align-items-center gap-2">
                    <i class="bi bi-reply-fill"></i> Balas Email ke {{ $message->email }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
