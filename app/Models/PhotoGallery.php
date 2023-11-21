<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoGallery extends Model
{
    use HasFactory , HasUuids;

    protected $fillable = [
        'title',
        'image',
        'description',
    ];

    // public function images()
    // {
    //     return $this->hasMany(GalleryDetails::class, 'gallery_id', 'id');
    // }

    public function galleryDetails()
    {
        return $this->hasMany(GalleryDetails::class, 'gallery_id', 'id');
    }
}