<x-layout-admin>
    <div class="container mt-5">
        <h3>Admin Dashboard</h3>

        <!-- Dashboard Cards -->
        <div class="row g-3">
            <!-- Jumlah Produk -->
            <div class="col-md-4 col-lg-3">
                <div class="card text-white bg-primary shadow">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Produk</h5>
                        <div class="d-flex align-items-center">
                            <span class="display-4 me-3">📦</span>
                            <span class="h3 mb-0">{{ $jumlahProduk }}</span>
                        </div>
                        <p class="mt-2">Total Produk</p>
                    </div>
                </div>
            </div>

            <!-- Jumlah Pesanan -->
            <div class="col-md-4 col-lg-3">
                <div class="card text-white bg-secondary shadow">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Pesanan</h5>
                        <div class="d-flex align-items-center">
                            <span class="display-4 me-3">🛒</span>
                            <span class="h3 mb-0">{{ $jumlahPesanan }}</span>
                        </div>
                        <p class="mt-2">Total Pesanan</p>
                    </div>
                </div>
            </div>

            <!-- Jumlah Pengguna -->
            <div class="col-md-4 col-lg-3">
                <div class="card text-white bg-success shadow">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Pengguna</h5>
                        <div class="d-flex align-items-center">
                            <span class="display-4 me-3">👤</span>
                            <span class="h3 mb-0">{{ $jumlahUser }}</span>
                        </div>
                        <p class="mt-2">Total Pengguna</p>
                    </div>
                </div>
            </div>

            <!-- Jumlah Admin -->
            <div class="col-md-4 col-lg-3">
                <div class="card text-white bg-info shadow">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Admin</h5>
                        <div class="d-flex align-items-center">
                            <span class="display-4 me-3">🔧</span>
                            <span class="h3 mb-0">{{ $jumlahAdmin }}</span>
                        </div>
                        <p class="mt-2">Total Admin</p>
                    </div>
                </div>
            </div>

            <!-- Jumlah Pesanan Pending -->
            <div class="col-md-4 col-lg-3">
                <div class="card text-white bg-warning shadow">
                    <div class="card-body">
                        <h5 class="card-title">Pesanan Pending</h5>
                        <div class="d-flex align-items-center">
                            <span class="display-4 me-3">⏳</span>
                            <span class="h3 mb-0">{{ $jumlahPesananPending }}</span>
                        </div>
                        <p class="mt-2">Total Pending</p>
                    </div>
                </div>
            </div>

            <!-- Jumlah Pesanan Process -->
            <div class="col-md-4 col-lg-3">
                <div class="card text-white bg-primary shadow">
                    <div class="card-body">
                        <h5 class="card-title">Pesanan Diproses</h5>
                        <div class="d-flex align-items-center">
                            <span class="display-4 me-3">🔄</span>
                            <span class="h3 mb-0">{{ $jumlahPesananProcess }}</span>
                        </div>
                        <p class="mt-2">Total Diproses</p>
                    </div>
                </div>
            </div>

            <!-- Jumlah Pesanan Diterima -->
            <div class="col-md-4 col-lg-3">
                <div class="card text-white bg-success shadow">
                    <div class="card-body">
                        <h5 class="card-title">Pesanan Diterima</h5>
                        <div class="d-flex align-items-center">
                            <span class="display-4 me-3">✅</span>
                            <span class="h3 mb-0">{{ $jumlahPesananDiterima }}</span>
                        </div>
                        <p class="mt-2">Total Diterima</p>
                    </div>
                </div>
            </div>

            <!-- Jumlah Pesanan Ditolak -->
            <div class="col-md-4 col-lg-3">
                <div class="card text-white bg-danger shadow">
                    <div class="card-body">
                        <h5 class="card-title">Pesanan Ditolak</h5>
                        <div class="d-flex align-items-center">
                            <span class="display-4 me-3">❌</span>
                            <span class="h3 mb-0">{{ $jumlahPesananDitolak }}</span>
                        </div>
                        <p class="mt-2">Total Ditolak</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout-admin>
