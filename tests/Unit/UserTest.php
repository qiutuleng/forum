<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var User
     */
    protected $user;

    protected function setUp()
    {
        parent::setUp();

        $this->user = create(User::class);
    }

    /** @test */
    public function user_can_be_find_by_name()
    {
        $this->assertInstanceOf(User::class, User::findByName($this->user->getName()));
    }
}
