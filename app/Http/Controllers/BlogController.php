<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();

        return view('pages.blog.index', compact('blogs'));
    }

    public function show(Blog $blog)
    {
        return view('pages.blog.show', compact('blog'));
    }

    public function create()
    {
        return view('pages.blog.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['slug'] = Str::slug($request->title);
        $blog = Blog::create($data);

        return redirect()->route('blog.show',$blog);
    }

    public function edit(Blog $blog)
    {
        return view('pages.blog.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $blog->update($data);

        return redirect()->route('blog.show',$blog);
    }
}
