<?php

use App\User;
use App\Article;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ArticleTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_fetches_active_articles_by_user()
    {
        // Given
        $user = factory(User::class, 1)->create(['id' => 1]);

        factory(Article::class, 2)->create(['status' => 1]);
        factory(Article::class, 1)->create(['status' => 2]);
        factory(Article::class, 1)->create(['status' => 3]);

        // When
        $articles = Article::status($user->id, 1)->get();

        // Then
        $this->assertCount(2, $articles);
        $this->assertEquals(1, $articles->first()->status);

    }

    /** @test */
    public function it_fetches_active_articles()
    {
        // Given
        factory(Article::class, 2)->create(['status' => 1]);
        factory(Article::class, 1)->create(['status' => 2]);
        factory(Article::class, 1)->create(['status' => 3]);

        // When
        $articles = Article::active()->get();

        // Then
        $this->assertCount(2, $articles);
        $this->assertEquals(1, $articles->first()->status);
    }

    /** @test */
    public function it_fetches_articles_by_title_and_description()
    {
        // Given
        $article_title = factory(Article::class, 1)->create(['title' => 'The train']);
        $article_description = factory(Article::class, 1)->create(['description' => 'The train is blue']);
        factory(Article::class, 3)->create();

        // When
        $articles = Article::search('train')->get();

        // Then
        $this->assertCount(2, $articles);
        $this->assertEquals('The train', $articles->shift()->title);
        $this->assertEquals('The train is blue', $articles->shift()->description);
    }
}