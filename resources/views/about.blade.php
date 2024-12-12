<x-layout>
<section class="container mx-auto mt-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto text-center">
        @foreach ($about as $row)
            <h1 class="text-4xl font-bold text-gray-900 sm:text-5xl">{{ $row->title }}</h1>
            <p class="mt-4 text-lg text-gray-600">{{ $row->subtitle }}</p>
        @endforeach
    </div>

    <div class="mt-12 max-w-4xl mx-auto">
        <p class="text-gray-700 text-justify leading-relaxed">
            @foreach ($about as $row)
                {{ $row->description }}
            @endforeach
        </p>

        <!-- Social Links -->
        <div class="mt-8 flex justify-center space-x-6">
            @foreach ($contact as $row)
                <!-- Instagram -->
                <a href="{{ $row->instagram }}" target="_blank" class="text-gray-500 hover:text-pink-500">
                    <i class="bi bi-instagram h-6 w-6 text-lg"></i>
                </a>
                <!-- WhatsApp -->
                <a href="{{ $row->whatsapp }}" target="_blank" class="text-gray-500 hover:text-green-500">
                    <i class="bi bi-whatsapp h-6 w-6 text-lg"></i>
                </a>
                <!-- TikTok -->
                <a href="{{ $row->tiktok }}" target="_blank" class="text-gray-500 hover:text-black">
                    <i class="bi bi-tiktok h-6 w-6 text-lg"></i>
                </a>
                <!-- Twitter -->
                <a href="{{ $row->twitter }}" target="_blank" class="text-gray-500 hover:text-blue-500">
                    <i class="bi bi-twitter h-6 w-6 text-lg"></i>
                </a>
                <!-- YouTube -->
                <a href="{{ $row->youtube }}" target="_blank" class="text-gray-500 hover:text-red-500">
                    <i class="bi bi-youtube h-6 w-6 text-lg"></i>
                </a>
        </div>
        <!-- Email -->
        <p class="mt-5 text-gray-500 hover:text-blue-700 text-lg font-medium text-center"><i class="bi bi-envelope h-6 w-6"></i> {{ $row->email }}</p>
        @endforeach
    </div>
</section>
</x-layout>
