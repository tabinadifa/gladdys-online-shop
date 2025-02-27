<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('id_produk');
            $table->string('nama_produk');
            $table->string('kategori_produk');
            $table->text('deskripsi_produk');
            $table->decimal('harga_produk', 15, 2); // Sesuaikan skala sesuai kebutuhan
            $table->decimal('diskon', 15, 2);
            $table->decimal('harga_final', 15, 2);
            $table->string('gambar_produk')->default('dashboard-template/products_img/default.png');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
