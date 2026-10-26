@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Ringkasan Dashboard')

@section('content')
<!-- Metric Cards -->
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-sm-6">
        <div class="card-admin p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <span class="text-muted fw-semibold small">Total Proyek</span>
                <div class="rounded-3 bg-primary-subtle text-primary p-2">
                    <i class="bi bi-kanban fs-4"></i>
                </div>
            </div>
            <h3 class="fw-bold text-dark mb-1">{{ $stats['projects_count'] }}</h3>
            <div class="small text-muted">
                <a href="{{ route('admin.projects.index') }}" class="text-decoration-none text-primary">Kelola proyek &rarr;</a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="card-admin p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <span class="text-muted fw-semibold small">Keahlian (Skills)</span>
                <div class="rounded-3 bg-info-subtle text-info p-2">
                    <i class="bi bi-stars fs-4"></i>
                </div>
            </div>
            <h3 class="fw-bold text-dark mb-1">{{ $stats['skills_count'] }}</h3>
            <div class="small text-muted">
                <a href="{{ route('admin.skills.index') }}" class="text-decoration-none text-info">Kelola keahlian &rarr;</a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="card-admin p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <span class="text-muted fw-semibold small">Pengalaman & Edu</span>
                <div class="rounded-3 bg-warning-subtle text-warning p-2">
                    <i class="bi bi-briefcase fs-4"></i>
                </div>
            </div>
            <h3 class="fw-bold text-dark mb-1">{{ $stats['experiences_count'] }}</h3>
            <div class="small text-muted">
                <a href="{{ route('admin.experiences.index') }}" class="text-decoration-none text-warning">Lihat timeline &rarr;</a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="card-admin p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <span class="text-muted fw-semibold small">Pesan Masuk</span>
                <div class="rounded-3 bg-danger-subtle text-danger p-2">
                    <i class="bi bi-chat-dots fs-4"></i>
                </div>
            </div>
            <div class="d-flex align-items-baseline gap-2 mb-1">
                <h3 class="fw-bold text-dark mb-0">{{ $stats['messages_count'] }}</h3>
                @if($stats['unread_messages'] > 0)
                    <span class="badge bg-danger rounded-pill">{{ $stats['unread_messages'] }} baru</span>
                @endif
            </div>
            <div class="small text-muted">
                <a href="{{ route('admin.messages.index') }}" class="text-decoration-none text-danger">Buka kotak pesan &rarr;</a>
            </div>
        </div>
    </div>
</div>

<!-- Quick Action Shortcuts -->
<div class="card-admin p-4 mb-4">
    <h6 class="fw-bold text-dark mb-3">Aksi Cepat</h6>
    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary-custom d-inline-flex align-items-center gap-2">
            <i class="bi bi-plus-circle"></i> Tambah Proyek Baru
        </a>
        <a href="{{ route('admin.skills.index') }}" class="btn btn-light border d-inline-flex align-items-center gap-2">
            <i class="bi bi-plus-circle"></i> Tambah Keahlian
        </a>
        <a href="{{ route('admin.profile.edit') }}" class="btn btn-light border d-inline-flex align-items-center gap-2">
            <i class="bi bi-person-gear"></i> Edit Profil Portfolio
        </a>
        <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-secondary d-inline-flex align-items-center gap-2 ms-auto">
            <i class="bi bi-globe"></i> Buka Website Publik
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Recent Messages Table -->
    <div class="col-lg-7">
        <div class="card-admin h-100 overflow-hidden">
            <div class="p-3 px-4 border-bottom d-flex justify-content-between align-items-center">
                <h6 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                    <i class="bi bi-envelope text-primary"></i> Pesan Masuk Terbaru
                </h6>
                <a href="{{ route('admin.messages.index') }}" class="small text-decoration-none">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light small">
                        <tr>
                            <th>Pengirim</th>
                            <th>Subjek</th>
                            <th>Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="small">
                        @forelse($recentMessages as $msg)
                            <tr class="{{ !$msg->is_read ? 'fw-bold bg-light-subtle' : '' }}">
                                <td>
                                    <div>{{ $msg->name }}</div>
                                    <div class="text-muted fw-normal" style="font-size: 0.75rem;">{{ $msg->email }}</div>
                                </td>
                                <td>{{ Str::limit($msg->subject, 30) }}</td>
                                <td>
                                    @if($msg->is_read)
                                        <span class="badge bg-secondary-subtle text-secondary">Dibaca</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger">Baru</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.messages.show', $msg->id) }}" class="btn btn-sm btn-light border">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Belum ada pesan masuk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Recent Projects Table -->
    <div class="col-lg-5">
        <div class="card-admin h-100 overflow-hidden">
            <div class="p-3 px-4 border-bottom d-flex justify-content-between align-items-center">
                <h6 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                    <i class="bi bi-kanban text-primary"></i> Proyek Terbaru
                </h6>
                <a href="{{ route('admin.projects.index') }}" class="small text-decoration-none">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light small">
                        <tr>
                            <th>Proyek</th>
                            <th>Kategori</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="small">
                        @forelse($recentProjects as $proj)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="{{ $proj->thumbnail_url }}" alt="{{ $proj->title }}" class="rounded object-fit-cover" style="width: 36px; height: 36px;">
                                        <span class="fw-semibold text-dark">{{ Str::limit($proj->title, 22) }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">{{ $proj->category }}</span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.projects.edit', $proj->id) }}" class="btn btn-sm btn-light border">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">Belum ada data proyek.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
