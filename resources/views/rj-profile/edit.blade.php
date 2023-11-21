<div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">RJ Info</h5>
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
        </div>
        <form action="{{route('rj-profiles.update',$profile->id)}}" method="post" id="form" class="form-validate is-alter ajax-form"
            enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('PATCH')
            <div class="modal-body col-md-12">
                <div class="row">
                    <div class="form-group col-md-6">
                        <div class="form-control-wrap">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">RJ Name</span>
                                </div>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" value="{{ $profile->name }}">
                                @error('name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <span class="text-danger" id="name-validation"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-control-wrap">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">RJ Image</span>
                                </div>
                                <div class="form-file"> <input type="file" class="form-file-input" id="image"
                                        name="image">
                                    <label class="form-file-label" for="image">{{ $profile->image }}</label>
                                </div>
                            </div>
                        </div>
                        <span class="text-danger" id="image-validation"></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="form-group col-md-6">
                        <div class="form-control-wrap">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Show Time</span>
                                </div>
                                <input type="time" autocomplete="false"
                                    class="form-control @error('duty_time') is-invalid @enderror" id="duty_time"
                                    name="duty_time" value="{{ $profile->duty_time }}">

                                @error('duty_time')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <span class="text-danger" id="duty_time-validation"></span>
                    </div>
                </div>


            <div class="row mb-3">
                <div class="form-group col-md-12">
                    <div class="form-control-wrap">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Details</span>
                            </div>
                            <textarea
                                class="form-control form-control @error('details') is-invalid @enderror"
                                type="text" autocomplete="off" class="form-control" id="details"
                                name="details" aria-label="With textarea" required>{{$profile->details}}
                            </textarea>
                            @error('details')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
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
<script src="{{asset('assets/js/libs/editors/summernote.js?ver=3.2.2')}}"></script>
<script>
$(document).ready(function() {
     NioApp.SummerNote();
    ajaxFormSubmit();
});
</script>
