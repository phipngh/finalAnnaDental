{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
{{-- <div class="row justify-content-center">--}}
{{-- <div class="col-md-8">--}}
{{-- <div class="card">--}}
{{-- <div class="card-header">{{ __('Login') }}</div>--}}

{{-- <div class="card-body">--}}

{{-- start form--}}

{{-- <form method="POST" action="{{ route('login') }}">--}}
{{-- @csrf--}}

{{-- <div class="form-group row">--}}
{{-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{-- <div class="col-md-6">--}}
{{-- <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

{{-- @error('email')--}}
{{-- <span class="invalid-feedback" role="alert">--}}
{{-- <strong>{{ $message }}</strong>--}}
{{-- </span>--}}
{{-- @enderror--}}
{{-- </div>--}}
{{-- </div>--}}

{{-- <div class="form-group row">--}}
{{-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{-- <div class="col-md-6">--}}
{{-- <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

{{-- @error('password')--}}
{{-- <span class="invalid-feedback" role="alert">--}}
{{-- <strong>{{ $message }}</strong>--}}
{{-- </span>--}}
{{-- @enderror--}}
{{-- </div>--}}
{{-- </div>--}}

{{-- <div class="form-group row">--}}
{{-- <div class="col-md-6 offset-md-4">--}}
{{-- <div class="form-check">--}}
{{-- <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

{{-- <label class="form-check-label" for="remember">--}}
{{-- {{ __('Remember Me') }}--}}
{{-- </label>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- </div>--}}

{{-- <div class="form-group row mb-0">--}}
{{-- <div class="col-md-8 offset-md-4">--}}
{{-- <button type="submit" class="btn btn-primary">--}}
{{-- {{ __('Login') }}--}}
{{-- </button>--}}

{{-- @if (Route::has('password.request'))--}}
{{-- <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{-- {{ __('Forgot Your Password?') }}--}}
{{-- </a>--}}
{{-- @endif--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- </form>--}}

{{-- end  form--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- </div>--}}
{{--</div>--}}
{{--@endsection--}}


@extends('master.admin.user_master')

@section('content')

<div class="account-pages mt-5 pt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-pattern">

                    <div class="card-body p-4">

                        <div class="text-center w-75 m-auto">
                            <a href="{{route('user.index')}}">
                                <span><img src="{{asset('AdminSide/images/logo-dark.png')}}" alt="" height="22"></span>
                            </a>


                            <h5 class="text-uppercase text-center font-bold mt-4">Sign In</h5>

                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="emailaddress">Email address</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <a href="{{route('password.request')}}" class="text-primary float-right"><small>Forgot your password?</small></a>

                                <label for="password">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>

                            <div class="form-group mb-3">
                                <div class="custom-control custom-checkbox checkbox-success">
                                    {{-- <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked>--}}
                                    <input class="custom-control-input" type="checkbox" name="remember" id="checkbox-signin" {{ old('remember') ? 'checked' : '' }}>
                                    {{-- <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}
                                    <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                                </div>
                            </div>

                            <div class="form-group form-row mb-0 text-center">
                                <div class="col-6"><button class="btn btn-gradient btn-block" type="submit"> Log In</button></div>
                                <div class="col-6"><a href="{{ url('auth/google') }}" style="" type="button" class="google-button">
                                        <span class="google-button__icon">
                                            <svg viewBox="0 0 366 372" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M125.9 10.2c40.2-13.9 85.3-13.6 125.3 1.1 22.2 8.2 42.5 21 59.9 37.1-5.8 6.3-12.1 12.2-18.1 18.3l-34.2 34.2c-11.3-10.8-25.1-19-40.1-23.6-17.6-5.3-36.6-6.1-54.6-2.2-21 4.5-40.5 15.5-55.6 30.9-12.2 12.3-21.4 27.5-27 43.9-20.3-15.8-40.6-31.5-61-47.3 21.5-43 60.1-76.9 105.4-92.4z" id="Shape" fill="#EA4335" />
                                                <path d="M20.6 102.4c20.3 15.8 40.6 31.5 61 47.3-8 23.3-8 49.2 0 72.4-20.3 15.8-40.6 31.6-60.9 47.3C1.9 232.7-3.8 189.6 4.4 149.2c3.3-16.2 8.7-32 16.2-46.8z" id="Shape" fill="#FBBC05" />
                                                <path d="M361.7 151.1c5.8 32.7 4.5 66.8-4.7 98.8-8.5 29.3-24.6 56.5-47.1 77.2l-59.1-45.9c19.5-13.1 33.3-34.3 37.2-57.5H186.6c.1-24.2.1-48.4.1-72.6h175z" id="Shape" fill="#4285F4" />
                                                <path d="M81.4 222.2c7.8 22.9 22.8 43.2 42.6 57.1 12.4 8.7 26.6 14.9 41.4 17.9 14.6 3 29.7 2.6 44.4.1 14.6-2.6 28.7-7.9 41-16.2l59.1 45.9c-21.3 19.7-48 33.1-76.2 39.6-31.2 7.1-64.2 7.3-95.2-1-24.6-6.5-47.7-18.2-67.6-34.1-20.9-16.6-38.3-38-50.4-62 20.3-15.7 40.6-31.5 60.9-47.3z" fill="#34A853" /></svg>
                                        </span>
                                        <span class="google-button__text">Sign in with Google</span>
                                    </a></div>

                            </div>

                        </form>

                        <div class="row mt-4">
                            <div class="col-sm-12 text-center">
                                <p class="text-muted mb-0">Don't have an account?<a href="{{route('register')}}" class="text-primary ml-1 h5"><b>Sign
                                            Up</b></a></p>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-sm-12 text-center">
                                <p class="text-muted mb-0">Dismiss, <a href="{{route('user.index')}}" class="text-primary"><b>Back to main page</b></a></p>
                            </div>
                        </div>

                        <!-- <a href="{{ url('auth/google') }}" style="margin-top: 20px;" class="btn btn-lg btn-success btn-block">
                            <strong>Login With Google</strong>
                        </a> -->



                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->


            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>

@endsection