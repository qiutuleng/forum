<?php

namespace Tests\Feature;

use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReadThreadsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_view_all_threads()
    {
        $thread = factory(Thread::class)->create();

        $response = $this->get(route('threads.index'));

        $response->assertSee($thread->getTitle());
    }

    /** @test */
    public function a_user_can_read_a_single_thread()
    {
        $thread = factory(Thread::class)->create();

        $response = $this->get($thread->path());

        $response->assertSee($thread->getTitle());
    }
}
