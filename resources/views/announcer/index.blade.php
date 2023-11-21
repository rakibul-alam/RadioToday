@extends('layouts.main')

@section('title', 'CMS | Announcers')

@section('content')

@php
use Illuminate\Support\Str;
use App\Enums\StatusEnum;
@endphp

<div class="announcer-title">
    <ul>
        <li class="preview-item d-flex justify-content-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalForm">
                Add New Announcer
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
                    <th>Name</th>
                    <th>Image</th>
                    <th>Details</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($announcers as $index => $announcer)
                <tr>
                    <td>{{ $index + 1 }}</td>

                    <td class="pro-name">
                        <h6>{{ $announcer->name }}</h6>
                    </td>
                    <td>
                        <img src="{{ asset('storage/announcers/'.$announcer->image) }}" alt="" width="50px">
                    </td>
                    <td class="text-wrap">
                        <span id="content1">{!! substr(strip_tags($announcer->details), 0, 150) !!}</span>
                    </td>
                    <td>
                        <div class="custom-control custom-switch status-change"
                            data-value="{{ $announcer->status == StatusEnum::Active->value ? StatusEnum::Inactive->value : StatusEnum::Active->value }}"
                            data-url="{{route('announcers.status.change',$announcer->id)}}">
                            <input type="checkbox" class="custom-control-input" id="customSwitch{{$index + 1}}"
                                {{ $announcer->status == StatusEnum::Active->value ? 'checked' : '' }} name='input_switch'>
                            <label class="custom-control-label" for="customSwitch{{$index + 1}}"></label>
                        </div>
                    </td>

                    <td>
                        <form method="POST" action="{{ route('announcers.destroy', $announcer->id) }}">
                            @method('DELETE')
                            @csrf
                            <a href="javascript:void(0)" class="badge bg-outline-info ajax-modal-trigger"
                                data-route="{{ route('announcers.edit', $announcer->id) }}"><em
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Announcer Info</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>

            <div class="modal-body col-md-12">
                <form action="{{route('announcers.store')}}" method="post" class="form-validate is-alter"
                    enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="form-group col-12">
                            <div class="form-control-wrap">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text custom-input-label-width" >Name</span>
                                    </div>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" required>
                                </div>
                                @error('name')
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
                                            id="image" name="image" width="100px" required>
                                        <label class="form-file-label" for="image"></label>
                                    </div>
                                    <div>
                                        <img id="image-preview" src="#" alt="Image Preview"  width="100px">
                                        <button class="mb-8" id="remove-preview" style="display:none">Remove</button>
                                    </div>
                                </div>
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <div class="form-control-wrap">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text custom-input-label-width">Details</span>
                                    </div>
                                    <textarea class="form-control form-control @error('details') is-invalid @enderror"
                                        type="text" autocomplete="off" class="form-control" id="details" name="details"
                                        aria-label="With textarea" required></textarea>
                                </div>
                                @error('details')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
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
changePromotionStatus();

function changePromotionStatus() {
    $btnDestroy = $('.status-change');

    $btnDestroy.on('click', function() {
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
