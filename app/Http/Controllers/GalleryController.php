<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{
    public function index(Request $request): View
    {
        $query = Album::query()->withCount('photos');

        if ($category = $request->string('category')) {
            $query->where('category', $category);
        }

        if ($year = $request->integer('year')) {
            $query->whereYear('date', $year);
        }

        return view('pages.gallery.index', [
            'albums' => $query->orderByDesc('date')->paginate(12)->withQueryString(),
            'categories' => Album::query()->select('category')->distinct()->pluck('category'),
            'years' => Album::query()->whereNotNull('date')->selectRaw(DB::getDriverName() === 'mysql' ? 'DISTINCT YEAR(date) as y' : 'DISTINCT strftime("%Y", date) as y')->pluck('y'),
            'activeCategory' => $request->category,
        ]);
    }

    public function show(Album $album): View
    {
        $album->load('photos');

        return view('pages.gallery.show', compact('album'));
    }
}
