<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Blog;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BlogTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * @test
     * Test index blog page.
     *
     * @return void
     */
    public function userCanSeeBlogPage()
    {
        $blog = Blog::factory(1)->create()->first();
        $this->get('blog')
            ->assertSee($blog->title);
    }

     /**
     * @test
     * Test show blog page
     *
     * @return void
     */
    public function userCanSeeSingleBlogPage()
    {
        $blog = Blog::factory(1)->create()->first();
        $this->get('blog/'.$blog->slug)
            ->assertSee($blog->subject);
    }
}
