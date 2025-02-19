<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $movies = Movie::with('genre')->paginate(10);
        $search = $request->input('search');
        $query = Movie::query();

        if ($search) {
            $query->where('title', 'LIKE', "%$search%");
        }

        $movies = $query->paginate(10);
        $genres = Genre::all();

        return view('movies.index', compact('movies', 'genres', 'search'));
    }


    public function create()
    {
        $genres = Genre::all();
        return view('movies.create', compact('genres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:movies,title',
            'poster' => 'nullable|image|max:2048', // 2MB = 2048KB
            'intro' => 'required',
            'release_date' => 'required|date|after_or_equal:today',
            'genre_id' => 'required|exists:genres,id'
        ], [
            'title.required' => 'Tiêu đề không được để trống',
            'title.unique' => 'Tiêu đề phim đã tồn tại',
            'poster.image' => 'File phải là hình ảnh',
            'poster.max' => 'Kích thước ảnh không được quá 2MB',
            'intro.required' => 'Giới thiệu không được để trống',
            'release_date.required' => 'Ngày công chiếu không được để trống',
            'release_date.after_or_equal' => 'Ngày công chiếu không được nhỏ hơn hôm nay',
            'genre_id.required' => 'Thể loại không được để trống',
            'genre_id.exists' => 'Thể loại không hợp lệ'
        ]);

        Movie::create($request->all());

        return redirect()->route('movies.index')->with('success', 'Phim đã được thêm thành công!');
    }

    public function show($id)
    {
        $movie = Movie::with('genre')->findOrFail($id);
        return view('movies.show', compact('movie'));
    }

    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        $genres = Genre::all();
        return view('movies.edit', compact('movie', 'genres'));
    }

    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'poster' => 'nullable|image',
            'intro' => 'required|string',
            'release_date' => 'required|date',
            'genre_id' => 'required|exists:genres,id'
        ]);

        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters', 'public');
            $movie->poster = $posterPath;
        }

        $movie->update([
            'title' => $request->title,
            'intro' => $request->intro,
            'release_date' => $request->release_date,
            'genre_id' => $request->genre_id
        ]);

        return redirect()->route('movies.index');
    }

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect()->route('movies.index');
    }
}
