<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Requests\StorePodcastDetailsRequest;
use App\Http\Requests\UpdatePodcastDetailsRequest;
use App\Models\Podcast;
use App\Models\PodcastDetails;
use App\Services\Admin\PodcastDetailsService;
use Illuminate\Support\Facades\Session;

class PodcastDetailsController extends Controller
{
    public function __construct(
        private PodcastDetailsService $podcastDetailsService,
    ) {
        //
    }

    public function index()
    {
        $podcast_details = PodcastDetails::all();

        return view('podcasts.show', compact('podcasts'));
    }

    public function store(StorePodcastDetailsRequest $request, Podcast $podcast)
    {
        $this->podcastDetailsService->store($request->validated(), $podcast);

        return to_route('podcasts.show', $podcast->id)->with('status', 'New Podcast Details Content Successfully Created.');
    }

    public function uniqueId(string $content_id)
    {
        $id = $content_id.'_'.rand(1000, 9999);
        if (PodcastDetails::where('content_details_id', $id)->exists()) {
            $this->uniqueId($content_id);
        }

        return $id;
    }

    public function edit(Podcast $podcast, PodcastDetails $podcastDetail)
    {
        return view('podcast-details.edit', [
            'podcast' => $podcast,
            'podcastDetail' => $podcastDetail,
        ]);
    }

    public function update(UpdatePodcastDetailsRequest $request, Podcast $podcast, PodcastDetails $podcastDetail)
    {
        $this->podcastDetailsService->update($request->validated(), $podcastDetail);

        Session::flash('status', 'Podcast Details Content Successfully Updated');

        return response()->json(['redirect' => true, 'route' => route('podcasts.show', $podcast->id)]);
    }

    public function destroy(Podcast $podcast, PodcastDetails $podcastDetail)
    {
        $this->podcastDetailsService->destroy($podcastDetail);

        return to_route('podcasts.show', $podcast->id)->with('status', 'Podcast Details Info Successfully Deleted.');
    }

    public function podcastDetailsStatusChange(PodcastDetails $podcastDetail)
    {
        $podcastDetail->update([
            'status' => $podcastDetail->status == StatusEnum::Active->value ? StatusEnum::Inactive->value : StatusEnum::Active,
        ]);
        Session::flash('status', 'Podcast Details Status Successfully Changed');

        return response()->json(['redirect' => true, 'route' => route('podcasts.show', $podcastDetail->podcast_id)]);
    }
}
