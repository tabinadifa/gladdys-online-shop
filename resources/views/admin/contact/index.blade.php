<x-layout-admin>
<div class="card-body">
    <h3>Contact</h3>
    <a href="{{ route('contact.create') }}" class="btn btn-primary d-inline-block" style="width: 10%;">Add</a>
    <table class="table mt-3" id="myTable">
        <thead>
            <tr>
                <th scope="col">WhatsApp</th>
                <th scope="col">E-mail</th>
                <th scope="col">Instagram</th>
                <th scope="col">TikTok</th>
                <th scope="col">Twitter/X</th>
                <th scope="col">YouTube</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contact as $row)
            <tr>
                <td><a href="{{ asset($row->phone) }}" target="_blank" class="btn btn-info btn-sm">Open WhatsApp</a></td>
                <td>{{ $row->email }}</td>
                <td><a href="{{ asset($row->instagram) }}" target="_blank" class="btn btn-info btn-sm">Open Instagram</a></td>
                <td><a href="{{ asset($row->tiktok) }}" target="_blank" class="btn btn-info btn-sm">Open TikTok</a></td>
                <td><a href="{{ asset($row->twitter) }}" target="_blank" class="btn btn-info btn-sm">Open Twitter/X</a></td>
                <td><a href="{{ asset($row->youtube) }}" target="_blank" class="btn btn-info btn-sm">Open YouTube</a></td>
                <td>
                    <a href="{{ route('contact.show', $row) }}" class="btn btn-secondary btn-sm">Detail</a>
                    <a href="{{ route('contact.edit', $row) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('contact.destroy', $row->id) }}" method="POST" class="d-inline" id="deleteForm-{{ $row->id }}">
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
