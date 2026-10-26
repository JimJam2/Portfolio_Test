<?php

namespace Tests\Feature;

use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
        $response->assertSee('Masuk Panel Admin');
    }

    public function test_guest_is_redirected_to_login_when_accessing_admin(): void
    {
        $response = $this->get(route('admin.dashboard'));

        $response->assertRedirect(route('login'));
    }

    public function test_regular_user_cannot_access_admin_dashboard(): void
    {
        $user = User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'role' => 'user',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->actingAs($user)->get(route('admin.dashboard'));

        $response->assertStatus(403);
    }

    public function test_admin_can_access_admin_dashboard(): void
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => Hash::make('admin123'),
        ]);

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Ringkasan Dashboard');
    }

    public function test_admin_can_authenticate_via_login_form(): void
    {
        User::create([
            'name' => 'Admin Master',
            'email' => 'master@example.com',
            'role' => 'admin',
            'password' => Hash::make('secretpass'),
        ]);

        $response = $this->post(route('login.submit'), [
            'email' => 'master@example.com',
            'password' => 'secretpass',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticated();
    }

    public function test_admin_can_create_a_project(): void
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => Hash::make('admin123'),
        ]);

        $projectData = [
            'title' => 'E-Commerce Website',
            'category' => 'Web App',
            'short_description' => 'Toko online lengkap',
            'description' => 'Deskripsi panjang proyek',
            'tech_stack' => 'Laravel, Bootstrap 5, MySQL',
            'is_featured' => 1,
            'order' => 1,
        ];

        $response = $this->actingAs($admin)->post(route('admin.projects.store'), $projectData);

        $response->assertRedirect(route('admin.projects.index'));
        $this->assertDatabaseHas('projects', [
            'title' => 'E-Commerce Website',
            'slug' => 'e-commerce-website',
        ]);
    }

    public function test_admin_can_toggle_message_read_status(): void
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => Hash::make('admin123'),
        ]);

        $message = Message::create([
            'name' => 'Tester',
            'email' => 'tester@example.com',
            'subject' => 'Pertanyaan',
            'message' => 'Isi pesan pengujian',
            'is_read' => false,
        ]);

        $response = $this->actingAs($admin)->patch(route('admin.messages.toggle-read', $message->id));

        $response->assertRedirect();
        $this->assertTrue($message->fresh()->is_read);
    }
}
