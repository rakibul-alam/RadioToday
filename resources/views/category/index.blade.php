@extends('layouts.main')

@section('title', 'CMS | Category')

@section('content')

@php
use Illuminate\Support\Str;
use App\Enums\StatusEnum;
@endphp

<style>
.tagify {
    width: 100%;
    max-width: 700px;
}
</style>

<div class="podcast-title">
    <ul>
        <li class="preview-item d-flex justify-content-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalForm">
                Add New Category
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
                    <th>Code</th>
                    <th>Name(En)</th>
                    <th>Name(Bn)</th>
                    <th>Status</th>
                    <th>Created By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $index => $category)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $category->cat_code }}</td>
                    <td class="pro-name">
                        <h6>{{ $category->name_en }}</h6>
                    </td>
                    <td>{{ $category->name_bn }}</td>

                    <td>
                        <div class="custom-control custom-switch status-change"
                            data-value="{{ $category->status == StatusEnum:: Active->value ? StatusEnum:: Inactive->value : StatusEnum:: Active->value }}{{$category->name_en}}"
                            data-url="{{route('categories.status.change',$category->id)}}">
                            <input type="checkbox" class="custom-control-input" id="customSwitch{{$index + 1}}"
                                {{ $category->status == StatusEnum::Active->value ? 'checked' : '' }} name='input_switch'>
                            <label class="custom-control-label" for="customSwitch{{$index + 1}}"></label>
                        </div>
                    </td>
                    <td>{{ $category->createdBy?->name?:''}}</td>
                    <td>
                        <form method="POST" action="{{ route('categories.destroy', $category->id) }}">
                            @method('DELETE')
                            @csrf
                            <a href="javascript:void(0)" class="badge bg-outline-info ajax-modal-trigger"
                                data-route="{{ route('categories.edit', $category->id) }}"><em
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

<div class="modal fade" id="modalForm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Categories</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body col-md-12">
                <form action="{{route('categories.store')}}" method="post" class="form-validate is-alter"
                    autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="form-group col-12">
                            <div class="form-control-wrap">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Name(En)</span>
                                    </div>
                                    <input type="text" class="form-control" id="name" name="name_en">
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-12">
                            <div class="form-control-wrap">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Name(Bn)</span>
                                    </div>
                                    <input type="text" class="form-control" id="name_bn" name="name_bn">
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-12">
                            <div class="form-control-wrap">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Category Code</span>
                                    </div>
                                    <input type="text" class="form-control" id="category" value="RT" disabled>
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
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<script>
var inputs = document.querySelectorAll('input[name=tag]')
inputs.forEach((input) => {
    new Tagify(input)
})

$(function() {
    $("#name").keyup(function() {
        var name = $("#name").val();
        if (name.length <= 3) {
            $("#category").val('RT' + name.toUpperCase());
        }

    });
});
</script>

<script>
statusChange();

function statusChange() {
    $btnDestroy = $('.status-change');

    $btnDestroy.on('click', function() {
        swal({
            title: "Are you want to " + $(this).data('value') + "?",
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

@endpush
