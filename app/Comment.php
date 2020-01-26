<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Comment extends Model
{
    protected $fillable = [
        'comment',
        'user_id',
        'is_approved'
    ];

    protected $casts = [
        'is_approved' => 'boolean'
    ];

    /**
     * Return all comments for this model.
     *
     * @return MorphMany
     */
    public function comments()
    {
        return $this->morphMany(config('comments.comment_class'), 'commentable');
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function commentator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
