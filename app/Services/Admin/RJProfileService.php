<?php

namespace App\Services\Admin;

use App\Enums\StatusEnum;
use App\Models\RJProfile;
use Illuminate\Support\Facades\Storage;

class RJProfileService
{
    public function index()
    {
        return [
            'profiles' => RJProfile::orderBy('created_at', 'desc')->get(),
        ];
    }

    public function store(array $data)
    {
        $data['image'] = $this->fileUpload($data['image']);

        RJProfile::create([
            ...$data,
            'status' => StatusEnum::Active->value,
        ]);

    }

    public function show(RJProfile $rj_profile)
    {
        return [
            'profile' => $rj_profile,
        ];
    }

    public function edit(RJProfile $rj_profile)
    {
        return [
            'profile' => $rj_profile,
        ];
    }

    public function update(array $data, RJProfile $rj_profile)
    {
        if (isset($data['image'])) {

            $data['image'] = $this->fileUpload($data['image']);
        }

        $rj_profile->update($data);
    }

    public function fileUpload($image, RJProfile $rj_profile = null)
    {
        $name = time().'.'.$image->getClientOriginalExtension();
        if ($rj_profile) {
            if (Storage::exists('public/rj/'.$rj_profile->image)) {
                Storage::delete('public/rj/'.$rj_profile->image);
            }
        }
        Storage::put('public/rj/'.$name, file_get_contents($image));

        return $name;
    }
}
