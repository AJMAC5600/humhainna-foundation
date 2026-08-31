<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(): View
    {
        return view('pages.admin.blog.index', ['posts' => BlogPost::latest()->paginate(15)]);
    }

    public function create(): View
    {
        return view('pages.admin.blog.form', ['post' => new BlogPost]);
    }

    public function store(Request $request): RedirectResponse
    {
        BlogPost::create($this->persist($request));

        return redirect()->route('admin.blog.index')->with('success', 'Post saved.');
    }

    public function edit(BlogPost $post): View
    {
        return view('pages.admin.blog.form', compact('post'));
    }

    public function update(Request $request, BlogPost $post): RedirectResponse
    {
        $post->update($this->persist($request, ignoreId: $post->id));

        return redirect()->route('admin.blog.index')->with('success', 'Post updated.');
    }

    public function destroy(BlogPost $post): RedirectResponse
    {
        $post->delete();

        return back()->with('success', 'Post deleted.');
    }

    private function persist(Request $request, ?int $ignoreId = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string', 'max:60000'],
            'cover' => ['nullable', 'image', 'max:5120'],
            'publish' => ['sometimes', 'boolean'],
        ]);

        $slug = Str::slug($data['title']);
        while (BlogPost::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug .= '-'.Str::random(3);
        }
        $data['slug'] = $slug;

        if ($request->boolean('publish')) {
            $data['published_at'] = now();
        } else {
            $data['published_at'] = null;
        }

        if ($request->hasFile('cover')) {
            $data['cover_path'] = $request->file('cover')->store('blog/covers', 'public');
        }

        unset($data['cover'], $data['publish']);

        return $data;
    }
}
