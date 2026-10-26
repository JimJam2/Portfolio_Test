<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Portfolio Professional') - {{ $profile->full_name ?? 'Web Developer' }}</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --primary-light: #eef2ff;
            --dark-navy: #0f172a;
            --slate-800: #1e293b;
            --slate-600: #475569;
            --slate-100: #f1f5f9;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #334155;
            background-color: #f8fafc;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        /* Navbar */
        .navbar-custom {
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.35rem;
            color: var(--dark-navy) !important;
            letter-spacing: -0.5px;
        }

        .navbar-brand span {
            color: var(--primary);
        }

        .nav-link {
            font-weight: 500;
            color: #475569 !important;
            padding: 0.5rem 1rem !important;
            transition: color 0.2s ease;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--primary) !important;
        }

        /* Hero */
        .hero-section {
            padding: 7rem 0 5rem;
            background: linear-gradient(180deg, #f8fafc 0%, #eef2ff 100%);
            position: relative;
        }

        .badge-pill-custom {
            background-color: #e0e7ff;
            color: var(--primary);
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 50rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
        }

        .hero-title {
            font-size: 3.25rem;
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: -1px;
            color: var(--dark-navy);
        }

        .text-gradient {
            background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .avatar-wrapper {
            position: relative;
            display: inline-block;
        }

        .avatar-img {
            width: 320px;
            height: 320px;
            object-fit: cover;
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            box-shadow: 0 20px 40px -15px rgba(79, 70, 229, 0.3);
            border: 6px solid #fff;
            animation: morphBlob 10s ease-in-out infinite alternate;
        }

        @keyframes morphBlob {
            0% { border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; }
            50% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
            100% { border-radius: 40% 60% 60% 40% / 40% 60% 40% 60%; }
        }

        .floating-badge {
            position: absolute;
            background: white;
            padding: 0.5rem 1rem;
            border-radius: 12px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            font-weight: 600;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .badge-1 { top: 10px; right: -20px; }
        .badge-2 { bottom: 20px; left: -20px; }

        /* Section Styling */
        .section-padding {
            padding: 5.5rem 0;
        }

        .section-header {
            margin-bottom: 3.5rem;
        }

        .section-subtitle {
            text-transform: uppercase;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 2px;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .section-title {
            font-size: 2.25rem;
            font-weight: 800;
            color: var(--dark-navy);
            letter-spacing: -0.5px;
        }

        /* Cards & Components */
        .card-custom {
            background: #ffffff;
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-custom:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.08), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-color: rgba(99, 102, 241, 0.3);
        }

        /* Buttons */
        .btn-primary-custom {
            background-color: var(--primary);
            border-color: var(--primary);
            color: white;
            font-weight: 600;
            padding: 0.75rem 1.75rem;
            border-radius: 12px;
            transition: all 0.2s ease;
        }

        .btn-primary-custom:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);
        }

        .btn-outline-custom {
            border: 2px solid #cbd5e1;
            color: var(--slate-800);
            font-weight: 600;
            padding: 0.7rem 1.75rem;
            border-radius: 12px;
            transition: all 0.2s ease;
        }

        .btn-outline-custom:hover {
            background-color: var(--slate-100);
            border-color: #94a3b8;
            color: var(--dark-navy);
        }

        /* Timeline */
        .timeline {
            position: relative;
            padding-left: 2rem;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 7px;
            top: 10px;
            bottom: 10px;
            width: 2px;
            background: #e2e8f0;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 2rem;
        }

        .timeline-dot {
            position: absolute;
            left: -2rem;
            top: 4px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: var(--primary);
            border: 3px solid white;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
        }

        /* Filter Tabs */
        .filter-btn {
            background: transparent;
            border: 1px solid #e2e8f0;
            color: #64748b;
            padding: 0.45rem 1.15rem;
            border-radius: 50rem;
            font-size: 0.875rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .filter-btn.active, .filter-btn:hover {
            background-color: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }

        /* Footer */
        .footer {
            background-color: var(--dark-navy);
            color: #94a3b8;
            padding: 4rem 0 2rem;
        }

        .footer a {
            color: #cbd5e1;
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer a:hover {
            color: #fff;
        }

        @media (max-width: 991px) {
            .hero-title { font-size: 2.5rem; }
            .avatar-img { width: 240px; height: 240px; margin-top: 2rem; }
            .hero-section { padding: 6rem 0 4rem; }
        }
    </style>
    @yield('styles')
</head>
<body data-bs-spy="scroll" data-bs-target="#mainNavbar" data-bs-offset="100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-custom" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="bi bi-code-slash text-primary me-2"></i>{{ explode(' ', $profile->full_name ?? 'Portfolio')[0] }}<span>.dev</span>
            </a>
            
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list fs-2 text-dark"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#about">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#skills">Keahlian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#services">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#projects">Portfolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#experience">Pengalaman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#contact">Kontak</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-2">
                    @auth
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-primary-custom d-flex align-items-center gap-1">
                                <i class="bi bi-speedometer2"></i> Admin Panel
                            </a>
                        @else
                            <span class="badge bg-secondary me-2">{{ Auth::user()->name }}</span>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Logout">
                                <i class="bi bi-box-arrow-right"></i>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-sm btn-outline-custom d-flex align-items-center gap-1">
                            <i class="bi bi-shield-lock"></i> Login Admin
                        </a>
                        <a href="#contact" class="btn btn-sm btn-primary-custom">
                            Hubungi Saya
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-4 justify-content-between">
                <div class="col-lg-5 col-md-6">
                    <h5 class="text-white fw-bold mb-3">
                        <i class="bi bi-code-slash text-primary me-2"></i>{{ $profile->full_name ?? 'Portfolio' }}
                    </h5>
                    <p class="mb-3 text-secondary">
                        {{ $profile->tagline ?? 'Membangun aplikasi web modern, terstruktur, dan siap skala tinggi.' }}
                    </p>
                    <div class="d-flex gap-2">
                        @if(!empty($profile->github_url))
                            <a href="{{ $profile->github_url }}" target="_blank" class="btn btn-sm btn-outline-secondary rounded-circle" style="width:38px;height:38px;display:flex;align-items:center;justify-content:center;">
                                <i class="bi bi-github"></i>
                            </a>
                        @endif
                        @if(!empty($profile->linkedin_url))
                            <a href="{{ $profile->linkedin_url }}" target="_blank" class="btn btn-sm btn-outline-secondary rounded-circle" style="width:38px;height:38px;display:flex;align-items:center;justify-content:center;">
                                <i class="bi bi-linkedin"></i>
                            </a>
                        @endif
                        @if(!empty($profile->instagram_url))
                            <a href="{{ $profile->instagram_url }}" target="_blank" class="btn btn-sm btn-outline-secondary rounded-circle" style="width:38px;height:38px;display:flex;align-items:center;justify-content:center;">
                                <i class="bi bi-instagram"></i>
                            </a>
                        @endif
                        @if(!empty($profile->email))
                            <a href="mailto:{{ $profile->email }}" class="btn btn-sm btn-outline-secondary rounded-circle" style="width:38px;height:38px;display:flex;align-items:center;justify-content:center;">
                                <i class="bi bi-envelope"></i>
                            </a>
                        @endif
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h6 class="text-white fw-bold mb-3">Tautan Cepat</h6>
                    <ul class="list-unstyled d-flex flex-column gap-2 small">
                        <li><a href="#about"><i class="bi bi-chevron-right me-1 text-primary"></i> Tentang Saya</a></li>
                        <li><a href="#skills"><i class="bi bi-chevron-right me-1 text-primary"></i> Keahlian Teknis</a></li>
                        <li><a href="#projects"><i class="bi bi-chevron-right me-1 text-primary"></i> Proyek Portfolio</a></li>
                        <li><a href="#experience"><i class="bi bi-chevron-right me-1 text-primary"></i> Pengalaman & Karir</a></li>
                        <li><a href="#contact"><i class="bi bi-chevron-right me-1 text-primary"></i> Form Kontak</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h6 class="text-white fw-bold mb-3">Akses Panel</h6>
                    <p class="small text-secondary mb-2">Portal administrasi untuk memperbarui konten proyek, profil, dan membaca pesan masuk.</p>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-light w-100">
                            <i class="bi bi-speedometer2 me-1"></i> Buka Admin Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light w-100">
                            <i class="bi bi-lock me-1"></i> Masuk Sebagai Admin
                        </a>
                    @endauth
                </div>
            </div>

            <hr class="border-secondary my-4">

            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start small text-secondary">
                    &copy; {{ date('Y') }} {{ $profile->full_name ?? 'Portfolio' }}. Dikembangkan menggunakan <span class="text-white fw-semibold">Laravel & Bootstrap</span>.
                </div>
                <div class="col-md-6 text-center text-md-end small text-secondary mt-2 mt-md-0">
                    Dirancang dengan clean code & modern responsive UI.
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5.3 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
