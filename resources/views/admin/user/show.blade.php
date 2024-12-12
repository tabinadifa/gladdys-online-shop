<x-layout-admin>
    <div class="container mt-5">
        <a href="{{ route('user.index') }}" class="btn btn-secondary mb-3">Kembali ke Laporan</a>
        <h3>Detail Pengguna</h3>
        <table class="table table-bordered">
            <tr>
                <th>ID User</th>
                <td>{{ $user->id }}</td>
            </tr>
            <tr>
                <th>Nama</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Usertype</th>
                <td>{{ $user->usertype }}</td>
            </tr>
            <tr>
                <th>Waktu Pendaftaran</th>
                <td>{{ $user->created_at->format('d M Y H:i') }}</td>
            </tr>
        </table>
    </div>
</x-layout-admin>
