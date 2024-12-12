<x-layout-admin>
<a href="{{ route('about.index') }}" class="btn btn-secondary d-inline-block" style="width: 10%;">Back</a>
<form action="{{ route('about.update', $about) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="title" class="form-label">Judul</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ $about->title }}" required>
    </div>
    <div class="mb-3">
        <label for="subtitle" class="form-label">Subjudul</label>
        <input type="text" class="form-control" id="subtitle" name="subtitle" value="{{ $about->subtitle }}" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Deskripsi</label>
        <textarea class="form-control" id="description" name="description" required>{{ $about->description }}</textarea>
    </div>
    <button type="submit" class="btn btn-info">Update</button>
</form>
</x-layout-admin>
