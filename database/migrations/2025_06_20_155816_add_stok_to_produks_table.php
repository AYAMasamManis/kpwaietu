    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        public function up(): void
        {
            Schema::table('produks', function (Blueprint $table) {
                // UBAH 'harga' MENJADI 'price'
                $table->integer('stok')->default(0)->after('price'); // Tambahkan kolom 'stok' setelah 'price'
            });
        }

        public function down(): void
        {
            Schema::table('produks', function (Blueprint $table) {
                $table->dropColumn('stok');
            });
        }
    };
    