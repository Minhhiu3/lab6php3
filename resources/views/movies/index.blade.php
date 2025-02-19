@extends('layouts.app')

@section('content')
    <h1>Danh sách phim</h1>

    <!-- Form tìm kiếm -->
    <form action="{{ route('movies.index') }}" method="GET">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm phim...">
        <button type="submit">Tìm kiếm</button>
    </form>

    <a href="{{ route('movies.create') }}">Thêm phim</a>

    <table>
        <tr>
            <th>Tiêu đề</th>
            <th>Thể loại</th>
            <th>Ngày công chiếu</th>
            <th>Poster</th>
            <th>Hành động</th>
        </tr>
        @foreach ($movies as $movie)
            <tr>
                <td>{{ $movie->title }}</td>
                <td>{{ $movie->genre->name }}</td>
                <td>{{ $movie->release_date }}</td>
                <td>
                    @if ($movie->poster)
                        <img src="{{ asset('storage/' . $movie->poster) }}" alt="Poster" width="100">
                    @endif
                </td>
                <td>
                    <a href="{{ route('movies.show', $movie->id) }}">Xem</a>
                    <a href="{{ route('movies.edit', $movie->id) }}">Sửa</a>
                    <form action="{{ route('movies.destroy', $movie->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit">Xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {{ $movies->appends(['search' => request('search')])->links() }}
@endsection
