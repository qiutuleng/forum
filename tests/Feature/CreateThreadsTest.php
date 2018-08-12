<?php

namespace Tests\Feature;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_may_not_create_thread()
    {
        $this->expectException(AuthenticationException::class);

        $this->post(route('threads.store'));
    }

    /** @test */
    public function an_authenticated_user_can_create_new_form_threads()
    {
        $this->signIn(factory(User::class)->create());

        $thread = factory(Thread::class)->make();
        $this->post(route('threads.store'), $thread->toArray())
            ->assertRedirect();

        $this->get($thread->path())
            ->assertSee($thread->getTitle())
            ->assertSee($thread->getBody());
    }
}
