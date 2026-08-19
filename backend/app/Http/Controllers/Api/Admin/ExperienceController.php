<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ExperienceController extends Controller
{
    public function index(): JsonResponse
    {
        $experiences = Experience::orderBy('sort_order', 'asc')->get();

        return response()->json([
            'success' => true,
            'data' => $experiences,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'role' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'period' => 'required|string|max:100',
            'description' => 'required|string',
            'achievements' => 'nullable|array',
            'technologies' => 'nullable|array',
            'is_current' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $exp = Experience::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Experience created successfully',
            'data' => $exp,
        ], 201);
    }

    public function update(Request $request, Experience $experience): JsonResponse
    {
        $validated = $request->validate([
            'role' => 'sometimes|required|string|max:255',
            'company' => 'sometimes|required|string|max:255',
            'location' => 'nullable|string|max:255',
            'period' => 'sometimes|required|string|max:100',
            'description' => 'sometimes|required|string',
            'achievements' => 'nullable|array',
            'technologies' => 'nullable|array',
            'is_current' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $experience->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Experience updated successfully',
            'data' => $experience,
        ]);
    }

    public function destroy(Experience $experience): JsonResponse
    {
        $experience->delete();

        return response()->json([
            'success' => true,
            'message' => 'Experience deleted successfully',
        ]);
    }
}
