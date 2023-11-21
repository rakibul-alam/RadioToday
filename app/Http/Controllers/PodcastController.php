<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Requests\StorePodcastRequest;
use App\Http\Requests\UpdatePodcastRequest;
use App\Models\Podcast;
use App\Services\Admin\PodcastService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PodcastController extends Controller
{
    public function __construct(
        private PodcastService $podcastService,
    ) {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('podcasts.index', $this->podcastService->index());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('podcasts.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePodcastRequest $request)
    {
        $this->podcastService->store($request->validated());

        return to_route('podcasts.index')->with('status', 'New Podcast Content Successfully Created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Podcast $podcast)
    {
        return view('podcasts.show', $this->podcastService->show($podcast));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Podcast $podcast)
    {
        return view('podcasts.edit', $this->podcastService->edit($podcast));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePodcastRequest $request, Podcast $podcast)
    {
        $this->podcastService->update($request->validated(), $podcast);
        Session::flash('status', 'Podcast Content Successfully Updated');

        return response()->json(['redirect' => true, 'route' => route('podcasts.index')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Podcast $podcast)
    {
        $this->podcastService->destroy($podcast);

        return to_route('podcasts.index')->with('status', "Podcast's Info Successfully Deleted.");
    }

    public function changePodcastStatus(Request $request, Podcast $podcast)
    {
        $podcast->update([
            'status' => $podcast->status == StatusEnum::Active->value ? StatusEnum::Inactive->value : StatusEnum::Active->value,
        ]);
        Session::flash('status', 'Podcast Status Successfully Changed');

        return response()->json(['redirect' => true, 'route' => route('podcasts.index')]);
    }
}
