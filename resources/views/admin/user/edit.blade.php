<x-layout-admin>
    <div class="container mt-5">
        <a href="{{ route('user.index') }}" class="btn btn-secondary mb-3">Kembali ke Laporan</a>
        <h3>Edit Usertype</h3>
        <form action="{{ route('user.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="usertype" class="form-label">Usertype</label>
                <select name="usertype" id="usertype" class="form-control">
                    <option value="user" {{ $user->usertype == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ $user->usertype == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
</x-layout-admin>
