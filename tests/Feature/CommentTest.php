<?php

namespace Tests\Feature;

use App\Comment;
use App\Enums\UserRole;
use App\News;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function testTheCommentatorCanDeleteTheirComment()
    {
        $this->be($commentator = factory(User::class)->create());

        $comment = factory(Comment::class)->create([
            'user_id' => $commentator->id
        ]);

        $this->json('DELETE', "/api/comments/{$comment->id}")
            ->assertSuccessful();

        $this->assertSoftDeleted($comment);
    }

    public function testAPlayerCannotDeleteACommentTheyDidNotWrite()
    {
        $comment = factory(Comment::class)->create();

        $this->actingAs(factory(User::class)->create(['role' => UserRole::Player]))
            ->json('DELETE', "/api/comments/{$comment->id}")
            ->assertForbidden();

        $this->assertDatabaseHas('comments', ['id' => $comment->id]);
    }

    public function testTheCommentatorCanUpdateTheirComment()
    {
        $this->be($commentator = factory(User::class)->create());

        $comment = factory(Comment::class)->create([
            'user_id' => $commentator->id,
            'comment' => 'Everybody cheered a jolly hoo, as blizzard released a well thought-out game that is worth playing for decades to come.'
        ]);

        $this->json('PUT', "/api/comments/{$comment->id}", [
            'comment' => 'Nah just kidding, it was a shit-show. Obviously.'
        ])->assertSuccessful();

        $this->assertDatabaseHas('comments', [
            'id' => $comment->id,
            'comment' => 'Nah just kidding, it was a shit-show. Obviously.'
        ]);
    }

    public function testAPlayerCannotUpdateACommentTheyDidNotWrite()
    {
        $comment = factory(Comment::class)->create([
            'comment' => 'Nyaalotha? more like lovecrafted LoTR rip-off, amiright?'
        ]);

        $this->actingAs(factory(User::class)->create(['role' => UserRole::Player]))
            ->json('PUT', "/api/comments/{$comment->id}", [
                'comment' => 'Nyanlotha best thing ever. Especially when it blows up.'
            ])
            ->assertForbidden();

        $this->assertDatabaseHas('comments', [
            'id' => $comment->id,
            'comment' => 'Nyaalotha? more like lovecrafted LoTR rip-off, amiright?'
        ]);
    }
}
