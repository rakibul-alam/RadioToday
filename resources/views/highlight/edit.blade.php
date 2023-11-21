<div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Highlights Info</h5>
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
        </div>

        <form action="{{route('highlights.update',$highlight->id)}}" method="post" id="form" class="form-validate is-alter ajax-form"
            enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('PATCH')
            <div class="modal-body col-md-12">
                <div class="row">
                    <div class="form-group col-12">
                        <div class="form-control-wrap">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Title</span>
                                </div>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="title"
                                    name="title" value="{{ $highlight->title }}">
                            </div>
                        </div>
                        <span class="text-danger" id="title-validation"></span>
                    </div>

                    <div class="input-group-prepend mb-3">
                            <span class="input-group-text">Image</span>
                        <div class="modal-body">
                            <img id="currentImage" src="{{ asset('storage/highlights/'.$highlight->image) }}" alt="Current Image" width="100px">
                            <input type="file"  name="image" id="newImage" accept="image/*" width="100px">
                            <img id="imagePreview" src="" alt="Image Preview" width="100px">
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
                                                        id="details" name="details">{{ $highlight->details }}
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
                        <span class="text-danger" id="details-validation"></span>
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
<script src="{{asset('assets/js/libs/editors/summernote.js?ver=3.2.2')}}"></script>
<script>
$(document).ready(function() {
     NioApp.SummerNote();
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
