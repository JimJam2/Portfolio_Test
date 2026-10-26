@extends('layouts.app')

@section('title', $profile->full_name . ' - ' . $profile->title)

@section('content')
    <!-- Alerts / Flash Messages -->
    @if(session('success'))
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 1090; margin-top: 4.5rem;">
            <div class="alert alert-success alert-dismissible fade show shadow-lg border-0" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 1090; margin-top: 4.5rem;">
            <div class="alert alert-danger alert-dismissible fade show shadow-lg border-0" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-7">
                    <div class="badge-pill-custom mb-3">
                        <span class="spinner-grow spinner-grow-sm text-primary" role="status" style="width: 0.6rem; height: 0.6rem;"></span>
                        Terbuka untuk Projek & Full-time
                    </div>
                    <h1 class="hero-title mb-3">
                        Halo, Saya <span class="text-gradient">{{ $profile->full_name }}</span>
                    </h1>
                    <h4 class="text-secondary fw-semibold mb-3">
                        {{ $profile->title }}
                    </h4>
                    <p class="lead text-muted mb-4" style="font-size: 1.15rem; line-height: 1.7;">
                        {{ $profile->tagline ?? $profile->bio }}
                    </p>

                    <div class="d-flex flex-wrap gap-3 mb-4">
                        <a href="#projects" class="btn btn-primary-custom d-inline-flex align-items-center gap-2">
                            <i class="bi bi-grid-fill"></i> Jelajahi Portfolio
                        </a>
                        <a href="#contact" class="btn btn-outline-custom d-inline-flex align-items-center gap-2">
                            <i class="bi bi-chat-dots-fill text-primary"></i> Hubungi Saya
                        </a>
                        @if(!empty($profile->resume_url) && $profile->resume_url !== '#')
                            <a href="{{ $profile->resume_url }}" target="_blank" class="btn btn-outline-secondary d-inline-flex align-items-center gap-2" style="border-radius: 12px;">
                                <i class="bi bi-file-earmark-arrow-down"></i> Unduh CV
                            </a>
                        @endif
                    </div>

                    <!-- Quick Stats -->
                    <div class="row g-3 pt-3 border-top">
                        <div class="col-4">
                            <div class="fw-bold fs-3 text-dark">{{ $profile->years_of_experience }}+</div>
                            <div class="small text-muted">Tahun Pengalaman</div>
                        </div>
                        <div class="col-4 border-start ps-3">
                            <div class="fw-bold fs-3 text-dark">{{ $profile->completed_projects }}+</div>
                            <div class="small text-muted">Proyek Selesai</div>
                        </div>
                        <div class="col-4 border-start ps-3">
                            <div class="fw-bold fs-3 text-dark">{{ $profile->satisfied_clients }}+</div>
                            <div class="small text-muted">Klien Puas</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 text-center">
                    <div class="avatar-wrapper">
                        <img src="{{ $profile->avatar_url }}" alt="{{ $profile->full_name }}" class="avatar-img img-fluid">
                        <div class="floating-badge badge-1">
                            <i class="bi bi-laptop text-primary fs-5"></i>
                            <div class="text-start">
                                <div class="text-muted" style="font-size: 0.7rem;">Spesialisasi</div>
                                <div class="fw-bold text-dark">Full-Stack Laravel</div>
                            </div>
                        </div>
                        <div class="floating-badge badge-2">
                            <i class="bi bi-bootstrap-fill text-purple fs-5" style="color: #7952b3;"></i>
                            <div class="text-start">
                                <div class="text-muted" style="font-size: 0.7rem;">Frontend Stack</div>
                                <div class="fw-bold text-dark">Bootstrap 5 UI</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section-padding bg-white">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-5">
                    <div class="p-4 rounded-4 bg-light border position-relative">
                        <h5 class="fw-bold text-dark mb-4 d-flex align-items-center gap-2">
                            <i class="bi bi-person-badge text-primary fs-4"></i> Informasi Pribadi
                        </h5>
                        <ul class="list-unstyled mb-0 d-flex flex-column gap-3">
                            <li class="d-flex align-items-center gap-3">
                                <div class="bg-white p-2 rounded-3 border text-primary">
                                    <i class="bi bi-envelope"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Email</small>
                                    <span class="fw-semibold text-dark">{{ $profile->email ?? 'email@example.com' }}</span>
                                </div>
                            </li>
                            <li class="d-flex align-items-center gap-3">
                                <div class="bg-white p-2 rounded-3 border text-primary">
                                    <i class="bi bi-telephone"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Telepon / WhatsApp</small>
                                    <span class="fw-semibold text-dark">{{ $profile->phone ?? '+62 812-xxxx-xxxx' }}</span>
                                </div>
                            </li>
                            <li class="d-flex align-items-center gap-3">
                                <div class="bg-white p-2 rounded-3 border text-primary">
                                    <i class="bi bi-geo-alt"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Domisili</small>
                                    <span class="fw-semibold text-dark">{{ $profile->location ?? 'Indonesia' }}</span>
                                </div>
                            </li>
                            <li class="d-flex align-items-center gap-3">
                                <div class="bg-white p-2 rounded-3 border text-primary">
                                    <i class="bi bi-briefcase"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Status Ketersediaan</small>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle">Tersedia untuk Kontrak / Remote</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="section-subtitle">Tentang Saya</div>
                    <h2 class="section-title mb-4">Menggabungkan Arsitektur Backend yang Kuat dengan Desain Antarmuka yang Elegan</h2>
                    
                    <p class="text-muted mb-4 lead" style="font-size: 1.05rem;">
                        {{ $profile->bio }}
                    </p>

                    @if(!empty($profile->about_details))
                        <p class="text-muted mb-4">
                            {{ $profile->about_details }}
                        </p>
                    @endif

                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="p-3 bg-light rounded-3 border">
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <i class="bi bi-check2-circle text-primary fs-5"></i>
                                    <span class="fw-bold text-dark">Clean & Testable Code</span>
                                </div>
                                <small class="text-muted">Menerapkan prinsip SOLID, DRY, dan automated testing.</small>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-3 bg-light rounded-3 border">
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <i class="bi bi-check2-circle text-primary fs-5"></i>
                                    <span class="fw-bold text-dark">User-Centered Design</span>
                                </div>
                                <small class="text-muted">Antarmuka rapi, intuitif, dan optimal di seluruh perangkat.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="section-padding bg-light">
        <div class="container">
            <div class="section-header text-center mx-auto" style="max-width: 650px;">
                <div class="section-subtitle">Keahlian Teknis</div>
                <h2 class="section-title">Teknologi & Tools yang Dikuasai</h2>
                <p class="text-muted">Keahlian yang saya gunakan sehari-hari untuk mengembangkan aplikasi web berskala produksi.</p>
            </div>

            <!-- Skills Grouped By Category -->
            <div class="row g-4">
                @foreach($skillCategories as $cat)
                    <div class="col-lg-4 col-md-6">
                        <div class="card card-custom h-100 p-4 border-0 shadow-sm">
                            <h5 class="fw-bold text-dark mb-3 pb-2 border-bottom d-flex align-items-center justify-content-between">
                                <span>{{ $cat }}</span>
                                <span class="badge bg-primary-subtle text-primary">{{ $skills->where('category', $cat)->count() }} Skill</span>
                            </h5>
                            <div class="d-flex flex-column gap-3">
                                @foreach($skills->where('category', $cat) as $skill)
                                    <div>
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span class="fw-semibold text-dark small d-flex align-items-center gap-2">
                                                @if(!empty($skill->icon))
                                                    <i class="{{ $skill->icon }} text-primary"></i>
                                                @else
                                                    <i class="bi bi-check text-primary"></i>
                                                @endif
                                                {{ $skill->name }}
                                            </span>
                                            <span class="small fw-bold text-primary">{{ $skill->proficiency }}%</span>
                                        </div>
                                        <div class="progress" style="height: 7px; background-color: #e2e8f0; border-radius: 10px;">
                                            <div class="progress-bar" role="progressbar" style="width: {{ $skill->proficiency }}%; background: linear-gradient(90deg, #4f46e5, #06b6d4); border-radius: 10px;" aria-valuenow="{{ $skill->proficiency }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="section-padding bg-white">
        <div class="container">
            <div class="section-header text-center mx-auto" style="max-width: 650px;">
                <div class="section-subtitle">Layanan Unggulan</div>
                <h2 class="section-title">Apa yang Bisa Saya Kerjakan</h2>
                <p class="text-muted">Solusi komprehensif mulai dari konsep, pengembangan arsitektur, hingga implementasi siap pakai.</p>
            </div>

            <div class="row g-4">
                @forelse($services as $service)
                    <div class="col-lg-3 col-md-6">
                        <div class="card card-custom h-100 p-4 border text-start">
                            <div class="rounded-3 bg-primary-subtle text-primary p-3 d-inline-flex align-items-center justify-content-center mb-4" style="width: 56px; height: 56px;">
                                <i class="{{ $service->icon }} fs-3"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-2">{{ $service->title }}</h5>
                            <p class="text-muted small mb-0">{{ $service->description }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted">Belum ada data layanan.</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Portfolio / Projects Showcase Section -->
    <section id="projects" class="section-padding bg-light">
        <div class="container">
            <div class="section-header text-center mx-auto" style="max-width: 650px;">
                <div class="section-subtitle">Portfolio Terpilih</div>
                <h2 class="section-title">Karya & Proyek Terkini</h2>
                <p class="text-muted">Beberapa proyek web application dan sistem informasi yang telah saya selesaikan.</p>

                <!-- Category Filters -->
                <div class="d-flex flex-wrap justify-content-center gap-2 mt-4" id="projectFilters">
                    <button type="button" class="filter-btn active" data-filter="all">Semua Proyek</button>
                    @foreach($projectCategories as $cat)
                        <button type="button" class="filter-btn" data-filter="{{ Str::slug($cat) }}">{{ $cat }}</button>
                    @endforeach
                </div>
            </div>

            <div class="row g-4" id="projectsContainer">
                @forelse($projects as $project)
                    <div class="col-lg-4 col-md-6 project-item" data-category="{{ Str::slug($project->category) }}">
                        <div class="card card-custom h-100 overflow-hidden border-0 shadow-sm">
                            <div class="position-relative overflow-hidden" style="height: 220px;">
                                <img src="{{ $project->thumbnail_url }}" alt="{{ $project->title }}" class="w-100 h-100 object-fit-cover" style="transition: transform 0.4s ease;">
                                <div class="position-absolute top-0 start-0 m-3">
                                    <span class="badge bg-dark bg-opacity-75 backdrop-blur px-3 py-2 text-white fw-semibold rounded-pill small">
                                        {{ $project->category }}
                                    </span>
                                </div>
                            </div>
                            <div class="card-body p-4 d-flex flex-column">
                                <h5 class="card-title fw-bold text-dark mb-2">
                                    <a href="{{ route('portfolio.project', $project->slug) }}" class="text-decoration-none text-dark hover-primary">
                                        {{ $project->title }}
                                    </a>
                                </h5>
                                <p class="card-text text-muted small mb-3 flex-grow-1">
                                    {{ Str::limit($project->short_description ?? $project->description, 110) }}
                                </p>

                                <!-- Tech Stack Badges -->
                                <div class="d-flex flex-wrap gap-1 mb-4">
                                    @foreach($project->tech_tags as $tag)
                                        <span class="badge bg-light text-secondary border small">{{ $tag }}</span>
                                    @endforeach
                                </div>

                                <div class="d-flex align-items-center justify-content-between pt-3 border-top mt-auto">
                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#projectModal{{ $project->id }}">
                                        <i class="bi bi-eye"></i> Detail
                                    </button>
                                    <div class="d-flex gap-2">
                                        @if(!empty($project->github_url))
                                            <a href="{{ $project->github_url }}" target="_blank" class="btn btn-sm btn-outline-secondary" title="Source Code">
                                                <i class="bi bi-github"></i>
                                            </a>
                                        @endif
                                        @if(!empty($project->demo_url))
                                            <a href="{{ $project->demo_url }}" target="_blank" class="btn btn-sm btn-primary" title="Live Demo">
                                                <i class="bi bi-box-arrow-up-right"></i> Demo
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Project Detail Modal -->
                    <div class="modal fade" id="projectModal{{ $project->id }}" tabindex="-1" aria-labelledby="projectModalLabel{{ $project->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content rounded-4 border-0 overflow-hidden shadow-lg">
                                <div class="modal-header border-bottom">
                                    <h5 class="modal-title fw-bold" id="projectModalLabel{{ $project->id }}">{{ $project->title }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-4">
                                    <img src="{{ $project->thumbnail_url }}" alt="{{ $project->title }}" class="img-fluid rounded-3 mb-4 w-100" style="max-height: 350px; object-fit: cover;">
                                    
                                    <div class="row g-3 mb-4">
                                        <div class="col-sm-4">
                                            <small class="text-muted d-block">Kategori</small>
                                            <span class="fw-semibold text-dark">{{ $project->category }}</span>
                                        </div>
                                        <div class="col-sm-4">
                                            <small class="text-muted d-block">Klien / Institusi</small>
                                            <span class="fw-semibold text-dark">{{ $project->client ?? 'Internal / Demo' }}</span>
                                        </div>
                                        <div class="col-sm-4">
                                            <small class="text-muted d-block">Waktu Penyelesaian</small>
                                            <span class="fw-semibold text-dark">{{ $project->completed_date ?? '-' }}</span>
                                        </div>
                                    </div>

                                    <h6 class="fw-bold text-dark">Deskripsi Proyek</h6>
                                    <p class="text-muted">{{ $project->description }}</p>

                                    <h6 class="fw-bold text-dark mt-4">Teknologi yang Digunakan</h6>
                                    <div class="d-flex flex-wrap gap-1 mb-4">
                                        @foreach($project->tech_tags as $tag)
                                            <span class="badge bg-primary-subtle text-primary px-3 py-2">{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="modal-footer bg-light border-0">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    @if(!empty($project->github_url))
                                        <a href="{{ $project->github_url }}" target="_blank" class="btn btn-outline-dark">
                                            <i class="bi bi-github me-1"></i> Repository
                                        </a>
                                    @endif
                                    @if(!empty($project->demo_url))
                                        <a href="{{ $project->demo_url }}" target="_blank" class="btn btn-primary">
                                            <i class="bi bi-box-arrow-up-right me-1"></i> Kunjungi Live Demo
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted py-5">Belum ada proyek yang ditampilkan.</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Experience & Education Section -->
    <section id="experience" class="section-padding bg-white">
        <div class="container">
            <div class="section-header text-center mx-auto" style="max-width: 650px;">
                <div class="section-subtitle">Perjalanan Karir</div>
                <h2 class="section-title">Pengalaman & Pendidikan</h2>
                <p class="text-muted">Jejak profesional dan latar belakang akademik dalam dunia rekayasa perangkat lunak.</p>
            </div>

            <div class="row g-5">
                <!-- Work Experience -->
                <div class="col-lg-6">
                    <div class="d-flex align-items-center gap-2 mb-4">
                        <div class="bg-primary-subtle text-primary p-2 rounded-3">
                            <i class="bi bi-briefcase-fill fs-4"></i>
                        </div>
                        <h4 class="fw-bold text-dark mb-0">Pengalaman Kerja</h4>
                    </div>

                    <div class="timeline">
                        @forelse($workExperiences as $work)
                            <div class="timeline-item">
                                <div class="timeline-dot"></div>
                                <div class="card card-custom p-4 border">
                                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-1">
                                        <h5 class="fw-bold text-dark mb-0">{{ $work->position }}</h5>
                                        <span class="badge bg-primary-subtle text-primary rounded-pill small">{{ $work->period }}</span>
                                    </div>
                                    <div class="text-secondary fw-semibold small mb-2">
                                        <i class="bi bi-building me-1"></i> {{ $work->company }}
                                        @if($work->location)
                                            <span class="ms-2"><i class="bi bi-geo-alt me-1"></i> {{ $work->location }}</span>
                                        @endif
                                    </div>
                                    @if($work->description)
                                        <p class="text-muted small mb-0">{{ $work->description }}</p>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">Belum ada riwayat pengalaman kerja.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Education -->
                <div class="col-lg-6">
                    <div class="d-flex align-items-center gap-2 mb-4">
                        <div class="bg-primary-subtle text-primary p-2 rounded-3">
                            <i class="bi bi-mortarboard-fill fs-4"></i>
                        </div>
                        <h4 class="fw-bold text-dark mb-0">Pendidikan</h4>
                    </div>

                    <div class="timeline">
                        @forelse($educations as $edu)
                            <div class="timeline-item">
                                <div class="timeline-dot" style="background: #06b6d4;"></div>
                                <div class="card card-custom p-4 border">
                                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-1">
                                        <h5 class="fw-bold text-dark mb-0">{{ $edu->position }}</h5>
                                        <span class="badge bg-info-subtle text-info-emphasis rounded-pill small">{{ $edu->period }}</span>
                                    </div>
                                    <div class="text-secondary fw-semibold small mb-2">
                                        <i class="bi bi-bank me-1"></i> {{ $edu->company }}
                                        @if($edu->location)
                                            <span class="ms-2"><i class="bi bi-geo-alt me-1"></i> {{ $edu->location }}</span>
                                        @endif
                                    </div>
                                    @if($edu->description)
                                        <p class="text-muted small mb-0">{{ $edu->description }}</p>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">Belum ada riwayat pendidikan.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="section-padding bg-light">
        <div class="container">
            <div class="section-header text-center mx-auto" style="max-width: 650px;">
                <div class="section-subtitle">Mari Berkolaborasi</div>
                <h2 class="section-title">Hubungi Saya</h2>
                <p class="text-muted">Punya ide proyek, tawaran kerja, atau ingin berdiskusi? Kirimkan pesan melalui form di bawah ini.</p>
            </div>

            <div class="row g-5">
                <div class="col-lg-5">
                    <div class="card card-custom p-4 p-lg-5 border-0 shadow-sm h-100 bg-white">
                        <h4 class="fw-bold text-dark mb-3">Informasi Kontak</h4>
                        <p class="text-muted mb-4">
                            Saya senang berdiskusi seputar peluang baru, konsultasi arsitektur aplikasi web, maupun kerja sama tim.
                        </p>

                        <div class="d-flex flex-column gap-4 mb-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-primary-subtle text-primary p-3 rounded-circle">
                                    <i class="bi bi-envelope-at fs-4"></i>
                                </div>
                                <div>
                                    <span class="text-muted small d-block">Kirim Email ke</span>
                                    <a href="mailto:{{ $profile->email }}" class="fw-bold text-dark text-decoration-none">
                                        {{ $profile->email ?? 'alex.pratama@example.com' }}
                                    </a>
                                </div>
                            </div>

                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-primary-subtle text-primary p-3 rounded-circle">
                                    <i class="bi bi-whatsapp fs-4"></i>
                                </div>
                                <div>
                                    <span class="text-muted small d-block">WhatsApp / Telepon</span>
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $profile->phone ?? '') }}" target="_blank" class="fw-bold text-dark text-decoration-none">
                                        {{ $profile->phone ?? '+62 812-3456-7890' }}
                                    </a>
                                </div>
                            </div>

                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-primary-subtle text-primary p-3 rounded-circle">
                                    <i class="bi bi-geo-alt-fill fs-4"></i>
                                </div>
                                <div>
                                    <span class="text-muted small d-block">Lokasi</span>
                                    <span class="fw-bold text-dark">{{ $profile->location ?? 'Jakarta, Indonesia' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="pt-4 border-top mt-auto">
                            <span class="text-muted small d-block mb-2">Ikuti Profil Sosial Media:</span>
                            <div class="d-flex gap-2">
                                @if(!empty($profile->github_url))
                                    <a href="{{ $profile->github_url }}" target="_blank" class="btn btn-outline-dark btn-sm rounded-circle" style="width:36px;height:36px;display:flex;align-items:center;justify-content:center;">
                                        <i class="bi bi-github"></i>
                                    </a>
                                @endif
                                @if(!empty($profile->linkedin_url))
                                    <a href="{{ $profile->linkedin_url }}" target="_blank" class="btn btn-outline-primary btn-sm rounded-circle" style="width:36px;height:36px;display:flex;align-items:center;justify-content:center;">
                                        <i class="bi bi-linkedin"></i>
                                    </a>
                                @endif
                                @if(!empty($profile->instagram_url))
                                    <a href="{{ $profile->instagram_url }}" target="_blank" class="btn btn-outline-danger btn-sm rounded-circle" style="width:36px;height:36px;display:flex;align-items:center;justify-content:center;">
                                        <i class="bi bi-instagram"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="card card-custom p-4 p-lg-5 border-0 shadow-sm bg-white">
                        <h4 class="fw-bold text-dark mb-4">Kirim Pesan Langsung</h4>

                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf

                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0 small">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label fw-semibold small">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control rounded-3 p-3 @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Contoh: Budi Pratama" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-semibold small">Alamat Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control rounded-3 p-3 @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="subject" class="form-label fw-semibold small">Subjek / Topik <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control rounded-3 p-3 @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{ old('subject') }}" placeholder="Misal: Penawaran Pembuatan Website Sistem CRM" required>
                                    @error('subject')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="message" class="form-label fw-semibold small">Isi Pesan <span class="text-danger">*</span></label>
                                    <textarea class="form-control rounded-3 p-3 @error('message') is-invalid @enderror" id="message" name="message" rows="5" placeholder="Tuliskan detail kebutuhan atau pertanyaan Anda di sini..." required>{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-primary-custom w-100 py-3 d-flex align-items-center justify-content-center gap-2">
                                        <i class="bi bi-send-fill"></i> Kirim Pesan Sekarang
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    // Project filter logic
    document.addEventListener('DOMContentLoaded', function () {
        const filterButtons = document.querySelectorAll('#projectFilters .filter-btn');
        const projectItems = document.querySelectorAll('#projectsContainer .project-item');

        filterButtons.forEach(button => {
            button.addEventListener('click', function () {
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                const filterValue = this.getAttribute('data-filter');

                projectItems.forEach(item => {
                    if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
@endsection
