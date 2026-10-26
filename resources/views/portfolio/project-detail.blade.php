@extends('layouts.app')

@section('title', $project->title . ' - Detail Portfolio')

@section('content')
<section class="section-padding" style="padding-top: 7.5rem; background: #f8fafc;">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('home') }}#projects" class="text-decoration-none">Portfolio</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $project->title }}</li>
            </ol>
        </nav>

        <div class="row g-5">
            <div class="col-lg-8">
                <div class="card card-custom p-4 border-0 shadow-sm bg-white mb-4">
                    <div class="mb-3">
                        <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-semibold">{{ $project->category }}</span>
                    </div>
                    <h1 class="fw-bold text-dark mb-3">{{ $project->title }}</h1>
                    
                    <div class="rounded-4 overflow-hidden mb-4 border">
                        <img src="{{ $project->thumbnail_url }}" alt="{{ $project->title }}" class="img-fluid w-100" style="max-height: 480px; object-fit: cover;">
                    </div>

                    <h4 class="fw-bold text-dark mb-3">Deskripsi Lengkap</h4>
                    <div class="text-secondary leading-relaxed mb-4" style="font-size: 1.05rem; line-height: 1.8;">
                        {!! nl2br(e($project->description ?? $project->short_description)) !!}
                    </div>

                    <h5 class="fw-bold text-dark mb-3">Teknologi & Tools</h5>
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        @foreach($project->tech_tags as $tag)
                            <span class="badge bg-light text-dark border px-3 py-2 fs-6 fw-medium">
                                <i class="bi bi-tag-fill text-primary me-1"></i> {{ $tag }}
                            </span>
                        @endforeach
                    </div>

                    <div class="d-flex flex-wrap gap-3 pt-3 border-top">
                        @if(!empty($project->demo_url))
                            <a href="{{ $project->demo_url }}" target="_blank" class="btn btn-primary-custom d-inline-flex align-items-center gap-2">
                                <i class="bi bi-box-arrow-up-right"></i> Kunjungi Live Demo
                            </a>
                        @endif
                        @if(!empty($project->github_url))
                            <a href="{{ $project->github_url }}" target="_blank" class="btn btn-outline-dark d-inline-flex align-items-center gap-2" style="border-radius: 12px; padding: 0.75rem 1.75rem;">
                                <i class="bi bi-github"></i> Source Code
                            </a>
                        @endif
                        <a href="{{ route('home') }}#projects" class="btn btn-outline-secondary d-inline-flex align-items-center gap-2" style="border-radius: 12px; padding: 0.75rem 1.75rem;">
                            <i class="bi bi-arrow-left"></i> Kembali ke Portfolio
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card card-custom p-4 border-0 shadow-sm bg-white mb-4">
                    <h5 class="fw-bold text-dark mb-3 border-bottom pb-2">Informasi Proyek</h5>
                    <ul class="list-unstyled mb-0 d-flex flex-column gap-3 small">
                        <li>
                            <span class="text-muted d-block">Klien / Organisasi:</span>
                            <span class="fw-bold text-dark fs-6">{{ $project->client ?? 'Internal / Open Source' }}</span>
                        </li>
                        <li>
                            <span class="text-muted d-block">Tanggal Penyelesaian:</span>
                            <span class="fw-bold text-dark fs-6">{{ $project->completed_date ?? 'Terselesaikan' }}</span>
                        </li>
                        <li>
                            <span class="text-muted d-block">Kategori:</span>
                            <span class="fw-bold text-dark fs-6">{{ $project->category }}</span>
                        </li>
                    </ul>
                </div>

                @if($relatedProjects->count() > 0)
                    <div class="card card-custom p-4 border-0 shadow-sm bg-white">
                        <h5 class="fw-bold text-dark mb-3 border-bottom pb-2">Proyek Lainnya</h5>
                        <div class="d-flex flex-column gap-3">
                            @foreach($relatedProjects as $rel)
                                <div class="d-flex gap-3 align-items-center">
                                    <img src="{{ $rel->thumbnail_url }}" alt="{{ $rel->title }}" class="rounded-3 object-fit-cover" style="width: 70px; height: 55px;">
                                    <div>
                                        <h6 class="mb-1 fw-bold">
                                            <a href="{{ route('portfolio.project', $rel->slug) }}" class="text-decoration-none text-dark hover-primary small">
                                                {{ Str::limit($rel->title, 35) }}
                                            </a>
                                        </h6>
                                        <span class="badge bg-light text-muted border" style="font-size: 0.7rem;">{{ $rel->category }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
