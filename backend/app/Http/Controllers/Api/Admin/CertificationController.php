<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CertificationController extends Controller
{
    public function index(): JsonResponse
    {
        $certs = Certification::orderBy('sort_order', 'asc')->get();

        return response()->json([
            'success' => true,
            'data' => $certs,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'credential_id' => 'nullable|string|max:255',
            'issue_date' => 'nullable|date',
            'expiration_date' => 'nullable|date',
            'credential_url' => 'nullable|url',
            'image' => 'nullable|string',
            'sort_order' => 'integer',
        ]);

        $cert = Certification::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Certification created successfully',
            'data' => $cert,
        ], 201);
    }

    public function update(Request $request, Certification $certification): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'organization' => 'sometimes|required|string|max:255',
            'credential_id' => 'nullable|string|max:255',
            'issue_date' => 'nullable|date',
            'expiration_date' => 'nullable|date',
            'credential_url' => 'nullable|url',
            'image' => 'nullable|string',
            'sort_order' => 'integer',
        ]);

        $certification->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Certification updated successfully',
            'data' => $certification,
        ]);
    }

    public function destroy(Certification $certification): JsonResponse
    {
        $certification->delete();

        return response()->json([
            'success' => true,
            'message' => 'Certification deleted successfully',
        ]);
    }
}
