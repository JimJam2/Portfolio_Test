<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Models\Message;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard overview.
     */
    public function index(): View
    {
        $stats = [
            'projects_count' => Project::count(),
            'skills_count' => Skill::count(),
            'experiences_count' => Experience::count(),
            'messages_count' => Message::count(),
            'unread_messages' => Message::where('is_read', false)->count(),
        ];

        $recentMessages = Message::latest()->take(5)->get();
        $recentProjects = Project::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentMessages', 'recentProjects'));
    }
}
