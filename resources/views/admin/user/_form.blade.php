<div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

    <div class="d-flex flex-column gap-7 gap-lg-10">
        <x-admin.card>
            <div class="row mt-10">
                <div class="mb-10 fv-row">
                    <label class="required form-label" for="name">نام</label>
                    <input type="text" name="name" id="name" class="form-control mb-2" placeholder="نام " value="{{ old('name', $user) }}" />
                    <x-admin.error-field :errors="$errors" name="name"></x-admin.error-field>
                </div>
            </div>

            <div class="row fv-row mt-10">
                <div class="col-md-6">
                    <div class="mb-5">
                        <label class="form-label" for="password">رمزعبور</label>
                        <input type="password" name="password" id="password" class="form-control mb-2" value="{{ old('password', $user) }}" />
                        <x-admin.error-field :errors="$errors" name="password"></x-admin.error-field>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-5">
                        <label class="form-label" for="password_confirmation">تکرار رمزعبور</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control mb-2" value="{{ old('password_confirmation', $user) }}" />
                        <x-admin.error-field :errors="$errors" name="password_confirmation"></x-admin.error-field>
                    </div>
                </div>
            </div>

            <div class="row mt-10">
                <label class="form-label" for="email">آدرس ایمیل</label>
                <input type="text" name="email" id="email" class="form-control mb-2" value="{{ old('email', $user) }}" />
                <x-admin.error-field :errors="$errors" name="email"></x-admin.error-field>
                @if($user && $user?->hasVerifiedEmail())<small> تایید شده در {{ $user->email_verified_at->toJalali('Y/m/d') }} </small>@endif
            </div>
            <div class="row mt-10">
                <label class="form-label" for="phone">شماره تلفن</label>
                <input type="text" name="phone" id="phone" class="form-control mb-2" value="{{ old('phone', $user) }}" />
                <x-admin.error-field :errors="$errors" name="phone"></x-admin.error-field>
                @if($user && $user?->hasVerifiedPhone())<small> تایید شده در {{ $user->phone_verified_at->toJalali('Y/m/d') }} </small>@endif
            </div>
        </x-admin.card>

    </div>

    <div class="d-flex justify-content-end">
        <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
            <span class="indicator-label">ذخیره تغییرات</span>
        </button>
    </div>
</div>
