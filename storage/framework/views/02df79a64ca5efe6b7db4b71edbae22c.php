

<?php $__env->startSection('title', 'Riwayat Pesanan'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-4 text-gray-800">Riwayat Pesanan Anda</h2>

    <?php if(session('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    
    <?php if(auth()->guard()->check()): ?>
        <?php if(Auth::user()->role === 'admin'): ?>
            <div class="mb-4 text-right">
                
                <a href="<?php echo e(route('orders.export')); ?>" class="cta-button bg-green-600">Ekspor Histori Penjualan</a>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <?php if($orders->isEmpty()): ?>
        <p class="text-center text-gray-500">Anda belum memiliki pesanan.</p>
    <?php else: ?>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border-collapse border border-gray-300">
                <thead>
                    <tr>
                        <th class="border px-4 py-2 text-left bg-gray-100 text-gray-800">ID Pesanan</th>
                        <th class="border px-4 py-2 text-left bg-gray-100 text-gray-800">Tanggal</th>
                        <th class="border px-4 py-2 text-left bg-gray-100 text-gray-800">Produk</th>
                        <th class="border px-4 py-2 text-right bg-gray-100 text-gray-800">Total Harga</th>
                        <th class="border px-4 py-2 text-left bg-gray-100 text-gray-800">Status</th>
                        <th class="border px-4 py-2 text-left bg-gray-100 text-gray-800">Bukti Transfer</th>
                        <th class="border px-4 py-2 text-left bg-gray-100 text-gray-800">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="border px-4 py-2"><?php echo e($order->id); ?></td>
                            <td class="border px-4 py-2"><?php echo e($order->created_at->format('d M Y')); ?></td>
                            <td class="border px-4 py-2">
                                <ul class="list-disc pl-5">
                                    <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($item->produk->name); ?> (<?php echo e($item->quantity); ?> x Rp<?php echo e(number_format($item->price, 0, ',', '.')); ?>)</li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </td>
                            <td class="border px-4 py-2 text-right">Rp<?php echo e(number_format($order->total_price, 0, ',', '.')); ?></td>
                            <td class="border px-4 py-2">
                                <?php
                                    $statusClass = '';
                                    switch($order->status) {
                                        case 'pending': $statusClass = 'bg-gray-200 text-gray-800'; break;
                                        case 'menunggu_verifikasi': $statusClass = 'bg-yellow-200 text-yellow-800'; break;
                                        case 'terbayar': $statusClass = 'bg-green-200 text-green-800'; break;
                                        case 'diproses': $statusClass = 'bg-blue-200 text-blue-800'; break;
                                        case 'dikirim': $statusClass = 'bg-purple-200 text-purple-800'; break;
                                        case 'selesai': $statusClass = 'bg-green-200 text-green-800'; break;
                                        case 'dibatalkan': $statusClass = 'bg-red-200 text-red-800'; break;
                                        default: $statusClass = 'bg-gray-200 text-gray-800'; break;
                                    }
                                ?>
                                <span class="px-2 py-1 rounded text-xs font-semibold <?php echo e($statusClass); ?>">
                                    <?php echo e(ucfirst(str_replace('_', ' ', $order->status))); ?>

                                </span>
                            </td>
                            <td class="border px-4 py-2 text-center">
                                <?php if($order->bukti_transfer): ?>
                                    <a href="<?php echo e(asset('storage/bukti_transfer/' . $order->bukti_transfer)); ?>" target="_blank" class="text-blue-600 hover:underline">Lihat</a>
                                <?php else: ?>
                                    <span class="text-gray-400">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="border px-4 py-2">
                                <a href="<?php echo e(route('orders.show', $order->id)); ?>" class="text-blue-600 hover:underline mr-2">Detail</a>
                                <?php if(!$order->trashed()): ?>
                                    <form action="<?php echo e(route('orders.archive', $order->id)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin mengarsipkan pesanan ini?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="text-red-600 hover:underline text-sm">Arsipkan</button>
                                    </form>
                                <?php else: ?>
                                    <span class="text-gray-500 text-sm ml-2">Diarsipkan</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\waiteu-app\resources\views/order/index.blade.php ENDPATH**/ ?>