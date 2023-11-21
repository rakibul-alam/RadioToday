<?php

namespace App\Services\Admin;

use App\Enums\StatusEnum;
use App\Models\Promotion;
use Illuminate\Support\Facades\Storage;

class PromotionsService
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return [
            'promotions' => Promotion::orderBy('created_at', 'desc')->get(),
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
        Promotion::create([
            ...$data,
            'status' => StatusEnum::Active->value,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Promotion $promotion)
    {
        return [
            'promotion' => $promotion,
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promotion $promotion)
    {
        return [
            'promotion' => $promotion,
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(array $data, Promotion $promotion)
    {
        if (isset($data['image'])) {

            $data['image'] = $this->fileUpload($data['image']);
        }

        $promotion->update($data);
    }

    public function fileUpload($image, Promotion $promotion = null)
    {
        $name = time().'.'.$image->getClientOriginalExtension();
        if ($promotion) {
            if (Storage::exists('public/promotions/'.$promotion->image)) {
                Storage::delete('public/promotions/'.$promotion->image);
            }
        }
        Storage::put('public/promotions/'.$name, file_get_contents($image));

        return $name;
    }
}
