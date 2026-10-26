@extends('layouts.admin')

@section('title', 'Edit Profil Portfolio')
@section('page_title', 'Profil & Informasi Personal')

@section('content')
<div class="row">
    <div class="col-lg-10 mx-auto">
        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Main Info Card -->
            <div class="card-admin p-4 p-md-5 mb-4">
                <h5 class="fw-bold text-dark mb-4 border-bottom pb-3">Informasi Utama</h5>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label for="full_name" class="form-label fw-semibold small">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" value="{{ old('full_name', $profile->full_name) }}" required>
                        @error('full_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="title" class="form-label fw-semibold small">Jabatan / Profesi Utama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $profile->title) }}" placeholder="Contoh: Senior Full-Stack Developer" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="tagline" class="form-label fw-semibold small">Tagline Hero (Slogan Singkat)</label>
                        <input type="text" class="form-control @error('tagline') is-invalid @enderror" id="tagline" name="tagline" value="{{ old('tagline', $profile->tagline) }}" placeholder="Membangun solusi web modern dan scalable...">
                    </div>

                    <div class="col-12">
                        <label for="bio" class="form-label fw-semibold small">Bio Singkat</label>
                        <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio" rows="3">{{ old('bio', $profile->bio) }}</textarea>
                    </div>

                    <div class="col-12">
                        <label for="about_details" class="form-label fw-semibold small">Detail Tambahan Tentang Saya</label>
                        <textarea class="form-control @error('about_details') is-invalid @enderror" id="about_details" name="about_details" rows="4">{{ old('about_details', $profile->about_details) }}</textarea>
                    </div>
                </div>

                <!-- Avatar Section -->
                <h6 class="fw-bold text-dark mb-3 pt-3 border-top">Foto Profil (Avatar)</h6>
                <div class="row g-4 align-items-center mb-4">
                    <div class="col-auto">
                        <img src="{{ $profile->avatar_url }}" alt="Preview" class="rounded-circle object-fit-cover border shadow-sm" id="avatarPreview" style="width: 90px; height: 90px;">
                    </div>
                    <div class="col">
                        <div class="mb-2">
                            <label for="avatar_file" class="form-label fw-semibold small mb-1">Unggah Foto Baru (JPG, PNG, WebP maks 2MB)</label>
                            <input type="file" class="form-control form-control-sm @error('avatar_file') is-invalid @enderror" id="avatar_file" name="avatar_file" accept="image/*" onchange="previewImage(this)">
                            @error('avatar_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="avatar_url" class="form-label fw-semibold small mb-1">Atau Gunakan URL Gambar Eksternal</label>
                            <input type="url" class="form-control form-control-sm @error('avatar_url') is-invalid @enderror" id="avatar_url" name="avatar_url" value="{{ old('avatar_url', str_starts_with($profile->avatar ?? '', 'http') ? $profile->avatar : '') }}" placeholder="https://images.unsplash.com/...">
                        </div>
                    </div>
                </div>

                <!-- Counters / Stats -->
                <h6 class="fw-bold text-dark mb-3 pt-3 border-top">Statistik Pengalaman</h6>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="years_of_experience" class="form-label fw-semibold small">Tahun Pengalaman</label>
                        <input type="number" min="0" class="form-control @error('years_of_experience') is-invalid @enderror" id="years_of_experience" name="years_of_experience" value="{{ old('years_of_experience', $profile->years_of_experience) }}">
                    </div>
                    <div class="col-md-4">
                        <label for="completed_projects" class="form-label fw-semibold small">Proyek Selesai</label>
                        <input type="number" min="0" class="form-control @error('completed_projects') is-invalid @enderror" id="completed_projects" name="completed_projects" value="{{ old('completed_projects', $profile->completed_projects) }}">
                    </div>
                    <div class="col-md-4">
                        <label for="satisfied_clients" class="form-label fw-semibold small">Klien Puas</label>
                        <input type="number" min="0" class="form-control @error('satisfied_clients') is-invalid @enderror" id="satisfied_clients" name="satisfied_clients" value="{{ old('satisfied_clients', $profile->satisfied_clients) }}">
                    </div>
                </div>
            </div>

            <!-- Contact & Social Links Card -->
            <div class="card-admin p-4 p-md-5 mb-4">
                <h5 class="fw-bold text-dark mb-4 border-bottom pb-3">Kontak & Media Sosial</h5>

                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="email" class="form-label fw-semibold small">Alamat Email Publik</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $profile->email) }}">
                    </div>

                    <div class="col-md-6">
                        <label for="phone" class="form-label fw-semibold small">No. Telepon / WhatsApp</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $profile->phone) }}">
                    </div>

                    <div class="col-md-6">
                        <label for="location" class="form-label fw-semibold small">Lokasi / Domisili</label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location', $profile->location) }}">
                    </div>

                    <div class="col-md-6">
                        <label for="resume_url" class="form-label fw-semibold small">Tautan Unduh Resume / CV</label>
                        <input type="text" class="form-control @error('resume_url') is-invalid @enderror" id="resume_url" name="resume_url" value="{{ old('resume_url', $profile->resume_url) }}" placeholder="https://drive.google.com/... atau #">
                    </div>

                    <div class="col-md-4">
                        <label for="github_url" class="form-label fw-semibold small">URL GitHub</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-github"></i></span>
                            <input type="url" class="form-control" id="github_url" name="github_url" value="{{ old('github_url', $profile->github_url) }}" placeholder="https://github.com/username">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="linkedin_url" class="form-label fw-semibold small">URL LinkedIn</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-linkedin"></i></span>
                            <input type="url" class="form-control" id="linkedin_url" name="linkedin_url" value="{{ old('linkedin_url', $profile->linkedin_url) }}" placeholder="https://linkedin.com/in/username">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="instagram_url" class="form-label fw-semibold small">URL Instagram</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-instagram"></i></span>
                            <input type="url" class="form-control" id="instagram_url" name="instagram_url" value="{{ old('instagram_url', $profile->instagram_url) }}" placeholder="https://instagram.com/username">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="d-flex justify-content-end gap-3 mb-5">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-light border px-4 py-2">Batal</a>
                <button type="submit" class="btn btn-primary-custom px-5 py-2">
                    <i class="bi bi-save me-1"></i> Simpan Perubahan Profil
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('avatarPreview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
