@extends('layouts.admin')

@section('title', 'Tambah Proyek Baru')
@section('page_title', 'Tambah Proyek Portfolio Baru')

@section('content')
<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card-admin p-4 p-md-5">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                <h5 class="fw-bold text-dark mb-0">Formulir Proyek Baru</h5>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-sm btn-light border">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">
                    <div class="col-md-8">
                        <label for="title" class="form-label fw-semibold small">Judul Proyek <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="Contoh: E-Commerce Platform Modern" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="category" class="form-label fw-semibold small">Kategori <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('category') is-invalid @enderror" id="category" name="category" value="{{ old('category', 'Web App') }}" placeholder="Contoh: Web App, UI/UX, API" required>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="short_description" class="form-label fw-semibold small">Deskripsi Singkat (Ringkasan di Kartu)</label>
                        <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description" rows="2" placeholder="Ringkasan 1-2 kalimat mengenai proyek ini...">{{ old('short_description') }}</textarea>
                    </div>

                    <div class="col-12">
                        <label for="description" class="form-label fw-semibold small">Deskripsi Lengkap Proyek</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" placeholder="Jelaskan latar belakang proyek, fitur utama, arsitektur, dan hasil yang dicapai...">{{ old('description') }}</textarea>
                    </div>

                    <div class="col-12">
                        <label for="tech_stack" class="form-label fw-semibold small">Tech Stack (Pisahkan dengan koma)</label>
                        <input type="text" class="form-control @error('tech_stack') is-invalid @enderror" id="tech_stack" name="tech_stack" value="{{ old('tech_stack') }}" placeholder="Contoh: Laravel, Bootstrap 5, MySQL, REST API">
                        <small class="text-muted">Akan ditampilkan sebagai tag lencana.</small>
                    </div>

                    <!-- Thumbnail Section -->
                    <div class="col-12 border-top pt-3">
                        <h6 class="fw-bold text-dark mb-3">Gambar Thumbnail</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="thumbnail_file" class="form-label fw-semibold small">Unggah Gambar (JPG, PNG, WebP maks 3MB)</label>
                                <input type="file" class="form-control @error('thumbnail_file') is-invalid @enderror" id="thumbnail_file" name="thumbnail_file" accept="image/*">
                            </div>
                            <div class="col-md-6">
                                <label for="thumbnail_url" class="form-label fw-semibold small">Atau URL Gambar Online</label>
                                <input type="url" class="form-control @error('thumbnail_url') is-invalid @enderror" id="thumbnail_url" name="thumbnail_url" value="{{ old('thumbnail_url') }}" placeholder="https://images.unsplash.com/...">
                            </div>
                        </div>
                    </div>

                    <!-- Meta Details -->
                    <div class="col-md-6 border-top pt-3">
                        <label for="demo_url" class="form-label fw-semibold small">URL Demo Langsung (Live URL)</label>
                        <input type="url" class="form-control @error('demo_url') is-invalid @enderror" id="demo_url" name="demo_url" value="{{ old('demo_url') }}" placeholder="https://demo.domain.com">
                    </div>

                    <div class="col-md-6 border-top pt-3">
                        <label for="github_url" class="form-label fw-semibold small">URL Repositori GitHub</label>
                        <input type="url" class="form-control @error('github_url') is-invalid @enderror" id="github_url" name="github_url" value="{{ old('github_url') }}" placeholder="https://github.com/username/project">
                    </div>

                    <div class="col-md-4">
                        <label for="client" class="form-label fw-semibold small">Klien / Lembaga</label>
                        <input type="text" class="form-control" id="client" name="client" value="{{ old('client') }}" placeholder="Contoh: PT FinTech Digital">
                    </div>

                    <div class="col-md-4">
                        <label for="completed_date" class="form-label fw-semibold small">Waktu Selesai</label>
                        <input type="text" class="form-control" id="completed_date" name="completed_date" value="{{ old('completed_date') }}" placeholder="Contoh: Januari 2025">
                    </div>

                    <div class="col-md-4">
                        <label for="order" class="form-label fw-semibold small">Urutan Tampil (Order)</label>
                        <input type="number" class="form-control" id="order" name="order" value="{{ old('order', 0) }}">
                    </div>

                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="is_featured" name="is_featured" value="1" checked>
                            <label class="form-check-label fw-semibold small text-dark" for="is_featured">Jadikan Proyek Unggulan di Halaman Utama</label>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-5 pt-3 border-top">
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-light border px-4">Batal</a>
                    <button type="submit" class="btn btn-primary-custom px-4">
                        <i class="bi bi-save me-1"></i> Simpan Proyek
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
