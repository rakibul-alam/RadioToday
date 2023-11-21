<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Requests\StoreAnnouncerRequest;
use App\Http\Requests\UpdateAnnouncerRequest;
use App\Models\Announcer;
use App\Services\Admin\AnnouncerService;
use Illuminate\Support\Facades\Session;

class AnnouncerController extends Controller
{
    public function __construct(
        private AnnouncerService $announcerService
    ) {

    }

    public function index()
    {
        return view('announcer.index', $this->announcerService->index());
    }

    public function store(StoreAnnouncerRequest $request)
    {
        $this->announcerService->store($request->validated());

        return to_route('announcers.index')->with('status', 'New Announcer Successfully Created.');
    }

    public function show(Announcer $announcer)
    {

        return view('announcer.show', $this->announcerService->show($announcer));

    }

    public function edit(Announcer $announcer)
    {
        return view('announcer.edit', $this->announcerService->edit($announcer));

    }

    public function update(UpdateAnnouncerRequest $request, Announcer $announcer)
    {
        $this->announcerService->update($request->validated(), $announcer);
        Session::flash('status', 'Announcer Successfully Updated');

        return response()->json(['redirect' => true, 'route' => route('announcers.index')]);
    }

    public function destroy(Announcer $announcer)
    {
        $announcer->delete();

        return to_route('announcers.index')->with('status', 'Announcer Info Successfully Deleted.');
    }

    public function changeAnnouncerStatus(Announcer $announcer)
    {
        $announcer->update([
            'status' => $announcer->status == StatusEnum::Active->value ? StatusEnum::Inactive->value : StatusEnum::Active->value,
        ]);
        Session::flash('status', 'Announcer Status Successfully Changed');

        return response()->json(['redirect' => true, 'route' => route('announcers.index')]);
    }
}
