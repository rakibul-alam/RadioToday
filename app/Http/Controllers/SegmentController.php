<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Requests\StoreSegmentRequest;
use App\Http\Requests\UpdateSegmentRequest;
use App\Models\Segment;
use App\Services\Admin\SegmentService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SegmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(
        private SegmentService $segmentService
    ) {

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('segment.index', $this->segmentService->index());
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
    public function store(StoreSegmentRequest $request)
    {
        $this->segmentService->store($request->validated());

        return to_route('segments.index')->with('status', 'New Segment Successfully Created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Segment $segment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Segment $segment)
    {
        return view('segment.edit', $this->segmentService->edit($segment));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSegmentRequest $request, Segment $segment)
    {
        $this->segmentService->update($request->validated(), $segment);
        Session::flash('status', 'Segment Successfully Updated');

        return response()->json(['redirect' => true, 'route' => route('segments.index')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Segment $segment)
    {
        $segment->delete();

        return to_route('segments.index')->with('status', 'Segment Info Successfully Deleted.');
    }

    public function changeSegmentStatus(Segment $segment)
    {
        $segment->update([
            'status' => $segment->status == StatusEnum::Active->value ? StatusEnum::Inactive->value : StatusEnum::Active,
        ]);
        Session::flash('status', 'Segment Status Successfully Changed');

        return response()->json(['redirect' => true, 'route' => route('segments.index')]);
    }
}
