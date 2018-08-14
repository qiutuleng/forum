<?php

namespace Tests\Feature;

use App\Models\Reply;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FavoritesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_can_not_favorite_anything()
    {
        $this->withExceptionHandling()
            ->post(route('replies.favorites', 1))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function an_authenticated_can_favorite_any_reply()
    {
        $this->signIn();

        /** @var Reply $reply */
        $reply = create(Reply::class);

        $this->post(route('replies.favorites', $reply));

        $this->assertEquals(1, $reply->getFavoritesCount());
    }

    /** @test */
    public function an_authenticated_user_may_only_favorite_a_reply_once()
    {
        $this->signIn();

        /** @var Reply $reply */
        $reply = create(Reply::class);

        try {
            $this->post(route('replies.favorites', $reply));
            $this->post(route('replies.favorites', $reply));
        } catch (\Illuminate\Database\QueryException $exception) {
            $this->fail('Did not expect to insert the same record set twice.');
        }

        $this->assertEquals(1, $reply->getFavoritesCount());
    }

    /** @test */
    public function an_authenticated_user_can_cancel_favorite_a_reply()
    {
        $this->signIn();

        /** @var Reply $reply */
        $reply = create(Reply::class);

        // Favorite
        $this->post(route('replies.favorites', $reply));
        $this->assertEquals(1, $reply->getFavoritesCount());

        // Cancel favorite
        $this->delete(route('replies.favorites', $reply));

        $this->assertEquals(0, $reply->getFavoritesCount());
    }
}
