{{-- resources/views/components/application-logo.blade.php --}}

{{-- Menggunakan gambar logo kustom Anda --}}
{{-- Pastikan gambar 'logowaiteu.png' berada di folder 'public/images/' --}}
<img src="{{ asset('images/logowaiteu.png') }}" alt="Waiteu Logo" {{ $attributes->merge(['style' => 'width: auto; height: 100%;']) }}>

{{-- Komponen ini akan dipanggil di layouts/navigation.blade.php dan layouts/guest.blade.php --}}
