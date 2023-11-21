<?php

namespace App\Services\Admin;

use App\Enums\StatusEnum;
use App\Models\Announcer;
use Illuminate\Support\Facades\Storage;

class AnnouncerService
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return [
            'announcers' => Announcer::orderBy('created_at', 'desc')->get(),
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

        Announcer::create([
            ...$data,
            'status' => StatusEnum::Active->value,
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Announcer $announcer)
    {
        return [
            'announcer' => $announcer,
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Announcer $announcer)
    {
        return [
            'announcer' => $announcer,
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(array $data, Announcer $announcer)
    {
        if (isset($data['image'])) {

            $data['image'] = $this->fileUpload($data['image']);
        }
        $announcer->update($data);
    }

    public function fileUpload($image, Announcer $announcer = null)
    {
        $name = time().'.'.$image->getClientOriginalExtension();
        if ($announcer) {
            if (Storage::exists('public/announcers/'.$announcer->image)) {
                Storage::delete('public/announcers/'.$announcer->image);
            }
        }
        Storage::put('public/announcers/'.$name, file_get_contents($image));

        return $name;
    }
}
