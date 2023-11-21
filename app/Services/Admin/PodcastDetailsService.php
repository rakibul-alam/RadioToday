<?php

namespace App\Services\Admin;

use App\Enums\StatusEnum;
use App\Models\Podcast;
use App\Models\PodcastDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PodcastDetailsService
{
    public function index()
    {
        return [
            'podcast_details' => PodcastDetails::orderBy('created_at', 'desc')->get(),

        ];
    }

    public function store(array $data, Podcast $podcast)
    {

        $data['content_details_id'] = $this->uniqueId($podcast->content_id);

        $size = $data['file_path']->getSize();
        $extension = $data['file_path']->getClientOriginalExtension();
        $name = $data['content_details_id'].'.'.$extension;
        Storage::disk('local')->put('public/podcast/audio/'.$name, file_get_contents($data['file_path']));
        $data['file_path'] = $name;

        $data['image'] = $this->fileUpload($data['image'], $data['content_details_id']);

        PodcastDetails::create([
            ...$data,
            'podcast_id' => $podcast->id,
            'status' => StatusEnum::Active->value,
        ]);
    }

    public function uniqueId(string $content_id)
    {
        $id = $content_id.'_'.rand(1000, 9999);
        if (PodcastDetails::where('content_details_id', $id)->exists()) {
            $this->uniqueId($content_id);
        }

        return $id;
    }

    public function edit(PodcastDetails $podcastDetail)
    {
        return [
            'podcast' => $podcastDetail,
            'podcasts' => Podcast::all(),
        ];
    }

    public function update(array $data, PodcastDetails $podcastDetail)
    {
        if (isset($data['file_path'])) {

            if (Storage::exists('public/podcast/audio/'.$podcastDetail->file_path)) {
                Storage::delete('public/podcast/audio/'.$podcastDetail->file_path);
            }
            $data['file_path'] = $podcastDetail->content_details_id.'.'.$podcastDetail->file('file_path')->getClientOriginalExtension();
            Storage::disk('local')->put('public/podcast/audio/'.$data['file_path'], file_get_contents($podcastDetail->file('file_path')));
        }

        if (isset($data['image'])) {

            $data['image'] = $this->fileUpload($data['image'], $podcastDetail->content_details_id, $podcastDetail);
        }

        $podcastDetail->update($data);

    }

    public function fileUpload($image, $content_details_id, PodcastDetails $podcastDetail = null)
    {
        $name = $content_details_id.'.'.$image->getClientOriginalExtension();
        if ($podcastDetail) {
            if (Storage::exists('public/podcast/'.$podcastDetail->image)) {
                Storage::delete('public/podcast/'.$podcastDetail->image);
            }
        }
        Storage::put('public/podcast/'.$name, file_get_contents($image));

        return $name;
    }

    public function destroy(PodcastDetails $podcastDetail)
    {
        DB::transaction(function () use ($podcastDetail) {
            if (Storage::exists('public/podcast/'.$podcastDetail->image)) {
                Storage::delete('public/podcast/'.$podcastDetail->image);
            }
            if (Storage::exists('public/podcast/audio/'.$podcastDetail->file_path)) {
                Storage::delete('public/podcast/audio/'.$podcastDetail->file_path);
            }

            $podcastDetail->delete();
        });

    }
}
