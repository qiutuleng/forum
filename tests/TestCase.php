<?php

namespace Tests;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function signIn(Authenticatable $user = null, $drive = null)
    {
        $user = $user ?: create(User::class);

        return $this->actingAs($user, $drive);
    }
}
