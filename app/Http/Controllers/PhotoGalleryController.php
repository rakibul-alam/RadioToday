<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhotoGalleryRequest;
use App\Http\Requests\UpdatePhotoGalleryRequest;
use App\Models\PhotoGallery;
use App\Services\Admin\PhotoGalleryService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PhotoGalleryController extends Controller
{
    public function __construct(
        private PhotoGalleryService $photoGalleryService
    ) {

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('photo-gallery.index', $this->photoGalleryService->index());
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
    public function store(StorePhotoGalleryRequest $request)
    {
        $this->photoGalleryService->store($request->validated());

        return to_route('photo-galleries.index')->with('status', 'New Gallery Successfully Created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PhotoGallery $photo_gallery)
    {
        return view('photo-gallery.show', $this->photoGalleryService->show($photo_gallery));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PhotoGallery $photo_gallery)
    {
        return view('photo-gallery.edit', $this->photoGalleryService->edit($photo_gallery));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhotoGalleryRequest $request, PhotoGallery $photo_gallery)
    {
        $this->photoGalleryService->update($request->validated(), $photo_gallery);
        Session::flash('status', 'Photo Gallery Successfully Updated');

        return response()->json(['redirect' => true, 'route' => route('photo-galleries.index')]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PhotoGallery $photo_gallery)
    {
        // dd($this->photoGalleryService);
        $this->photoGalleryService->destroy($photo_gallery);

        return to_route('photo-galleries.index')->with('status', 'Gallery Info Successfully Deleted.');
    }
}
