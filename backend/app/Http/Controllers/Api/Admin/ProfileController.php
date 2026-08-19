<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    public function show(): JsonResponse
    {
        $profile = Profile::first();

        return response()->json([
            'success' => true,
            'data' => $profile,
        ]);
    }

    public function update(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'about_me_text' => 'nullable|string',
            'avatar' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'cv_url' => 'nullable|string',
            'experience_years' => 'integer|min:0',
            'happy_clients' => 'integer|min:0',
            'projects_completed' => 'integer|min:0',
            'technologies_count' => 'integer|min:0',
            'available_for_hire' => 'boolean',
        ]);

        $profile = Profile::firstOrCreate(['user_id' => $request->user()->id ?? 1], $validated);
        $profile->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully',
            'data' => $profile,
        ]);
    }
}
