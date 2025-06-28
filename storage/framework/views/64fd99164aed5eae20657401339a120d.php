

<?php $__env->startSection('title', 'Selamat Datang di Waiteu Collagen Drink'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    
    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8 flex flex-col md:flex-row items-center p-6 text-center md:text-left" style="background-color: #FDF8F5;">
        <div class="md:w-1/2 p-6">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 leading-tight">
                Rasakan Kulit Cerah Alami dengan <span class="text-pink-600" style="color: #C7A2A2;">Waiteu Collagen Drink</span>
            </h1>
            <p class="text-lg text-gray-700 mb-6">
                Minuman kolagen premium diformulasikan dari Korea, untuk kulit sehat, cerah, dan awet muda dari dalam. Bersertifikat BPOM dan Halal MUI.
            </p>
            <a href="<?php echo e(route('produk.index')); ?>" class="cta-button bg-blue-600 px-8 py-3 text-xl inline-flex items-center">
                Lihat Produk Kami
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>
        <div class="md:w-1/2 flex justify-center items-center p-6">
            <img src="<?php echo e(asset('images/latar2.jpg')); ?>" alt="Waiteu Hero Image" class="rounded-lg shadow-xl" style="max-width: 90%; height: auto;">
        </div>
    </div>

    
    <div class="text-center mb-8">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">Manfaat Utama Waiteu Collagen Drink</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                <div class="text-pink-600 text-4xl mb-3" style="color: #C7A2A2;">✨</div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Mencerahkan Kulit</h3>
                <p class="text-gray-700 text-sm">Dengan kandungan L-Glutathione Grade A, kulit tampak lebih cerah merata.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                <div class="text-pink-600 text-4xl mb-3" style="color: #C7A2A2;">💧</div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Melembapkan & Mengencangkan</h3>
                <p class="text-gray-700 text-sm">Peptide Fish Collagen membantu menjaga elastisitas dan hidrasi kulit.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                <div class="text-pink-600 text-4xl mb-3" style="color: #C7A2A2;">🌿</div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Anti-Aging</h3>
                <p class="text-gray-700 text-sm">Menyamarkan keriput dan mencegah tanda-tanda penuaan dini.</p>
            </div>
        </div>
    </div>

    
    <div class="text-center mb-8">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">Apa Kata Pelanggan Kami?</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                <p class="italic text-gray-700 mb-3">"Kulitku jadi lebih cerah dan kenyal setelah rutin minum Waiteu! Nggak nyangka hasilnya secepat ini."</p>
                <p class="font-semibold text-gray-800">- Sarah P.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                <p class="italic text-gray-700 mb-3">"Bekas jerawat memudar, rambut juga terasa lebih kuat. Waiteu beneran solusi lengkap untuk kecantikan!"</p>
                <p class="font-semibold text-gray-800">- Dewi K.</p>
            </div>
        </div>
        <a href="<?php echo e(route('forum')); ?>" class="cta-button bg-purple-600 mt-6 inline-flex items-center">
            Lihat Lebih Banyak Testimoni
            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </a>
    </div>

    
    <div class="text-center bg-brown-50 p-8 rounded-lg shadow-lg border border-gray-200" style="background-color: #E6D2C4; color: #4A4A4A;">
        <h2 class="text-3xl font-semibold mb-4">Siap untuk Kulit Impian Anda?</h2>
        <p class="text-lg mb-6">Mulai perjalanan kecantikan Anda bersama Waiteu Collagen Drink sekarang juga!</p>
        <a href="<?php echo e(route('keranjang')); ?>" class="cta-button bg-green-600 px-8 py-3 text-xl inline-flex items-center">
            Pesan Sekarang!
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 0a2 2 0 100 4 2 2 0 000-4z"></path></svg>
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\waiteu-app\resources\views/home.blade.php ENDPATH**/ ?>