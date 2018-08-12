<?php

namespace Tests\Feature;

use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_may_not_create_thread()
    {
        $this->withExceptionHandling();

        $this->get(route('threads.create'))
            ->assertRedirect(route('login'));

        $this->post(route('threads.store'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function an_authenticated_user_can_create_new_form_threads()
    {
        $this->signIn();

        $thread = make(Thread::class);

        $response = $this->publishThread($thread->toArray());
        $response->assertRedirect();

        $this->get($response->headers->get('Location'))
            ->assertSee($thread->getTitle())
            ->assertSee($thread->getBody());
    }

    protected function publishThread($overrides = [])
    {
        $this->signIn();

        $thread = make(Thread::class, $overrides);

        return $this->post(route('threads.store'), $thread->toArray());
    }
}
