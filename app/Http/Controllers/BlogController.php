<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Contracts\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        return view('pages.blog.index', [
            'posts' => BlogPost::whereNotNull('published_at')
                ->latest('published_at')->paginate(9),
        ]);
    }

    public function show(BlogPost $post): View
    {
        abort_if($post->published_at === null, 404);

        return view('pages.blog.show', compact('post'));
    }
}
