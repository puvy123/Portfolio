<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PortfolioController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\Admin\ProjectController;
use App\Http\Controllers\Api\Admin\SkillController;
use App\Http\Controllers\Api\Admin\ServiceController;
use App\Http\Controllers\Api\Admin\ExperienceController;
use App\Http\Controllers\Api\Admin\EducationController;
use App\Http\Controllers\Api\Admin\CertificationController;
use App\Http\Controllers\Api\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Api\Admin\TestimonialController;
use App\Http\Controllers\Api\Admin\MessageController;
use App\Http\Controllers\Api\Admin\SettingController;
use App\Http\Controllers\Api\Admin\ProfileController;
use App\Http\Controllers\Api\Admin\SocialLinkController;

/*
|--------------------------------------------------------------------------
| API Routes - Developer & IT Portfolio
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function () {
    // Health Check
    Route::get('/health', function () {
        return response()->json([
            'status' => 'online',
            'service' => 'Developer Portfolio API',
            'timestamp' => now()->toIso8601String()
        ]);
    });

    // Public Endpoints
    Route::get('/portfolio', [PortfolioController::class, 'index']);
    Route::post('/contact', [ContactController::class, 'store']);
    Route::get('/blog', [BlogController::class, 'index']);
    Route::get('/blog/{slug}', [BlogController::class, 'show']);

    // Authentication Endpoints
    Route::post('/auth/login', [AuthController::class, 'login']);

    // Protected Admin Routes (Sanctum)
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::get('/auth/me', [AuthController::class, 'me']);

        // Dashboard & Overview
        Route::get('/admin/dashboard', [DashboardController::class, 'stats']);

        // Profile & Settings
        Route::get('/admin/profile', [ProfileController::class, 'show']);
        Route::put('/admin/profile', [ProfileController::class, 'update']);
        Route::get('/admin/settings', [SettingController::class, 'index']);
        Route::post('/admin/settings', [SettingController::class, 'update']);

        // Messages / Inquiries
        Route::get('/admin/messages', [MessageController::class, 'index']);
        Route::put('/admin/messages/{message}/toggle-read', [MessageController::class, 'toggleRead']);
        Route::delete('/admin/messages/{message}', [MessageController::class, 'destroy']);

        // CRUD Endpoints
        Route::apiResource('/admin/projects', ProjectController::class);
        Route::apiResource('/admin/skills', SkillController::class);
        Route::apiResource('/admin/services', ServiceController::class);
        Route::apiResource('/admin/experiences', ExperienceController::class);
        Route::apiResource('/admin/educations', EducationController::class);
        Route::apiResource('/admin/certifications', CertificationController::class);
        Route::apiResource('/admin/blog', AdminBlogController::class);
        Route::apiResource('/admin/testimonials', TestimonialController::class);
        Route::apiResource('/admin/social-links', SocialLinkController::class);
    });
});
