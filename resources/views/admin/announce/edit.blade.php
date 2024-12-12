<x-layout-admin>
<a href="{{ route('announce.index') }}" class="btn btn-secondary d-inline-block" style="width: 10%;">Back</a>
<form action="{{ route('announce.update', $announce) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="title" class="form-label">Announcement</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ $announce->title }}" required>
    </div>
    <button type="submit" class="btn btn-info">Update</button>
</form>
</x-layout-admin>
