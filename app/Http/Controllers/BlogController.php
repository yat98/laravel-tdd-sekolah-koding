<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

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
}
