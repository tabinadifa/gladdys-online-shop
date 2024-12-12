<x-layout-admin>
<form action="{{ route('about.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Judul</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="mb-3">
        <label for="subtitle" class="form-label">Subjudul</label>
        <input type="text" class="form-control" id="subtitle" name="subtitle" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Deskripsi</label>
        <textarea class="form-control" id="description" name="description" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</x-layout-admin>
