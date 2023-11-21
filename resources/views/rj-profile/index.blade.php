    @extends('layouts.main')

    @section('title', 'CMS | RJ Profile')

    @section('content')

    @php
       use Illuminate\Support\Str;
       use App\Enums\StatusEnum;
    @endphp

    <div class="rj-title">
        <ul>
            <li class="preview-item d-flex justify-content-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalForm">
                    Add New RJ
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
                        <th>RJ Name</th>
                        <th>RJ Image</th>
                        <th>RJ Details</th>
                        <th>Show Time</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($profiles as $index => $profile)
                    <tr>
                        <td>{{ $index + 1 }}</td>

                        <td class="pro-name">
                            <h6>{{ $profile->name }}</h6>
                        </td>
                        <td>
                            <img src="{{ asset('storage/rj/'.$profile->image) }}" alt="" width="50px">
                        </td>
                        <td class="text-wrap">{!! $profile->details !!}</td>
                        <td>{{ $profile->duty_time }}
                        </td>
                        <td>
                            <div class="custom-control custom-switch status-change"
                            data-value="{{ $profile->status == StatusEnum:: Active->value ? StatusEnum:: Inactive->value : StatusEnum:: Active->value }}"
                            data-url="{{route('rj-profiles.status.change',$profile->id)}}">
                            <input type="checkbox" class="custom-control-input" id="customSwitch{{$index + 1}}"
                                {{ $profile->status == StatusEnum::Active->value ? 'checked' : '' }} name='input_switch'>
                            <label class="custom-control-label" for="customSwitch{{$index + 1}}"></label>
                        </div>
                        </td>

                        <td>
                            <form method="POST" action="{{ route('rj-profiles.destroy', $profile->id) }}">
                                @method('DELETE')
                                @csrf
                                <a href="javascript:void(0)" class="badge bg-outline-info ajax-modal-trigger"
                                    data-route="{{ route('rj-profiles.edit', $profile->id) }}"><em
                                        class=" icon ni ni-edit"></em>
                                    Edit</a>

                                <a href="{{ route('rj-profiles.show',$profile->id) }}"
                                    class="badge bg-outline-success"><em class="icon ni ni-eye-fill"></em>
                                    View</a>

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
                    <h5 class="modal-title">RJ Info</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>

                <div class="modal-body col-md-12">
                    <form action="{{route('rj-profiles.store')}}" method="post" class="form-validate is-alter"
                        enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="form-group col-12">
                                <div class="form-control-wrap">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">RJ Name</span>
                                        </div>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name">
                                        @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <div class="form-control-wrap">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">RJ Image</span>
                                        </div>
                                        <div class="form-file">
                                            <input type="file"
                                                class="form-file-input @error('image') is-invalid @enderror" id="image"
                                                name="image">
                                            <label class="form-file-label" for="image"></label>
                                        </div>
                                        @error('image')
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
                                            <span class="input-group-text">Show Time</span>
                                        </div>
                                        <input type="time" autocomplete="false"
                                            class="form-control @error('duty_time') is-invalid @enderror" id="duty_time"
                                            name="duty_time">
                                        @error('duty_time')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
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
                                            aria-label="With textarea"></textarea>
                                        @error('details')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
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
changeRJProfileStatus();

function changeRJProfileStatus() {
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
    @endpush
