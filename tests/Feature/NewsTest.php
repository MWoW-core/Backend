<?php

namespace Tests\Feature;

use App\News;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class NewsTest extends TestCase
{
    use RefreshDatabase;

    public function testAnybodyViewAnyNews()
    {
        $this->get('/api/news')->assertSuccessful();
    }

    public function testCanViewAnArticleBySlug()
    {
        $news = factory(News::class)->create();

        $this->getJson("/api/news/{$news->slug}")
            ->assertSuccessful()
            ->assertJsonFragment([
                'slug' => $news->slug
            ]);
    }

    public function testCanFilterByCategory()
    {
        factory(News::class)->create(['category' => 'Changelog']);
        factory(News::class)->create(['category' => 'Patch notes']);

        $this->getJson('/api/news?category=Changelog')
            ->assertSuccessful()
            ->assertSee('Changelog')
            ->assertDontSee('Patch notes');
    }

    public function testCanCommentOnANewsArticle()
    {
        $article = factory(News::class)->create();
        $this->be($commentator = factory(User::class)->create());

        $this->json('POST', '/api/comments', [
            'commentable_type' => 'News',
            'commentable_id' => $article->id,
            'comment' => 'hello world'
        ])->assertSuccessful();

        $this->assertDatabaseHas('comments', [
            'user_id' => $commentator->id,
            'commentable_type' => 'News',
            'commentable_id' => $article->id,
            'comment' => 'hello world'
        ]);

        self::assertTrue(
            $article->comments()->where('comment', 'hello world')->where('user_id', $commentator->id)->exists(),
            'Unable to find comment within News relationship to Comments.'
        );
    }
}
