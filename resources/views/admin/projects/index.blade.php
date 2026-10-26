@extends('layouts.admin')

@section('title', 'Manajemen Proyek')
@section('page_title', 'Daftar Proyek Portfolio')

@section('content')
<div class="card-admin p-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <!-- Search and Filter Form -->
        <form method="GET" action="{{ route('admin.projects.index') }}" class="d-flex flex-wrap align-items-center gap-2">
            <div class="input-group" style="max-width: 260px;">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                <input type="text" name="search" class="form-control bg-light border-start-0" placeholder="Cari nama, tech..." value="{{ request('search') }}">
            </div>

            <select name="category" class="form-select bg-light" style="max-width: 180px;" onchange="this.form.submit()">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>

            @if(request('search') || request('category'))
                <a href="{{ route('admin.projects.index') }}" class="btn btn-light border" title="Reset Filter">
                    <i class="bi bi-x-circle"></i>
                </a>
            @endif
        </form>

        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary-custom d-inline-flex align-items-center gap-2">
            <i class="bi bi-plus-lg"></i> Tambah Proyek
        </a>
    </div>

    <!-- Projects Table -->
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light small">
                <tr>
                    <th style="width: 80px;">Thumbnail</th>
                    <th>Judul Proyek</th>
                    <th>Kategori</th>
                    <th>Tech Stack</th>
                    <th style="width: 100px;">Unggulan</th>
                    <th class="text-end" style="width: 140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                    <tr>
                        <td>
                            <img src="{{ $project->thumbnail_url }}" alt="{{ $project->title }}" class="rounded-3 object-fit-cover shadow-sm" style="width: 60px; height: 45px;">
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $project->title }}</div>
                            <div class="text-muted small">Klien: {{ $project->client ?? 'Personal' }}</div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border">{{ $project->category }}</span>
                        </td>
                        <td>
                            <div class="d-flex flex-wrap gap-1" style="max-width: 250px;">
                                @foreach($project->tech_tags as $tag)
                                    <span class="badge bg-light text-secondary border" style="font-size: 0.7rem;">{{ $tag }}</span>
                                @endforeach
                            </div>
                        </td>
                        <td>
                            @if($project->is_featured)
                                <span class="badge bg-success-subtle text-success">Ya</span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary">Tidak</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="d-inline-flex gap-1">
                                <a href="{{ route('portfolio.project', $project->slug) }}" target="_blank" class="btn btn-sm btn-light border" title="Lihat di Web">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-sm btn-light border text-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-light border text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $project->id }}" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{ $project->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4 border-0">
                                        <div class="modal-body text-center p-4">
                                            <div class="rounded-circle bg-danger-subtle text-danger mx-auto d-flex align-items-center justify-content-center mb-3" style="width: 56px; height: 56px;">
                                                <i class="bi bi-exclamation-triangle fs-3"></i>
                                            </div>
                                            <h5 class="fw-bold mb-2">Hapus Proyek Ini?</h5>
                                            <p class="text-muted small mb-4">Apakah Anda yakin ingin menghapus proyek "<strong>{{ $project->title }}</strong>"? Tindakan ini tidak dapat dibatalkan.</p>
                                            
                                            <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <div class="d-flex justify-content-center gap-2">
                                                    <button type="button" class="btn btn-light border px-4" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger px-4">Ya, Hapus</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-5">
                            <i class="bi bi-inbox fs-2 d-block mb-2 text-secondary"></i>
                            Tidak ada proyek yang ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($projects->hasPages())
        <div class="mt-4 pt-3 border-top d-flex justify-content-end">
            {{ $projects->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
