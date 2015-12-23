<?php

use App\Article;
use App\Category;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_fetches_all_active_categories()
    {
        // Given
        factory(Category::class, 2)->create();
        factory(Category::class, 5)->create(['status' => 2]);

        // When
        $categories = Category::active()->get();

        // Then
        $this->assertCount(2, $categories);
    }

    /** @test */
    public function it_fetches_how_many_articles_are_in_category()
    {
        // Given
        $category = factory(Category::class, 1)->create();

        factory(Article::class, 5)->create(['category_id' => $category->id]);

        // When
        $articlesCount = $category->articlesCount;

        // Then
        $this->assertEquals(5, $articlesCount);
    }
}