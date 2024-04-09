@extends('front.layouts.main', [
    'minimal' => true
])

@section('content')
    <div class="sign_in_up_bg">
        <div class="container">
            <div class="row justify-content-lg-center justify-content-md-center">
                <div class="col-lg-6 col-md-8">
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <div class="sign_form">
                        <h2>ورود/ثبت نام</h2>
                        <p>شماره موبایل یا ایمیل خود را وارد کنید</p>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="ui search focus mt-15">
                                <div class="ui left icon input swdh11 swdh19">
                                    <input class="prompt srch_explore" type="email" name="email" value="{{ old('email') }}"
                                           placeholder="شماره موبایل یا ایمیل خود را وارد کنید">
                                </div>
                            </div>
                            <div class="ui search focus mt-15">
                                <div class="ui left icon input swdh11 swdh19">
                                    <input class="prompt srch_explore" type="password"
                                           name="password"
                                           required autocomplete="new-password" placeholder="رمز عبور">
                                </div>
                            </div>
                            <div class="ui search focus mt-15">
                                <div class="ui left icon input swdh11 swdh19">
                                    <input class="prompt srch_explore" type="password"
                                           name="password_confirmation" required placeholder="تکرار رمز عبور">
                                </div>
                            </div>
                            <button class="login-btn" type="submit">ثبت نام کنید</button>
                        </form>

                        <p class="mb-0 mt-30">قبلا ثبت نام کردی؟ <a href="{{ route('login') }}">از اینجا وارد شو </a></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
