<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Requests\StorePromotionRequest;
use App\Http\Requests\UpdatePromotionRequest;
use App\Models\Promotion;
use App\Services\Admin\PromotionsService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PromotionController extends Controller
{
    public function __construct(
        private PromotionsService $promotionsService
    ) {

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('promotion.index', $this->promotionsService->index());
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
    public function store(StorePromotionRequest $request)
    {
        $this->promotionsService->store($request->validated());

        return to_route('promotions.index')->with('status', 'New Promotion Successfully Created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Promotion $promotion)
    {

        return view('promotion.show', $this->promotionsService->show($promotion));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promotion $promotion)
    {
        return view('promotion.edit', $this->promotionsService->edit($promotion));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePromotionRequest $request, Promotion $promotion)
    {
        $this->promotionsService->update($request->validated(), $promotion);
        Session::flash('status', 'Promotion Successfully Updated');

        return response()->json(['redirect' => true, 'route' => route('promotions.index')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promotion $promotion)
    {
        $promotion->delete();

        return to_route('promotions.index')->with('status', 'Promotion Info Successfully Deleted.');
    }

    public function changePromotionStatus(Promotion $promotion)
    {
        $promotion->update([
            'status' => $promotion->status == StatusEnum::Active->value ? StatusEnum::Inactive->value : StatusEnum::Active,
        ]);
        Session::flash('status', 'Promotion Status Successfully Changed');

        return response()->json(['redirect' => true, 'route' => route('promotions.index')]);
    }
}
