@extends('layouts.main')

@section('title', 'CMS | Podcast')

@section('content')

@php
use Illuminate\Support\Str;
use App\Enums\StatusEnum;
@endphp

<div class="container">
    <div class="card col-12">
        <div class="card-header d-flex justify-content-between">
            <h4>Content List : ({{$podcast->name}}-{{$podcast->content_id}})</h4>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalForm">
                Add New Podcast File
            </button>
        </div>
        <div class="card-inner">
            <table class="datatable-init nowrap table">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Duration</th>
                        <th>Audio Player</th>
                        <th>Publish Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $podcastDetails=$podcast->podcastDetails;
                    @endphp
                    @foreach ($podcastDetails as $index => $podcastDetail)
                    <tr>
                        <td>{{ $index + 1 }}</td>

                        <td>{{ $podcastDetail->title }}</td>
                        <td><img src="{{ asset('storage/podcast/'.$podcastDetail->image) }}" alt="" width="50px">
                        </td>
                        <td>{{  sprintf("%02d:%02d", floor( $podcastDetail->duration_time/60),  $podcastDetail->duration_time%60) . ' h ' }}
                        </td>
                        <td> <audio controls>
                                <source src="{{ asset('storage/podcast/audio/'.$podcastDetail->file_path) }}"
                                    type="audio/mp3">
                            </audio>
                        </td>
                        <td>{{ $podcastDetail->release_date }}</td>
                        <td>
                        <div class="custom-control custom-switch status-change"
                            data-value="{{ $podcastDetail->status == StatusEnum:: Active->value ? StatusEnum:: Inactive->value : StatusEnum:: Active->value }}"
                            data-url="{{route('podcast-details.status.update.change',$podcastDetail->id)}}">
                            <input type="checkbox" class="custom-control-input" id="customSwitch{{$index + 1}}"
                                {{ $podcastDetail->status == StatusEnum::Active->value ? 'checked' : '' }} name='input_switch'>
                            <label class="custom-control-label" for="customSwitch{{$index + 1}}"></label>
                        </div>
                        </td>
                        <td>
                            <form method="POST" action="{{route('podcasts.details.content.destroy',  ['podcast' => $podcast->id, 'podcastDetail' => $podcastDetail->id]) }}">
                                @method('DELETE')
                                @csrf
                                    <a href="javascript:void(0)" class="badge bg-outline-info ajax-modal-trigger"
                                    data-route="{{ route('podcasts.content.edit',  ['podcast' => $podcast->id, 'podcastDetail' => $podcastDetail->id]) }}"><em
                                        class=" icon ni ni-edit"></em>
                                    Edit</a>

                                    <button class="badge bg-outline-danger" onclick="return confirm('Are you sure?'); event.preventDefault();
                                    this.closest('form').submit();"><em class="icon ni ni-trash"></em>
                                    Delete</a>
                                </button>
                            </form>
                        </td>
                    </tr>
                 @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalForm">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Podcast Details</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body col-md-12">
                <form action="{{route('podcasts.content.store',$podcast->id)}}" method="post"
                    enctype="multipart/form-data" class="form-validate is-alter">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="form-control-wrap">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Title</span>
                                    </div>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title">
                                    @error('title')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <div class="form-control-wrap">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Podcast Name</span>
                                    </div>
                                    <input type="text" class="form-control @error('podcast_id') is-invalid @enderror"
                                        id="podcast_id" name="podcast_id">
                                    @error('podcast_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="form-control-wrap">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> Image</span>
                                    </div>
                                    <div class="form-file"> <input type="file" class="form-file-input" id="image"
                                            name="image">
                                        <label class="form-file-label" for="image"></label>
                                    </div>
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <div class="form-control-wrap">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Release Date</span>
                                    </div>
                                    <input type="text" autocomplete="false"
                                        class="form-control @error('release_date') is-invalid @enderror date-picker"
                                        id="release_date" name="release_date">
                                    @error('release_date')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="form-control-wrap">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> File</span>
                                    </div>
                                    <div class="form-file">
                                        <input type="file"
                                            class="form-file-input @error('file_path') is-invalid @enderror"
                                            id="file_path" name="file_path">
                                        <label class="form-file-label" for="file_path"></label>
                                    </div>
                                    @error('file_path')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <div class="form-control-wrap">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Duration Time</span>
                                    </div>
                                    <input type="text" autocomplete="false"
                                        class="form-control @error('released') is-invalid @enderror" id="duration_time"
                                        name="duration_time">
                                    @error('duration_time')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-12">
                            <div class="form-control-wrap">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Description</span>
                                    </div>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                        name="description" id="description" rows="2"></textarea>

                                    @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="modal-footer bg-light">
                <button type="submit" class="btn btn-lg btn-primary ml-auto">Create </button>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
changePodcastDetailsStatus();

function changePodcastDetailsStatus() {
    $btnDestroy = $('.status-change');

    $btnDestroy.on('click', function() {
        swal({
            title: "Is this " + $(this).data('value') + "?",
            icon: "warning",
            type: "warning",
            buttons: ["Cancel", "Yes!"],
            confirmButtonColor: '#0ac282',
            cancelButtonColor: '#fe5d70',
            confirmButtonText: 'Yes, confirm it!'
        }).then((confirm) => {
            if (confirm) {
                $.ajax({
                    url: $(this).data('url'),
                    type: 'post',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        '_method': 'PATCH',
                    },
                    success: function(data) {
                        if (data.redirect == true) {
                            return window.location.replace(data.route);
                        }
                    },
                    error: function() {}
                });
            } else {
                let input = this.querySelector('input[name=input_switch]');
                if (input.checked) {
                    input.checked = false;
                } else {
                    input.checked = true;
                }
            }
        });
    });
}
</script>
@endpush
