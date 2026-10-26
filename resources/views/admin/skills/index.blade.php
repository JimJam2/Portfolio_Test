@extends('layouts.admin')

@section('title', 'Manajemen Keahlian')
@section('page_title', 'Keahlian Teknis (Skills)')

@section('content')
<div class="card-admin p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold text-dark mb-1">Daftar Keahlian</h5>
            <p class="text-muted small mb-0">Kelola persentase kecakapan dan kategori teknologi Anda.</p>
        </div>
        <button type="button" class="btn btn-primary-custom d-inline-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addSkillModal">
            <i class="bi bi-plus-lg"></i> Tambah Keahlian
        </button>
    </div>

    <!-- Skills Table -->
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light small">
                <tr>
                    <th style="width: 50px;">Icon</th>
                    <th>Nama Keahlian</th>
                    <th>Kategori</th>
                    <th style="width: 250px;">Tingkat Kecakapan</th>
                    <th style="width: 80px;">Urutan</th>
                    <th class="text-end" style="width: 120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($skills as $skill)
                    <tr>
                        <td>
                            <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center text-primary" style="width: 36px; height: 36px;">
                                <i class="{{ $skill->icon ?? 'bi bi-code' }} fs-5"></i>
                            </div>
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $skill->name }}</div>
                            <div class="text-muted small">Class: <code>{{ $skill->icon }}</code></div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border">{{ $skill->category }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="progress flex-grow-1" style="height: 8px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $skill->proficiency }}%;" aria-valuenow="{{ $skill->proficiency }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="fw-bold small text-primary">{{ $skill->proficiency }}%</span>
                            </div>
                        </td>
                        <td>{{ $skill->order }}</td>
                        <td class="text-end">
                            <button type="button" class="btn btn-sm btn-light border text-primary" data-bs-toggle="modal" data-bs-target="#editSkillModal{{ $skill->id }}" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <form action="{{ route('admin.skills.destroy', $skill->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus keahlian {{ $skill->name }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light border text-danger" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editSkillModal{{ $skill->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-4 border-0">
                                <div class="modal-header border-bottom">
                                    <h5 class="modal-title fw-bold">Edit Keahlian: {{ $skill->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.skills.update', $skill->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body p-4">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold small">Nama Keahlian <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" value="{{ $skill->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold small">Kategori <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="category" value="{{ $skill->category }}" placeholder="Frontend / Backend / Tools" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold small">Kecakapan (1 - 100%) <span class="text-danger">*</span></label>
                                            <input type="number" min="1" max="100" class="form-control" name="proficiency" value="{{ $skill->proficiency }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold small">Bootstrap Icon Class</label>
                                            <input type="text" class="form-control" name="icon" value="{{ $skill->icon }}" placeholder="bi bi-code-slash">
                                            <small class="text-muted">Cari icon di <a href="https://icons.getbootstrap.com/" target="_blank">icons.getbootstrap.com</a></small>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold small">Urutan Tampil</label>
                                            <input type="number" class="form-control" name="order" value="{{ $skill->order }}">
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-light border-0">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary-custom">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Belum ada keahlian ditambahkan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Add Skill Modal -->
<div class="modal fade" id="addSkillModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold">Tambah Keahlian Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.skills.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Nama Keahlian <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" placeholder="Contoh: Laravel, Tailwind CSS, Docker" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Kategori <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="category" placeholder="Contoh: Backend, Frontend, Tools & DevOps" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Kecakapan (1 - 100%) <span class="text-danger">*</span></label>
                        <input type="number" min="1" max="100" class="form-control" name="proficiency" value="85" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Bootstrap Icon Class</label>
                        <input type="text" class="form-control" name="icon" placeholder="Contoh: bi bi-cpu, bi bi-database, bi bi-git">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Urutan Tampil</label>
                        <input type="number" class="form-control" name="order" value="0">
                    </div>
                </div>
                <div class="modal-footer bg-light border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary-custom">Simpan Keahlian</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
