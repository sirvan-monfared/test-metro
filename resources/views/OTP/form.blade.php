@extends('front.layouts.main', [
    'minimal' => true
])

@section('content')
    <div class="sign_in_up_bg">
        <div class="container">

            @include('flash')

            <div class="row justify-content-lg-center justify-content-md-center">
                <div class="col-lg-6 col-md-8">
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <div class="sign_form">

                        @if($errors->any())
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        @endif

                        <h3>لطفا کد ارسال شده به ایمیل خود را وارد نمایید</h3>

                        <form method="POST" action="/verify-otp" style="margin-top: 60px;">
                            @csrf

                            <otp-field></otp-field>


                            <button class="login-btn" type="submit">بررسی کد</button>
                        </form>

                        <form method="POST" action="{{ route('otp.resend') }}">
                            @csrf
                            <button type="submit">ارسال مجدد</button>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
