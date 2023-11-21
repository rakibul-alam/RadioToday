<div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Announcer Info</h5>
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
        </div>

        <form action="{{route('announcers.update',$announcer->id)}}" method="post" id="form" class="form-validate is-alter ajax-form"
            enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('PATCH')
            <div class="modal-body col-md-12">
                <div class="row">
                    <div class="form-group col-12">
                        <div class="form-control-wrap">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Name</span>
                                </div>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" value="{{ $announcer->name }}">
                            </div>
                        </div>
                        <span class="text-danger" id="name-validation"></span>
                    </div>

                    <div class="input-group-prepend mb-3">
                            <span class="input-group-text">Image</span>

                        <div class="modal-body">
                            <img id="currentImage" src="{{ asset('storage/announcers/'.$announcer->image) }}" alt="Current Image" width="100px">
                            <input type="file"  name="image" id="newImage" accept="image/*" width="100px">
                            <img id="imagePreview" src="" alt="Image Preview" width="100px">
                            <span class="text-danger" id="image-validation"></span>
                        </div>
                        <span class="text-danger" id="newImage-validation"></span>
                    </div>
                </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="form-control-wrap">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Details</span>
                                        </div>
                                        <textarea
                                            class="form-control form-control @error('details') is-invalid @enderror"
                                            type="text" autocomplete="off" class="form-control" id="details"
                                            name="details" aria-label="With textarea" required>{{$announcer->details}}
                                        </textarea>
                                        @error('details')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <span class="text-danger" id="details-validation"></span>
                            </div>
                        </div>
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text">
                        <button type="submit" class="btn btn-lg btn-primary ml-auto">Update
                        </button>
                    </span>
                </div>
        </form>
    </div>
</div>

{{-- @push('scripts') --}}
<script>
    $(document).ready(function() {
        // NioApp.SummerNote();
        ajaxFormSubmit();
    });
    </script>

<script>
$(document).ready(function () {
    $('#newImage').on('change', function () {
        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imagePreview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    });

    $('#imageUpdateForm').on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                // Handle success, e.g., close the modal or display a success message
            },
            error: function (data) {
                // Handle errors
            }
        });
    });
});

</script>
{{-- @endpush --}}
