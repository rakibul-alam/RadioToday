<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGalleryDetailsRequest;
use App\Models\GalleryDetails;
use App\Models\PhotoGallery;
use App\Services\Admin\GalleryDetailsService;
use Illuminate\Support\Facades\Storage;

class GalleryDetailsController extends Controller
{
    public function __construct(
        private GalleryDetailsService $galleryDetailsService
    ) {

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreGalleryDetailsRequest $request, PhotoGallery $photo_gallery)
    {
        $request->validated();

        if ($request->has('image')) {
            foreach ($request->file('image') as $image) {
                $name = time().'-'.$image->getClientOriginalName();
                Storage::put('public/gallery/'.$name, file_get_contents($image));
                GalleryDetails::create([
                    'image' => $name,
                    'gallery_id' => $photo_gallery->id,
                ]);
            }
        }

        return to_route('photo-galleries.show', $photo_gallery->id)->with('status', 'New Gallery Successfully Created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(GalleryDetails $gallery_detail)
    {

        return view('photo-gallery.show', $this->galleryDetailsService->show($gallery_detail));
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PhotoGallery $photo_gallery, GalleryDetails $gallery_details)
    {
        if (Storage::exists('public/gallery/'.$gallery_details->image)) {
            Storage::delete('public/gallery/'.$gallery_details->image);
        }
        $gallery_details->delete();

        return to_route('photo-galleries.show', $photo_gallery->id)->with('status', 'Gallery Image Successfully Deleted.');

    }
}
