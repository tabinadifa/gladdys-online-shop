<x-layout-admin>
    <div class="container mt-5">
        <h3>Daftar Pengguna</h3>
        <table class="table table-bordered mt-3" id="myTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>ID User</th>
                    <th>Email</th>
                    <th>Usertype</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->usertype }}</td>
                    <td>
                        <!-- Detail -->
                        <a href="{{ route('user.show', $user->id) }}" class="btn btn-secondary btn-sm">Detail</a>

                        <!-- Edit -->
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <!-- Delete -->
                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline" id="deleteForm-{{ $user->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $user->id }}')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus pengguna ini?')) {
                document.getElementById('deleteForm-' + id).submit();
            }
        }
    </script>
</x-layout-admin>
