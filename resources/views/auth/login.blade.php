<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../../../">
    <meta charset="utf-8">
    <meta name="author" content="ebs">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" class="rounded-circle" href="{{asset('images/rdt-favicon.png')}}">
    <!-- Page Title  -->
    <title>Login | Radio Today Admin Template</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('assets/css/dashlite.css?ver=3.2.2') }}">
    <link id="skin-default" rel="stylesheet" href="{{asset('assets/css/theme.css?ver=3.2.2')}}">
</head>

<body class="nk-body bg-white npc-general pg-auth">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-split nk-split-page nk-split-lg">
                        <div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container bg-white">
                            <div class="nk-block nk-block-middle nk-auth-body">
                                <div class="brand-logo pb-5">
                                    <a href="#" class="logo-link">
                                        <img class="logo-light logo-img logo-img-lg"
                                            src="{{asset('images/radio_today_logo.png')}}"
                                            srcset="{{asset('images/radio_today_logo.png 2x')}}" alt="logo">
                                        <img class="logo-dark logo-img logo-img-lg"
                                            src="{{asset('images/radio_today_logo.png')}}"
                                            srcset="{{asset('images/radio_today_logo.png 2x')}}"
                                            alt="radio_today_logo-dark">
                                    </a>
                                </div>
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title">Sign-In</h5>
                                        <div class="nk-block-des">
                                            <p>Access the Radio Today panel using your email and password.</p>
                                        </div>
                                    </div>
                                </div><!-- .nk-block-head -->
                                <form action="{{ route('login') }}" class="form-validate is-alter" autocomplete="off"
                                    method="POST">
                                    @csrf

                                    <div class="row mb-12">
                                        <label for="email"
                                            class="col-md-4 col-form-label">{{ __('Email Address') }}</label>

                                        <div class="col-md-12">
                                            <input id="email" placeholder="Enter your email address or username"
                                                type="email" class="form-control @error('email') is-invalid @enderror"
                                                name="email" value="{{ old('email') }}" required autocomplete="email"
                                                autofocus>

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- .form-group -->
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <label for="password"
                                                class="col-md-4  col-form-label ">{{ __('Password') }}</label>

                                            <div class="col-md-12">
                                                <input id="password" placeholder="Enter your password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="current-password">

                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6 ">
                                                    <div class="form-check">
                                                        <input class="form-check-input mt-3" type="checkbox"
                                                            name="remember" id="remember"
                                                            {{ old('remember') ? 'checked' : '' }}>
                                                        <div>
                                                            <label class="form-check-label mt-2" for="remember">

                                                                {{ __('Remember Me') }}

                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- .form-group -->
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-dark btn-block">Sign in</button>
                                    </div>
                                </form><!-- form -->
                            </div>
                            <!-- .nk-block -->
                            <div class="nk-block nk-auth-footer">
                                <div class="mt-3">
                                    <p>&copy; 2023 E.B Solutions Limited. All Rights Reserved.</p>
                                </div>
                            </div><!-- .nk-block -->
                        </div><!-- .nk-split-content -->
                        <div class="nk-split-content nk-split-stretch bg-lighter d-flex" data-content="athPromo">
                            <img class="opacity-50" src="{{asset('images/slides/radio_today_img.jpeg')}}"
                                alt="slide img">
                        </div><!-- .nk-split-content -->
                    </div><!-- .nk-split -->
                </div>
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="{{asset('assets/js/bundle.js?ver=3.2.2')}}"></script>
    <script src="{{asset('assets/js/scripts.js?ver=3.2.2')}}"></script>

</html>