@extends('layouts.app')

@section('title', 'Chỉnh sửa phim')

@section('content')
    <h1>Chỉnh sửa phim</h1>
    <form action="{{ route('movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label>Tiêu đề:</label>
        <input type="text" name="title" value="{{ $movie->title }}" required>

        <label>Thể loại:</label>
        <select name="genre_id">
            @foreach ($genres as $genre)
                <option value="{{ $genre->id }}" {{ $movie->genre_id == $genre->id ? 'selected' : '' }}>
                    {{ $genre->name }}
                </option>
            @endforeach
        </select>

        <label>Giới thiệu:</label>
        <textarea name="intro">{{ $movie->intro }}</textarea>

        <label>Ngày phát hành:</label>
        <input type="date" name="release_date" value="{{ $movie->release_date }}">

        <label>Hình ảnh áp phích:</label>
        <input type="file" name="poster">
        @if($movie->poster)
            <img src="{{ asset('storage/' . $movie->poster) }}" alt="Poster" width="100">
        @endif

        <button type="submit">Cập nhật</button>
    </form>

    <a href="{{ route('movies.index') }}" class="btn btn-secondary">Quay lại danh sách</a>

@endsection
