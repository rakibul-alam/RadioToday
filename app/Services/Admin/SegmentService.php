<?php

namespace App\Services\Admin;

use App\Enums\StatusEnum;
use App\Models\Segment;
use Illuminate\Support\Facades\Storage;

class SegmentService
{
    public function index()
    {
        return [
            'segments' => Segment::orderBy('created_at', 'desc')->get(),
        ];
    }

    public function store(array $data)
    {
        $data['image'] = $this->fileUpload($data['image']);

        Segment::create([
            ...$data,
            'status' => StatusEnum::Active->value,
        ]);

    }

    public function edit(Segment $segment)
    {
        return [
            'segment' => $segment,
        ];
    }

    public function update(array $data, Segment $segment)
    {
        if (isset($data['image'])) {

            $data['image'] = $this->fileUpload($data['image']);
        }

        $segment->update($data);
    }

    public function fileUpload($image, Segment $segment = null)
    {
        $name = time().'.'.$image->getClientOriginalExtension();
        if ($segment) {
            if (Storage::exists('public/segments/'.$segment->image)) {
                Storage::delete('public/segments/'.$segment->image);
            }
        }
        Storage::put('public/segments/'.$name, file_get_contents($image));

        return $name;
    }
}
