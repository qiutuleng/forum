<?php

namespace App\Models;

use App\Models\Traits\Favoriteable;
use App\Models\Traits\HasOwner;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasOwner, Favoriteable;

    protected $fillable = [
        'user_id', 'body',
    ];

    protected $with = ['owner', 'favorites'];

    /**
     * Get a body attribute.
     *
     * @return string
     */
    public function getBody()
    {
        return $this->getAttributeValue('body');
    }
}
