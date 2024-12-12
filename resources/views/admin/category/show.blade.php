<x-layout-admin>
<a href="{{ route('category.index') }}" class="btn btn-secondary d-inline-block" style="width: 10%;">Back</a>
<table class="table mt-4">
    <tr>
        <th>Nama Kategori</th> 
        <td>{{ $category->name }}</td> 
    </tr>
    <tr>
        <th>Dibuat pada tanggal</th>
        <td>{{ $category->created_at->format('d M Y H:i') }}</td>
    </tr>
</table>
</x-layout-admin>