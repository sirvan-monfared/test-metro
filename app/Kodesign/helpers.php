<?php

use App\Kodesign\Cart\Cart;
use App\Models\Course;

if (!function_exists('cart')) {
    function cart(): Cart
    {
        return app(Cart::class);
    }
}

if (!function_exists('price_format')) {
    function price_format($price, $currency = true): string
    {
        if ($currency) {
            return "<span class='price'>" . number_format($price) . "</span><span class='currency'> تومان</span>";
        }

        return "<span class='price'>" . number_format($price) . '</span>';
    }
}

if (!function_exists('isEmail')) {

    function isEmail($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}

if (!function_exists('isMobile')) {
    function isMobile($value): bool
    {
        if (str_contains(trim($value), ' ')) return false;

        $value = convertDigitsToLatin($value);
        $phone_pattern = '#(0|\+98)?([ ]|,|-|[()]){0,2}9[0|1|2|3|4|9]([ ]|,|-|[()]){0,2}(?:[0-9]([ ]|,|-|[()]){0,2}){8}#';
        if (preg_match($phone_pattern, $value) === 1) {
            return true;
        }

        return false;
    }
}

if (!function_exists('emailOrMobile')) {
    function emailOrMobile($value): bool|string
    {
        if (isEmail($value)) {
            return 'email';
        }
        if (isMobile($value)) {
            return 'mobile';
        }

        return false;
    }
}

if (!function_exists('convertDigitsToLatin')) {
    function convertDigitsToLatin($text): string
    {
        $persian_digits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $english_digits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        return str_replace($persian_digits, $english_digits, $text);
    }
}
if (!function_exists('getIntendedUrl')) {
    function getIntendedUrl()
    {
        $intended_url = session()->get('url.intended', url('/'));
        session()->forget('url.intended');

        return $intended_url;
    }
}
if (!function_exists('apartEmbedUrl')) {
    function apartEmbedUrl($aparat_video_url)
    {
        return str_replace('/v/', '/embed/', $aparat_video_url);
    }
}

if (!function_exists('apartIframeUrl')) {
    function apartIframeUrl($aparat_video_url)
    {
        $video_code = str_replace('https://www.aparat.com/v/', '', $aparat_video_url);

        return "https://www.aparat.com/video/video/embed/videohash/{$video_code}/vt/frame";
    }
}

if (!function_exists('startOfJalaliDay')) {
    function startOfJalaliDay($format = 'Y-m-d H:i:s', $date = null)
    {
        if ($date) {
            return verta()->parse($date)->startDay()->formatGregorian($format);
        }

        return verta()->startDay()->formatGregorian($format);
    }
}

if (!function_exists('endOfJalaliDay')) {
    function endOfJalaliDay($format = 'Y-m-d H:i:s', $date = null)
    {
        if ($date) {
            return verta()->parse($date)->endDay()->formatGregorian($format);
        }

        return verta()->endDay()->formatGregorian($format);
    }
}

if (!function_exists('toGregorian')) {
    function toGregorian($date, $format = 'Y-m-d H:i:s')
    {
        return verta()->parse($date)->formatGregorian($format);
    }
}

if (!function_exists('enDigits')) {
    function enDigits($text)
    {
        $persian_digits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];

        $english_digits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        return str_replace($persian_digits, $english_digits, $text);
    }
}

if (!function_exists('correctDiscount')) {
    function correctDiscount($discount_amount)
    {
        return ((int) $discount_amount === 1) ? 0 : (int) $discount_amount;
    }
}

if (!function_exists('slugNormalizer')) {
    function slugNormalizer($string)
    {
        $unwanted = array("؟", "ئ", ">", "<", "ء", "أ", "إ", "إ", "ؤ", "ی", "ة", "َ", "ُ", "ِ", "ّ", "ۀ", "ـ", "«", "»", "ً", "ٌ", "ٍ", "،", "؛", "ك", "ي");
        $cleaned = array("", "ی", "", "", "", "ا", "ا", "ا", "و", "ی", "ه", "", "", "", "", "ه", "", "", "", "", "", "", "", "", "ک", "ی");

        $string = str_replace($unwanted, $cleaned, $string);
        $string = trim(mb_strtolower($string, 'UTF-8'));
        $string = preg_replace("/[^اآبپتثجچحخدذرزژسشصضطظعغفقکگلمنوهی a-z0-9_\s-]/", "", $string);
        $string = preg_replace("/[\s-]+/", " ", $string);
        $string = preg_replace("/[\s_]/", "-", $string);
        // $string = removeEndDash($string);

        return $string;
    }
}

if (!function_exists('showPrice')) {
    function showPrice(Course $course, $bigFontSize = false)
    {
        $insFontSize = $bigFontSize ? 'text-3xl' : 'text-lg md:text-xl';
        $delFontSize = $bigFontSize ? 'text-2xl' : 'text-base md:text-lg';
        $priceFontSize = $bigFontSize ? 'text-3xl' : 'text-lg md:text-xl';

        $price = $course->finalPrice() === 0 ? 'رایگان' : price_format($course->finalPrice());

        if (!$course->hasDiscount()) {
            return "<span class='block font-medium {$priceFontSize}'>" . $price . '</span>';
        }

        return "<span class='block font-medium'><del class='block pl-1 text-red-600 {$delFontSize}'>" . price_format($course->price, false) . "</del><ins class='block no-underline {$insFontSize}'>" . $price . "</ins></span>";
    }
}

if (!function_exists('isDashboardPanel')) {
    function isDashboardPanel(): bool
    {
        return (request()->route()->getPrefix() === "/dashboard");
    }
}

if (! function_exists('educationOptions')) {

    function educationOptions(): array
    {
        return [
            'diploma' => 'دیپلم',
            'associate' => 'کاردانی',
            'bachelor' => 'کارشناسی',
            'masters' => 'کارشناسی ارشد',
            'phd' => 'دکترا',
        ];
    }
}
