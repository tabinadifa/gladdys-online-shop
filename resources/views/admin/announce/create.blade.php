<x-layout-admin>
<form action="{{ route('announce.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Announcement</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</x-layout-admin>
