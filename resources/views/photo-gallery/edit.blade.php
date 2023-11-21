<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Photo Galleries</h5>
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
        </div>

        <form action="{{route('photo-galleries.update',$gallery->id)}}" method="post" id="form" class="form-validate is-alter ajax-form"
            enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('PATCH')
            <div class="modal-body col-md-12">
                <div class="row">
                    <div class="form-group col-md-6">
                        <div class="form-control-wrap">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Image</span>
                                </div>
                                <div class="form-file"> <input type="file"
                                        class="form-file-input @error('image') is-invalid @enderror" id="image"
                                        name="image" value="">
                                    <label class="form-file-label" for="image">{{ $gallery->image }}</label>
                                </div>
                            </div>
                        </div>
                        <span class="text-danger" id="image-validation"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-control-wrap">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Title</span>
                                </div>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                    name="title" value="{{ $gallery->title }}">
                                @error('title')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <span class="text-danger" id="title-validation"></span>
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
                                    name="description">{{ $gallery->description }}</textarea>
                            </div>
                        </div>
                        <span class="text-danger" id="description-validation"></span>
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

<script>
$(document).ready(function() {
    ajaxFormSubmit();
});
</script>
