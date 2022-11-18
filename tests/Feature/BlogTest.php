<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BlogTest extends TestCase
{
    use DatabaseTransactions;

    private $blog;

    protected function setUp(): void
    {
        parent::setUp();
        $this->blog = Blog::factory(1)->create()->first();
    }

    /**
     * @test
     * Test index blog page.
     *
     * @return void
     */
    public function userCanSeeBlogPage()
    {
        $this->get('blog')
            ->assertSee($this->blog->title);
    }

     /**
     * @test
     * Test show blog page
     *
     * @return void
     */
    public function userCanSeeSingleBlogPage()
    {
        $this->get('blog/'.$this->blog->slug)
            ->assertSee($this->blog->subject);
    }

    /**
     * @test
     * Test guest cant post blog page
     *
     * @return void
     */
    public function guestCantPostBlogPage()
    {
        $this->get('blog/create')
            ->assertRedirect('/login');
    }

    /**
     * @test
     * Test user can post blog page
     *
     * @return void
     */
    public function userCanPostBlogPage()
    {
        $user = User::factory(1)->create()->first();
        $this->actingAs($user);
        $blog = Blog::factory(1)->make()->first();

        $this->post('blog',$blog->toArray())
            ->assertRedirect('blog/'.$blog->slug);

        $this->get('blog/'.$blog->slug)
            ->assertSee($blog->title)
            ->assertSee($user->name);
    }
}
