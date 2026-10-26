@extends('layouts.admin')

@section('title', 'Pengaturan Akun')
@section('page_title', 'Pengaturan Akun Administrator')

@section('content')
<div class="row g-4">
    <div class="col-lg-6">
        <!-- Account Info Form -->
        <div class="card-admin p-4 p-md-5 h-100">
            <h5 class="fw-bold text-dark mb-4 border-bottom pb-3 d-flex align-items-center gap-2">
                <i class="bi bi-person-circle text-primary"></i> Data Akun Login
            </h5>

            <form action="{{ route('admin.account.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold small">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold small">Alamat Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold small">Role Sistem</label>
                    <div>
                        <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 fs-6">
                            <i class="bi bi-shield-check me-1"></i> {{ strtoupper($user->role) }}
                        </span>
                    </div>
                    <small class="text-muted">Hak akses penuh untuk mengelola seluruh konten dan data portofolio.</small>
                </div>

                <button type="submit" class="btn btn-primary-custom w-100 py-2">
                    <i class="bi bi-check-lg me-1"></i> Simpan Informasi Akun
                </button>
            </form>
        </div>
    </div>

    <div class="col-lg-6">
        <!-- Password Change Form -->
        <div class="card-admin p-4 p-md-5 h-100">
            <h5 class="fw-bold text-dark mb-4 border-bottom pb-3 d-flex align-items-center gap-2">
                <i class="bi bi-key-fill text-warning"></i> Ganti Password
            </h5>

            <form action="{{ route('admin.account.password') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="current_password" class="form-label fw-semibold small">Password Saat Ini <span class="text-danger">*</span></label>
                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" required placeholder="••••••••">
                    @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold small">Password Baru <span class="text-danger">*</span></label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required placeholder="Minimal 8 karakter">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label fw-semibold small">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required placeholder="Ulangi password baru">
                </div>

                <button type="submit" class="btn btn-warning w-100 py-2 fw-semibold">
                    <i class="bi bi-shield-lock me-1"></i> Perbarui Password
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
