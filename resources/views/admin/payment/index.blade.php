<x-layout-admin>

    <div class="container mt-5">
        <h3>Pembayaran</h3>
        <a href="{{ route('payment.create') }}" class="btn btn-primary d-inline-block" style="width: 15%;">Add</a>
        <table class="table table-bordered mt-3" id="myTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Gambar QRIS</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payment as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><img src="{{ asset($row->gambar_qris) }}" alt="" style="width: 64px; height: 64px; object-fit: cover; border-radius: 4px;" ></td>
                    <td>
                        <!-- Detail -->
                        <a href="{{ route('payment.show', $row->id) }}" class="btn btn-secondary btn-sm">Detail</a>
                        <!-- Edit -->
                        <a href="{{ route('payment.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <!-- Delete -->
                        <form action="{{ route('payment.destroy', $row->id) }}" method="POST" class="d-inline" id="deleteForm-{{ $row->id }}">
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