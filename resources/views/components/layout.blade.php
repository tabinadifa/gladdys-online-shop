<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Gladdy's Case</title>
    <style>
        .sticky-header {
            transition: background-color 0.3s ease, box-shadow 0.3s ease, padding 0.3s ease;
            padding: 0.5rem 1rem;
        }

        .sticky-header.scrolled {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 0.25rem 1rem;
        }
    </style>
</head>

<body class="bg-gray-100">
    <!-- Sticky Header -->
    <div class="sticky-header fixed top-0 left-0 w-full z-50 bg-transparent">
        <div class="container mx-auto px-4">
            <header class="bg-transparent">
                <div class="flex items-center justify-between">
                    <!-- Logo / Brand Name -->
                    <div>
                        <a href="{{ route('index') }}" class="text-xl font-bold text-gray-400">Gladdy's Case</a>
                    </div>

                    <!-- Navbar -->
                    <div class="flex items-center gap-4">
                        @if (Route::has('login'))
                            <nav class="-mx-3 flex flex-1 justify-end">
                                @auth
                                    <!-- Tampilkan Dashboard dan tombol "Tentang Kami" serta "Keranjang" saat sudah login -->
                                    <a href="{{ route('about') }}"
                                        class="text-sm font-medium text-gray-900 border border-gray-200 bg-white px-4 py-2 rounded hover:text-gray-700 focus:outline-none focus:ring me-6">
                                        About
                                    </a>
                                    <a href="{{ route('cart.index') }}" class="text-sm font-medium text-white bg-yellow-400 px-4 py-2 rounded hover:bg-yellow-700 focus:outline-none focus:ring me-6">
                                        Cart
                                    </a>

                                    <!-- Tombol Logout -->
                                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit"
                                            class="text-sm font-medium text-gray-900 border border-gray-200 bg-white px-4 py-2 rounded hover:text-gray-700 focus:outline-none focus:ring">
                                            Log out
                                        </button>
                                    </form>
                                @else
                                    <!-- Tampilkan tombol Login dan Register saat belum login -->
                                    <a href="{{ route('login') }}"
                                        class="text-sm font-medium text-gray-900 border border-gray-200 bg-white px-4 py-2 rounded hover:text-gray-700 focus:outline-none focus:ring me-6">
                                        Log in
                                    </a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}"
                                            class="text-sm font-medium text-white bg-yellow-400 px-4 py-2 rounded hover:bg-yellow-700 focus:outline-none focus:ring">
                                            Register
                                        </a>
                                    @endif
                                @endauth
                            </nav>
                        @endif
                    </div>
                </div>
            </header>
        </div>
    </div>
    <!-- Content -->
    {{ $slot }}
    <!-- End Content -->

    <script>
        const header = document.querySelector('.sticky-header');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>
</body>

</html>
