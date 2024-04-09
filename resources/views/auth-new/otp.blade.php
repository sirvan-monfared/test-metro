@extends('front.layouts.main', [
    'minimal' => true
])

@section('content')
    <div class="sign_in_up_bg">
        <div class="container">
            <div class="row justify-content-lg-center justify-content-md-center">
                <div class="col-lg-5 col-md-7">
                    <verify-otp-form recipient="{{ $recipient }}" recipient-type="{{ $recipient_type }}" :timer="{{ $resend_timer }}"></verify-otp-form>
                </div>
            </div>
        </div>
    </div>
@endsection
