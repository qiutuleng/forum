<?php

namespace App\Models;

use App\Models\Traits\HasOwner;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasOwner;

    protected $fillable = [
        'body',
    ];

    public function getBody()
    {
        return $this->getAttributeValue('body');
    }
}
