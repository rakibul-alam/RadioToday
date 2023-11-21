<div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Podcast Content Details</h5>
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
        </div>
        <form enctype="multipart/form-data"
            action="{{ route('podcasts.content.update', ['podcast' => $podcast->id, 'podcastDetail' => $podcastDetail->id]) }}"  id="form" class="form-validate is-alter ajax-form"
             method="post">
            <div class="modal-body col-md-12">

                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="form-group col-md-12">
                        <div class="form-control-wrap">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Title</span>
                                </div>
                                <input type="text"
                                    class="form-control @error('title') is-invalid @enderror"
                                    id="title" name="title" value="{{$podcastDetail->title}}">
                                @error('title')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="form-control-wrap">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Image</span>
                                </div>
                                <div class="form-file"> <input type="file"
                                        class="form-file-input" id="image" name="image">
                                    <label class="form-file-label"
                                        for="image">{{ $podcastDetail->image }}</label>
                                </div>
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="form-control-wrap">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">File</span>
                                </div>
                                <div class="form-file @error('file_path') is-invalid @enderror">
                                    <input type="file" class="form-file-input " id="file_path"
                                        name="file_path">
                                    <label class="form-file-label"
                                        for="file_path">{{ $podcastDetail->file_path }}</label>
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
                                    <span class="input-group-text">Publish Date</span>
                                </div>
                                <input type="text" autocomplete="false"
                                    class="form-control @error('published_date') is-invalid @enderror date-picker"
                                    id="release_date" name="published_date"
                                    value="{{$podcastDetail->published_date}}">
                                @error('published_date')
                                <p class="text-danger">{{ $message }}</p>
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
                                <input type="text" autocomplete="false" class="form-control"
                                    id="duration_time" name="duration_time"
                                    value="{{$podcastDetail->duration_time}}">
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
                                <textarea
                                    class="form-control @error('description') is-invalid @enderror"
                                    name="description" id="description" rows="2">{{ $podcastDetail->description }}
                                    </textarea>

                                @error('description')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
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
