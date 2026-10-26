<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProjectController extends Controller
{
    /**
     * Display a listing of projects.
     */
    public function index(Request $request): View
    {
        $query = Project::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search): void {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%")
                    ->orWhere('tech_stack', 'like', "%{$search}%");
            });
        }

        if ($category = $request->input('category')) {
            $query->where('category', $category);
        }

        $projects = $query->orderBy('order')->latest()->paginate(10)->withQueryString();
        $categories = Project::select('category')->distinct()->pluck('category');

        return view('admin.projects.index', compact('projects', 'categories'));
    }

    /**
     * Show the form for creating a new project.
     */
    public function create(): View
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created project in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'category' => ['required', 'string', 'max:100'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'thumbnail_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:3072'],
            'thumbnail_url' => ['nullable', 'string', 'max:500'],
            'tech_stack' => ['nullable', 'string', 'max:255'],
            'demo_url' => ['nullable', 'string', 'max:255'],
            'github_url' => ['nullable', 'string', 'max:255'],
            'client' => ['nullable', 'string', 'max:150'],
            'completed_date' => ['nullable', 'string', 'max:100'],
            'is_featured' => ['nullable', 'boolean'],
            'order' => ['nullable', 'integer'],
        ]);

        $baseSlug = Str::slug($validated['title']);
        $slug = $baseSlug;
        $count = 1;
        while (Project::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$count}";
            $count++;
        }
        $validated['slug'] = $slug;

        if ($request->hasFile('thumbnail_file')) {
            $validated['thumbnail'] = $request->file('thumbnail_file')->store('projects', 'public');
        } elseif (! empty($request->input('thumbnail_url'))) {
            $validated['thumbnail'] = $request->input('thumbnail_url');
        } else {
            $validated['thumbnail'] = null;
        }

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['order'] = $validated['order'] ?? 0;

        unset($validated['thumbnail_file'], $validated['thumbnail_url']);

        Project::create($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Proyek baru berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified project.
     */
    public function edit(Project $project): View
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified project in storage.
     */
    public function update(Request $request, Project $project): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'category' => ['required', 'string', 'max:100'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'thumbnail_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:3072'],
            'thumbnail_url' => ['nullable', 'string', 'max:500'],
            'tech_stack' => ['nullable', 'string', 'max:255'],
            'demo_url' => ['nullable', 'string', 'max:255'],
            'github_url' => ['nullable', 'string', 'max:255'],
            'client' => ['nullable', 'string', 'max:150'],
            'completed_date' => ['nullable', 'string', 'max:100'],
            'is_featured' => ['nullable', 'boolean'],
            'order' => ['nullable', 'integer'],
        ]);

        if ($project->title !== $validated['title']) {
            $baseSlug = Str::slug($validated['title']);
            $slug = $baseSlug;
            $count = 1;
            while (Project::where('slug', $slug)->where('id', '!=', $project->id)->exists()) {
                $slug = "{$baseSlug}-{$count}";
                $count++;
            }
            $validated['slug'] = $slug;
        }

        if ($request->hasFile('thumbnail_file')) {
            if ($project->thumbnail && ! str_starts_with($project->thumbnail, 'http')) {
                Storage::disk('public')->delete($project->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail_file')->store('projects', 'public');
        } elseif ($request->filled('thumbnail_url')) {
            $validated['thumbnail'] = $request->input('thumbnail_url');
        }

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['order'] = $validated['order'] ?? 0;

        unset($validated['thumbnail_file'], $validated['thumbnail_url']);

        $project->update($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Data proyek berhasil diperbarui!');
    }

    /**
     * Remove the specified project from storage.
     */
    public function destroy(Project $project): RedirectResponse
    {
        if ($project->thumbnail && ! str_starts_with($project->thumbnail, 'http')) {
            Storage::disk('public')->delete($project->thumbnail);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil dihapus!');
    }
}
