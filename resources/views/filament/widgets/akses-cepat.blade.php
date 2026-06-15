<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">? Akses cepat</x-slot>

        <div class="grid grid-cols-2 gap-3">
            @php
            $menus = [
                ['icon' => 'heroicon-o-user-plus', 'label' => 'Tambah mahasiswa', 'sub' => 'Data Master', 'href' => '/admin/mahasiswas/create'],
                ['icon' => 'heroicon-o-calendar-days', 'label' => 'Jadwal baru', 'sub' => 'Kursus', 'href' => '/admin/jadwal-kursuses/create'],
                ['icon' => 'heroicon-o-document-text', 'label' => 'Buat post', 'sub' => 'Blog', 'href' => '/admin/posts/create'],
                ['icon' => 'heroicon-o-academic-cap', 'label' => 'Input nilai', 'sub' => 'Akademik', 'href' => '/admin/absen'],
                ['icon' => 'heroicon-o-credit-card', 'label' => 'Cek pembayaran', 'sub' => 'Keuangan', 'href' => '/admin/pembayarans'],
                ['icon' => 'heroicon-o-envelope', 'label' => 'Newsletter', 'sub' => 'Blog', 'href' => '/admin/newsletters'],
            ];
            @endphp

            @foreach($menus as $menu)
            <a href="{{ $menu['href'] }}" 
               class="flex flex-col gap-1 p-3 rounded-xl border border-gray-200 dark:border-gray-700 hover:bg-warning-50 dark:hover:bg-warning-900/20 transition-colors group">
                <x-dynamic-component 
                    :component="$menu['icon']" 
                    class="w-5 h-5 text-warning-500" />
                <span class="text-sm font-medium text-gray-800 dark:text-gray-200 leading-tight">{{ $menu['label'] }}</span>
                <span class="text-xs text-gray-400">{{ $menu['sub'] }}</span>
            </a>
            @endforeach
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
