<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">New Categories</h5>
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
        </div>
        <form action="{{route('categories.update', $category->id )}}" method="post"
            class="form-validate is-alter ajax-form" id="form">
            <div class="modal-body col-md-12">

                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="form-group col-12">
                        <div class="form-control-wrap">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Name(En)</span>
                                </div>
                                <input type="text" class="form-control" id="name_en" name="name_en"
                                    value="{{$category->name_en}}">
                            </div>
                        </div>
                        <span class="text-danger" id="name_en-validation"></span>
                    </div>

                    <div class="form-group col-12">
                        <div class="form-control-wrap">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Name(Bn)</span>
                                </div>
                                <input type="text" class="form-control" id="name_bn" name="name_bn"
                                    value="{{$category->name_bn}}">
                            </div>
                        </div>
                        <span class="text-danger" id="name_bn-validation"></span>
                    </div>

                    <div class="form-group col-12">
                        <div class="form-control-wrap">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Category Code</span>
                                </div>
                                <input type="text" class="form-control" id="category" name=""
                                    value="{{$category->cat_code}}" disabled>
                            </div>
                        </div>
                        <span class="text-danger" id="category-validation"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="submit" class="btn btn-lg btn-primary ml-auto">Update </button>
            </div>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
    ajaxFormSubmit();
});

$(function() {
    $("#name_en").keyup(function() {
        var name = $("#name_en").val();
        if (name.length <= 3) {
            $("#category1").val('RT' + name.toUpperCase());
        }

    });
});
</script>
