<?php

namespace App\Services;

use App\Models\FAQ;
use Illuminate\Http\Request;

class FaqService
{
    public static function store($faqable, Request $request)
    {
        $faqable->faqs()->delete();

        $faqs = self::prepareFaqs($request->faq__titles, $request->faq__bodys);

        $faqable->faqs()->saveMany($faqs);
    }

    protected static function prepareFaqs($titles, $bodys)
    {
        $output = [];

        if (! $titles && ! $bodys) {
            return $output;
        }

        foreach ($titles as $key => $title) {
            if (!$title && ! $bodys[$key]) {
                continue;
            }
            $output[] = new FAQ(['title' => $title, 'body' => $bodys[$key]]);
        }

        return $output;
    }
}
