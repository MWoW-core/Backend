<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use BeyondCode\Comments\Traits\HasComments;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class News
 * @package App
 * @mixin Builder
 * @property int $id
 * @property int $writer_id
 * @property string $title
 * @property string $slug
 * @property string $headline
 * @property string $body
 * @property-read string $link
 * @property-read User $creator
 * @property-read Collection $comments
 */
class News extends Model
{
    use HasComments, SoftDeletes;

    protected $fillable = [
        'writer_id',
        'category',
        'title',
        'slug',
        'headline',
        'body'
    ];

    public function writer()
    {
        return $this->belongsTo(User::class);
    }
}
