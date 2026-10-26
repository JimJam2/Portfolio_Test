@extends('layouts.admin')

@section('title', 'Pesan Kontak')
@section('page_title', 'Kotak Masuk Pesan')

@section('content')
<div class="card-admin p-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <!-- Filter Tabs -->
        <div class="d-flex gap-2">
            <a href="{{ route('admin.messages.index') }}" class="btn btn-sm {{ !request('filter') ? 'btn-primary-custom' : 'btn-light border' }}">
                Semua Pesan ({{ \App\Models\Message::count() }})
            </a>
            <a href="{{ route('admin.messages.index', ['filter' => 'unread']) }}" class="btn btn-sm {{ request('filter') === 'unread' ? 'btn-danger' : 'btn-light border text-danger' }}">
                <i class="bi bi-envelope-fill me-1"></i> Belum Dibaca ({{ $unreadCount }})
            </a>
        </div>

        <!-- Search Form -->
        <form method="GET" action="{{ route('admin.messages.index') }}" class="d-flex align-items-center gap-2">
            @if(request('filter'))
                <input type="hidden" name="filter" value="{{ request('filter') }}">
            @endif
            <div class="input-group" style="max-width: 260px;">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                <input type="text" name="search" class="form-control form-control-sm bg-light border-start-0" placeholder="Cari pesan..." value="{{ request('search') }}">
            </div>
            @if(request('search'))
                <a href="{{ route('admin.messages.index', request('filter') ? ['filter' => request('filter')] : []) }}" class="btn btn-sm btn-light border" title="Reset">
                    <i class="bi bi-x"></i>
                </a>
            @endif
        </form>
    </div>

    <!-- Messages Table -->
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light small">
                <tr>
                    <th style="width: 30px;"></th>
                    <th>Pengirim</th>
                    <th>Subjek & Ringkasan</th>
                    <th style="width: 140px;">Waktu</th>
                    <th class="text-end" style="width: 140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $msg)
                    <tr class="{{ !$msg->is_read ? 'table-light fw-bold' : '' }}">
                        <td>
                            @if(!$msg->is_read)
                                <i class="bi bi-circle-fill text-danger" style="font-size: 0.6rem;" title="Belum dibaca"></i>
                            @else
                                <i class="bi bi-check2 text-muted"></i>
                            @endif
                        </td>
                        <td>
                            <div class="text-dark">{{ $msg->name }}</div>
                            <div class="text-muted small fw-normal">{{ $msg->email }}</div>
                        </td>
                        <td>
                            <div class="text-dark">{{ $msg->subject }}</div>
                            <div class="text-muted small fw-normal">{{ Str::limit($msg->message, 80) }}</div>
                        </td>
                        <td class="small text-muted">
                            {{ $msg->created_at->format('d M Y, H:i') }}
                        </td>
                        <td class="text-end">
                            <div class="d-inline-flex gap-1">
                                <a href="{{ route('admin.messages.show', $msg->id) }}" class="btn btn-sm btn-light border text-primary" title="Buka Pesan">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <form action="{{ route('admin.messages.toggle-read', $msg->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-light border" title="{{ $msg->is_read ? 'Tandai belum dibaca' : 'Tandai sudah dibaca' }}">
                                        <i class="bi {{ $msg->is_read ? 'bi-envelope' : 'bi-envelope-open' }}"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pesan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light border text-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-5">
                            <i class="bi bi-inbox fs-2 d-block mb-2 text-secondary"></i>
                            Tidak ada pesan masuk.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($messages->hasPages())
        <div class="mt-4 pt-3 border-top d-flex justify-content-end">
            {{ $messages->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
