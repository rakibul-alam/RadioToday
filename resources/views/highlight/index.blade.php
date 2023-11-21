@extends('layouts.main')

@section('title', 'CMS | Highlights')

@section('content')

@php
use Illuminate\Support\Str;
@endphp

<div class="hightlights-title">
    <ul>
        <li class="preview-item d-flex justify-content-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalForm">
                Add New Highlight
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
                    <th>Details</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($highlights as $index => $highlight)
                <tr>
                    <td>{{ $index + 1 }}</td>

                    <td class="pro-name">
                        <h6>{{ $highlight->title }}</h6>
                    </td>
                    <td>
                        <img src="{{ asset('storage/highlights/'.$highlight->image) }}" alt="" width="50px">
                    </td>
                    <td class="text-wrap">
                        <span id="content1">{!! substr(strip_tags($highlight->details), 0, 200) !!}...</span>

                    </td>

                    <td>
                        <form method="POST" action="{{ route('highlights.destroy', $highlight->id) }}">
                            @method('DELETE')
                            @csrf
                            <a href="javascript:void(0)" class="badge bg-outline-info ajax-modal-trigger"
                                data-route="{{ route('highlights.edit', $highlight->id) }}"><em
                                    class=" icon ni ni-edit"></em>
                                Edit</a>
{{--
                            <a href="{{ route('highlights.show',$highlight->id) }}" class="badge bg-outline-success"><em
                                    class="icon ni ni-eye-fill"></em>
                                View</a>  --}}

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
                <h5 class="modal-title">Highlights Info</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>

            <div class="modal-body col-md-12">
                <form action="{{route('highlights.store')}}" method="post" class="form-validate is-alter"
                    enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="form-group col-12">
                            <div class="form-control-wrap">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text custom-input-label-width">Title</span>
                                    </div>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title">
                                </div>
                                @error('title')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group col-12">
                            <div class="form-control-wrap">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text custom-input-label-width">Image</span>
                                    </div>

                                    <div class="form-file">
                                        <input type="file" class="form-file-input @error('image') is-invalid @enderror"
                                            id="image" name="image" width="100px">
                                        <label class="form-file-label" for="image"></label>
                                    </div>
                                    <div>
                                        <img id="image-preview" src="#" alt="Image Preview"  width="100px">
                                        <button class="mb-8" id="remove-preview" style="display:none">Remove</button>
                                    </div>
                                </div>
                                <span class="text-danger" id="image-validation"></span>
                            </div>
                        </div>

                        <div class="form-group col-12">
                            <div class="form-control-wrap">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Details</span>
                                        <div class="nk-block nk-block-lg">
                                            <div class="card card-bordered">
                                                <div class="card-inner">
                                                    <textarea type="text"
                                                        class="summernote-basic @error('details') is-invalid @enderror"
                                                        id="details" name="details">
                                                        </textarea>
                                                    @error('details')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
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
@endsection

@push('scripts')

<script>
document.getElementById('image').addEventListener('change', function() {
    const preview = document.getElementById('image-preview');
    const removeButton = document.getElementById('remove-preview');

    if (this.files && this.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            removeButton.style.display = 'block';
        };
        reader.readAsDataURL(this.files[0]);
    } else {
        preview.src = '#';
        preview.style.display = 'none';
        removeButton.style.display = 'none';
    }
});

document.getElementById('remove-preview').addEventListener('click', function() {
    const imageInput = document.getElementById('image');
    imageInput.value = '';
    const preview = document.getElementById('image-preview');
    preview.src = '#';
    preview.style.display = 'none';
    this.style.display = 'none';
});
</script>
@endpush

