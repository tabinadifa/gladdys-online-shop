<x-layout-admin>
<div class="card-body">
<h3>Daftar Produk</h3>
    <a href="{{ route('products.create') }}" class="btn btn-primary d-inline-block" style="width: 15%;">Add Product</a>
    <table class="table mt-3" id="myTable">
        <thead>
            <tr>
                <th scope="col">Nama Produk</th>
                <th scope="col">Kategori</th>
                <th scope="col">Berat</th>
                <th scope="col">Diskon</th>
                <th scope="col">Harga Asli</th>
                <th scope="col">Harga Diskon</th>
                <th scope="col">Gambar</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($product as $row)
            <tr>
                <td>{{ $row->nama_produk }}</td>
                <td>{{ $row->kategori_produk }}</td>
                <td>{{ $row->berat_produk }}</td>
                <td>{{ $row->diskon ? ($row->diskon * 100) . '%' : '0%' }}</td>
                <td>Rp {{ number_format($row->harga_produk, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($row->harga_final, 0, ',', '.') }}</td>
                <td><img src="{{ asset($row->gambar_produk) }}" alt="" style="width: 64px; height: 64px; object-fit: cover; border-radius: 4px;" ></td>
                <td>
                    <a href="{{ route('products.show', $row) }}" class="btn btn-secondary btn-sm">Detail</a>
                    <a href="{{ route('products.edit', $row) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('products.destroy', $row->id_produk) }}" method="POST" class="d-inline" id="deleteForm-{{ $row->id_produk }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $row->id_produk }}')">Delete</button>
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
