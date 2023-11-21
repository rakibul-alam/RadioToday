<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    use HasFactory,HasUuids;

    protected $fillable =
    [
        'name',
        'content_id',
        'category_id',
        'released',
        'description',
        'name_bn',
        'published_date',
        'tag',
        'podcast_image',
        'status',

    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function podcastDetails()
    {
        return $this->hasMany(PodcastDetails::class);
    }
}
