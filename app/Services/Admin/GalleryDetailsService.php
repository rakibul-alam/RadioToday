<?php

namespace App\Services\Admin;

use App\Models\GalleryDetails;
use App\Models\PhotoGallery;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GalleryDetailsService
{

    public function store(array $data, PhotoGallery $photo_gallery, GalleryDetails $gallery_detail)
    {
        $data['image'] = $this->fileUpload($data['image']);
        GalleryDetails::create($data);
    }

    public function show(GalleryDetails $gallery_detail)
    {
        return [
            'gallery' => $gallery_detail,
        ];
    }

    public function edit(GalleryDetails $gallery_detail)
    {
        return [
            'gallery' => $gallery_detail,
        ];
    }

    public function update(array $data, GalleryDetails $gallery_detail)
    {
        if (isset($data['image'])) {

            $data['image'] = $this->fileUpload($data['image']);
        }

        $gallery_detail->update($data);
    }

    public function destroy(GalleryDetails $gallery_detail)
    {
        DB::transaction(function () use ($gallery_detail) {
            if (Storage::exists('public/gallery/'.$gallery_detail->image)) {
                Storage::delete('public/gallery/'.$gallery_detail->image);
            }
            $gallery_detail->delete();
        });

    }

    public function fileUpload($image, GalleryDetails $gallery_detail = null)
    {
        $name = time().'.'.$image->getClientOriginalExtension();

        if ($gallery_detail && Storage::exists('public/gallery/'.$$gallery_detail->image)) {
            Storage::delete('public/gallery/'.$$gallery_detail->image);
        }
        Storage::put('public/gallery/'.$name, file_get_contents($image));

        return $name;
    }
}