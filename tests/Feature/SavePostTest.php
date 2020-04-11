<?php


namespace Sohel\MarkdownParser\Test\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Sohel\MarkdownParser\Post;
use Sohel\MarkdownParser\Test\TestCase;

class SavePostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function a_post_can_created_with_the_factory()
    {
        $post =factory(Post::class)->create();
        $this->assertCount(1,Post::all());
    }

}
