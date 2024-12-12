<x-layout-admin>
<a href="{{ route('about.index') }}" class="btn btn-secondary d-inline-block" style="width: 10%;">Back</a>
<table class="table mt-4">
    <tr>
        <th>Judul</th> 
        <td>{{ $about->title }}</td> 
    </tr>
    <tr>
        <th>Subjudul</th>
        <td>{{ $about->subtitle }}</td>
    </tr>
    <tr>
        <th>Deskripsi</th>
        <td>{{ $about->description }}</td>
    </tr>
</table>

</x-layout-admin>
