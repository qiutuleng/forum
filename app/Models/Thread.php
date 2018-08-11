<?php

namespace App\Models;

use App\Models\Traits\HasOwner;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasOwner;

    protected $fillable = [
        'title', 'body',
    ];

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    /**
     * @return Collection
     */
    public function getReplies()
    {
        return $this->getRelationValue('replies');
    }

    /**
     * @return string
     */
    public function path()
    {
        return route('threads.show', $this);
    }

    /**
     * Get a title attribute
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->getAttributeValue('title');
    }

    /**
     * Get a body attribute
     *
     * @return string
     */
    public function getBody()
    {
        return $this->getAttributeValue('body');
    }
}
