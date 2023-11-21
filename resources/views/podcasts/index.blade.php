@extends('layouts.main')

@section('title', 'CMS | Podcast')

@section('content')

@php
use Illuminate\Support\Str;
use App\Enums\StatusEnum;
@endphp

<style>
.tagify {
    width: 100%;
    max-width: 700px;
}
</style>

<div class="podcast-title">
    <ul>
        <li class="preview-item d-flex justify-content-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalForm">
                Add New Podcast
            </button>
        </li>
    </ul>
</div>

<div class="card card-bordered card-preview">
    <div class="card-inner">
        <table class="datatable-init nowrap table">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Podcast Image</th>
                    <th>Name</th>
                    <th>Bangla Name</th>
                    <th>Publish Date</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($podcasts as $index => $podcast)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <img src="{{ asset('storage/podcast/'.$podcast->podcast_image) }}" alt="" width="50px">
                    </td>
                    <td class="pro-name">
                        <h6>{{ $podcast->name }}</h6>
                    </td>
                    <td>{{ $podcast->name_bn }}</td>
                    <td>{{ $podcast->published_date }}</td>
                    <td class="text-wrap">
                        <span id="content1">{!! substr(strip_tags($podcast->description), 0, 200) !!}...</span>
                    </td>
                    <td>
                    <div class="custom-control custom-switch status-change"
                        data-value="{{ $podcast->status == StatusEnum:: Active->value ? StatusEnum:: Inactive->value : StatusEnum:: Active->value }}"
                        data-url="{{route('podcasts.status.change',$podcast->id)}}">
                        <input type="checkbox" class="custom-control-input" id="customSwitch{{$index + 1}}"
                            {{ $podcast->status == StatusEnum::Active->value ? 'checked' : '' }} name='input_switch'>
                        <label class="custom-control-label" for="customSwitch{{$index + 1}}"></label>
                    </div>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('podcasts.destroy', $podcast->id) }}">
                            @method('DELETE')
                            @csrf
                            <a href="javascript:void(0)" class="badge bg-outline-info ajax-modal-trigger"
                                data-route="{{ route('podcasts.edit', $podcast->id) }}"><em
                                    class=" icon ni ni-edit"></em>
                                Edit</a>
                            <button class="badge bg-outline-danger" onclick="return confirm('Are you sure?'); event.preventDefault();
                                this.closest('form').submit();"><em class="icon ni ni-trash"></em>
                                Delete</a>
                            </button>
                            <a href="{{ route('podcasts.show',$podcast->id) }}" class="badge bg-outline-success"><em
                                    class="icon ni ni-eye-fill"></em>
                                View</a>
                        </form>
                    </td>

                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalForm">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Podcast Info</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>

            <form action="{{route('podcasts.store')}}" method="post" class="form-validate is-alter"
                enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="modal-body col-md-12">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="form-control-wrap">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Name</span>
                                    </div>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name">
                                    @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <div class="form-control-wrap">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">বাংলা নাম</span>
                                    </div>
                                    <input type="text" class="form-control @error('name_bn') is-invalid @enderror"
                                        id="name_bn" name="name_bn">
                                    @error('name_bn')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="form-control-wrap">

                                <div class="input-group-prepend">
                                    <span class="input-group-text form-control ">Category</span>
                                    <select class="form-select form-control @error('released') is-invalid @enderror"
                                        id="category_id" name="category_id">
                                        <option value="">
                                            Select Category</option>
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name_en}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <div class="form-control-wrap">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Released</span>
                                    </div>
                                    <input type="text" autocomplete="false"
                                        class="form-control @error('released') is-invalid @enderror date-picker"
                                        id="released" name="released" required>
                                    @error('released')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-control-wrap">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Publish Date</span>
                                    </div>
                                    <input type="text" autocomplete="false"
                                        class="form-control @error('released') is-invalid @enderror date-picker"
                                        id="published_date" name="published_date" required>

                                    @error('published_date')
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
                                        <span class="input-group-text">Podcast Image</span>
                                    </div>
                                    <div class="form-file"> <input type="file" class="form-file-input"
                                            id="podcast_image" name="podcast_image">
                                        <label class="form-file-label" for="podcast_image"></label>
                                    </div>
                                    @error('podcast_image')
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
                                        <span class="input-group-text">Tags</span>
                                    </div>
                                    <input type="text" class="form-control @error('released') is-invalid @enderror"
                                        id="input-tag" name="tag" required>
                                    @error('tag')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="form-control-wrap">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Description</span>
                                    </div>
                                    <textarea class="form-control form-control @error('released') is-invalid @enderror"
                                        type="text" autocomplete="off" class="form-control" id="description"
                                        name="description" aria-label="With textarea" required></textarea>
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
</div>

@endsection

@push('scripts')
<script>
var inputs = document.querySelectorAll('input[name=tag]')
inputs.forEach((input) => {
    new Tagify(input);

})
</script>

<script>
changePodcastStatus();

function changePodcastStatus() {
    $btnDestroy = $('.status-change');

    $btnDestroy.on('click', function() {
        // alert('dfsf');
        swal({
            title: "Want to " + $(this).data('value') + " this?",
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
