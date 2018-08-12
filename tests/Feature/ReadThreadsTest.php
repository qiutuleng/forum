<?php

namespace Tests\Feature;

use App\Models\Channel;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReadThreadsTest extends TestCase
{
    use RefreshDatabase;

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
    public function a_user_can_view_all_threads()
    {
        $this->get(route('threads.index'))
            ->assertSee($this->thread->getTitle());
    }

    /** @test */
    public function a_user_can_read_a_single_thread()
    {
        $this->get($this->thread->path())
            ->assertSee($this->thread->getTitle());
    }

    /** @test */
    public function a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        $reply = create(Reply::class, ['thread_id' => $this->thread->getKey()]);

        $this->get($this->thread->path())->assertSee($reply->getBody());
    }

    /** @test */
    public function a_user_can_filter_threads_according_a_channel()
    {
        $channel = create(Channel::class);
        $threadInChannel = create(Thread::class, ['channel_id' => $channel->getKey()]);
        $threadNotInChannel = create(Thread::class);

        $this->get(route('threads.index', $channel->getSlug()))
            ->assertSee($threadInChannel->getTitle())
            ->assertDontSee($threadNotInChannel->getTitle());
    }

    /** @test */
    public function a_user_can_filter_threads_by_any_username()
    {
        $user = create(User::class, ['name' => 'JohnDoe']);
        $this->signIn($user);

        $threadByJohn = create(Thread::class, ['user_id' => $user->getKey()]);
        $threadNotByJohn = create(Thread::class);

        $this->get(route('threads.index', ['channel' => '', 'by' => $user->getName(),]))
            ->assertSee($threadByJohn->getTitle())
            ->assertDontSee($threadNotByJohn->getTitle());

    }
}
