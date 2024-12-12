<x-layout-admin>
<div class="card-body">
    <h3>About</h3>
    <a href="{{ route('about.create') }}" class="btn btn-primary d-inline-block" style="width: 10%;">Add</a>
    <table class="table mt-3" id="myTable">
        <thead>
            <tr>
                <th scope="col">Judul</th>
                <th scope="col">Subjudul</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($about as $row)
            <tr>
                <td>{{ $row->title }}</td>
                <td>{{ $row->subtitle }}</td>
                <td>
                    <a href="{{ route('about.show', $row) }}" class="btn btn-secondary btn-sm">Detail</a>
                    <a href="{{ route('about.edit', $row) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('about.destroy', $row->id) }}" method="POST" class="d-inline" id="deleteForm-{{ $row->id }}">
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
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            document.getElementById('deleteForm-' + id).submit();
        }
    }
</script>
</x-layout-admin>
