 

<?php $__env->startSection('title', 'Keranjang Belanja'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-4">Keranjang Belanja</h2>

    <?php if(session('error')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5 text-sm">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if(auth()->guard()->check()): ?>
    <form method="POST" action="<?php echo e(route('orders.store')); ?>">
        <?php echo csrf_field(); ?>
        <?php $__empty_1 = true; $__currentLoopData = $produks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?> 
            <div class="card mb-3 p-3 border rounded-lg shadow-sm">
                <h5 class="text-lg font-semibold"><?php echo e($produk->name); ?></h5> 
                <p class="text-gray-700">Harga: Rp<?php echo e(number_format($produk->price)); ?></p> 
                <p class="text-gray-700">Stok Tersedia: <?php echo e($produk->stok); ?></p> 
                <input type="hidden" name="product_id[]" value="<?php echo e($produk->id); ?>">
                <div class="form-group mt-2">
                    <label for="quantity-<?php echo e($produk->id); ?>" class="block text-sm font-medium text-gray-700">Jumlah:</label>
                    <input type="text" name="quantity[]" id="quantity-<?php echo e($produk->id); ?>"
                           class="form-control w-24 border rounded-md px-2 py-1 mt-1"
                           value="0"> 
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-center text-gray-500">Tidak ada produk tersedia untuk ditambahkan ke keranjang.</p>
        <?php endif; ?>

        <div class="flex justify-between items-center mt-4"> 
            <?php if(!$produks->isEmpty()): ?>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Proses Pesanan
                </button>
            <?php endif; ?>
            <a href="<?php echo e(route('orders.index')); ?>" class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300">
                Lihat Riwayat Pesanan Saya
            </a>
        </div>
    </form>
    <?php else: ?>
    <p class="text-center text-gray-500">
        Silakan <a href="<?php echo e(route('login')); ?>" class="text-blue-600 underline">login</a> untuk menambahkan produk ke keranjang.
    </p>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\waiteu-app\resources\views/order/create.blade.php ENDPATH**/ ?>