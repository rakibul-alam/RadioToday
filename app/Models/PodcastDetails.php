<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PodcastDetails extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'podcast_id',
        'content_details_id',
        'title',
        'image',
        'description',
        'file_path',
        'duration_time',
        'release_date',
        'status',

    ];

    public function podcast()
    {
        return $this->belongsTo(Podcast::class);
    }
}
