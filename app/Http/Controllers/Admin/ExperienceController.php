<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExperienceController extends Controller
{
    /**
     * Display a listing of experiences & education.
     */
    public function index(): View
    {
        $experiences = Experience::where('type', 'experience')->orderBy('order')->get();
        $educations = Experience::where('type', 'education')->orderBy('order')->get();

        return view('admin.experiences.index', compact('experiences', 'educations'));
    }

    /**
     * Store a newly created experience or education.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'type' => ['required', 'in:experience,education'],
            'position' => ['required', 'string', 'max:150'],
            'company' => ['required', 'string', 'max:150'],
            'period' => ['required', 'string', 'max:100'],
            'location' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'order' => ['nullable', 'integer'],
        ]);

        $validated['order'] = $validated['order'] ?? 0;

        Experience::create($validated);

        return redirect()->route('admin.experiences.index')->with('success', 'Riwayat berhasil ditambahkan!');
    }

    /**
     * Update the specified experience or education.
     */
    public function update(Request $request, Experience $experience): RedirectResponse
    {
        $validated = $request->validate([
            'type' => ['required', 'in:experience,education'],
            'position' => ['required', 'string', 'max:150'],
            'company' => ['required', 'string', 'max:150'],
            'period' => ['required', 'string', 'max:100'],
            'location' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'order' => ['nullable', 'integer'],
        ]);

        $validated['order'] = $validated['order'] ?? 0;

        $experience->update($validated);

        return redirect()->route('admin.experiences.index')->with('success', 'Riwayat berhasil diperbarui!');
    }

    /**
     * Remove the specified experience.
     */
    public function destroy(Experience $experience): RedirectResponse
    {
        $experience->delete();

        return redirect()->route('admin.experiences.index')->with('success', 'Riwayat berhasil dihapus!');
    }
}
