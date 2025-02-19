@extends('layouts.app')

@section('title', 'Chi tiết phim')

@section('content')
    <h1>Chi tiết phim</h1>
    <p>Tiêu đề: {{ $movie->title }}</p>
    <p>Thể loại: {{ $movie->genre->name }}</p>
    <p>Giới thiệu: {{ $movie->intro }}</p>
    <p>Ngày phát hành: {{ $movie->release_date }}</p>
    <img src="{{ asset('storage/' . $movie->poster) }}" alt="Poster">

    <a href="{{ route('movies.index') }}" class="btn btn-secondary">Quay lại danh sách</a>

@endsection
