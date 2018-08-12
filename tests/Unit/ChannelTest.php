<?php

namespace Tests\Unit;

use App\Models\Channel;
use App\Models\Thread;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChannelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var Channel
     */
    protected $channel;

    protected function setUp()
    {
        parent::setUp();

        $this->channel = create(Channel::class);
    }

    /** @test */
    public function a_channel_consists_of_threads()
    {
        $thread = create(Thread::class, ['channel_id' => $this->channel->getKey()]);

        $threads = $this->channel->getThreads();

        $this->assertInstanceOf(Collection::class, $threads);
        $this->assertTrue($threads->contains($thread));
    }
}
