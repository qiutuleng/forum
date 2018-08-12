<?php

namespace App\Models\Traits;


use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

trait HasOwner
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return User|null
     */
    public function getOwner()
    {
        return $this->getRelationValue('owner');
    }

    public function scopeByOwner(Builder $builder, $user)
    {
        $builder->where('user_id', $user instanceof User ? $user->getKey() : $user);
    }

    public function scopeByOwnerId(Builder $builder, $userId)
    {
        $this->scopeByOwner($builder, $userId);
    }

    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->getAttribute('user_id');
    }

    /**
     * @return string
     */
    public function getOwnerId()
    {
        return $this->getUserId();
    }

    /**
     * @return string
     */
    public function getOwnerName()
    {
        return $this->getOwner()->getName();
    }
}