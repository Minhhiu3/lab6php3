<form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label class="form-label">Tiêu đề phim</label>
        <input type="text" name="title" class="form-control" required>
        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Poster</label>
        <input type="file" name="poster" class="form-control">
        @error('poster') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Giới thiệu</label>
        <input type="text" name="intro" class="form-control" required>
        @error('intro') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Ngày công chiếu</label>
        <input type="date" name="release_date" class="form-control" required>
        @error('release_date') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Thể loại</label>
        <select name="genre_id" class="form-control">
            @foreach ($genres as $genre)
                <option value="{{ $genre->id }}">{{ $genre->name }}</option>
            @endforeach
        </select>
        @error('genre_id') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <button type="submit" class="btn btn-primary">Thêm Phim</button>
</form>
