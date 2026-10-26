<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Show profile edit form.
     */
    public function edit(): View
    {
        $profile = Profile::firstOrCreate(
            ['id' => 1],
            [
                'full_name' => 'Portfolio Owner',
                'title' => 'Web Developer',
                'years_of_experience' => 3,
                'completed_projects' => 20,
                'satisfied_clients' => 15,
            ]
        );

        return view('admin.profile.edit', compact('profile'));
    }

    /**
     * Update portfolio profile.
     */
    public function update(Request $request): RedirectResponse
    {
        $profile = Profile::firstOrCreate(['id' => 1]);

        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:150'],
            'title' => ['required', 'string', 'max:150'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'about_details' => ['nullable', 'string'],
            'avatar_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:2048'],
            'avatar_url' => ['nullable', 'string', 'max:500'],
            'email' => ['nullable', 'email', 'max:150'],
            'phone' => ['nullable', 'string', 'max:50'],
            'location' => ['nullable', 'string', 'max:150'],
            'resume_url' => ['nullable', 'string', 'max:255'],
            'github_url' => ['nullable', 'string', 'max:255'],
            'linkedin_url' => ['nullable', 'string', 'max:255'],
            'instagram_url' => ['nullable', 'string', 'max:255'],
            'years_of_experience' => ['required', 'integer', 'min:0'],
            'completed_projects' => ['required', 'integer', 'min:0'],
            'satisfied_clients' => ['required', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('avatar_file')) {
            if ($profile->avatar && ! str_starts_with($profile->avatar, 'http')) {
                Storage::disk('public')->delete($profile->avatar);
            }
            $validated['avatar'] = $request->file('avatar_file')->store('avatars', 'public');
        } elseif (! empty($request->input('avatar_url'))) {
            $validated['avatar'] = $request->input('avatar_url');
        }

        unset($validated['avatar_file'], $validated['avatar_url']);

        $profile->update($validated);

        return redirect()->route('admin.profile.edit')->with('success', 'Profil portfolio berhasil diperbarui!');
    }
}
