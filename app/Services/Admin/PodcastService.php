<?php

namespace App\Services\Admin;

use App\Enums\StatusEnum;
use App\Models\Category;
use App\Models\Podcast;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PodcastService
{
    public function __construct(
        private PodcastDetailsService $podcastDetailsService,
    ) {

    }

    public function index()
    {
        return [
            'podcasts' => Podcast::orderBy('created_at', 'desc')->get(),
            'categories' => Category::all(),
        ];
    }

    public function store(array $data)
    {
        $data['content_id'] = $this->uniqueId();
        $data['podcast_image'] = $this->fileUpload($data['podcast_image'], $data['content_id']);

        Podcast::create([
            ...$data,
            'status' => StatusEnum::Active->value,
        ]);
    }

    public function show(Podcast $podcast)
    {
        return [
            'podcast' => $podcast,
        ];
    }

    public function edit(Podcast $podcast)
    {
        return [
            'podcast' => $podcast,
            'categories' => Category::all(),
        ];
    }

    public function update(array $data, Podcast $podcast)
    {
        DB::transaction(function () use ($data, $podcast) {
            if (isset($data['podcast_image'])) {
                $data['podcast_image'] = $this->fileUpload($data['podcast_image'], $podcast->content_id, $podcast);
            }
            $podcast->update($data);

        }, 5);
    }

    public function destroy(Podcast $podcast)
    {
        $podcastDetails = $podcast->podcastDetails;

        DB::transaction(function () use ($podcast, $podcastDetails) {

            if (Storage::exists('public/podcast/'.$podcast->podcast_image)) {
                Storage::delete('public/podcast/'.$podcast->podcast_image);
            }
            foreach ($podcastDetails as $podcastDetail) {

                $this->podcastDetailsService->destroy($podcastDetail);
            }

            $podcast->delete();
        });
    }

    public function fileUpload($image, $content_id, Podcast $podcast = null)
    {
        $name = $content_id.'.'.$image->getClientOriginalExtension();

        if ($podcast && Storage::exists('public/podcast/'.$podcast->podcast_image)) {
            Storage::delete('public/podcast/'.$podcast->podcast_image);
        }

        Storage::put('public/podcast/'.$name, file_get_contents($image));

        return $name;
    }

    public function uniqueId()
    {
        $id = 'RTPOD_'.rand(10000, 99999);
        if (Podcast::where('content_id', $id)->exists()) {
            $this->uniqueId();
        }

        return $id;
    }
}
