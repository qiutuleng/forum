<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = [
        'name', 'slug',
    ];

    /**
     * Have multiple threads
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

    /**
     * Get all the threads belonging to this channel.
     *
     * @return Collection
     */
    public function getThreads()
    {
        return $this->getRelationValue('threads');
    }

    /**
     * Get a name attribute.
     *
     * @return string
     */
    public function getName()
    {
        return $this->getAttributeValue('name');
    }

    /**
     * Get a slug attribute.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->getAttributeValue('slug');
    }
}
