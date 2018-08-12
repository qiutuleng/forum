<?php

namespace App\Models;

use App\Models\Traits\HasOwner;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasOwner;

    protected $fillable = [
        'channel_id', 'title', 'body',
    ];

    /**
     * Belongs to a channel.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    /**
     * Get the channel that owns this thread.
     *
     * @return Channel|null
     */
    public function getChannel()
    {
        return $this->getRelationValue('channel');
    }

    /**
     * Get the channel slug that owns this thread.
     *
     * @return string
     */
    public function getChannelSlug()
    {
        return $this->getChannel()->getSlug();
    }

    /**
     * Have multiple replies.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    /**
     * Get all the replies belonging to this thread.
     *
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
        return route('threads.show', [$this->getChannelSlug(), $this]);
    }

    /**
     * Get a title attribute.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->getAttributeValue('title');
    }

    /**
     * Get a body attribute.
     *
     * @return string
     */
    public function getBody()
    {
        return $this->getAttributeValue('body');
    }

    /**
     * Add a reply to this thread.
     *
     * @param array $reply
     * @return Reply
     */
    public function addReply(array $reply)
    {
        return $this->replies()->create($reply);
    }
}
