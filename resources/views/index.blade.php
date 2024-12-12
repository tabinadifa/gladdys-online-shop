<x-layout>
<section
  class="relative bg-[url('{{ asset('template/img/hero.jpg') }}')] bg-cover bg-center bg-no-repeat"
>
  <!-- Overlay Transparan -->
  <div class="absolute inset-0 bg-gradient-to-br from-yellow-600 via-orange-500 to-amber-900 opacity-60"></div>

  <!-- Konten Hero -->
  <div
    class="relative mx-auto max-w-screen-xl px-4 py-32 sm:px-6 lg:flex lg:h-screen lg:items-center lg:px-8"
  >
    <div class="max-w-xl text-left ltr:sm:text-left rtl:sm:text-right">
      <h1
        class="text-3xl font-extrabold text-white sm:text-5xl"
        style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);"
      >
        Welcome to

        <strong
          class="block font-extrabold text-yellow-400"
          style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);"
        >
          Gladdy's Store
        </strong>
      </h1>

      <p
        class="mt-4 max-w-lg text-white sm:text-xl/relaxed"
        style="text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.7);"
      >
   Percantik barangmu dengan aksesoris yang unik dan stylish!
      </p>

      <div class="mt-8 flex flex-wrap gap-4 text-center">
        <a
          href="#produk"
          class="block w-full rounded bg-yellow-400 px-12 py-3 text-sm font-medium text-white shadow hover:bg-yellow-500 focus:outline-none focus:ring active:bg-yellow-600 sm:w-auto"
        >
          View More
        </a>

        <a
          href="{{ route('about') }}"
          class="block w-full rounded bg-white px-12 py-3 text-sm font-medium text-yellow-600 shadow hover:text-yellow-700 focus:outline-none focus:ring active:text-yellow-500 sm:w-auto"
        >
          About Us
        </a>
      </div>
    </div>
  </div>
</section>

<div class="bg-yellow-600 px-4 py-3 text-white">
  <p class="text-center text-sm font-medium">
    @foreach ($announc as $row)
    {{ $row->title }}
    @endforeach
  </p>
</div>
<br><br>
<div class="container mx-auto p-4" id="produk">
<h1
        class="text-3xl font-extrabold text-amber sm:text-5xl"
      >
        Produk
</h1>
    <!-- Filter Kategori -->
     <br><br>
    <div class="mb-4 flex justify-start">
        <form action="{{ route('index') }}" method="GET" class="flex items-center">
            <select name="kategori" class="rounded border-gray-300 p-2 text-sm" onchange="this.form.submit()">
                <option value="">All</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('kategori') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    <!-- Daftar Produk -->
    @if (session('success'))
    <div class="relative bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-md mb-4" role="alert">
        <strong class="font-bold">Berhasil!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
        <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.remove();">
            <svg class="fill-current h-6 w-6 text-green-700" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title>Tutup</title>
                <path d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 7.066 5.652a1 1 0 00-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 11.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934a1 1 0 000-1.414z"/>
            </svg>
        </button>
    </div>
@endif
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @forelse ($product as $row)
            <a href="{{ route('product.show', $row->id_produk) }}" class="group relative block overflow-hidden border border-gray-200 rounded-lg shadow hover:shadow-md">
                <div class="aspect-square bg-gray-100 overflow-hidden">
                    <img
                        src="{{ $row->gambar_produk }}"
                        alt="{{ $row->nama_produk }}"
                        class="w-full h-full object-cover transition duration-500 group-hover:scale-105"
                    />
                </div>

                <div class="relative bg-white p-4">
                    @php
                        $currentDate = date('Y-m-d');
                        $productDate = date('Y-m-d', strtotime($row->created_at));
                        $isNew = ($currentDate == $productDate);
                    @endphp
                    @if($isNew)
                        <span class="whitespace-nowrap bg-yellow-400 px-2 py-1 text-xs font-medium"> New </span> 
                    @endif

                    <h3 class="mt-2 text-base font-medium text-gray-900">{{ $row->nama_produk }}</h3> 
                    <p class="mt-1 text-sm text-gray-700">Rp {{ number_format($row->harga_produk, 0, ',', '.') }}</p>

                    <form action="{{ route('cart.add', $row->id_produk) }}" method="POST" class="mt-3">
                      @csrf
                         @if(auth()->check())
                        <button
                             type="submit"
                             class="block w-full rounded bg-yellow-400 px-4 py-2 text-xs font-medium text-white hover:bg-yellow-500 transition"
                         >
                              Tambah ke Keranjang
                        </button>
                          @else
                        <a
                            href="{{ route('login') }}"
                            class="block w-full rounded bg-gray-400 px-4 py-2 text-xs font-medium text-white hover:bg-gray-500 transition"
                        >
                        Login untuk Menambah
                        </a>
                      @endif
                    </form>

                </div>
            </a>
        @empty
            <p class="text-center text-gray-500 col-span-full">Produk tidak ditemukan</p>
        @endforelse
    </div>



</div>
</x-layout>
