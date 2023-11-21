@extends('layouts.main')

@section('title', 'CMS | PhotoGallery')

@section('content')

<div class="photo-title">
    <ul>
        <li class="preview-item d-flex justify-content-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalForm">
                Add New Photo
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
                    <th>Title</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($galleries as $index => $gallery)
                <tr>
                    <td>{{ $index + 1 }}</td>

                    <td class="pro-name">
                        <h6>{{ $gallery->title }}</h6>
                    </td>
                    <td>
                        <img src="{{ asset('storage/gallery/'.$gallery->image) }}" alt="" width="50px">
                    </td>
                    <td class="text-wrap">{!! $gallery->description !!}</td>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('photo-galleries.destroy', $gallery->id) }}">
                            @method('DELETE')
                            @csrf
                            <a href="javascript:void(0)" class="badge bg-outline-info ajax-modal-trigger"
                                data-route="{{ route('photo-galleries.edit', $gallery->id) }}"><em
                                    class=" icon ni ni-edit"></em>
                                Edit</a>

                            <a href="{{ route('photo-galleries.show',$gallery->id) }}"
                                class="badge bg-outline-success"><em class="icon ni ni-eye-fill"></em>
                                View</a>

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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Photo Galleries</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>

            <div class="modal-body col-md-12">
                <form action="{{route('photo-galleries.store')}}" method="post" class="form-validate is-alter"
                    enctype="multipart/form-data" autocomplete="off">
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
                                        <span class="input-group-text">Image</span>
                                    </div>
                                    <div class="form-file"> <input type="file"
                                            class="form-file-input @error('image') is-invalid @enderror" id="image"
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
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="form-control-wrap">

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Description</span>
                                    </div>
                                    <textarea type="text" class="form-control" id="description"
                                        name="description"></textarea>
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
@endpush
