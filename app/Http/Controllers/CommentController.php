<?php

namespace App\Http\Controllers;

use App\Comment;
use App\StorableEvents\CommentWasDeleted;
use App\StorableEvents\CommentWasUpdated;
use Illuminate\Http\Request;
use App\Rules\ValidMorphMapKey;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Event;
use App\StorableEvents\CommentWasWritten;
use App\Http\Requests\StoreCommentRequest;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request)
    {
        $this->authorize('create', new Comment);

        Event::dispatch(
            new CommentWasWritten(
                array_merge(
                    [
                        'user_id' => $request->user()->id
                    ],
                    $request->validated()
                )
            )
        );
    }

    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $validated = $this->validate($request, [
            'comment' => ['string', 'min:2', 'max:65535']
        ]);

        Event::dispatch(
            new CommentWasUpdated(
                $comment->getKey(),
                $validated
            )
        );
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        Event::dispatch(
            new CommentWasDeleted(
                $comment->getKey()
            )
        );
    }
}
