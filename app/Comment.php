<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Comment
 * @package App
 * @mixin Builder
 *
 * @property string $comment
 * @property string $commentable_type
 * @property integer $commentable_id
 * @property integer $user_id
 * @property boolean $is_approved
 *
 * @property-read Collection $comments
 * @property-read Model $commentable
 * @property-read User|null $commentator
 */
class Comment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'comment',
        'commentable_type',
        'commentable_id',
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
