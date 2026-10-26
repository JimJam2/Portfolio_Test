<?php

namespace Database\Seeders;

use App\Models\Experience;
use App\Models\Message;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Admin User
        User::updateOrCreate(
            ['email' => 'admin@portfolio.test'],
            [
                'name' => 'Administrator',
                'role' => 'admin',
                'password' => Hash::make('admin123'),
            ]
        );

        // 2. Create Regular Demo User
        User::updateOrCreate(
            ['email' => 'user@portfolio.test'],
            [
                'name' => 'John Doe',
                'role' => 'user',
                'password' => Hash::make('password123'),
            ]
        );

        // 3. Create or Update Portfolio Profile
        Profile::updateOrCreate(
            ['id' => 1],
            [
                'full_name' => 'Alex Pratama',
                'title' => 'Senior Full Stack Developer & UI/UX Specialist',
                'tagline' => 'Membangun Solusi Web Modern, Terstruktur, dan Berperforma Tinggi dengan Laravel & Bootstrap',
                'bio' => 'Halo! Saya Alex Pratama, seorang Software Engineer yang berfokus pada pengembangan aplikasi web modern yang cepat, aman, dan mudah diskalakan. Berpengalaman dalam arsitektur backend Laravel, integrasi database, dan desain antarmuka yang bersih serta responsif.',
                'about_details' => 'Dengan pengalaman lebih dari 4 tahun di industri pengembangan perangkat lunak, saya terbiasa menangani siklus hidup pengembangan sistem secara menyeluruh—mulai dari riset kebutuhan, pemodelan database, pembuatan RESTful API, hingga implementasi antarmuka Bootstrap yang ramah pengguna. Saya percaya bahwa kode yang bersih dan user experience yang baik adalah kunci kesuksesan produk digital.',
                'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=700&q=80',
                'email' => 'alex.pratama@example.com',
                'phone' => '+62 812-3456-7890',
                'location' => 'Jakarta, Indonesia',
                'resume_url' => '#',
                'github_url' => 'https://github.com',
                'linkedin_url' => 'https://linkedin.com',
                'instagram_url' => 'https://instagram.com',
                'years_of_experience' => 4,
                'completed_projects' => 38,
                'satisfied_clients' => 25,
            ]
        );

        // 4. Skills
        $skills = [
            ['name' => 'Laravel Framework', 'category' => 'Backend', 'proficiency' => 95, 'icon' => 'bi bi-hdd-rack', 'order' => 1],
            ['name' => 'PHP 8.x', 'category' => 'Backend', 'proficiency' => 92, 'icon' => 'bi bi-filetype-php', 'order' => 2],
            ['name' => 'RESTful API & Sanctum', 'category' => 'Backend', 'proficiency' => 90, 'icon' => 'bi bi-link-45deg', 'order' => 3],
            ['name' => 'MySQL & Database Design', 'category' => 'Backend', 'proficiency' => 88, 'icon' => 'bi bi-database', 'order' => 4],
            ['name' => 'Bootstrap 5', 'category' => 'Frontend', 'proficiency' => 96, 'icon' => 'bi bi-bootstrap', 'order' => 5],
            ['name' => 'JavaScript (ES6+) & AJAX', 'category' => 'Frontend', 'proficiency' => 86, 'icon' => 'bi bi-filetype-js', 'order' => 6],
            ['name' => 'HTML5 & Modern CSS3', 'category' => 'Frontend', 'proficiency' => 95, 'icon' => 'bi bi-filetype-html', 'order' => 7],
            ['name' => 'Alpine.js / Vue.js', 'category' => 'Frontend', 'proficiency' => 82, 'icon' => 'bi bi-lightning-charge', 'order' => 8],
            ['name' => 'Git & GitHub Workflow', 'category' => 'Tools & DevOps', 'proficiency' => 92, 'icon' => 'bi bi-git', 'order' => 9],
            ['name' => 'Docker & Containerization', 'category' => 'Tools & DevOps', 'proficiency' => 78, 'icon' => 'bi bi-box-seam', 'order' => 10],
            ['name' => 'Linux Server & Nginx', 'category' => 'Tools & DevOps', 'proficiency' => 80, 'icon' => 'bi bi-terminal', 'order' => 11],
            ['name' => 'PHPUnit Testing', 'category' => 'Tools & DevOps', 'proficiency' => 85, 'icon' => 'bi bi-check2-circle', 'order' => 12],
        ];

        foreach ($skills as $skill) {
            Skill::updateOrCreate(['name' => $skill['name']], $skill);
        }

        // 5. Services
        $services = [
            [
                'title' => 'Web Application Development',
                'icon' => 'bi bi-laptop',
                'description' => 'Membangun aplikasi web full-stack kustom berbasis Laravel dengan arsitektur MVC yang solid, clean code, dan mudah di-maintain.',
                'order' => 1,
            ],
            [
                'title' => 'REST API & System Integration',
                'icon' => 'bi bi-diagram-3',
                'description' => 'Pembuatan RESTful API berperforma tinggi dengan token authentication, rate limiting, dan dokumentasi lengkap untuk web & mobile.',
                'order' => 2,
            ],
            [
                'title' => 'Responsive UI/UX Frontend',
                'icon' => 'bi bi-palette',
                'description' => 'Implementasi antarmuka yang elegan, responsif di semua perangkat (desktop, tablet, smartphone) menggunakan Bootstrap 5 terkini.',
                'order' => 3,
            ],
            [
                'title' => 'Database & Performance Tuning',
                'icon' => 'bi bi-speedometer2',
                'description' => 'Optimasi query database, indeks tabel, caching Redis, serta peningkatan kecepatan load time untuk skala traffic tinggi.',
                'order' => 4,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(['title' => $service['title']], $service);
        }

        // 6. Projects
        $projects = [
            [
                'title' => 'SaaS HR & Payroll Cloud System',
                'slug' => 'saas-hr-payroll-cloud-system',
                'category' => 'Web App',
                'short_description' => 'Sistem manajemen SDM multi-tenant lengkap dengan absensi online, otomatisasi payroll, dan KPI tracking.',
                'description' => 'Platform SaaS HR terpadu yang membantu perusahaan mengelola absensi karyawan berbasis geolokasi, perhitungan gaji otomatis dengan komponen pajak PPh21, manajemen cuti, serta evaluasi performa kinerja berkala.',
                'thumbnail' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80',
                'tech_stack' => 'Laravel 11, Bootstrap 5, MySQL, Chart.js, Export Excel',
                'demo_url' => 'https://example.com/demo-hr',
                'github_url' => 'https://github.com/example/hr-system',
                'client' => 'PT Prima Solusi Mandiri',
                'completed_date' => 'Januari 2025',
                'is_featured' => true,
                'order' => 1,
            ],
            [
                'title' => 'E-Commerce Fashion & Apparel Store',
                'slug' => 'ecommerce-fashion-apparel-store',
                'category' => 'E-Commerce',
                'short_description' => 'Platform toko online modern dengan integrasi payment gateway Midtrans dan kurir otomatis (RajaOngkir).',
                'description' => 'Toko daring yang dirancang untuk kenyamanan belanja busana terkini. Mendukung multi varian produk, cart real-time, perhitungan ongkos kirim otomatis ke seluruh Indonesia, dan pembayaran instan via Virtual Account, QRIS, & E-Wallet.',
                'thumbnail' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&w=800&q=80',
                'tech_stack' => 'Laravel, Bootstrap 5, Midtrans API, RajaOngkir, MySQL',
                'demo_url' => 'https://example.com/demo-shop',
                'github_url' => 'https://github.com/example/fashion-shop',
                'client' => 'UrbanStyle Indonesia',
                'completed_date' => 'Desember 2024',
                'is_featured' => true,
                'order' => 2,
            ],
            [
                'title' => 'Digital Portal Berita & Publishing CMS',
                'slug' => 'digital-portal-berita-publishing-cms',
                'category' => 'Web App',
                'short_description' => 'Platform portal berita multi-kategori dengan panel redaksi custom dan optimasi SEO terdepan.',
                'description' => 'Sistem manajemen berita berskala tinggi dengan fitur manajemen artikel multi-penulis, approval redaktur, penempatan iklan otomatis, komentar terfilter, dan kecepatan loading di bawah 1 detik dengan caching server.',
                'thumbnail' => 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?auto=format&fit=crop&w=800&q=80',
                'tech_stack' => 'Laravel, Bootstrap 5, TinyMCE, Redis Cache, SEO Schema',
                'demo_url' => 'https://example.com/demo-news',
                'github_url' => 'https://github.com/example/news-cms',
                'client' => 'Kabar Nusantara Media',
                'completed_date' => 'November 2024',
                'is_featured' => true,
                'order' => 3,
            ],
            [
                'title' => 'Sistem Rekam Medis & Reservasi Klinik (SIMRS)',
                'slug' => 'sistem-rekam-medis-reservasi-klinik',
                'category' => 'Web App',
                'short_description' => 'Aplikasi informasi medis, antrean pasien online, dan resep digital untuk klinik spesialis.',
                'description' => 'Aplikasi operasional klinik yang menghubungkan resepsionis, dokter, apotek, dan kasir dalam satu aliran data yang rapi dan terenkripsi. Pasien juga dapat membooking nomor antrean secara online.',
                'thumbnail' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=800&q=80',
                'tech_stack' => 'Laravel, Bootstrap 5, DataTables, PDF Generation, SQLite',
                'demo_url' => 'https://example.com/demo-medis',
                'github_url' => 'https://github.com/example/sim-klinik',
                'client' => 'Klinik Medika Sehati',
                'completed_date' => 'September 2024',
                'is_featured' => true,
                'order' => 4,
            ],
            [
                'title' => 'Fleet Logistics Tracking Dashboard',
                'slug' => 'fleet-logistics-tracking-dashboard',
                'category' => 'Dashboard',
                'short_description' => 'Dashboard monitoring posisi dan pengiriman armada logistik secara realtime dengan peta interaktif.',
                'description' => 'Antarmuka monitoring operasional armada logistik yang menampilkan status kendaraan secara visual, konsumsi bahan bakar, estimasi waktu tiba (ETA), serta peringatan darurat otomatis.',
                'thumbnail' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=800&q=80',
                'tech_stack' => 'Laravel, Bootstrap 5, Leaflet JS, WebSockets, Chart.js',
                'demo_url' => 'https://example.com/demo-fleet',
                'github_url' => 'https://github.com/example/fleet-dashboard',
                'client' => 'TransLogistik Express',
                'completed_date' => 'Agustus 2024',
                'is_featured' => true,
                'order' => 5,
            ],
            [
                'title' => 'Auth & Microservices API Gateway',
                'slug' => 'auth-microservices-api-gateway',
                'category' => 'API / Backend',
                'short_description' => 'Gateway autentikasi terpusat dan perutean API aman untuk ekosistem aplikasi mobile & partner.',
                'description' => 'Layanan backend berkinerja tinggi yang menangani autentikasi pengguna tunggal (Single Sign-On / SSO) via OAuth2 dan Laravel Sanctum, dilengkapi rate limit cerdas, log audit keamanan, dan health check endpoint.',
                'thumbnail' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=800&q=80',
                'tech_stack' => 'Laravel, Sanctum, Redis, Docker, Swagger / OpenAPI',
                'demo_url' => 'https://example.com/api-docs',
                'github_url' => 'https://github.com/example/api-gateway',
                'client' => 'FinTech Digital Solusindo',
                'completed_date' => 'Juni 2024',
                'is_featured' => true,
                'order' => 6,
            ],
        ];

        foreach ($projects as $project) {
            Project::updateOrCreate(['slug' => $project['slug']], $project);
        }

        // 7. Experiences & Education
        $experiences = [
            [
                'type' => 'experience',
                'position' => 'Lead Full-Stack Web Developer',
                'company' => 'PT Digital Solusi Nusantara',
                'period' => '2023 - Sekarang',
                'location' => 'Jakarta, Indonesia',
                'description' => 'Memimpin tim engineering yang terdiri dari 5 developer dalam merancang dan mengembangkan produk web enterprise berbasis Laravel. Menginisiasi standarisasi arsitektur kode dan CI/CD pipeline.',
                'order' => 1,
            ],
            [
                'type' => 'experience',
                'position' => 'Senior Backend Developer',
                'company' => 'Inovasi Teknologi Mandiri',
                'period' => '2021 - 2023',
                'location' => 'Bandung, Indonesia',
                'description' => 'Bertanggung jawab atas core backend API untuk aplikasi e-commerce dan integrasi payment gateway. Mengoptimalkan query database yang meningkatkan responsivitas sistem hingga 40%.',
                'order' => 2,
            ],
            [
                'type' => 'experience',
                'position' => 'Junior Web Developer',
                'company' => 'Creative Studio Web',
                'period' => '2020 - 2021',
                'location' => 'Jakarta, Indonesia',
                'description' => 'Mengembangkan puluhan landing page dan website profil perusahaan responsif menggunakan Bootstrap, PHP, dan MySQL.',
                'order' => 3,
            ],
            [
                'type' => 'education',
                'position' => 'S1 Teknik Informatika (Bachelor of CS)',
                'company' => 'Universitas Indonesia',
                'period' => '2016 - 2020',
                'location' => 'Depok, Jawa Barat',
                'description' => 'Lulus dengan predikat Sangat Memuaskan. Aktif dalam riset Rekayasa Perangkat Lunak dan memenangkan kompetisi Hackathon tingkat nasional.',
                'order' => 4,
            ],
        ];

        foreach ($experiences as $exp) {
            Experience::updateOrCreate(
                ['position' => $exp['position'], 'company' => $exp['company']],
                $exp
            );
        }

        // 8. Sample Contact Messages
        Message::updateOrCreate(
            ['email' => 'client@perusahaan.co.id'],
            [
                'name' => 'Budi Santoso',
                'subject' => 'Tawaran Proyek Pembuatan Aplikasi ERP',
                'message' => 'Halo Alex, kami dari PT Maju Bersama tertarik dengan portfolio Anda di bidang Laravel. Kami ingin mendiskusikan kemungkinan kerja sama pembuatan sistem ERP internal kantor kami.',
                'is_read' => false,
            ]
        );

        Message::updateOrCreate(
            ['email' => 'siti.rahma@startup.id'],
            [
                'name' => 'Siti Rahma',
                'subject' => 'Undangan Diskusi Tech Consultant',
                'message' => 'Selamat siang, kami melihat proyek SaaS yang Anda kerjakan dan sangat terkesan. Apakah Anda bersedia untuk sesi konsultasi arsitektur cloud untuk startup kami minggu depan?',
                'is_read' => true,
            ]
        );
    }
}
