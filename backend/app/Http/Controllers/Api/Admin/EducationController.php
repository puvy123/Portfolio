<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EducationController extends Controller
{
    public function index(): JsonResponse
    {
        $educations = Education::orderBy('sort_order', 'asc')->get();

        return response()->json([
            'success' => true,
            'data' => $educations,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'institution' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'field' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'description' => 'nullable|string',
            'sort_order' => 'integer',
        ]);

        $edu = Education::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Education created successfully',
            'data' => $edu,
        ], 201);
    }

    public function update(Request $request, Education $education): JsonResponse
    {
        $validated = $request->validate([
            'institution' => 'sometimes|required|string|max:255',
            'degree' => 'sometimes|required|string|max:255',
            'field' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'description' => 'nullable|string',
            'sort_order' => 'integer',
        ]);

        $education->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Education updated successfully',
            'data' => $education,
        ]);
    }

    public function destroy(Education $education): JsonResponse
    {
        $education->delete();

        return response()->json([
            'success' => true,
            'message' => 'Education deleted successfully',
        ]);
    }
}
