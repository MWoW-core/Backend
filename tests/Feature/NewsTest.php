<?php

namespace Tests\Feature;

use App\News;
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

    public function testCanFilterByCategory()
    {
        factory(News::class)->create(['category' => 'Changelog']);
        factory(News::class)->create(['category' => 'Patch notes']);

        $this->getJson('/api/news?category=Changelog')
            ->assertSuccessful()
            ->assertSee('Changelog')
            ->assertDontSee('Patch notes');
    }

    public function testAnAdminCanCreateNews()
    {
        $this
            ->asAdmin()
            ->postJson('/api/news', [
                'category' => 'Changelog',
                'title' => 'Something spicy',
                'headline' => 'Liquorice & chili',
                'body' => 'Gotta fill something.'
            ])
            ->assertSuccessful();

        $this->assertDatabaseHas('news', [
            'writer_id' => Auth::id(),
            'category' => 'Changelog',
            'title' => 'Something spicy',
            'headline' => 'Liquorice & chili',
            'body' => 'Gotta fill something.'
        ]);
    }

    public function testAPlayerCannotCreateNews()
    {
        $this->assertGuest()->postJson('/api/news', [])->assertUnauthorized();
        $this->asPlayer()->postJson('/api/news', [])->assertForbidden();
    }

    public function testAdminCanUpdateANewsArticle()
    {
        $news = factory(News::class)->create();

        $this
            ->asAdmin()
            ->putJson("/api/news/{$news->id}", [
                'category' => 'Changelog',
                'title' => 'Something spicy',
                'headline' => 'Liquorice & chili',
                'body' => 'Gotta fill something.'
            ])
            ->assertSuccessful();

        $this->assertDatabaseHas('news', [
            'id' => $news->id,

            'category' => 'Changelog',
            'title' => 'Something spicy',
            'headline' => 'Liquorice & chili',
            'body' => 'Gotta fill something.'
        ]);
    }

    public function testAPlayerCannotUpdateNews()
    {
        $news = factory(News::class)->create();

        $this->assertGuest()->putJson("/api/news/{$news->id}", [])->assertUnauthorized();
        $this->asPlayer()->putJson("/api/news/{$news->id}", [])->assertForbidden();
    }

    public function testAnAdminCanDeleteANewsArticle()
    {
        $news = factory(News::class)->create();

        $this
            ->asAdmin()
            ->deleteJson("/api/news/{$news->id}")
            ->assertSuccessful();

        $this->assertSoftDeleted($news);
    }

    public function testAPlayerCannotDeleteNews()
    {
        $news = factory(News::class)->create();

        $this->assertGuest()->deleteJson("/api/news/{$news->id}", [])->assertUnauthorized();
        $this->asPlayer()->deleteJson("/api/news/{$news->id}", [])->assertForbidden();
    }
}
