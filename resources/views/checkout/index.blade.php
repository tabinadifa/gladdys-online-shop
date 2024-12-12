<x-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-center text-gray-800">Cek Ongkir</h2>
            <form action="{{ route('checkout.cekOngkir') }}" method="POST" class="space-y-4 mt-6">
                @csrf
                <!-- Kota Asal -->
                <div class="form-group">
                    <label for="origin" class="block text-sm font-medium text-gray-700">Kota Asal:</label>
                    <select name="origin" id="origin" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm p-2 focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="148">Bogor</option>
                    </select>
                </div>
                <!-- Kota Tujuan -->
                <div class="form-group">
                    <label for="destination_id" class="block text-sm font-medium text-gray-700">Kota Tujuan:</label>
                    <select name="destination_id" id="destination_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm p-2 focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Pilih Kota Tujuan</option>
                        @foreach ($cities['rajaongkir']['results'] as $city)
                            <option value="{{ $city['city_id'] }}" {{ old('city_id') == $city['city_id'] ? 'selected' : '' }}>{{ $city['city_name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Berat Produk -->
                <div class="form-group">
                    <label for="weight" class="block text-sm font-medium text-gray-700">Berat Produk (gram):</label>
                    <input type="number" name="weight" id="weight" 
                    value="{{ $totalWeight }}" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm p-2 focus:ring-blue-500 focus:border-blue-500" readonly>

                </div>
                <!-- Kurir -->
                <div class="form-group">
                    <label for="courier" class="block text-sm font-medium text-gray-700">Pilih Kurir:</label>
                    <select name="courier" id="courier" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm p-2 focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Pilih Kurir</option>
                        <option value="jne" {{ old('courier') == 'jne' ? 'selected' : '' }}>JNE</option>
                        <option value="pos" {{ old('courier') == 'pos' ? 'selected' : '' }}>POS</option>
                        <option value="tiki" {{ old('courier') == 'tiki' ? 'selected' : '' }}>TIKI</option>
                    </select>
                </div>
                <!-- Submit Button -->
                <div>
                    <button type="submit" class="w-full py-2 px-4 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                        Cek Ongkir
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
