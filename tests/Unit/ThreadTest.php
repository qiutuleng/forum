<?php

namespace Tests\Unit;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * @var Thread
     */
    protected $thread;

    protected function setUp()
    {
        parent::setUp();

        $this->thread = create(Thread::class);
    }

    /** @test */
    public function a_thread_has_replies()
    {
        $this->assertInstanceOf(Collection::class, $this->thread->getReplies());
    }

    /** @test */
    public function a_thread_has_a_owner()
    {
        $this->assertInstanceOf(User::class, $this->thread->getOwner());
    }

    /** @test */
    public function a_thread_can_add_reply()
    {
        $this->thread->addReply([
            'body' => $this->faker->paragraph,
            'user_id' => 1,
        ]);

        $this->assertCount(1, $this->thread->getReplies());
    }
}
