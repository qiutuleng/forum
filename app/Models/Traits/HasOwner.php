<?php

namespace App\Models\Traits;


use App\Models\User;

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