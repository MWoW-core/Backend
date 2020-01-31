<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsResource;
use App\News;
use App\StorableEvents\NewsCreated;
use App\StorableEvents\NewsDeleted;
use App\StorableEvents\NewsUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(News::class);
    }

    public function index(Request $request)
    {
        $validated = $this->validate($request, [
            'category' => 'nullable|string|exists:news,category',
            'perPage' => 'nullable|numeric',
            'page' => 'nullable|numeric'
        ]);

        return NewsResource::collection(
            News::with('writer')
            ->latest()
            ->when(Arr::get($validated, 'category'), fn ($query, $category) => $query->where('category', $category))
            ->withCount('comments')
            ->paginate(
                $validated['perPage'] ?? 15,
                ['*'],
                'page',
                $validated['page'] ?? null
            )
        );
    }

    public function show(News $news)
    {
        return new NewsResource(
            $news->loadMissing([
                'writer',
                'comments' => fn ($query) => $query->latest(),
                'comments.commentator'
            ])
        );
    }
}
