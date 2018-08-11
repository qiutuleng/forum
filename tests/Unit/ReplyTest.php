<?php

namespace Tests\Unit;

use App\Models\Reply;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReplyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var Reply
     */
    protected $reply;

    protected function setUp()
    {
        parent::setUp();

        $this->reply = factory(Reply::class)->create();
    }

    /** @test */
    public function it_has_an_owner()
    {
        $this->assertInstanceOf(User::class, $this->reply->getOwner());
    }
}
