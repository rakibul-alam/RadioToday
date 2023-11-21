    @extends('layouts.main')

    @section('title', 'CMS | RjProfile')

    @section('content')


    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="row">
                <div class="col-12">
                    <div class="gallery card card-bordered">
                        <a class="gallery-image popup-image" href="#">
                            <img src="{{ asset('storage/rj/'.$profile->image) }}" alt="" width="250px">
                        </a>
                        <div class="gallery-body card-inner align-center justify-between flex-wrap g-2">
                            <div class="user-card">
                                <div class="rj-info">
                                    <span class="lead-text">{{$profile->name}}</span>
                                    <span class="lead-text">{!! $profile->details !!}</span>
                                </div>
                            </div>
                            <div>
                                <a href="#">
                                    <button class="btn btn-p-0 btn-nofocus"><em class="icon ni ni-share"></em></button>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div @endsection