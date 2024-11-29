<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::paginate(10);
        return view('pages.index', compact('pages'));
    }

    public function create()
    {
        return view('pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required|string|unique:pages',
            'content' => 'required',
        ]);

        Page::create([
            'slug' => $request->slug,
            'content' => $request->input('content'),
            'created_at' => now(),
            'status' => 1,
        ]);

        return redirect()->route('pages.index');
    }
}
