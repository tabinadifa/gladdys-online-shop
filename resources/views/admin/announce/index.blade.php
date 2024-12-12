<x-layout-admin>

    <div class="container mt-5">
        <h3>Announcement</h3>
        <a href="{{ route('announce.create') }}" class="btn btn-primary d-inline-block" style="width: 15%;">Add</a>
        <table class="table table-bordered mt-3" id="myTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Announcement</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($announce as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->title }}</td>
                    <td>
                        <!-- Detail -->
                        <a href="{{ route('announce.show', $row->id) }}" class="btn btn-secondary btn-sm">Detail</a>
                        <!-- Edit -->
                        <a href="{{ route('announce.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <!-- Delete -->
                        <form action="{{ route('announce.destroy', $row->id) }}" method="POST" class="d-inline" id="deleteForm-{{ $row->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $row->id }}')">Delete</button>
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