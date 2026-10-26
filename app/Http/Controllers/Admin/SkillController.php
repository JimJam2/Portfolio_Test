<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SkillController extends Controller
{
    /**
     * Display skills management list.
     */
    public function index(): View
    {
        $skills = Skill::orderBy('category')->orderBy('order')->get();
        $categories = Skill::select('category')->distinct()->pluck('category');

        return view('admin.skills.index', compact('skills', 'categories'));
    }

    /**
     * Store a new skill.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'category' => ['required', 'string', 'max:100'],
            'proficiency' => ['required', 'integer', 'between:1,100'],
            'icon' => ['nullable', 'string', 'max:100'],
            'order' => ['nullable', 'integer'],
        ]);

        $validated['order'] = $validated['order'] ?? 0;

        Skill::create($validated);

        return redirect()->route('admin.skills.index')->with('success', 'Keahlian baru berhasil ditambahkan!');
    }

    /**
     * Update an existing skill.
     */
    public function update(Request $request, Skill $skill): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'category' => ['required', 'string', 'max:100'],
            'proficiency' => ['required', 'integer', 'between:1,100'],
            'icon' => ['nullable', 'string', 'max:100'],
            'order' => ['nullable', 'integer'],
        ]);

        $validated['order'] = $validated['order'] ?? 0;

        $skill->update($validated);

        return redirect()->route('admin.skills.index')->with('success', 'Keahlian berhasil diperbarui!');
    }

    /**
     * Delete a skill.
     */
    public function destroy(Skill $skill): RedirectResponse
    {
        $skill->delete();

        return redirect()->route('admin.skills.index')->with('success', 'Keahlian berhasil dihapus!');
    }
}
