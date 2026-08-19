<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SkillController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $skills = Skill::with('category')->orderBy('sort_order', 'asc')->get();

        return response()->json([
            'success' => true,
            'data' => $skills,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'skill_category_id' => 'nullable|exists:skill_categories,id',
            'name' => 'required|string|max:100',
            'icon' => 'nullable|string',
            'proficiency' => 'required|integer|min:1|max:100',
            'experience_years' => 'required|string|max:50',
            'is_featured' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $skill = Skill::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Skill created successfully',
            'data' => $skill->load('category'),
        ], 201);
    }

    public function update(Request $request, Skill $skill): JsonResponse
    {
        $validated = $request->validate([
            'skill_category_id' => 'nullable|exists:skill_categories,id',
            'name' => 'sometimes|required|string|max:100',
            'icon' => 'nullable|string',
            'proficiency' => 'sometimes|required|integer|min:1|max:100',
            'experience_years' => 'sometimes|required|string|max:50',
            'is_featured' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $skill->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Skill updated successfully',
            'data' => $skill->load('category'),
        ]);
    }

    public function destroy(Skill $skill): JsonResponse
    {
        $skill->delete();

        return response()->json([
            'success' => true,
            'message' => 'Skill deleted successfully',
        ]);
    }
}
