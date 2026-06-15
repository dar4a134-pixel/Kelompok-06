<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center justify-between">
                <span>Aktivitas terbaru</span>
                <a href="#" class="text-sm text-warning-500 hover:underline">Semua</a>
            </div>
        </x-slot>

        <div class="space-y-4">
            @php
            $aktivitas = [
                ['warna' => 'bg-warning-400', 'judul' => 'Budi Santoso mendaftar', 'sub' => 'Bahasa Inggris - Batch Juni', 'waktu' => '2m'],
                ['warna' => 'bg-success-400', 'judul' => 'Jadwal Bahasa Jepang ditambahkan', 'sub' => 'Selasa 09.00 - Dewi', 'waktu' => '18m'],
                ['warna' => 'bg-primary-400', 'judul' => 'Post blog dipublikasikan', 'sub' => 'Tips belajar bahasa asing', 'waktu' => '1j'],
                ['warna' => 'bg-info-400', 'judul' => 'Nilai akhir diinput', 'sub' => 'Batch Bahasa Korea - 24 mahasiswa', 'waktu' => '3j'],
                ['warna' => 'bg-danger-400', 'judul' => 'Pembayaran dikonfirmasi', 'sub' => 'Sari W - Rp 1.500.000', 'waktu' => '5j'],
            ];
            @endphp

            @foreach($aktivitas as $item)
            <div class="flex items-start gap-3">
                <div class="mt-1.5 w-2 h-2 rounded-full flex-shrink-0 {{ $item['warna'] }}"></div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $item['judul'] }}</p>
                    <p class="text-xs text-gray-500">{{ $item['sub'] }}</p>
                </div>
                <span class="text-xs text-gray-400 flex-shrink-0">{{ $item['waktu'] }}</span>
            </div>
            @endforeach
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
