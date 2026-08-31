<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Photo;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(): View
    {
        return view('pages.admin.gallery.index', [
            'albums' => Album::withCount('photos')->orderByDesc('date')->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('pages.admin.gallery.form', ['album' => new Album]);
    }

    public function store(Request $request): RedirectResponse
    {
        $album = Album::create($this->validated($request, withCover: true));
        $this->uploadPhotos($request, $album);

        return redirect()->route('admin.gallery.edit', $album)->with('success', 'Album created. You can add more photos now.');
    }

    public function edit(Album $album): View
    {
        return view('pages.admin.gallery.form', ['album' => $album->load('photos')]);
    }

    public function update(Request $request, Album $album): RedirectResponse
    {
        $data = $this->validated($request);

        if ($request->hasFile('cover')) {
            $data['cover_path'] = $request->file('cover')->store('gallery/covers', 'public');
        } else {
            unset($data['cover_path']);
        }

        $album->update($data);
        $this->uploadPhotos($request, $album);

        return back()->with('success', 'Album updated.');
    }

    public function destroy(Album $album): RedirectResponse
    {
        $album->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Album deleted.');
    }

    public function destroyPhoto(Photo $photo): RedirectResponse
    {
        $photo->delete();

        return back()->with('success', 'Photo removed.');
    }

    private function uploadPhotos(Request $request, Album $album): void
    {
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('gallery/photos', 'public');
                $album->photos()->create(['path' => $path]);
            }
        }
    }

    private function validated(Request $request, bool $withCover = false): array
    {
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'in:education,health,environment,relief,women,events,campaigns,other'],
            'date' => ['nullable', 'date'],
            'description' => ['nullable', 'string', 'max:5000'],
            'video_url' => ['nullable', 'url'],
            'cover' => [$withCover ? 'required' : 'nullable', 'image', 'max:5120'],
            'photos' => ['nullable', 'array'],
            'photos.*' => ['image', 'max:5120'],
        ];

        $data = $request->validate($rules);

        if ($request->hasFile('cover')) {
            $data['cover_path'] = $request->file('cover')->store('gallery/covers', 'public');
        }
        unset($data['cover'], $data['photos']);

        return $data;
    }
}
