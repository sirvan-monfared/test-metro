import {createApp, defineAsyncComponent} from "vue";
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();


const app = createApp({});

app.component('add-to-cart-button', defineAsyncComponent(() =>
    import('./components/front/AddToCartButton')
));
app.component('shopping-cart', defineAsyncComponent(() =>
    import('./components/front/ShoppingCart')
));
app.component('shopping-cart-mobile', defineAsyncComponent(() =>
    import('./components/front/ShoppingCartMobile')
));
app.component('auth-menu', defineAsyncComponent(() =>
    import('./components/front/AuthMenu')
));
app.component('cart-layout', defineAsyncComponent(() =>
    import('./components/front/cartLayout')
));
app.component('login-form', defineAsyncComponent(() =>
    import('./components/front/LoginForm')
));
app.component('verify-otp-form', defineAsyncComponent(() =>
    import('./components/front/VerifyOTPForm')
));
app.component('forget-password', defineAsyncComponent(() =>
    import('./components/front/ForgetPassword')
));
app.component('reset-password', defineAsyncComponent(() =>
    import('./components/front/ResetPassword')
));
app.component('blog-comments', defineAsyncComponent(() =>
    import('./components/front/Comments')
));
app.component('rate-with-stars', defineAsyncComponent(() =>
    import('./components/RateWithStars')
));
app.component('open-video-button', defineAsyncComponent(() =>
    import('./components/front/OpenVideoButton')
));
app.component('exercise-upload', defineAsyncComponent(() =>
    import('./components/dashboard/ExerciseUpload')
));
app.component('persian-date-picker', defineAsyncComponent(() =>
    import('./components/front/PersianDatePicker')
));
app.component('wheel-of-fortune', defineAsyncComponent(() =>
    import('./components/front/WheelOfFortune')
));

app.mount('#app');
