<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BlogTest extends TestCase
{
    use DatabaseTransactions;

    private $blog, $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->blog = Blog::factory(1)->create()->first();
        $this->user = User::factory(1)->create()->first();
    }

    private function makeBlog($input)
    {
        $this->actingAs($this->user);

        return $input;
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
     * Test user post blog required title
     *
     * @return void
     */
    public function userPostBlogRequireTitle()
    {
        $input = $this->makeBlog([
            'subject'=> 'Test test test...'
        ]);

        $this->post('blog',$input)->assertSessionHasErrors('title');
    }

    /**
     * @test
     * Test user post blog required subject
     *
     * @return void
     */
    public function userPostBlogRequireSubject()
    {
        $input = $this->makeBlog([
            'title' => 'Test From Feature Test '.time(),
        ]);

        $this->post('blog',$input)->assertSessionHasErrors('subject');
    }

    /**
     * @test
     * Test user can post blog page
     *
     * @return void
     */
    public function userCanPostBlogPage()
    {
        $input = $this->makeBlog([
            'title' => 'Test From Feature Test '.time(),
            'subject'=> 'Test test test...'
        ]);
        $slug = Str::slug($input['title']);

        $this->post('blog',$input)->assertRedirect('blog/'.$slug);

        $this->get('blog/'.$slug)
            ->assertSee($input['title'])
            ->assertSee($this->user->name);
    }

    /**
     * @test
     * Test guest cant post blog page
     *
     * @return void
     */
    public function guestCantUpdateBlogPage()
    {
        $this->get('blog/'.$this->blog->slug.'/edit')
            ->assertRedirect('/login');
    }

    /**
     * @test
     * Test user update blog required title
     *
     * @return void
     */
    public function userUpdateBlogRequireTitle()
    {
        $input = $this->makeBlog([
            'subject'=> 'Update test test test...'
        ]);

        $this->put('blog/'.$this->blog->id,$input)
            ->assertSessionHasErrors('title');
    }

    /**
     * @test
     * Test user update blog required subject
     *
     * @return void
     */
    public function userUpdateBlogRequireSubject()
    {
        $input = $this->makeBlog([
            'title' => 'Update test From Feature Test '.time(),
        ]);

        $this->put('blog/'.$this->blog->id,$input)
            ->assertSessionHasErrors('subject');
    }

    /**
     * @test
     * Test user can update blog page
     *
     * @return void
     */
    public function userCanUpdateBlogPage()
    {
        $input = $this->makeBlog([
            'title' => 'Update test From Feature Test '.time(),
            'subject'=> 'Update test test test...'
        ]);
        $slug = Str::slug($input['title']);

        $this->json('PUT','blog/'.$this->blog->id,$input)
            ->assertRedirect('blog/'.$slug);

        $this->get('blog/'.$slug)
            ->assertSee($input['title'])
            ->assertSee($input['subject']);
    }
}
