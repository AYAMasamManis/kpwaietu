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
            Schema::create('produks', function (Blueprint $table) {
                $table->id();
                $table->string('name'); // <<< UBAH DARI 'nama_varian' MENJADI 'name'
                $table->text('description'); // <<< UBAH DARI 'deskripsi' MENJADI 'description'
                $table->string('gambar')->nullable();
                $table->integer('price'); // <<< UBAH DARI 'harga' MENJADI 'price'
                // Kolom 'stok' akan ditambahkan di migrasi terpisah (add_stok_to_produks_table)
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('produks');
        }
    };
    