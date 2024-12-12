<x-layout-admin>
<a href="{{ route('announce.index') }}" class="btn btn-secondary d-inline-block" style="width: 10%;">Back</a>
<table class="table mt-4">
    <tr>
        <th>Announcement</th> 
        <td>{{ $announce->title }}</td> 
    </tr>
    <tr>
        <th>Dibuat pada tanggal</th>
        <td>{{ $announce->created_at->format('d M Y H:i') }}</td>
    </tr>
</table>
</x-layout-admin>