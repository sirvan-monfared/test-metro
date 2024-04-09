<?php

namespace App\Http\Controllers;

use App\Facades\DisposableEmailChecker;
use App\Kodesign\BreadCrumbs;
use App\Kodesign\SchemaGenerator;
use App\Models\Course;

class PagesController extends Controller
{
    public function home(SchemaGenerator $schema)
    {
        return view('front.home.index')->with([
            'courses' => Course::list()->get(),
            'page_schema' => $schema->siteNavigation()->toScript()
        ]);
    }

    public function about(BreadCrumbs $breadCrumbs): \Illuminate\Contracts\View\View
    {
        $breadCrumbs->add(2, 'درباره لاراپلاس', route('front.about'));

        return view('front.about.index', [
            'breadCrumbs' => $breadCrumbs->items()
        ]);
    }
}
