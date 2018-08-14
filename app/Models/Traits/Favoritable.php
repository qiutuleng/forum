<?php

namespace App\Models\Traits;

use App\Models\Favorite;
use App\Models\User;
use Auth;
use Illuminate\Database\Eloquent\Collection;

trait Favoritable
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favoriteable');
    }

    /**
     * @param User|null $user
     */
    public function favorite(User $user = null)
    {
        $user = $user ?: Auth::user();

        if (is_null($user)) return;

        $attributes = ['user_id' => $user->getKey()];

        if (!$this->isFavorited($user)) {
            $this->favorites()->create($attributes);
        }
    }

    /**
     * @param User|null $user
     */
    public function cancelFavorite(User $user = null)
    {
        $user = $user ?: Auth::user();

        !is_null($user) && $this->favorites()->where(['user_id' => $user->getKey()])->delete();
    }

    /**
     * @param User|null $user
     * @return bool
     */
    public function isFavorited(User $user = null)
    {
        $user = $user ?: Auth::user();

        return is_null($user) ? false : $this->favorites()->where(['user_id' => $user->getKey()])->exists();
    }

    /**
     * @return Collection
     */
    public function getFavorites()
    {
        return $this->getRelationValue('favorites');
    }

    /**
     * @return int
     */
    public function getFavoritesCount()
    {
        return $this->getAttribute('favorites_count') ?: $this->favorites()->count();
    }
}