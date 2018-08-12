<?php

namespace Tests;

use App\Exceptions\Handler;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    /**
     * @var ExceptionHandler
     */
    protected $oldExceptionHandler;

    protected function setUp()
    {
        parent::setUp();

        $this->disableExceptionHandling();
    }


    public function signIn(Authenticatable $user = null, $drive = null)
    {
        $user = $user ?: create(User::class);

        return $this->actingAs($user, $drive);
    }

    protected function disableExceptionHandling()
    {
        $this->oldExceptionHandler = $this->app->make(ExceptionHandler::class);

        $this->app->instance(ExceptionHandler::class, new class extends Handler
        {
            public function __construct()
            {
                //
            }

            public function report(Exception $exception)
            {
                //
            }

            public function render($request, Exception $exception)
            {
                throw $exception;
            }
        });
    }

    public function withExceptionHandling()
    {
        $this->app->instance(ExceptionHandler::class, $this->oldExceptionHandler);

        return $this;
    }
}
