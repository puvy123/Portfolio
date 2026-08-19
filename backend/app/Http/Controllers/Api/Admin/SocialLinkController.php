<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SocialLinkController extends Controller
{
    public function index(): JsonResponse
    {
        $links = SocialLink::orderBy('sort_order', 'asc')->get();

        return response()->json([
            'success' => true,
            'data' => $links,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'platform' => 'required|string|max:100',
            'url' => 'required|url',
            'icon' => 'nullable|string|max:50',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $link = SocialLink::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Social link created successfully',
            'data' => $link,
        ], 201);
    }

    public function update(Request $request, SocialLink $socialLink): JsonResponse
    {
        $validated = $request->validate([
            'platform' => 'sometimes|required|string|max:100',
            'url' => 'sometimes|required|url',
            'icon' => 'nullable|string|max:50',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $socialLink->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Social link updated successfully',
            'data' => $socialLink,
        ]);
    }

    public function destroy(SocialLink $socialLink): JsonResponse
    {
        $socialLink->delete();

        return response()->json([
            'success' => true,
            'message' => 'Social link deleted successfully',
        ]);
    }
}
