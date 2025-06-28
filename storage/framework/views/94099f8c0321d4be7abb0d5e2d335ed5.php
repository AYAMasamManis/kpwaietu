    

    <?php $__env->startSection('title', 'Konfirmasi Pesanan'); ?>

    <?php $__env->startSection('content'); ?>
    <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800">Konfirmasi Pesanan Anda</h2>

        <?php if(session('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <div class="mb-6 border-b pb-4">
            <p class="text-lg font-bold text-gray-800">ID Pesanan: <?php echo e($order->id); ?></p>
            <p class="text-gray-700">Tanggal Pesanan: <?php echo e($order->created_at->format('d M Y H:i')); ?></p>
            <p class="text-xl font-bold text-blue-600">Total Pembayaran: Rp<?php echo e(number_format($order->total_price, 0, ',', '.')); ?></p>
            <p class="text-lg font-bold">Status: <span class="text-red-500"><?php echo e($order->status); ?></span></p>

            
            <?php if($order->bukti_transfer): ?>
                <div class="mt-4 p-4 bg-gray-50 border border-gray-200 rounded-lg text-center">
                    <p class="font-semibold text-gray-800 mb-2">Bukti Transfer:</p>
                    <a href="<?php echo e(asset('storage/bukti_transfer/' . $order->bukti_transfer)); ?>" target="_blank">
                        <img src="<?php echo e(asset('storage/bukti_transfer/' . $order->bukti_transfer)); ?>" alt="Bukti Transfer" class="mx-auto max-w-xs h-auto rounded-lg shadow-sm border border-gray-300">
                    </a>
                </div>
            <?php endif; ?>

            
            <?php if(auth()->guard()->check()): ?>
                <?php if(Auth::user()->role === 'admin'): ?>
                    <div class="mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <p class="font-semibold text-yellow-800 mb-2">Ubah Status Pesanan (Admin):</p>
                        <form action="<?php echo e(route('orders.updateStatus', $order->id)); ?>" method="POST" class="space-y-3">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status:</label>
                                <select name="status" id="status" class="border rounded-md px-3 py-1 w-full focus:ring-blue-600 focus:border-transparent">
                                    <option value="pending" <?php echo e($order->status == 'pending' ? 'selected' : ''); ?>>Pending</option>
                                    <option value="menunggu_verifikasi" <?php echo e($order->status == 'menunggu_verifikasi' ? 'selected' : ''); ?>>Menunggu Verifikasi</option>
                                    <option value="terbayar" <?php echo e($order->status == 'terbayar' ? 'selected' : ''); ?>>Terbayar</option>
                                    <option value="diproses" <?php echo e($order->status == 'diproses' ? 'selected' : ''); ?>>Diproses</option>
                                    <option value="dikirim" <?php echo e($order->status == 'dikirim' ? 'selected' : ''); ?>>Dikirim</option>
                                    <option value="selesai" <?php echo e($order->status == 'selesai' ? 'selected' : ''); ?>>Selesai</option>
                                    <option value="dibatalkan" <?php echo e($order->status == 'dibatalkan' ? 'selected' : ''); ?>>Dibatalkan</option>
                                </select>
                            </div>
                            <div>
                                <label for="catatan_admin" class="block text-sm font-medium text-gray-700">Catatan Admin (Opsional):</label>
                                <textarea name="catatan_admin" id="catatan_admin" rows="3" class="w-full border rounded-md px-3 py-2 focus:ring-blue-600 focus:border-transparent"><?php echo e(old('catatan_admin', $order->catatan_admin)); ?></textarea>
                            </div>
                            <button type="submit" class="cta-button bg-yellow-600 mt-2">Update Status</button>
                        </form>
                        <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo e($errors->first('status')); ?></p> 
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <?php $__errorArgs = ['catatan_admin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo e($errors->first('catatan_admin')); ?></p> 
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <?php if($order->catatan_admin): ?> 
                        <div class="mt-4 p-4 bg-gray-50 border border-gray-200 rounded-lg">
                            <p class="font-semibold text-gray-800">Catatan Admin:</p>
                            <p class="text-gray-700"><?php echo e($order->catatan_admin); ?></p>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <h3 class="text-xl font-semibold mb-3 text-gray-800">Detail Produk:</h3>
        <ul class="list-disc pl-5 mb-6 space-y-2">
            <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="flex items-center space-x-3">
                    <?php if($item->produk->gambar): ?>
                        <img src="<?php echo e(asset('storage/produk_gambar/' . $item->produk->gambar)); ?>" alt="<?php echo e($item->produk->name); ?>" class="w-12 h-12 object-cover rounded-md shadow-sm border border-gray-200">
                    <?php else: ?>
                        <div class="w-12 h-12 bg-gray-100 rounded-md flex items-center justify-center text-gray-400 text-xs">No Image</div>
                    <?php endif; ?>
                    <span class="text-gray-700"><?php echo e($item->produk->name); ?> (<?php echo e($item->quantity); ?> x Rp<?php echo e(number_format($item->price, 0, ',', '.')); ?>)</span>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>

        <h3 class="text-xl font-semibold mb-3 text-gray-800">Instruksi Pembayaran:</h3>
        <div class="bg-gray-100 p-4 rounded-lg mb-6 border border-gray-200">
            <p class="mb-2 text-gray-700">Silakan transfer total pembayaran sebesar **Rp<?php echo e(number_format($order->total_price, 0, ',', '.')); ?>** ke rekening berikut:</p>
            <p class="font-bold text-gray-800">Bank ABC</p>
            <p class="font-bold text-gray-800">Nomor Rekening: 1234567890</p>
            <p class="font-bold text-gray-800">Atas Nama: PT. Waiteu Jaya Abadi</p>
            <p class="mt-3 text-sm text-gray-600">Mohon lakukan pembayaran dalam waktu 24 jam. Pesanan akan diproses setelah pembayaran terverifikasi.</p>
        </div>

        <h3 class="text-xl font-semibold mb-3 text-gray-800">Konfirmasi Pembayaran:</h3>
        <p class="mb-4 text-gray-700">Setelah melakukan pembayaran, mohon konfirmasi dengan mengirimkan bukti transfer ke:</p>
        <ul class="list-disc pl-5 mb-6 space-y-1">
            <li class="text-gray-700">Email: <a href="mailto:konfirmasi@waiteu.com" class="text-blue-600 hover:underline">konfirmasi@waiteu.com</a></li>
            <li class="text-gray-700">WhatsApp: <a href="https://wa.me/6285223391294" target="_blank" class="text-blue-600 hover:underline">6285223391294</a></li>
        </ul>

        
        <?php if(($order->status == 'pending' || $order->status == 'menunggu_verifikasi') && !$order->bukti_transfer): ?>
            <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                <p class="font-semibold text-blue-800 mb-2">Unggah Bukti Transfer Anda:</p>
                <?php if(auth()->guard()->check()): ?>
                    <form action="<?php echo e(route('orders.uploadBukti', $order->id)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="file" name="bukti" class="w-full border rounded-md px-3 py-2 mb-2 focus:ring-blue-600 focus:border-blue-600 focus:ring-1" required>
                        <?php $__errorArgs = ['bukti'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo e($errors->first('bukti')); ?></p> 
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <button type="submit" class="cta-button bg-blue-600">Unggah Bukti</button>
                    </form>
                <?php else: ?>
                    <p class="text-sm text-gray-600">Anda harus login untuk mengunggah bukti transfer.</p>
                <?php endif; ?>
            </div>
        <?php elseif($order->bukti_transfer): ?> 
            <div class="mt-6 p-4 bg-green-50 border border-green-200 rounded-lg text-center">
                <p class="font-semibold text-green-800 mb-2">Bukti transfer sudah diunggah.</p>
                <a href="<?php echo e(asset('storage/bukti_transfer/' . $order->bukti_transfer)); ?>" target="_blank" class="text-blue-600 hover:underline">Lihat Bukti Transfer</a>
            </div>
        <?php endif; ?>

        <div class="text-center mt-6">
            <a href="<?php echo e(route('orders.index')); ?>" class="cta-button bg-gray-200 text-gray-800">Lihat Riwayat Pesanan Saya</a>
        </div>
    </div>
    <?php $__env->stopSection(); ?>
    
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\waiteu-app\resources\views/order/show.blade.php ENDPATH**/ ?>