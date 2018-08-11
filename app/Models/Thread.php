<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $fillable = [
        'title', 'body',
    ];

    public function path()
    {
        return route('threads.show', $this);
    }

    public function getTitle()
    {
        return $this->getAttributeValue('title');
    }

    public function getBody()
    {
        return $this->getAttributeValue('body');
    }
}
