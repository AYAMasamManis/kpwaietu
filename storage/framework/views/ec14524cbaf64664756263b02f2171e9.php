

<?php $__env->startSection('title', 'Dashboard Admin'); ?>

<?php $__env->startSection('content'); ?>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-8 text-center">
        <?php echo e(__('Dashboard Admin')); ?>

    </h2>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 text-gray-900">
                <p class="mb-4">Halo, Admin <?php echo e(Auth::user()->name); ?> 👋</p>
                <p class="mb-6">Selamat datang di panel Admin Waiteu Collagen. Di sini kamu bisa mengelola produk, pesanan, dan komentar pengguna.</p>

                
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-blue-50 p-6 rounded-lg shadow-md border border-blue-100 text-center">
                        <h3 class="text-xl font-semibold text-blue-800">Total Produk</h3>
                        <p class="text-4xl font-bold text-blue-600 mt-2"><?php echo e($totalProduk); ?></p>
                    </div>
                    <div class="bg-green-50 p-6 rounded-lg shadow-md border border-green-100 text-center">
                        <h3 class="text-xl font-semibold text-green-800">Total Pesanan</h3>
                        <p class="text-4xl font-bold text-green-600 mt-2"><?php echo e($totalPesanan); ?></p>
                    </div>
                    <div class="bg-yellow-50 p-6 rounded-lg shadow-md border border-yellow-100 text-center">
                        <h3 class="text-xl font-semibold text-yellow-800">Pesanan Pending</h3>
                        <p class="text-4xl font-bold text-yellow-600 mt-2"><?php echo e($pendingOrders); ?></p>
                    </div>
                    <div class="bg-purple-50 p-6 rounded-lg shadow-md border border-purple-100 text-center">
                        <h3 class="text-xl font-semibold text-purple-800">Total Pengguna</h3>
                        <p class="text-4xl font-bold text-purple-600 mt-2"><?php echo e($totalUsers); ?></p>
                    </div>
                </div>

                
                <div class="flex flex-wrap gap-4 justify-center">
                    <a href="<?php echo e(route('produk.index')); ?>" class="cta-button bg-blue-600">
                        Kelola Produk
                    </a>
                    <a href="<?php echo e(route('orders.index')); ?>" class="cta-button bg-green-600">
                        Lihat Pesanan
                    </a>
                    <a href="<?php echo e(route('forum')); ?>" class="cta-button bg-purple-600">
                        Lihat Forum
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\waiteu-app\resources\views/dashboard/admin.blade.php ENDPATH**/ ?>