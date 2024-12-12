<x-layout-admin>
<div class="card-body">
    <h3>Daftar Order</h3>
    <table class="table mt-3" id="myTable">
        <thead>
            <tr>
                <th scope="col">ID Order</th>
                <th scope="col">ID User</th>
                <th scope="col">Nama Pemesan</th>
                <th scope="col">Phone</th>
                <th scope="col">Alamat</th>
                <th scope="col">Total Harga</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->user_id }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->phone }}</td>
                <td>{{ $row->address }}</td>
                <td>Rp {{ number_format($row->total_price, 0, ',', '.') }}</td>
                <td>
                <span class="badge 
                    {{ $row->status == 'pending' ? 'bg-warning' : 
                        ($row->status == 'rejected' ? 'bg-danger' : 
                        ($row->status == 'process' ? 'bg-info' : 'bg-success')) }}">
                    {{ ucfirst($row->status) }}
                </span>
                </td>
                <td>
                    <a href="{{ route('orders.show', $row->id) }}" class="btn btn-secondary btn-sm">Detail</a>
                    <a href="{{ route('orders.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('orders.destroy', $row->id) }}" method="POST" class="d-inline" id="deleteForm-{{ $row->id }}">
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
        if (confirm('Apakah Anda yakin ingin menghapus order ini?')) {
            document.getElementById('deleteForm-' + id).submit();
        }
    }
</script>
</x-layout-admin>
