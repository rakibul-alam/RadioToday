@extends('layouts.main')

@section('title', 'CMS | Photo Gallery')

@section('content')

@php
use Illuminate\Support\Str;
use App\Enums\StatusEnum;
@endphp


<div class="photo-title">
    <ul>
        <li class="preview-item d-flex justify-content-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalForm">
                Upload New Image
            </button>
        </li>
    </ul>
</div>


<div class="modal fade" id="modalForm">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Image Upload</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>

            <div class="modal-body col-md-12">
                <form action="{{route('photo-galleries.details.store',$gallery->id)}}" method="post"
                    class="form-validate is-alter" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Multiple File Upload</label>
                                <div class="form-control-wrap">
                                    <div class="form-file">
                                        <input type="file" multiple class="form-file-input" id="image" name="image[]"
                                            multiple>
                                        <label class="form-file-label" for="image">Choose files</label>
                                    </div>
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

<h2>Images for Photo Gallery : <span class="text-primary">Image Gallery</span> </h2>

<div class="row mt-4">
    @php
    $galleryDetails=$gallery->galleryDetails;
    @endphp

    @foreach ($galleryDetails as $galleryDetail)
    <div class="col-md-3 position-relative">
        <div class="card text-white shadow p-3 mb-2 bg-body rounded mb-3" style="max-width: 20rem;">
            <div class="card-body p-0">
                <img src="{{asset('storage/gallery/'.$galleryDetail->image)}}" width="250" height="200" alt="Image Description">
            </div>
            <form method="POST" action="{{ route('photo-galleries.details.destroy', [$gallery->id,$galleryDetail->id]) }}">
                @method('DELETE')
                @csrf
                <button class="badge bg-outline-danger position-absolute top-0 end-0" onclick="return confirm('Are you sure?'); event.preventDefault();
                this.closest('form').submit();"><em class="icon ni ni-trash"></em>
                    Delete</a>
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>

@endsection
