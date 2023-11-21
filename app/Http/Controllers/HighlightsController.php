<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHighlightsRequest;
use App\Http\Requests\UpdateHighlightsRequest;
use App\Models\Highlight;
use App\Services\Admin\HighlightService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class HighlightsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(
        private HighlightService $highlightService
    ) {

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('highlight.index', $this->highlightService->index());
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
    public function store(StoreHighlightsRequest $request)
    {
        $this->highlightService->store($request->validated());

        return to_route('highlights.index')->with('status', 'New Highlights Successfully Created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Highlight $highlight)
    {

        return view('highlight.show', $this->highlightService->show($highlight));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Highlight $highlight)
    {
        return view('highlight.edit', $this->highlightService->edit($highlight));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHighlightsRequest $request, Highlight $highlight)
    {
        $this->highlightService->update($request->validated(), $highlight);
        Session::flash('status', 'Highlight Successfully Updated');

        return response()->json(['redirect' => true, 'route' => route('highlights.index')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Highlight $highlight)
    {
        $highlight->delete();

        return to_route('promotions.index')->with('status', 'Highlights Info Successfully Deleted.');
    }

    public function changePromotionStatus(Highlight $highlight)
    {
        $highlight->update([
            'status' => $highlight->status == 1 ? 0 : 1,
        ]);
        Session::flash('status', 'Highlights Status Successfully Changed');

        return response()->json(['redirect' => true, 'route' => route('highlights.index')]);
    }
}
