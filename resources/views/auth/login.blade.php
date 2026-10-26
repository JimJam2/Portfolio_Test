<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Portfolio</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #31104b 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            max-width: 460px;
            width: 100%;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .btn-primary-custom {
            background: #4f46e5;
            border-color: #4f46e5;
            color: #fff;
            font-weight: 600;
            padding: 0.8rem 1.5rem;
            border-radius: 12px;
            transition: all 0.2s ease;
        }
        .btn-primary-custom:hover {
            background: #4338ca;
            border-color: #4338ca;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.4);
        }
    </style>
</head>
<body>
    <div class="login-card p-4 p-md-5">
        <div class="text-center mb-4">
            <div class="d-inline-flex align-items-center justify-content-center bg-primary-subtle text-primary rounded-circle mb-3" style="width: 60px; height: 60px;">
                <i class="bi bi-shield-lock-fill fs-2"></i>
            </div>
            <h3 class="fw-bold text-dark mb-1">Masuk Panel Admin</h3>
            <p class="text-muted small">Kelola portofolio, keahlian, dan pesan kontak</p>
        </div>

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show small" role="alert">
                <i class="bi bi-exclamation-circle-fill me-1"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger small mb-3">
                @foreach($errors->all() as $error)
                    <div><i class="bi bi-exclamation-triangle me-1"></i> {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label fw-semibold small text-dark">Email Admin</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
                    <input type="email" class="form-control bg-light border-start-0 ps-0 @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', 'admin@portfolio.test') }}" placeholder="admin@portfolio.test" required autofocus>
                </div>
            </div>

            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label for="password" class="form-label fw-semibold small text-dark mb-0">Password</label>
                </div>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-key"></i></span>
                    <input type="password" class="form-control bg-light border-start-0 ps-0 @error('password') is-invalid @enderror" id="password" name="password" value="admin123" placeholder="••••••••" required>
                </div>
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" checked>
                <label class="form-check-label small text-muted" for="remember">
                    Ingat sesi saya di perangkat ini
                </label>
            </div>

            <button type="submit" class="btn btn-primary-custom w-100 mb-3 d-flex align-items-center justify-content-center gap-2">
                <i class="bi bi-box-arrow-in-right"></i> Masuk Sekarang
            </button>
        </form>

        <!-- Quick Demo Credentials Box -->
        <div class="p-3 rounded-3 bg-light border mt-4">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="fw-bold text-dark small"><i class="bi bi-info-circle-fill text-primary me-1"></i> Akun Demo Tersedia:</span>
            </div>
            <div class="small text-muted mb-1">
                <strong>Admin:</strong> <code>admin@portfolio.test</code> | Password: <code>admin123</code>
            </div>
            <div class="small text-muted">
                <strong>User Biasa:</strong> <code>user@portfolio.test</code> | Password: <code>password123</code>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="text-decoration-none text-muted small d-inline-flex align-items-center gap-1">
                <i class="bi bi-arrow-left"></i> Kembali ke Website Portfolio
            </a>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
