<div class="coupon_code">
    <div class="coupon_input">
        <div class="ui search focus mt-15">
            <form method="POST" action="{{ route('cart.coupon') }}">
                @csrf
                <div class="ui left icon input swdh11 swdh19">
                    <input class="prompt srch_explore" type="text" name="coupon"
                           id="id_coupon_code" placeholder="کد تخفیف دارید؟ اینجا وارد کنید">
                </div>
                <button class="code-apply-btn" type="submit">اعمال کد</button>
            </form>
        </div>
    </div>
</div>
