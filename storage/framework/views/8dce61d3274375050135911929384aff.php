<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Waiteu Collagen Drink')); ?></title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

        
        <style>
            body {
                background-color: #FDF8F5 !important; /* Krem sangat muda / Nude Background */
                color: #4A4A4A !important;
            }
            .guest-container {
                display: flex;
                min-height: 100vh;
            }
            .guest-image-section {
                flex: 0.7; /* Mengurangi ukuran section gambar */
                background-color: #E6D2C4; /* Warna nude kecoklatan untuk section gambar */
                position: relative;
                overflow: hidden;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 1rem;
                background-size: contain;
                background-position: center;
                background-repeat: no-repeat;
                min-height: 400px;
                max-height: 100vh;
            }
            .guest-image-section.image-1 { background-image: url('<?php echo e(asset('images/varian_putihH.jpg')); ?>'); }
            .guest-image-section.image-2 { background-image: url('<?php echo e(asset('images/latar1.jpg')); ?>'); }

            /* Overlay untuk membuat teks lebih jelas di atas gambar */
            .guest-image-section::after {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.2); /* Semi-transparan gelap */
                z-index: 1; /* Di atas gambar, di bawah teks */
            }

            .guest-image-slogan {
                position: absolute;
                z-index: 2; /* Di atas overlay */
                color: white; /* Warna teks putih */
                font-size: 2.25rem; /* Ukuran teks besar */
                font-weight: bold; /* Teks tebal */
                text-align: center;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6); /* Bayangan teks agar lebih terbaca */
                padding: 1rem;
            }


            .guest-form-section {
                flex: 1.3; /* Memberikan lebih banyak ruang pada section form */
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 2rem;
                background-color: #FDF8F5; /* Background terang untuk form */
            }
            .guest-card {
                background-color: #FFFFFF !important;
                box-shadow: 0 8px 25px rgba(0,0,0,0.1); /* Bayangan yang lebih menonjol */
                border-radius: 12px !important;
                padding: 2.5rem;
                width: 100%;
                max-width: 420px;
                border: 1px solid #EDEDED;
            }

            /* Overrides untuk elemen Breeze */
            .text-gray-900 { color: #2A2A2A !important; }
            .text-gray-600 { color: #777777 !important; }
            .text-gray-500 { color: #A0A0A0 !important; }
            .text-gray-400 { color: #B0B0B0 !important; }
            .text-gray-800 { color: #4A4A4A !important; }

            /* Tombol Primary (Login/Register) */
            .inline-flex.items.center.px-4.py-2.bg-gray-800 {
                background-color: #C7A2A2 !important;
                border-radius: 8px !important;
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                transition: background-color 0.3s ease, transform 0.2s ease;
            }
            .inline-flex.items.center.px-4.py-2.bg-gray-800:hover {
                background-color: #A68A8A !important;
                transform: translateY(-1px);
            }
            .inline-flex.items.center.px-4.py-2.bg-gray-800:active {
                transform: translateY(0);
            }

            /* Input fields */
            .border-gray-300 { border-color: #E0E0E0 !important; }
            .focus\:border-indigo-500:focus { border-color: #C7A2A2 !important; }
            .focus\:ring-indigo-500:focus { box-shadow: 0 0 0 3px rgba(199, 162, 162, 0.25) !important; }

            /* Media queries untuk tampilan mobile */
            @media (max-width: 768px) {
                .guest-container {
                    flex-direction: column;
                }
                .guest-image-section {
                    display: none;
                }
                .guest-form-section {
                    flex: none;
                    width: 100%;
                }
                .guest-card {
                    max-width: 90%;
                }
            }
        </style>
    </head>
    <body>
        <div class="guest-container">
            <div class="guest-image-section image-1">
                
                <div class="guest-image-slogan">
                    Mungkin, Inilah Rahasia Kulit Cerahmu.
                </div>
            </div>
            <div class="guest-form-section">
                <div class="guest-card">
                    <div class="flex justify-center mb-6">
                        <a href="/">
                            
                            <?php if (isset($component)) { $__componentOriginal8892e718f3d0d7a916180885c6f012e7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8892e718f3d0d7a916180885c6f012e7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.application-logo','data' => ['class' => 'w-20 h-20 fill-current text-gray-500']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('application-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-20 h-20 fill-current text-gray-500']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8892e718f3d0d7a916180885c6f012e7)): ?>
<?php $attributes = $__attributesOriginal8892e718f3d0d7a916180885c6f012e7; ?>
<?php unset($__attributesOriginal8892e718f3d0d7a916180885c6f012e7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8892e718f3d0d7a916180885c6f012e7)): ?>
<?php $component = $__componentOriginal8892e718f3d0d7a916180885c6f012e7; ?>
<?php unset($__componentOriginal8892e718f3d0d7a916180885c6f012e7); ?>
<?php endif; ?>
                        </a>
                    </div>
                    <?php echo e($slot); ?>

                </div>
            </div>
        </div>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\waiteu-app\resources\views/layouts/guest.blade.php ENDPATH**/ ?>