<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return redirect('dashboard');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function getPageBySlug($slug)
    {
        $page = Page::where('slug', $slug)->where('status', 1)->first();

        return view('page', compact('page'));
    }
}
