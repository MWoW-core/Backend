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

    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'category' => ['required', 'string', 'min:3', 'max:255'],
            'slug' => ['string', 'min:3', 'max:255'],
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'headline' => ['required', 'string', 'min:3', 'max:255'],
            'body' => ['required', 'string', 'min:20', 'max:65535']
        ]);

        if (isset($validated['slug']) === false) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        Event::dispatch(
            new NewsCreated($request->user()->id, $validated)
        );
    }

    public function show(News $news)
    {
        new NewsResource($news);
    }

    public function update(Request $request, News $news)
    {
        $validated = $this->validate($request, [
            'category' => ['string', 'min:3', 'max:255'],
            'slug' => ['string', 'min:3', 'max:255'],
            'title' => ['string', 'min:3', 'max:255'],
            'headline' => ['string', 'min:3', 'max:255'],
            'body' => ['string', 'min:20', 'max:65535']
        ]);

        if (isset($validated['title']) && !isset($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        Event::dispatch(
            new NewsUpdated(
                $news->id,
                $validated
            )
        );
    }

    public function destroy(News $news)
    {
        Event::dispatch(
            new NewsDeleted($news->id)
        );
    }
}
