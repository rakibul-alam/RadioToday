<?php

namespace App\Services\Admin;

use App\Models\Highlight;
use Illuminate\Support\Facades\Storage;

class HighlightService
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return [
            'highlights' => Highlight::orderBy('created_at', 'desc')->get(),
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

        Highlight::create($data);

    }

    /**
     * Display the specified resource.
     */
    public function show(Highlight $highlight)
    {
        return [
            'highlight' => $highlight,
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Highlight $highlight)
    {
        return [
            'highlight' => $highlight,
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(array $data, Highlight $highlight)
    {
        if (isset($data['image'])) {

            $data['image'] = $this->fileUpload($data['image']);
        }

        $highlight->update($data);
    }

    public function fileUpload($image, Highlight $highlight = null)
    {
        $name = time().'.'.$image->getClientOriginalExtension();
        if ($highlight) {
            if (Storage::exists('public/highlights/'.$highlight->image)) {
                Storage::delete('public/highlights/'.$highlight->image);
            }
        }
        Storage::put('public/highlights/'.$name, file_get_contents($image));

        return $name;
    }

    /**
     * Remove the specified resource from storage.
     */
}
