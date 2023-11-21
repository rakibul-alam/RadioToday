<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Requests\StoreRJProfileRequest;
use App\Http\Requests\UpdateRJProfileRequest;
use App\Models\RJProfile;
use App\Services\Admin\RJProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class RJProfileController extends Controller
{
    public function __construct(
        private RJProfileService $rjProfileService
    ) {

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('rj-profile.index', $this->rjProfileService->index());
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
    public function store(StoreRJProfileRequest $request)
    {
        $this->rjProfileService->store($request->validated());

        return to_route('rj-profiles.index')->with('status', 'New RJ Successfully Created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(RJProfile $rj_profile)
    {

        return view('rj-profile.show', $this->rjProfileService->show($rj_profile));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RJProfile $rj_profile)
    {
        return view('rj-profile.edit', $this->rjProfileService->edit($rj_profile));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRJProfileRequest $request, RJProfile $rj_profile)
    {
        $this->rjProfileService->update($request->validated(), $rj_profile);
        Session::flash('status', 'RJ Profile Successfully Updated');

        return response()->json(['redirect' => true, 'route' => route('rj-profiles.index')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RJProfile $rj_profile)
    {
        $rj_profile->delete();

        return to_route('rj-profiles.index')->with('status', 'RJ Info Successfully Deleted.');
    }

    public function changeRJProfileStatus(Request $request, RJProfile $profile)
    {
        $profile->update([
            'status' => $profile->status == StatusEnum::Active->value ? StatusEnum::Inactive->value : StatusEnum::Active,
        ]);
        Session::flash('status', 'RJ Status Successfully Changed');

        return response()->json(['redirect' => true, 'route' => route('rj-profiles.index')]);
    }
}
