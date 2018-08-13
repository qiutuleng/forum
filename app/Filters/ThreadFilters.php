<?php

namespace App\Filters;


use App\Models\Channel;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class ThreadFilters extends Filters
{
    protected $filters = [
        'by' => 'byUsername',
        'channel' => 'byChannel',
        'popular' => 'sortByPopular',
    ];

    /**
     * Filter the query by a given username.
     *
     * @param string $username
     * @return Builder
     */
    public function byUsername($username)
    {
        if (is_null($username)) return;

        return $this->builder->when(User::findByName($username), function ($builder, User $user) {
            $builder->byOwner($user);
        });
    }

    public function byChannel($channel)
    {
        if (!($channel instanceof Channel)) return;

        $this->builder->where('channel_id', $channel->getKey());
    }

    /**
     * Filter the query according to most popular threads.
     *
     * @param $popular
     */
    public function sortByPopular($popular)
    {
        if (!$popular) return;

        $this->builder->latest('replies_count');
    }
}
