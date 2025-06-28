

<?php $__env->startSection('title', 'Daftar Produk'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-4 text-gray-800">Daftar Produk Waiteu</h2>

    
    <?php if(session('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(auth()->guard()->check()): ?>
        <?php if(Auth::user()->role === 'admin'): ?>
            <div class="mb-6 text-right">
                <a href="<?php echo e(route('produk.create')); ?>" class="cta-button bg-blue-600">
                    + Tambah Produk Baru
                </a>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <?php if($produks->isEmpty()): ?>
        <p class="text-center text-gray-500">Tidak ada produk tersedia saat ini.</p>
    <?php else: ?>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border-collapse border border-gray-200">
                <thead>
                    <tr>
                        <th class="border px-4 py-2 text-left bg-gray-100 text-gray-800">Gambar</th>
                        <th class="border px-4 py-2 text-left bg-gray-100 text-gray-800">Nama</th>
                        <th class="border px-4 py-2 text-left bg-gray-100 text-gray-800">Deskripsi</th>
                        <th class="border px-4 py-2 text-right bg-gray-100 text-gray-800">Harga</th>
                        <th class="border px-4 py-2 text-right bg-gray-100 text-gray-800">Stok</th>
                        <?php if(auth()->guard()->check()): ?>
                            <?php if(Auth::user()->role === 'admin'): ?>
                                <th class="border px-4 py-2 bg-gray-100 text-gray-800">Aksi</th>
                            <?php endif; ?>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $produks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="text-center hover:bg-gray-50">
                        <td class="border px-4 py-2">
                            <?php if($produk->gambar): ?>
                                <img src="<?php echo e(asset('storage/produk_gambar/' . $produk->gambar)); ?>" alt="Gambar Produk" class="h-16 w-16 object-cover rounded mx-auto"> 
                            <?php else: ?>
                                <span class="text-gray-400">-</span>
                            <?php endif; ?>
                        </td>
                        <td class="border px-4 py-2 text-left text-gray-700"><?php echo e($produk->name); ?></td>
                        <td class="border px-4 py-2 text-left text-gray-700"><?php echo e($produk->description); ?></td>
                        <td class="border px-4 py-2 text-right text-gray-700">Rp<?php echo e(number_format($produk->price, 0, ',', '.')); ?></td>
                        <td class="border px-4 py-2 text-right text-gray-700"><?php echo e($produk->stok); ?></td>
                        <?php if(auth()->guard()->check()): ?>
                            <?php if(Auth::user()->role === 'admin'): ?>
                                <td class="border px-4 py-2">
                                    <a href="<?php echo e(route('produk.edit', $produk->id)); ?>" class="cta-button bg-yellow-500 px-3 py-1 text-sm mr-2">Edit</a>
                                    <form action="<?php echo e(route('produk.destroy', $produk->id)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="cta-button bg-red-600 px-3 py-1 text-sm">Hapus</button>
                                    </form>
                                </td>
                            <?php endif; ?>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="border px-4 py-2 text-center text-gray-500">Tidak ada produk ditemukan.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\waiteu-app\resources\views/produk/index.blade.php ENDPATH**/ ?>