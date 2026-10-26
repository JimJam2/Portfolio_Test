@extends('layouts.admin')

@section('title', 'Edit Proyek')
@section('page_title', 'Edit Proyek: ' . $project->title)

@section('content')
<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card-admin p-4 p-md-5">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                <h5 class="fw-bold text-dark mb-0">Ubah Data Proyek</h5>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-sm btn-light border">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <div class="col-md-8">
                        <label for="title" class="form-label fw-semibold small">Judul Proyek <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $project->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="category" class="form-label fw-semibold small">Kategori <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('category') is-invalid @enderror" id="category" name="category" value="{{ old('category', $project->category) }}" required>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="short_description" class="form-label fw-semibold small">Deskripsi Singkat (Ringkasan di Kartu)</label>
                        <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description" rows="2">{{ old('short_description', $project->short_description) }}</textarea>
                    </div>

                    <div class="col-12">
                        <label for="description" class="form-label fw-semibold small">Deskripsi Lengkap Proyek</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5">{{ old('description', $project->description) }}</textarea>
                    </div>

                    <div class="col-12">
                        <label for="tech_stack" class="form-label fw-semibold small">Tech Stack (Pisahkan dengan koma)</label>
                        <input type="text" class="form-control @error('tech_stack') is-invalid @enderror" id="tech_stack" name="tech_stack" value="{{ old('tech_stack', $project->tech_stack) }}">
                    </div>

                    <!-- Thumbnail Section -->
                    <div class="col-12 border-top pt-3">
                        <h6 class="fw-bold text-dark mb-3">Thumbnail Saat Ini</h6>
                        <div class="d-flex align-items-center gap-4 mb-3">
                            <img src="{{ $project->thumbnail_url }}" alt="{{ $project->title }}" class="rounded-3 object-fit-cover border shadow-sm" style="width: 120px; height: 80px;">
                            <div class="small text-muted">Unggah file baru atau masukkan URL jika ingin mengganti thumbnail di atas.</div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="thumbnail_file" class="form-label fw-semibold small">Ganti Gambar (File Upload)</label>
                                <input type="file" class="form-control @error('thumbnail_file') is-invalid @enderror" id="thumbnail_file" name="thumbnail_file" accept="image/*">
                            </div>
                            <div class="col-md-6">
                                <label for="thumbnail_url" class="form-label fw-semibold small">Atau Ganti URL Online</label>
                                <input type="url" class="form-control @error('thumbnail_url') is-invalid @enderror" id="thumbnail_url" name="thumbnail_url" value="{{ old('thumbnail_url', str_starts_with($project->thumbnail ?? '', 'http') ? $project->thumbnail : '') }}" placeholder="https://...">
                            </div>
                        </div>
                    </div>

                    <!-- Meta Details -->
                    <div class="col-md-6 border-top pt-3">
                        <label for="demo_url" class="form-label fw-semibold small">URL Demo Langsung (Live URL)</label>
                        <input type="url" class="form-control" id="demo_url" name="demo_url" value="{{ old('demo_url', $project->demo_url) }}">
                    </div>

                    <div class="col-md-6 border-top pt-3">
                        <label for="github_url" class="form-label fw-semibold small">URL Repositori GitHub</label>
                        <input type="url" class="form-control" id="github_url" name="github_url" value="{{ old('github_url', $project->github_url) }}">
                    </div>

                    <div class="col-md-4">
                        <label for="client" class="form-label fw-semibold small">Klien / Lembaga</label>
                        <input type="text" class="form-control" id="client" name="client" value="{{ old('client', $project->client) }}">
                    </div>

                    <div class="col-md-4">
                        <label for="completed_date" class="form-label fw-semibold small">Waktu Selesai</label>
                        <input type="text" class="form-control" id="completed_date" name="completed_date" value="{{ old('completed_date', $project->completed_date) }}">
                    </div>

                    <div class="col-md-4">
                        <label for="order" class="form-label fw-semibold small">Urutan Tampil (Order)</label>
                        <input type="number" class="form-control" id="order" name="order" value="{{ old('order', $project->order) }}">
                    </div>

                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold small text-dark" for="is_featured">Jadikan Proyek Unggulan di Halaman Utama</label>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-5 pt-3 border-top">
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-light border px-4">Batal</a>
                    <button type="submit" class="btn btn-primary-custom px-4">
                        <i class="bi bi-save me-1"></i> Perbarui Proyek
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
