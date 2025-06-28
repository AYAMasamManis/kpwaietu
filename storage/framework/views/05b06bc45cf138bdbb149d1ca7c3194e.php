 

<?php $__env->startSection('title', 'Dashboard Pelanggan'); ?> 

<?php $__env->startSection('content'); ?> 
    
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-6">
        <?php echo e(__('Dashboard Pelanggan')); ?>

    </h2>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <p>Halo, <?php echo e(Auth::user()->name); ?> 👋</p>
                <p>Selamat datang di Dashboard Waiteu Collagen. Di sini kamu bisa melihat pesananmu dan menjelajahi produk kami.</p>
                <div class="mt-4 space-y-2">
                    <a href="<?php echo e(route('produk.index')); ?>" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Lihat Produk
                    </a>
                    <a href="<?php echo e(route('keranjang')); ?>" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Buka Keranjang
                    </a>
                    <a href="<?php echo e(route('forum')); ?>" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                        Kunjungi Forum
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?> 

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\waiteu-app\resources\views/dashboard/customer.blade.php ENDPATH**/ ?>