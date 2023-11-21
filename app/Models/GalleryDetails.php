<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryDetails extends Model
{
    use HasFactory , HasUuids;

    protected $fillable = [
        'image',
        'gallery_id',
    ];

    public function gallery()
    {
        return $this->belongsTo(PhotoGallery::class);
    }
}
