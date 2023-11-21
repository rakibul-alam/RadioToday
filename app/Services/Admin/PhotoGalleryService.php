<?php

namespace App\Services\Admin;

use App\Enums\StatusEnum;
use App\Models\PhotoGallery;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PhotoGalleryService
{
    public function __construct(
        private galleryDetailsService $galleryDetailsService,
    ) {

    }

    public function index()
    {
        return [
            'galleries' => PhotoGallery::orderBy('created_at', 'desc')->get(),
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(array $data)
    {
        $data['image'] = $this->fileUpload($data['image']);

        PhotoGallery::create([
            ...$data,
            'status' => StatusEnum::Active->value,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PhotoGallery $photo_gallery)
    {
        return [
            'gallery' => $photo_gallery,
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PhotoGallery $photo_gallery)
    {
        return [
            'gallery' => $photo_gallery,
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(array $data, PhotoGallery $photo_gallery)
    {
        DB::transaction(function () use ($data, $photo_gallery) {
            if (isset($data['image'])) {

                $data['image'] = $this->fileUpload($data['image']);
            }
            $photo_gallery->update($data);

        }, 5);
    }

    public function destroy(PhotoGallery $photo_gallery)
    {
        $galleryDetails = $photo_gallery->galleryDetails;

        DB::transaction(function () use ($photo_gallery, $galleryDetails) {

            if (Storage::exists('public/gallery/'.$photo_gallery->image)) {
                Storage::delete('public/gallery/'.$photo_gallery->image);
            }
            foreach ($galleryDetails as $galleryDetail) {

                $this->galleryDetailsService->destroy($galleryDetail);
            }

            $photo_gallery->delete();
        });

    }

    public function fileUpload($image, PhotoGallery $photo_gallery = null)
    {
        $name = time().'.'.$image->getClientOriginalExtension();

        if ($photo_gallery && Storage::exists('public/gallery/'.$photo_gallery->image)) {
            Storage::delete('public/gallery/'.$photo_gallery->image);
        }

        Storage::put('public/gallery/'.$name, file_get_contents($image));

        return $name;
    }
}
