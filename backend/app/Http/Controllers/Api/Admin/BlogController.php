<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = BlogPost::with(['category', 'tags'])->orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $search = $request->query('search');
            $query->where('title', 'like', "%{$search}%");
        }

        $posts = $query->paginate($request->query('per_page', 15));

        return response()->json([
            'success' => true,
            'data' => $posts->items(),
            'meta' => [
                'current_page' => $posts->currentPage(),
                'per_page' => $posts->perPage(),
                'total' => $posts->total(),
                'last_page' => $posts->lastPage(),
            ]
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'blog_category_id' => 'nullable|exists:blog_categories,id',
            'featured_image' => 'nullable|string',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'author' => 'nullable|string|max:100',
            'published_at' => 'nullable|date',
            'status' => 'required|in:draft,published',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_keywords' => 'nullable|string',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'exists:tags,id',
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . rand(100, 999);
        $post = BlogPost::create($validated);

        if ($request->has('tag_ids')) {
            $post->tags()->sync($request->tag_ids);
        }

        return response()->json([
            'success' => true,
            'message' => 'Article created successfully',
            'data' => $post->load(['category', 'tags']),
        ], 201);
    }

    public function show(BlogPost $blog): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $blog->load(['category', 'tags']),
        ]);
    }

    public function update(Request $request, BlogPost $blog): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'blog_category_id' => 'nullable|exists:blog_categories,id',
            'featured_image' => 'nullable|string',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'sometimes|required|string',
            'author' => 'nullable|string|max:100',
            'published_at' => 'nullable|date',
            'status' => 'sometimes|required|in:draft,published',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_keywords' => 'nullable|string',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'exists:tags,id',
        ]);

        $blog->update($validated);

        if ($request->has('tag_ids')) {
            $blog->tags()->sync($request->tag_ids);
        }

        return response()->json([
            'success' => true,
            'message' => 'Article updated successfully',
            'data' => $blog->load(['category', 'tags']),
        ]);
    }

    public function destroy(BlogPost $blog): JsonResponse
    {
        $blog->tags()->detach();
        $blog->delete();

        return response()->json([
            'success' => true,
            'message' => 'Article deleted successfully',
        ]);
    }
}
