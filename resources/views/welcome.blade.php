<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMKM - Sistem Informasi Manajemen Kursus Multibahasa</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
    *,
    *::before,
    *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    :root {
        --orange: #F59E0B;
        --orange-light: #FEF3C7;
        --orange-dark: #D97706;
        --navy: #1E3A5F;
        --navy-light: #2D5282;
        --text: #1A202C;
        --muted: #718096;
        --surface: #F7FAFC;
        --white: #FFFFFF;
        --border: rgba(0, 0, 0, 0.08);
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: var(--text);
        background: var(--white);
        overflow-x: hidden;
    }

    /* ── FLAG BACKGROUND ── */
    .flag-bg {
        position: fixed;
        inset: 0;
        z-index: 0;
        pointer-events: none;
        overflow: hidden;
    }

    .flag-stripe {
        position: absolute;
        opacity: 0.045;
        border-radius: 12px;
    }

    /* Japan – merah putih */
    .flag-jp-white {
        background: #fff;
        border: 1px solid #e5e5e5;
        width: 200px;
        height: 133px;
        top: 5%;
        left: -2%;
        transform: rotate(-8deg);
    }

    .flag-jp-red {
        background: #BC002D;
        width: 66px;
        height: 66px;
        border-radius: 50%;
        top: calc(5% + 33px);
        left: calc(-2% + 67px);
        transform: rotate(-8deg);
        opacity: 0.06;
    }

    /* UK – Union Jack rings */
    .flag-uk {
        width: 260px;
        height: 140px;
        top: 15%;
        right: -4%;
        transform: rotate(6deg);
        background:
            linear-gradient(to bottom right, transparent 45%, #C8102E 45%, #C8102E 55%, transparent 55%),
            linear-gradient(to bottom left, transparent 45%, #C8102E 45%, #C8102E 55%, transparent 55%),
            linear-gradient(#012169 0%, #012169 38%, #fff 38%, #fff 42%, #C8102E 42%, #C8102E 58%, #fff 58%, #fff 62%, #012169 62%, #012169 100%);
        opacity: 0.05;
    }

    /* France – tricolor */
    .flag-fr {
        width: 180px;
        height: 120px;
        top: 60%;
        left: 3%;
        transform: rotate(-5deg);
        background: linear-gradient(to right, #002395 33.3%, #fff 33.3%, #fff 66.6%, #ED2939 66.6%);
        opacity: 0.05;
    }

    /* Korea – taeguk approximation */
    .flag-kr {
        width: 170px;
        height: 113px;
        top: 72%;
        right: 2%;
        transform: rotate(4deg);
        background: #fff;
        border: 1px solid #ddd;
        opacity: 0.04;
    }

    .flag-kr-circle {
        position: absolute;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: conic-gradient(#CD2E3A 0deg 180deg, #003478 180deg 360deg);
        top: calc(72% + 32px);
        right: calc(2% + 60px);
        transform: rotate(4deg);
        opacity: 0.055;
    }

    /* Germany – tricolor */
    .flag-de {
        width: 220px;
        height: 133px;
        top: 40%;
        right: 1%;
        transform: rotate(9deg);
        background: linear-gradient(to bottom, #000 33.3%, #DD0000 33.3%, #DD0000 66.6%, #FFCE00 66.6%);
        opacity: 0.05;
    }

    /* Spain */
    .flag-es {
        width: 190px;
        height: 127px;
        bottom: 12%;
        left: -1%;
        transform: rotate(-7deg);
        background: linear-gradient(to bottom, #AA151B 25%, #F1BF00 25%, #F1BF00 75%, #AA151B 75%);
        opacity: 0.045;
    }

    /* Mandarin / China */
    .flag-cn {
        width: 200px;
        height: 133px;
        bottom: 30%;
        right: -2%;
        transform: rotate(5deg);
        background: #DE2910;
        opacity: 0.04;
    }

    /* Indonesia */
    .flag-id-top {
        background: #CE1126;
        width: 240px;
        height: 60px;
        top: -10px;
        left: 38%;
        transform: rotate(-3deg);
    }

    .flag-id-bot {
        background: #fff;
        border: 1px solid #ddd;
        width: 240px;
        height: 60px;
        top: 50px;
        left: 38%;
        transform: rotate(-3deg);
    }

    /* ── NAVBAR ── */
    nav {
        position: relative;
        z-index: 100;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 5%;
        background: rgba(255, 255, 255, 0.92);
        backdrop-filter: blur(12px);
        border-bottom: 1px solid var(--border);
        position: sticky;
        top: 0;
    }

    .nav-brand {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
    }

    .nav-logo-icon {
        width: 36px;
        height: 36px;
        background: var(--orange);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .nav-logo-icon svg {
        width: 20px;
        height: 20px;
        fill: white;
    }

    .nav-brand-text {
        font-weight: 700;
        font-size: 1rem;
        color: var(--navy);
        line-height: 1.2;
    }

    .nav-brand-text span {
        color: var(--orange);
        display: block;
        font-size: 0.7rem;
        font-weight: 500;
        letter-spacing: 0.05em;
    }

    .nav-links {
        display: flex;
        align-items: center;
        gap: 2rem;
        list-style: none;
    }

    .nav-links a {
        text-decoration: none;
        color: var(--muted);
        font-size: 0.9rem;
        font-weight: 500;
        transition: color .2s;
    }

    .nav-links a:hover {
        color: var(--navy);
    }

    .nav-cta {
        display: flex;
        gap: 0.75rem;
    }

    .btn {
        padding: 0.55rem 1.25rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.875rem;
        cursor: pointer;
        border: none;
        text-decoration: none;
        transition: all .2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-ghost {
        background: transparent;
        border: 1.5px solid var(--border);
        color: var(--navy);
    }

    .btn-ghost:hover {
        border-color: var(--navy);
    }

    .btn-primary {
        background: var(--orange);
        color: white;
    }

    .btn-primary:hover {
        background: var(--orange-dark);
        transform: translateY(-1px);
    }

    /* ── HERO ── */
    .hero {
        position: relative;
        z-index: 1;
        min-height: 90vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 5rem 5% 4rem;
    }

    .hero-inner {
        max-width: 760px;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--orange-light);
        color: var(--orange-dark);
        font-size: 0.8rem;
        font-weight: 600;
        padding: 0.35rem 1rem;
        border-radius: 99px;
        margin-bottom: 1.5rem;
        border: 1px solid rgba(245, 158, 11, 0.3);
    }

    .hero-badge-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: var(--orange);
    }

    .hero h1 {
        font-size: clamp(2rem, 5vw, 3.2rem);
        font-weight: 700;
        color: var(--navy);
        line-height: 1.2;
        margin-bottom: 1.25rem;
    }

    .hero h1 span {
        color: var(--orange);
    }

    .hero p {
        font-size: 1.05rem;
        color: var(--muted);
        max-width: 580px;
        margin: 0 auto 2.5rem;
        line-height: 1.75;
    }

    .hero-actions {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-lg {
        padding: 0.8rem 1.75rem;
        font-size: 0.95rem;
    }

    /* ── LANGUAGE FLAGS ROW ── */
    .lang-row {
        position: relative;
        z-index: 1;
        padding: 2.5rem 5%;
        text-align: center;
        background: var(--surface);
        border-top: 1px solid var(--border);
        border-bottom: 1px solid var(--border);
    }

    .lang-row p {
        font-size: 0.8rem;
        color: var(--muted);
        margin-bottom: 1.25rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        font-weight: 600;
    }

    .lang-pills {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 0.75rem;
    }

    .lang-pill {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 0.5rem 1.1rem;
        background: white;
        border: 1.5px solid var(--border);
        border-radius: 99px;
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--navy);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
    }

    .lang-flag {
        font-size: 1.3rem;
    }

    /* ── FEATURES ── */
    .section {
        position: relative;
        z-index: 1;
        padding: 5rem 5%;
    }

    .section-header {
        text-align: center;
        margin-bottom: 3.5rem;
    }

    .section-eyebrow {
        font-size: 0.8rem;
        font-weight: 700;
        color: var(--orange);
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin-bottom: 0.75rem;
    }

    .section-header h2 {
        font-size: clamp(1.5rem, 3vw, 2.2rem);
        font-weight: 700;
        color: var(--navy);
        margin-bottom: 0.75rem;
    }

    .section-header p {
        color: var(--muted);
        font-size: 1rem;
        max-width: 520px;
        margin: 0 auto;
        line-height: 1.7;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 1.25rem;
        max-width: 1100px;
        margin: 0 auto;
    }

    .feature-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 1.75rem;
        transition: transform .2s, box-shadow .2s;
    }

    .feature-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.07);
    }

    .feature-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: var(--orange-light);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        margin-bottom: 1.1rem;
    }

    .feature-card h3 {
        font-size: 1rem;
        font-weight: 700;
        color: var(--navy);
        margin-bottom: 0.5rem;
    }

    .feature-card p {
        font-size: 0.875rem;
        color: var(--muted);
        line-height: 1.7;
    }

    /* ── STATS ── */
    .stats-section {
        position: relative;
        z-index: 1;
        background: var(--navy);
        padding: 4rem 5%;
        text-align: center;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 2rem;
        max-width: 800px;
        margin: 0 auto;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--orange);
        display: block;
    }

    .stat-label {
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.65);
        margin-top: 0.25rem;
    }

    /* ── CTA FOOTER ── */
    .cta-section {
        position: relative;
        z-index: 1;
        padding: 5rem 5%;
        text-align: center;
        background: var(--surface);
    }

    .cta-box {
        background: white;
        border: 1px solid var(--border);
        border-radius: 24px;
        padding: 3rem 2rem;
        max-width: 620px;
        margin: 0 auto;
    }

    .cta-box h2 {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--navy);
        margin-bottom: 0.75rem;
    }

    .cta-box p {
        color: var(--muted);
        margin-bottom: 1.75rem;
        font-size: 0.95rem;
        line-height: 1.7;
    }

    .input-row {
        display: flex;
        gap: 0.75rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .input-row input {
        padding: 0.65rem 1rem;
        border: 1.5px solid var(--border);
        border-radius: 8px;
        font-size: 0.875rem;
        font-family: inherit;
        color: var(--text);
        min-width: 220px;
        outline: none;
        transition: border-color .2s;
    }

    .input-row input:focus {
        border-color: var(--orange);
    }

    /* ── FOOTER ── */
    footer {
        position: relative;
        z-index: 1;
        text-align: center;
        padding: 1.5rem;
        font-size: 0.8rem;
        color: var(--muted);
        border-top: 1px solid var(--border);
    }
    </style>
</head>

<body>

    <div class="flag-bg" aria-hidden="true">
        <div class="flag-stripe flag-id-top"></div>
        <div class="flag-stripe flag-id-bot"></div>
        <div class="flag-stripe flag-jp-white"></div>
        <div class="flag-stripe flag-jp-red"></div>
        <div class="flag-stripe flag-uk"></div>
        <div class="flag-stripe flag-fr"></div>
        <div class="flag-stripe flag-de"></div>
        <div class="flag-stripe flag-es"></div>
        <div class="flag-stripe flag-kr"></div>
        <div class="flag-stripe flag-kr-circle"></div>
        <div class="flag-stripe flag-cn"></div>
    </div>

    <nav>
        <a href="#" class="nav-brand">
            <div class="nav-logo-icon">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9V8h2v8zm4 0h-2V8h2v8z" />
                </svg>
            </div>
            <div class="nav-brand-text">
                SIMKM
                <span>Kursus Multibahasa</span>
            </div>
        </a>
        <ul class="nav-links">
            <li><a href="#">Beranda</a></li>
            <li><a href="#">Kursus</a></li>
            <li><a href="#">Instruktur</a></li>
            <li><a href="#">Tentang</a></li>
        </ul>
        <div class="nav-cta">
            <a href="/admin" class="btn btn-primary">Panel Admin</a>
        </div>
    </nav>

    <section class="hero">
        <div class="hero-inner">
            <div class="hero-badge">
                <div class="hero-badge-dot"></div>
                Platform Kursus Bahasa Terpadu
            </div>
            <h1>
                Sistem Informasi<br>
                <span>Manajemen Kursus</span><br>
                Multibahasa
            </h1>
            <p>
                Kelola program kursus bahasa asing secara efisien — dari pendaftaran peserta,
                jadwal kelas, hingga laporan kemajuan belajar, semua dalam satu platform terintegrasi.
            </p>
            <div class="hero-actions">
                <a href="/admin" class="btn btn-primary btn-lg">
                    🚀 Mulai Sekarang
                </a>
                <a href="#fitur" class="btn btn-ghost btn-lg">
                    Lihat Fitur
                </a>
            </div>
        </div>
    </section>

    <div class="lang-row">
        <p>Bahasa yang tersedia</p>
        <div class="lang-pills">
            <div class="lang-pill"><span class="lang-flag">🇬🇧</span> Bahasa Inggris</div>
            <div class="lang-pill"><span class="lang-flag">🇯🇵</span> Bahasa Jepang</div>
            <div class="lang-pill"><span class="lang-flag">🇰🇷</span> Bahasa Korea</div>
            <div class="lang-pill"><span class="lang-flag">🇫🇷</span> Bahasa Prancis</div>
            <div class="lang-pill"><span class="lang-flag">🇩🇪</span> Bahasa Jerman</div>
            <div class="lang-pill"><span class="lang-flag">🇪🇸</span> Bahasa Spanyol</div>
            <div class="lang-pill"><span class="lang-flag">🇨🇳</span> Bahasa Mandarin</div>
            <div class="lang-pill"><span class="lang-flag">🇸🇦</span> Bahasa Arab</div>
        </div>
    </div>

    <section class="section" id="fitur">
        <div class="section-header">
            <p class="section-eyebrow">Fitur Unggulan</p>
            <h2>Semua yang Kamu Butuhkan</h2>
            <p>Dirancang untuk lembaga kursus bahasa modern dengan kebutuhan manajemen yang kompleks.</p>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">📚</div>
                <h3>Manajemen Kursus</h3>
                <p>Buat dan kelola program kursus berbagai bahasa dengan kurikulum yang terstruktur dan mudah diupdate.
                </p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">👥</div>
                <h3>Data Peserta</h3>
                <p>Kelola data pendaftaran, profil peserta, dan progres belajar setiap siswa secara terpusat.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📅</div>
                <h3>Jadwal Kelas</h3>
                <p>Atur jadwal kelas, ruangan, dan instruktur tanpa bentrok dengan sistem penjadwalan otomatis.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🎓</div>
                <h3>Manajemen Instruktur</h3>
                <p>Kelola data instruktur, spesialisasi bahasa, jam mengajar, dan evaluasi kinerja.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">💳</div>
                <h3>Pembayaran</h3>
                <p>Lacak pembayaran kursus, buat tagihan otomatis, dan pantau laporan keuangan secara real-time.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📊</div>
                <h3>Laporan & Analitik</h3>
                <p>Dapatkan insight mendalam tentang performa kursus dan perkembangan peserta lewat dashboard analitik.
                </p>
            </div>
        </div>
    </section>

    <div class="stats-section">
        <div class="stats-grid">
            <div class="stat-item">
                <span class="stat-number">8+</span>
                <p class="stat-label">Bahasa Tersedia</p>
            </div>
            <div class="stat-item">
                <span class="stat-number">3</span>
                <p class="stat-label">Role Pengguna</p>
            </div>
            <div class="stat-item">
                <span class="stat-number">100%</span>
                <p class="stat-label">Berbasis Web</p>
            </div>
            <div class="stat-item">
                <span class="stat-number">Laravel</span>
                <p class="stat-label">Teknologi Backend</p>
            </div>
        </div>
    </div>

    <section class="cta-section">
        <div class="cta-box">
            <h2>Daftar & Mulai Belajar</h2>
            <p>Bergabunglah dengan platform manajemen kursus multibahasa kami dan kelola program pembelajaran bahasa
                asing dengan lebih efisien.</p>
            <div class="input-row">
                <input type="email" placeholder="Masukkan email kamu...">
                <a href="/register" class="btn btn-primary">Daftar Gratis →</a>
            </div>
        </div>
    </section>

    <footer>
        © 2024 SIMKM — Sistem Informasi Manajemen Kursus Multibahasa. All rights reserved.
    </footer>

</body>

</html>