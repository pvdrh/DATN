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
            'status' => 'required|in:0,1',
        ]);

        Page::create([
            'slug' => $request->slug,
            'content' => $request->input('content'),
            'created_at' => now(),
            'status' => $request->status,
        ]);

        return redirect()->route('pages.index');
    }

    public function edit($id)
    {
        $page = Page::find($id);
        return view('pages.edit', compact('page'));
    }

    public function update(Request $request, $page_id)
    {
        $page = Page::find($page_id);
        $page->slug = $request->slug;
        $page->content = $request->input('content');
        $page->status = $request->status;
        $page->updated_at = now();
        $page->save();

        return redirect()->route('pages.index');
    }
}
