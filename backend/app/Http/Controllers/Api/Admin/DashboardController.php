<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\BlogPost;
use App\Models\Contact;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Certification;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    public function stats(): JsonResponse
    {
        $stats = [
            'total_projects' => Project::count(),
            'total_blog_posts' => BlogPost::count(),
            'total_messages' => Contact::count(),
            'unread_messages' => Contact::where('is_read', false)->count(),
            'total_services' => Service::count(),
            'total_skills' => Skill::count(),
            'total_experiences' => Experience::count(),
            'total_certifications' => Certification::count(),
        ];

        $recentMessages = Contact::orderBy('created_at', 'desc')->take(5)->get();
        $recentProjects = Project::with('category')->orderBy('created_at', 'desc')->take(5)->get();

        return response()->json([
            'success' => true,
            'data' => [
                'stats' => $stats,
                'recent_messages' => $recentMessages,
                'recent_projects' => $recentProjects,
            ]
        ]);
    }
}
