@extends('layouts.app') {{-- Menggunakan layout utama Anda --}}

@section('title', 'Tentang Kami')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg border border-gray-200"> {{-- Box konten utama --}}
    <h2 class="text-3xl font-semibold mb-6 text-gray-800 text-center">Tentang Waiteu Collagen Drink & Laili Brand</h2> {{-- Judul diubah sedikit --}}

    <div class="prose max-w-none text-gray-700 leading-relaxed"> {{-- Menggunakan prose untuk teks, jika Anda menginstal @tailwindcss/typography --}}

        {{-- BAGIAN TENTANG WAITEU COLLAGEN DRINK (DIPINDAHKAN KE ATAS) --}}
        <h3 class="text-2xl font-semibold mb-4 text-gray-800 border-b pb-2">Tentang Waiteu Collagen Drink</h3>
        {{-- Gambar produk utama untuk bagian ini --}}
        <img src="{{ asset('images/latar2.jpg') }}" alt="Waiteu Collagen Drink" class="w-full h-auto rounded-lg mb-6 shadow-md border border-gray-200" style="max-width: 400px; display: block; margin-left: auto; margin-right: auto;" /> {{-- <<< GAMBAR DIGANTI KE latar2.jpg --}}

        <p class="mb-4">
            Waiteu Collagen Drink adalah minuman kolagen yang diformulasikan langsung dari Korea, mengandung bahan utama L-Glutathione Grade A dan Peptide Fish Collagen bersertifikat halal dari MUI. Selain itu, produk ini juga mengandung ganggang merah, ganggang laut, vitamin C, vitamin B kompleks, dan glutation, yang semuanya diproses menggunakan teknologi Korea modern.
        </p>

        <h4 class="text-xl font-semibold mb-3 text-gray-800">Manfaat Utama</h4>
        <ul class="list-disc pl-8 mb-6 space-y-2">
            <li>Membantu mengurangi jerawat dan memuluskan bekas jerawat.</li>
            <li>Menyamarkan keriput dan mencegah penuaan dini.</li>
            <li>Mencerahkan dan memutihkan kulit wajah serta tubuh.</li>
            <li>Mengencangkan kulit dan menebalkan rambut.</li>
            <li>Hasil dapat terlihat dalam hitungan minggu jika digunakan secara rutin.</li>
        </ul>
        <p class="mb-6">
            Waiteu Collagen Drink hadir dengan harga yang lebih terjangkau dibanding produk sejenis di pasaran, sehingga dapat diakses oleh lebih banyak orang yang ingin merawat kulit dengan kolagen berkualitas tinggi.
        </p>

        <h4 class="text-xl font-semibold mb-3 text-gray-800">Varian Produk</h4>
        <ul class="list-disc pl-8 mb-6 space-y-2">
            <li class="flex items-center mb-2">
                <img src="{{ asset('images/latar1delima.jpg') }}" alt="Waiteu Delima" class="w-16 h-16 object-contain rounded-full border border-gray-200 mr-4 shadow-sm" onerror="this.onerror=null;this.src='https://placehold.co/64x64/FDF8F5/C7A2A2?text=Delima';" />
                <div>
                    <strong>Waiteu Delima:</strong> Varian ini mengandung ekstrak buah delima yang dikenal kaya antioksidan dan vitamin. Delima membantu menjaga kesehatan kulit, memperbaiki sel kulit, dan memberikan efek mencerahkan secara alami.
                </div>
            </li>
            <li class="flex items-center">
                <img src="{{ asset('images/latarwalet.jpg') }}" alt="Waiteu Sarang Walet" class="w-16 h-16 object-contain rounded-full border border-gray-200 mr-4 shadow-sm" onerror="this.onerror=null;this.src='https://placehold.co/64x64/FDF8F5/8DAB8F?text=Walet';" />
                <div>
                    <strong>Waiteu Sarang Walet:</strong> Varian ini mengandung ekstrak sarang burung walet yang terkenal sebagai bahan alami anti-aging. Sarang walet dipercaya dapat membantu regenerasi sel kulit, meningkatkan elastisitas, dan memberikan kelembapan ekstra pada kulit.
                </div>
            </li>
        </ul>
        <p class="mb-6">
            Kedua varian ini tetap mengusung manfaat utama kolagen, namun dengan tambahan bahan aktif spesifik untuk hasil yang lebih optimal sesuai kebutuhan kulit.
        </p>

        <hr class="my-8 border-gray-300"> {{-- Pembatas visual setelah bagian Waiteu --}}

        {{-- BAGIAN DETAIL PERUSAHAAN: LAILI BRAND (DIPINDAHKAN KE BAWAH) --}}
        <h3 class="text-2xl font-semibold mb-4 text-gray-800 border-b pb-2">Detail Perusahaan: Laili Brand</h3>
        <p class="mb-4">
            Laili Brand adalah anak perusahaan dari PT Karya Laili Mendunia yang berfokus pada produk kesehatan dan kecantikan. Perusahaan ini berbasis di Surabaya Barat dan memiliki visi untuk memberdayakan perempuan Indonesia, khususnya ibu rumah tangga, agar dapat mandiri secara ekonomi.
        </p>

        <h4 class="text-xl font-semibold mb-3 text-gray-800">Visi Perusahaan</h4>
        <p class="mb-4">
            Visi utama Laili Brand adalah membantu satu juta ibu rumah tangga di Indonesia memiliki karier yang membanggakan dan mendapatkan tujuh sumber penghasilan dari rumah. Dengan sistem kemitraan bisnis, Laili Brand telah membantu lebih dari 20.000 ibu rumah tangga meningkatkan kondisi finansial mereka.
        </p>

        <h4 class="text-xl font-semibold mb-3 text-gray-800">Misi Perusahaan</h4>
        <ul class="list-disc pl-8 mb-6 space-y-2">
            <li>Menghadirkan produk kesehatan dan kecantikan berkualitas tinggi dengan harga terjangkau.</li>
            <li>Memberdayakan perempuan Indonesia untuk mandiri secara ekonomi melalui peluang bisnis dari rumah.</li>
            <li>Membangun lingkungan kerja yang suportif, inovatif, dan islami, serta menanamkan nilai-nilai produktivitas, pembelajaran tanpa henti, dan rasa syukur dalam setiap aktivitas perusahaan.</li>
        </ul>

        <p class="text-center mt-8 text-gray-600">
            Terima kasih telah memilih Waiteu Collagen Drink sebagai bagian dari rutinitas kecantikan Anda.
        </p>

        <div class="text-center mt-6">
            <a href="{{ route('produk.index') }}" class="cta-button bg-blue-600">Lihat Produk Kami</a>
        </div>
    </div>
</div>
@endsection
