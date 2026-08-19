<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\SkillCategory;
use App\Models\Skill;
use App\Models\Service;
use App\Models\ProjectCategory;
use App\Models\Project;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Certification;
use App\Models\Testimonial;
use App\Models\SocialLink;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;

class PortfolioController extends Controller
{
    /**
     * Get complete aggregated portfolio payload for public single/multi-page view.
     */
    public function index(): JsonResponse
    {
        $profileModel = Profile::first();
        
        $settings = Setting::pluck('value', 'key')->toArray();

        $profile = [
            'name' => $profileModel?->name ?? 'Puvy',
            'title' => $profileModel?->title ?? 'IT Support Specialist | Full-Stack Web & App Developer',
            'bio' => $profileModel?->bio ?? 'Passionate IT Specialist and Full-Stack Developer creating resilient digital infrastructure and modern web applications.',
            'about_me_text' => $profileModel?->about_me_text ?? '',
            'avatar' => $profileModel?->avatar ?? 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=600&q=80',
            'location' => $profileModel?->location ?? 'San Francisco, CA',
            'cv_url' => $profileModel?->cv_url ?? '/downloads/cv.pdf',
            'available_for_hire' => (bool) ($profileModel?->available_for_hire ?? true),
            'stats' => [
                'years_exp' => ($profileModel?->experience_years ?? 6) . '+ Years',
                'projects_completed' => ($profileModel?->projects_completed ?? 54) . '+ Completed',
                'happy_clients' => ($profileModel?->happy_clients ?? 48) . '+ Clients',
                'technologies_count' => ($profileModel?->technologies_count ?? 28) . '+ Techs',
            ],
            'settings' => $settings,
        ];

        $skillCategories = SkillCategory::with(['skills' => function ($q) {
            $q->orderBy('sort_order', 'asc');
        }])->orderBy('sort_order', 'asc')->get();

        $skills = Skill::with('category')->orderBy('sort_order', 'asc')->get();
        $services = Service::where('is_active', true)->orderBy('sort_order', 'asc')->get();
        $projectCategories = ProjectCategory::all();
        $projects = Project::with(['category', 'images'])->where('is_published', true)->orderBy('sort_order', 'asc')->get();
        $experiences = Experience::orderBy('sort_order', 'asc')->get();
        $educations = Education::orderBy('sort_order', 'asc')->get();
        $certifications = Certification::orderBy('sort_order', 'asc')->get();
        $testimonials = Testimonial::orderBy('sort_order', 'asc')->get();
        $socialLinks = SocialLink::where('is_active', true)->orderBy('sort_order', 'asc')->get();

        return response()->json([
            'success' => true,
            'message' => 'Portfolio data retrieved successfully',
            'data' => [
                'profile' => $profile,
                'skill_categories' => $skillCategories,
                'skills' => $skills,
                'services' => $services,
                'project_categories' => $projectCategories,
                'projects' => $projects,
                'experiences' => $experiences,
                'educations' => $educations,
                'certifications' => $certifications,
                'testimonials' => $testimonials,
                'social_links' => $socialLinks,
            ]
        ]);
    }
}
