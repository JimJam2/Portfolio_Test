<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - Portfolio Admin</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --sidebar-width: 260px;
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --dark-navy: #0f172a;
            --sidebar-bg: #111827;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f1f5f9;
            color: #334155;
            min-height: 100vh;
        }

        /* Sidebar */
        #sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background-color: var(--sidebar-bg);
            color: #94a3b8;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        #sidebar .brand {
            padding: 1.5rem 1.25rem;
            color: #fff;
            font-weight: 800;
            font-size: 1.2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        #sidebar .nav-link {
            color: #9ca3af;
            padding: 0.75rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 500;
            border-radius: 8px;
            margin: 0.2rem 0.75rem;
            transition: all 0.2s ease;
        }

        #sidebar .nav-link:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.05);
        }

        #sidebar .nav-link.active {
            color: #fff;
            background-color: var(--primary);
            font-weight: 600;
        }

        #sidebar .nav-header {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #64748b;
            padding: 1.25rem 1.25rem 0.5rem;
        }

        /* Main Content Wrapper */
        #content-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
        }

        /* Topbar */
        .topbar {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: 0.85rem 1.75rem;
            position: sticky;
            top: 0;
            z-index: 990;
        }

        /* Cards */
        .card-admin {
            background: #fff;
            border-radius: 14px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
        }

        .btn-primary-custom {
            background-color: var(--primary);
            border-color: var(--primary);
            color: white;
            font-weight: 600;
            border-radius: 8px;
            padding: 0.55rem 1.25rem;
        }

        .btn-primary-custom:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            color: white;
        }

        @media (max-width: 991px) {
            #sidebar {
                margin-left: calc(-1 * var(--sidebar-width));
            }
            #sidebar.active {
                margin-left: 0;
            }
            #content-wrapper {
                margin-left: 0;
            }
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- Sidebar -->
    <aside id="sidebar">
        <div class="brand">
            <i class="bi bi-shield-shaded text-primary fs-4"></i>
            <div>
                <div>Admin Panel</div>
                <div class="small fw-normal text-secondary" style="font-size: 0.75rem;">Role: {{ Auth::user()->role ?? 'Admin' }}</div>
            </div>
        </div>

        <div class="py-3">
            <div class="nav-header">Utama</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
            </ul>

            <div class="nav-header">Manajemen Konten</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('admin.profile.edit') }}" class="nav-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                        <i class="bi bi-person-lines-fill"></i> Profil Portfolio
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.projects.index') }}" class="nav-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                        <i class="bi bi-kanban"></i> Proyek Portfolio
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.skills.index') }}" class="nav-link {{ request()->routeIs('admin.skills.*') ? 'active' : '' }}">
                        <i class="bi bi-stars"></i> Keahlian (Skills)
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.experiences.index') }}" class="nav-link {{ request()->routeIs('admin.experiences.*') ? 'active' : '' }}">
                        <i class="bi bi-briefcase"></i> Pengalaman & Edukasi
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.messages.index') }}" class="nav-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }} d-flex justify-content-between align-items-center">
                        <div>
                            <i class="bi bi-chat-left-text"></i> Pesan Kontak
                        </div>
                        @php
                            $unreadTotal = \App\Models\Message::where('is_read', false)->count();
                        @endphp
                        @if($unreadTotal > 0)
                            <span class="badge bg-danger rounded-pill">{{ $unreadTotal }}</span>
                        @endif
                    </a>
                </li>
            </ul>

            <div class="nav-header">Sistem</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('admin.account.edit') }}" class="nav-link {{ request()->routeIs('admin.account.*') ? 'active' : '' }}">
                        <i class="bi bi-gear"></i> Pengaturan Akun
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('home') }}" target="_blank" class="nav-link">
                        <i class="bi bi-box-arrow-up-right"></i> Lihat Website
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Content Wrapper -->
    <div id="content-wrapper">
        <!-- Topbar -->
        <nav class="topbar d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-light d-lg-none border shadow-none" id="sidebarToggle" type="button">
                    <i class="bi bi-list fs-5"></i>
                </button>
                <div class="fw-bold text-dark fs-5">
                    @yield('page_title', 'Dashboard')
                </div>
            </div>

            <div class="dropdown">
                <button class="btn btn-light border-0 dropdown-toggle d-flex align-items-center gap-2 p-1 pe-3" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 36px; height: 36px;">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="text-start d-none d-sm-block">
                        <div class="small fw-bold text-dark">{{ Auth::user()->name }}</div>
                        <div class="text-muted" style="font-size: 0.7rem;">Role: {{ Auth::user()->role }}</div>
                    </div>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 mt-2">
                    <li><h6 class="dropdown-header">Akun Administrator</h6></li>
                    <li>
                        <a class="dropdown-item py-2" href="{{ route('admin.account.edit') }}">
                            <i class="bi bi-person me-2 text-primary"></i> Pengaturan Akun
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item py-2" href="{{ route('home') }}" target="_blank">
                            <i class="bi bi-globe me-2 text-success"></i> Lihat Website Portfolio
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger py-2">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Body -->
        <div class="p-4 p-md-5 flex-grow-1">
            <!-- Flash Message Alerts -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3" role="alert">
                    <div class="fw-bold mb-1"><i class="bi bi-exclamation-circle-fill me-1"></i> Terjadi beberapa kesalahan:</div>
                    <ul class="mb-0 small">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="bg-white border-top py-3 px-4 text-center text-muted small">
            &copy; {{ date('Y') }} Portfolio Web Admin System &bull; Laravel & Bootstrap 5
        </footer>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebarToggle')?.addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('active');
        });
    </script>
    @yield('scripts')
</body>
</html>
