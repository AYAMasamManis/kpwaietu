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

        <!-- Styles (Ini akan memuat Tailwind CSS dari resources/css/app.css) -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

        
        <style>
            body { background-color: #FDF8F5 !important; color: #333333 !important; }
            header, footer { background-color: #B69797 !important; color: white !important; padding: 1rem; text-align: center; }
            .cta-button {
                background: #C7A2A2 !important;
                color: white !important;
                padding: 8px 16px;
                border: none;
                border-radius: 8px;
                text-decoration: none;
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                transition: background-color 0.3s ease, transform 0.2s ease;
                font-weight: 600;
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }
            .cta-button:hover {
                background: #A68A8A !important;
                transform: translateY(-1px);
            }
            .cta-button:active {
                transform: translateY(0);
            }

            .bg-blue-600 { background-color: #C7A2A2 !important; }
            .hover\:bg-blue-700:hover { background-color: #A68A8A !important; }
            .bg-green-600 { background-color: #8DAB8F !important; }
            .hover\:bg-green-700:hover { background-color: #79977B !important; }
            .bg-purple-600 { background-color: #A2A2C7 !important; }
            .hover\:bg-purple-700:hover { background-color: #8A8AA6 !important; }
            .bg-red-600 { background-color: #E77C7C !important; }
            .hover\:bg-red-700:hover { background-color: #CC6B6B !important; }
            .bg-yellow-500 { background-color: #D2BB73 !important; }
            .hover\:bg-yellow-600:hover { background-color: #BDA662 !important; }
            .bg-gray-200 { background-color: #EFEFEF !important; }
            .hover\:bg-gray-300:hover { background-color: #E0E0E0 !important; }

            /* Menguatkan warna teks global agar lebih terang di atas background */
            /* Ini menimpa warna teks Tailwind default */
            .text-gray-900, .text-gray-800, .text-gray-700, .text-gray-600, .text-gray-500, .text-gray-400 {
                color: #4A4A4A !important; /* Defaultkan ke abu-abu gelap yang lebih terbaca untuk teks umum */
            }

            /* Khusus untuk teks di header form partials di halaman profil */
            /* Ini adalah bagian yang paling penting untuk masalah Anda */
            .p-4.sm\:p-8.bg-white.shadow.sm\:rounded-lg header h2,
            .p-4.sm\:p-8.bg-white.shadow.sm\:rounded-lg header p {
                color: white !important; /* Paksa teks menjadi putih */
            }

            /* Menimpa gaya dark mode Breeze secara eksplisit untuk memastikan tema terang */
            .dark\:bg-gray-900 { background-color: #FDF8F5 !important; }
            .dark\:text-gray-100 { color: #4A4A4A !important; }
            .dark\:bg-gray-800 { background-color: #FFFFFF !important; }
            .dark\:text-gray-400 { color: #777777 !important; }
            .dark\:border-gray-700 { border-color: #DDDDDD !important; }
            .bg-white { background-color: #FFFFFF !important; }
            .shadow { box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.06); }

            /* Warna untuk teks navigasi */
            .main-navbar .nav-link { color: #8D6E6E !important; } /* Warna link navigasi yang lebih kalem */
            .main-navbar .nav-link.active { border-bottom: 2px solid #C7A2A2 !important; color: #C7A2A2 !important; }
            .main-navbar .nav-link:hover { color: #A68A8A !important; text-decoration: underline; }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <!-- Page Heading -->
            <?php if(isset($header)): ?>
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <?php echo e($header); ?>

                    </div>
                </header>
            <?php endif; ?>

            <!-- Page Content -->
            <main class="py-6 px-4 sm:px-6 lg:px-8">
                <?php echo $__env->yieldContent('content'); ?>
            </main>
        </div>
        <footer>
            <p>&copy; <?php echo e(date('Y')); ?> Waiteu Collagen Drink. All rights reserved.</p>
        </footer>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\waiteu-app\resources\views/layouts/app.blade.php ENDPATH**/ ?>