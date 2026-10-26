<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Message;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    /**
     * Display the portfolio landing page.
     */
    public function index(): View
    {
        $profile = Profile::first() ?? new Profile([
            'full_name' => 'Portfolio Owner',
            'title' => 'Web Developer',
            'tagline' => 'Full-Stack Developer using Laravel & Bootstrap',
            'bio' => 'Selamat datang di portfolio web saya.',
            'years_of_experience' => 3,
            'completed_projects' => 20,
            'satisfied_clients' => 15,
        ]);

        $skills = Skill::orderBy('order')->orderBy('proficiency', 'desc')->get();
        $skillCategories = $skills->pluck('category')->unique()->values();

        $services = Service::orderBy('order')->get();
        $projects = Project::orderBy('order')->latest()->get();
        $projectCategories = $projects->pluck('category')->unique()->values();

        $workExperiences = Experience::where('type', 'experience')->orderBy('order')->get();
        $educations = Experience::where('type', 'education')->orderBy('order')->get();

        return view('portfolio.index', compact(
            'profile',
            'skills',
            'skillCategories',
            'services',
            'projects',
            'projectCategories',
            'workExperiences',
            'educations'
        ));
    }

    /**
     * Display single project detail.
     */
    public function project(string $slug): View
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        $relatedProjects = Project::where('id', '!=', $project->id)
            ->where('category', $project->category)
            ->take(3)
            ->get();

        if ($relatedProjects->isEmpty()) {
            $relatedProjects = Project::where('id', '!=', $project->id)->take(3)->get();
        }

        $profile = Profile::first();

        return view('portfolio.project-detail', compact('project', 'relatedProjects', 'profile'));
    }

    /**
     * Store a message from the contact form.
     */
    public function contact(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'subject' => ['required', 'string', 'max:200'],
            'message' => ['required', 'string', 'max:3000'],
        ]);

        Message::create($validated);

        return redirect()->to(url()->previous().'#contact')
            ->with('success', 'Terima kasih atas pesan Anda! Saya akan segera merespons.');
    }
}
