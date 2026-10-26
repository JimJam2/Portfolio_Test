<?php

namespace Tests\Feature;

use App\Models\Message;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PortfolioTest extends TestCase
{
    use RefreshDatabase;

    public function test_portfolio_page_can_be_rendered(): void
    {
        Profile::create([
            'full_name' => 'Alex Pratama',
            'title' => 'Full Stack Developer',
            'bio' => 'Pengembang aplikasi Laravel dan Bootstrap.',
        ]);

        Skill::create([
            'name' => 'Laravel',
            'category' => 'Backend',
            'proficiency' => 95,
        ]);

        Project::create([
            'title' => 'Sistem HR Cloud',
            'slug' => 'sistem-hr-cloud',
            'category' => 'Web App',
            'short_description' => 'Aplikasi HR modern',
            'description' => 'Deskripsi lengkap HR',
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Alex Pratama');
        $response->assertSee('Full Stack Developer');
        $response->assertSee('Laravel');
        $response->assertSee('Sistem HR Cloud');
    }

    public function test_single_project_detail_page_can_be_viewed(): void
    {
        $project = Project::create([
            'title' => 'Portal Berita Terkini',
            'slug' => 'portal-berita-terkini',
            'category' => 'Web App',
            'short_description' => 'Portal berita cepat',
            'description' => 'Deskripsi rinci mengenai portal berita kami.',
        ]);

        $response = $this->get(route('portfolio.project', $project->slug));

        $response->assertStatus(200);
        $response->assertSee('Portal Berita Terkini');
        $response->assertSee('Deskripsi rinci mengenai portal berita kami.');
    }

    public function test_visitor_can_submit_contact_form(): void
    {
        $contactData = [
            'name' => 'Budi Client',
            'email' => 'budi@example.com',
            'subject' => 'Permintaan Penawaran Website',
            'message' => 'Halo, saya ingin membuat website portofolio untuk kantor kami.',
        ];

        $response = $this->post(route('contact.submit'), $contactData);

        $response->assertRedirect();
        $this->assertDatabaseHas('messages', [
            'email' => 'budi@example.com',
            'subject' => 'Permintaan Penawaran Website',
            'is_read' => false,
        ]);
    }

    public function test_contact_form_validates_required_fields(): void
    {
        $response = $this->post(route('contact.submit'), []);

        $response->assertSessionHasErrors(['name', 'email', 'subject', 'message']);
        $this->assertEquals(0, Message::count());
    }
}
