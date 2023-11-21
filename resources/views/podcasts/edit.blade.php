<div class="podcast-title">
    <ul>
        <li class="preview-item d-flex justify-content-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalForm1">
                Add New Podcast
            </button>
        </li>
    </ul>
</div>

<div class="modal-dialog modal-xl" role="document">

    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Podcast Info</h5>
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
        </div>

        <form action="{{route('podcasts.update', $podcast->id )}}" method="post" id="form" class="form-validate is-alter ajax-form"
            enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="modal-body col-md-12">
                <div class="row">
                    {{-- @dump($errors) --}}
                    <div class="form-group col-md-6">
                        <div class="form-control-wrap">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Name</span>
                                </div>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $podcast->name }}">
                            </div>
                        </div>
                        <span class="text-danger" id="name-validation"></span>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-control-wrap">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">বাংলা নাম</span>
                                </div>
                                <input type="text" class="form-control" id="name_bn" name="name_bn"
                                    value="{{ $podcast->name_bn }}">
                            </div>
                        </div>
                        <span class="text-danger" id="name-validation"></span>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <div class="form-control-wrap">

                            <div class="input-group-prepend">
                                <span class="input-group-text form-control ">Category</span>
                                <select class="form-select js-select2" name="category_id">
                                    <option value="">
                                        Select Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}"
                                        {{$category->id==$podcast->category_id ? 'selected':''}}>
                                        {{$category->name_en}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <span class="text-danger" id="name-validation"></span>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-control-wrap">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Released</span>
                                </div>
                                <input type="text" class="form-control date-picker" id="released" name="released" date-picker
                                    value="{{ $podcast->released }}">
                            </div>
                        </div>
                        <span class="text-danger" id="released-validation"></span>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <div class="form-control-wrap">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Published Date</span>
                                </div>
                                <input type="text" class="form-control date-picker" id="published_date" date-picker
                                    name="published_date" value="{{ $podcast->published_date }}">

                            </div>
                        </div>
                        <span class="text-danger" id="published_date-validation"></span>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-control-wrap">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Podcast Image</span>
                                </div>
                                <div class="form-file"> <input type="file" class="form-file-input" id="podcast_image"
                                        name="podcast_image">
                                    <label class="form-file-label"
                                        for="podcast_image">{{ $podcast->podcast_image }}</label>
                                </div>
                                <span class="text-danger" id="podcast_image-validation"></span>
                            </div>
                        </div>
                        <span class="text-danger" id="podcast_image-validation"></span>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="form-control-wrap">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Description</span>
                            </div>
                            <textarea type="text" class="form-control" id="description"
                                name="description">{{ $podcast->description }}</textarea>
                        </div>
                    </div>
                    <span class="text-danger" id="description-validation"></span>
                </div>

                <div class="form-group col-md-12">
                    <div class="form-control-wrap">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Tags</span>
                            </div>
                            <div class="tags-input">
                                <ul id="tags"></ul>
                                <input type="text" id="tag" class="form-control" name="tag" value="{{$podcast->tag}}" />
                            </div>
                        </div>
                    </div>
                    <span class="text-danger" id="tag-validation"></span>
                </div>
                <div class="modal-footer bg-light">
                    <button type="submit" class="btn btn-lg btn-primary ml-auto">Update </button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
<script>
$(document).ready(function() {
    ajaxFormSubmit();
});
</script>
