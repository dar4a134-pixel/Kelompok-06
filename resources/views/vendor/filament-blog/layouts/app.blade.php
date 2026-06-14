<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ $setting?->faviconImage }}" type="image/x-icon" />
    {!! \Firefly\FilamentBlog\Facades\SEOMeta::generate() !!}
    {!! $setting?->google_console_code !!}
    {!! $setting?->google_analytic_code !!}
    {!! $setting?->google_adsense_code !!}

    <title>Blog - SIMKM</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    'primary': {
                        DEFAULT: '#f59e0b',
                        50: '#fffbeb',
                        100: '#fef3c7',
                        400: '#fbbf24',
                        500: '#f59e0b',
                        600: '#d97706',
                        700: '#b45309',
                    },
                    'navy': {
                        DEFAULT: '#1a1a2e',
                        light: '#16213e',
                        dark: '#0f3460',
                    }
                }
            }
        }
    }
    </script>
    <style>
    * {
        font-family: "Poppins", sans-serif;
    }

    body {
        background: #0f172a;
        color: #e2e8f0;
    }

    /* Background effect */
    body::before {
        content: '';
        position: fixed;
        inset: 0;
        z-index: 0;
        pointer-events: none;
        background:
            radial-gradient(ellipse 600px 400px at 10% 20%, rgba(245, 158, 11, 0.06) 0%, transparent 70%),
            radial-gradient(ellipse 400px 600px at 90% 80%, rgba(15, 52, 96, 0.3) 0%, transparent 70%),
            radial-gradient(ellipse 300px 300px at 50% 50%, rgba(22, 33, 62, 0.2) 0%, transparent 70%);
    }

    .content-wrapper {
        position: relative;
        z-index: 1;
    }

    /* Navbar */
    nav {
        background: rgba(15, 23, 42, 0.95) !important;
        backdrop-filter: blur(12px);
        border-bottom: 1px solid rgba(245, 158, 11, 0.2);
    }

    /* Cards */
    .blog-card {
        background: linear-gradient(135deg, rgba(26, 26, 46, 0.9), rgba(22, 33, 62, 0.95));
        border: 1px solid rgba(245, 158, 11, 0.15);
        border-radius: 16px;
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .blog-card:hover {
        transform: translateY(-4px);
        border-color: rgba(245, 158, 11, 0.4);
        box-shadow: 0 12px 40px rgba(245, 158, 11, 0.1);
    }

    /* Article content */
    article h1,
    article h2,
    article h3,
    article h4 {
        color: #f1f5f9;
        font-weight: 800;
        padding-bottom: 10px;
    }

    article h1 {
        font-size: 2rem;
        line-height: 1.2;
        padding-bottom: 20px;
    }

    article h2 {
        font-size: 1.5rem;
        line-height: 1.2;
    }

    article h3 {
        font-size: 1.25rem;
    }

    article p {
        line-height: 1.75;
        color: #cbd5e1;
        margin-bottom: 1rem;
    }

    article ul {
        line-height: 1.7;
        padding-bottom: 5px;
        color: #cbd5e1;
    }

    article table {
        margin: 2rem 0;
        border-radius: 10px;
    }

    article table,
    article table td,
    article table th {
        border: 1px solid rgba(245, 158, 11, 0.2);
        padding: 5px 10px;
        color: #cbd5e1;
    }

    /* Badge */
    .badge {
        background: rgba(245, 158, 11, 0.15);
        color: #f59e0b;
        border: 1px solid rgba(245, 158, 11, 0.3);
        border-radius: 20px;
        padding: 2px 12px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    /* Footer */
    footer {
        background: rgba(15, 23, 42, 0.95);
        border-top: 1px solid rgba(245, 158, 11, 0.2);
    }

    /* Input */
    input[type="email"] {
        background: rgba(255, 255, 255, 0.05) !important;
        border: 1px solid rgba(245, 158, 11, 0.3) !important;
        color: white !important;
        border-radius: 12px !important;
    }

    input[type="email"]::placeholder {
        color: rgba(255, 255, 255, 0.4) !important;
    }

    input[type="email"]:focus {
        outline: none;
        border-color: #f59e0b !important;
        box-shadow: 0 0 0 2px rgba(245, 158, 11, 0.2) !important;
    }

    /* Scrollbar */
    ::-webkit-scrollbar {
        width: 6px;
    }

    ::-webkit-scrollbar-track {
        background: #0f172a;
    }

    ::-webkit-scrollbar-thumb {
        background: rgba(245, 158, 11, 0.4);
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: rgba(245, 158, 11, 0.7);
    }

    .line-clamp-2 {
        overflow: hidden;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
    }
    </style>
</head>

<body class="antialiased">
    <div class="content-wrapper min-h-screen">

        <!-- Navbar -->
        <nav class="sticky top-0 z-50 w-full px-6 py-4">
            <div class="container mx-auto flex items-center justify-between">
                <a href="{{ route('filamentblog.post.index') }}" class="flex items-center gap-3">
                    <div
                        class="flex h-9 w-9 items-center justify-center rounded-xl bg-amber-500 font-black text-gray-900 text-lg">
                        S</div>
                    <span class="text-xl font-black tracking-widest text-amber-400">SIMKM</span>
                    <span class="text-slate-400 font-light">| Blog</span>
                </a>
                <div class="flex items-center gap-6">
                    <a href="{{ route('filamentblog.post.index') }}"
                        class="text-slate-300 hover:text-amber-400 transition font-medium text-sm">Beranda</a>
                    <a href="{{ route('filamentblog.post.all') }}"
                        class="text-slate-300 hover:text-amber-400 transition font-medium text-sm">Semua Post</a>
                    <a href="/admin"
                        class="rounded-xl bg-amber-500 px-4 py-2 text-sm font-bold text-gray-900 hover:bg-amber-400 transition">Admin
                        Panel</a>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="mt-16 w-full px-6 py-12">
            <div class="container mx-auto">
                <div class="grid gap-10 sm:grid-cols-3 mb-10">
                    <!-- Brand -->
                    <div class="flex flex-col gap-3">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex h-9 w-9 items-center justify-center rounded-xl bg-amber-500 font-black text-gray-900 text-lg">
                                S</div>
                            <span class="text-xl font-black tracking-widest text-amber-400">SIMKM</span>
                        </div>
                        <p class="text-slate-400 text-sm leading-relaxed">
                            {{ $setting?->description ?? 'Sistem Informasi Manajemen Kursus — Blog resmi informasi dan berita terkini.' }}
                        </p>
                    </div>

                    <!-- Quick Links -->
                    <div class="flex flex-col gap-3">
                        <h4 class="font-bold text-amber-400 text-sm uppercase tracking-widest">Quick Links</h4>
                        @forelse($setting->quick_links ?? [] as $link)
                        <a href="{{ $link['url'] }}"
                            class="text-slate-400 hover:text-amber-400 transition text-sm hover:translate-x-1 inline-block">
                            → {{ $link['label'] }}
                        </a>
                        @empty
                        <p class="text-slate-600 text-sm">Belum ada link</p>
                        @endforelse
                    </div>

                    <!-- Newsletter -->
                    <div class="rounded-2xl border border-amber-500/20 bg-amber-500/5 p-6">
                        <h4 class="font-bold text-white mb-1">Subscribe Newsletter</h4>
                        <p class="text-slate-400 text-sm mb-4">Dapatkan update terbaru langsung di inbox kamu.</p>
                        <form method="post" action="{{ route('filamentblog.post.subscribe') }}">
                            @csrf
                            @error('email')
                            <span class="text-xs text-red-400 mb-2 block">{{ $message }}</span>
                            @enderror
                            <div class="relative">
                                <input type="email" name="email" value="{{ old('email') }}"
                                    placeholder="Masukkan email kamu" class="w-full px-4 py-3 pr-12 text-sm">
                                <button type="submit"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-amber-400 hover:text-amber-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 256 256">
                                        <path fill="currentColor"
                                            d="m220.24 132.24l-72 72a6 6 0 0 1-8.48-8.48L201.51 134H40a6 6 0 0 1 0-12h161.51l-61.75-61.76a6 6 0 0 1 8.48-8.48l72 72a6 6 0 0 1 0 8.48" />
                                    </svg>
                                </button>
                            </div>
                            @if(session('success'))
                            <span class="text-green-400 text-xs mt-2 block">{{ session('success') }}</span>
                            @endif
                        </form>
                    </div>
                </div>

                <div class="border-t border-slate-800 pt-6 text-center">
                    <p class="text-slate-500 text-sm">© {{ date('Y') }} SIMKM —
                        {{ $setting->organization_name ?? 'Sistem Informasi Manajemen Kursus' }}. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>

        <!-- Mobile Bottom Nav -->
        <div class="fixed bottom-0 left-0 z-50 h-16 w-full border-t border-amber-500/20 bg-navy sm:hidden"
            style="background: rgba(15,23,42,0.98);">
            <div class="mx-auto grid h-full max-w-lg grid-cols-2">
                <a href="{{ route('filamentblog.post.index') }}"
                    class="inline-flex flex-col items-center justify-center text-slate-400 hover:text-amber-400 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mb-1 w-5" viewBox="0 0 256 256">
                        <path fill="currentColor"
                            d="m217.47 105.24l-80-75.5a13.94 13.94 0 0 0-18.83 0l-80 75.5A14 14 0 0 0 34 115.55V208a14 14 0 0 0 14 14h48a14 14 0 0 0 14-14v-48a2 2 0 0 1 2-2h32a2 2 0 0 1 2 2v48a14 14 0 0 0 14 14h48a14 14 0 0 0 14-14v-92.45a14 14 0 0 0-4.53-10.31" />
                    </svg>
                    <span class="text-xs">Home</span>
                </a>
                <a href="{{ route('filamentblog.post.all') }}"
                    class="inline-flex flex-col items-center justify-center text-slate-400 hover:text-amber-400 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mb-1 w-5" viewBox="0 0 256 256">
                        <path fill="currentColor"
                            d="M216 40H40a16 16 0 0 0-16 16v160a8 8 0 0 0 11.58 7.15L64 208.94l28.42 14.21a8 8 0 0 0 7.16 0L128 208.94l28.42 14.21a8 8 0 0 0 7.16 0L192 208.94l28.42 14.21A8 8 0 0 0 232 216V56a16 16 0 0 0-16-16" />
                    </svg>
                    <span class="text-xs">Semua Post</span>
                </a>
            </div>
        </div>
    </div>

    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
    function onSubmit(token) {
        document.getElementById("comment-box").submit();
    }
    </script>
</body>

</html>