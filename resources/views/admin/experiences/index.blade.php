@extends('layouts.admin')

@section('title', 'Manajemen Pengalaman & Edukasi')
@section('page_title', 'Riwayat Pengalaman & Pendidikan')

@section('content')
<div class="card-admin p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold text-dark mb-1">Timeline Karir & Pendidikan</h5>
            <p class="text-muted small mb-0">Kelola riwayat karir profesional dan latar belakang akademik.</p>
        </div>
        <button type="button" class="btn btn-primary-custom d-inline-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addExperienceModal">
            <i class="bi bi-plus-lg"></i> Tambah Riwayat
        </button>
    </div>

    <!-- Tabs Nav -->
    <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active px-4 py-2" id="pills-work-tab" data-bs-toggle="pill" data-bs-target="#pills-work" type="button" role="tab" aria-selected="true">
                <i class="bi bi-briefcase me-1"></i> Pengalaman Kerja ({{ $experiences->count() }})
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link px-4 py-2" id="pills-edu-tab" data-bs-toggle="pill" data-bs-target="#pills-edu" type="button" role="tab" aria-selected="false">
                <i class="bi bi-mortarboard me-1"></i> Pendidikan ({{ $educations->count() }})
            </button>
        </li>
    </ul>

    <!-- Tabs Content -->
    <div class="tab-content" id="pills-tabContent">
        <!-- Work Tab -->
        <div class="tab-pane fade show active" id="pills-work" role="tabpanel" aria-labelledby="pills-work-tab">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light small">
                        <tr>
                            <th>Posisi / Peran</th>
                            <th>Perusahaan</th>
                            <th>Periode</th>
                            <th>Lokasi</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($experiences as $exp)
                            <tr>
                                <td>
                                    <div class="fw-bold text-dark">{{ $exp->position }}</div>
                                    <div class="text-muted small">{{ Str::limit($exp->description, 60) }}</div>
                                </td>
                                <td>{{ $exp->company }}</td>
                                <td><span class="badge bg-primary-subtle text-primary">{{ $exp->period }}</span></td>
                                <td>{{ $exp->location ?? '-' }}</td>
                                <td class="text-end">
                                    <button type="button" class="btn btn-sm btn-light border text-primary" data-bs-toggle="modal" data-bs-target="#editExpModal{{ $exp->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form action="{{ route('admin.experiences.destroy', $exp->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus riwayat ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light border text-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            @include('admin.experiences.partials.edit-modal', ['item' => $exp])
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Belum ada pengalaman kerja ditambahkan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Education Tab -->
        <div class="tab-pane fade" id="pills-edu" role="tabpanel" aria-labelledby="pills-edu-tab">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light small">
                        <tr>
                            <th>Jurusan / Gelar</th>
                            <th>Institusi / Universitas</th>
                            <th>Periode</th>
                            <th>Lokasi</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($educations as $edu)
                            <tr>
                                <td>
                                    <div class="fw-bold text-dark">{{ $edu->position }}</div>
                                    <div class="text-muted small">{{ Str::limit($edu->description, 60) }}</div>
                                </td>
                                <td>{{ $edu->company }}</td>
                                <td><span class="badge bg-info-subtle text-info-emphasis">{{ $edu->period }}</span></td>
                                <td>{{ $edu->location ?? '-' }}</td>
                                <td class="text-end">
                                    <button type="button" class="btn btn-sm btn-light border text-primary" data-bs-toggle="modal" data-bs-target="#editExpModal{{ $edu->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form action="{{ route('admin.experiences.destroy', $edu->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus riwayat pendidikan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light border text-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            @include('admin.experiences.partials.edit-modal', ['item' => $edu])
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Belum ada riwayat pendidikan ditambahkan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addExperienceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold">Tambah Riwayat Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.experiences.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Tipe Riwayat <span class="text-danger">*</span></label>
                        <select class="form-select" name="type" required>
                            <option value="experience">Pengalaman Kerja</option>
                            <option value="education">Pendidikan / Akademik</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Posisi / Gelar <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="position" placeholder="Contoh: Senior Web Developer atau S1 Sistem Informasi" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Perusahaan / Universitas <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="company" placeholder="Contoh: PT Teknologi Bangsa atau Universitas Gadjah Mada" required>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Periode Waktu <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="period" placeholder="Contoh: 2022 - Sekarang" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Lokasi</label>
                            <input type="text" class="form-control" name="location" placeholder="Contoh: Jakarta, Indonesia">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Deskripsi Peran / Pencapaian</label>
                        <textarea class="form-control" name="description" rows="3" placeholder="Tanggung jawab utama, teknologi yang digunakan, atau pencapaian..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Urutan Tampil</label>
                        <input type="number" class="form-control" name="order" value="0">
                    </div>
                </div>
                <div class="modal-footer bg-light border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary-custom">Simpan Riwayat</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
