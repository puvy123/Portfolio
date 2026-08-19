<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MessageController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Contact::orderBy('created_at', 'desc');

        if ($request->filled('status')) {
            if ($request->query('status') === 'unread') {
                $query->where('is_read', false);
            } elseif ($request->query('status') === 'read') {
                $query->where('is_read', true);
            }
        }

        $messages = $query->paginate($request->query('per_page', 20));

        return response()->json([
            'success' => true,
            'data' => $messages->items(),
            'meta' => [
                'current_page' => $messages->currentPage(),
                'per_page' => $messages->perPage(),
                'total' => $messages->total(),
                'last_page' => $messages->lastPage(),
            ]
        ]);
    }

    public function toggleRead(Contact $message): JsonResponse
    {
        $message->update(['is_read' => !$message->is_read]);

        return response()->json([
            'success' => true,
            'message' => 'Message status updated',
            'data' => $message,
        ]);
    }

    public function destroy(Contact $message): JsonResponse
    {
        $message->delete();

        return response()->json([
            'success' => true,
            'message' => 'Message deleted successfully',
        ]);
    }
}
