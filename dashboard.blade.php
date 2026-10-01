@extends('sailor.home.app-master')

@push('title')
    <title>SMART PELAUT JAKARTA</title>
@endpush

@push('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<style>
    /*
    |--------------------------------------------------------------------------
    | SMART PELAUT DASHBOARD — tema disamakan dengan JAK OCEAN
    |--------------------------------------------------------------------------
    | Seluruh class diberi prefix "sp-" agar tidak bertabrakan dengan
    | CSS dari layout utama atau halaman lainnya.
    */

    :root {
        --sp-primary: #005b96;
        --sp-primary-dark: #003f6b;
        --sp-primary-light: #e9f5fb;
        --sp-secondary: #00a8c6;
        --sp-accent: #65d8e6;

        --sp-white: #ffffff;
        --sp-light: #f5f9fc;
        --sp-border: #dceaf1;

        --sp-text: #17384a;
        --sp-text-muted: #526d7b;

        --sp-shadow-sm: 0 10px 30px rgba(0, 63, 107, 0.08);
        --sp-shadow-md: 0 20px 50px rgba(0, 63, 107, 0.14);
    }

    .sp-dash {
        width: 100%;
        overflow-x: hidden;
        color: var(--sp-text);
    }

    .sp-dash,
    .sp-dash * {
        box-sizing: border-box;
    }

    /* Sedikit saja jarak antara navbar/hero dan konten di bawahnya */
    .sp-dash > .container.py-5 {
        position: relative;
        z-index: 3;
        padding-top: 0 !important;
        margin-top: 0;
    }

    /* ---- Baris kartu menu, posisi menumpuk di bawah hero (gaya PPID) ---- */
    .sp-menu-grid-wrap {
        position: relative;
        z-index: 4;
        margin-top: -120px;
        margin-bottom: 8px;
        padding: 0 20px;
    }

    .sp-menu-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
    }

    @media (max-width: 767.98px) {
        .sp-menu-grid-wrap {
            margin-top: -70px;
        }
    }

    /* ---- Efek scroll reveal (sederhana & modern) ---- */
    .sp-reveal {
        opacity: 0;
        transform: translateY(26px);
        transition: opacity 0.7s cubic-bezier(0.22, 1, 0.36, 1),
                    transform 0.7s cubic-bezier(0.22, 1, 0.36, 1);
        will-change: opacity, transform;
    }

    .sp-reveal.sp-in {
        opacity: 1;
        transform: translateY(0);
    }

    @media (prefers-reduced-motion: reduce) {
        .sp-reveal {
            opacity: 1;
            transform: none;
            transition: none;
        }
    }

    /* ---- Hero section dengan background image (full-width) ---- */
    .sp-hero {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 400px;
        width: 100vw;
        margin-left: calc(-50vw + 50%);
        margin-right: calc(-50vw + 50%);
        margin-bottom: 0;
        padding: 60px 20px;
        overflow: hidden;
        background-color: var(--sp-primary-dark);
        background-image:
            linear-gradient(
                135deg,
                rgba(0, 45, 78, 0.55) 0%,
                rgba(0, 70, 116, 0.42) 45%,
                rgba(0, 91, 150, 0.30) 100%
            ),
            url('{{ asset('assets/img/smartpelaut/halutama.jpg') }}');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .sp-hero-inner {
        position: relative;
        z-index: 2;
        max-width: 720px;
        text-align: center;
    }

    /* ---- Judul halaman ---- */
    .sp-dash-title {
        position: relative;
        margin: 0;
        color: #fff;
        font-size: clamp(1.7rem, 3.4vw, 2.4rem);
        font-weight: 800;
        line-height: 1.25;
        letter-spacing: -0.02em;
        text-align: center;
        text-shadow: 0 2px 6px rgba(0, 0, 0, 0.55), 0 4px 22px rgba(0, 0, 0, 0.45);
    }

    .sp-dash-title::after {
        content: "";
        display: block;
        width: 65px;
        height: 4px;
        margin: 18px auto 0;
        border-radius: 50px;
        background: var(--sp-accent);
    }

    /* ---- Menu cards ---- */
    .sp-menu-card {
        width: 260px;
        max-width: 100%;
        padding: 20px 18px;
        border: 1px solid var(--sp-border);
        border-radius: 16px;
        background-color: var(--sp-white);
        box-shadow: var(--sp-shadow-sm);
        text-align: center;
        transition: transform 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease;
    }

    .sp-menu-card:hover {
        border-color: rgba(0, 168, 198, 0.55);
        transform: translateY(-5px);
        box-shadow: var(--sp-shadow-md);
    }

    .sp-menu-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        margin: 0 auto 12px;
        border-radius: 13px;
        background: linear-gradient(145deg, var(--sp-primary), var(--sp-secondary));
        color: var(--sp-white);
        font-size: 1.1rem;
    }

    .sp-menu-card h3 {
        margin: 0 0 6px;
        color: var(--sp-primary-dark);
        font-size: 0.98rem;
        font-weight: 800;
    }

    .sp-menu-card p {
        margin-bottom: 14px;
        color: var(--sp-text-muted);
        font-size: 0.82rem;
        line-height: 1.55;
    }

    .sp-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        min-height: 38px;
        padding: 8px 20px;
        border: 2px solid var(--sp-primary);
        border-radius: 50px;
        background-color: var(--sp-primary);
        color: var(--sp-white) !important;
        font-size: 0.84rem;
        font-weight: 700;
        text-decoration: none !important;
        transition: transform 0.25s ease, background-color 0.25s ease, box-shadow 0.25s ease;
        box-shadow: 0 10px 24px rgba(0, 63, 107, 0.18);
    }

    .sp-btn:hover {
        background-color: var(--sp-primary-dark);
        border-color: var(--sp-primary-dark);
        color: var(--sp-white) !important;
        transform: translateY(-3px);
        box-shadow: 0 14px 30px rgba(0, 63, 107, 0.24);
    }

    /* Tekan/klik: warna makin gelap + sedikit mengecil supaya terasa "ditekan" */
    .sp-btn:active {
        background-color: var(--sp-primary-dark);
        border-color: var(--sp-primary-dark);
        transform: translateY(-1px) scale(0.96);
        box-shadow: 0 6px 16px rgba(0, 63, 107, 0.28);
    }

    /* Tanda panah kecil yang bergerak ke kanan saat hover/klik, penanda "bisa diklik" */
    .sp-btn-arrow {
        display: inline-flex;
        transition: transform 0.25s ease;
    }

    .sp-btn:hover .sp-btn-arrow {
        transform: translateX(5px);
    }

    .sp-btn:active .sp-btn-arrow {
        transform: translateX(8px);
    }

    /* ---- Deskripsi program ---- */
    .sp-doc {
        position: relative;
        overflow: hidden;
        margin: -16px 0 56px;
        padding: 40px 44px;
        border-radius: 22px;
        background-color: var(--sp-primary-dark);
        background-image: linear-gradient(135deg, #003653 0%, #005b96 55%, #00799f 100%);
        box-shadow: var(--sp-shadow-md);
    }

    .sp-doc::before {
        content: "";
        position: absolute;
        top: -170px;
        right: -140px;
        width: 380px;
        height: 380px;
        border: 1px solid rgba(255, 255, 255, 0.10);
        border-radius: 50%;
        pointer-events: none;
    }

    .sp-doc p {
        position: relative;
        z-index: 1;
        max-width: none;
        margin-bottom: 18px;
        color: rgba(255, 255, 255, 0.94);
        font-size: 0.98rem;
        line-height: 1.85;
        text-align: justify;
    }

    .sp-doc p:last-child {
        margin-bottom: 0;
    }

    .sp-doc strong {
        color: var(--sp-white);
    }

    .sp-doc em {
        color: var(--sp-accent);
        font-style: italic;
    }

    /* ---- Section heading ---- */
    .sp-section-label {
        display: inline-block;
        margin-bottom: 8px;
        color: var(--sp-secondary);
        font-size: 0.76rem;
        font-weight: 800;
        letter-spacing: 0.12em;
        text-transform: uppercase;
    }

    .sp-section-head {
        margin: 52px 0 24px;
    }

    .sp-section-head h3 {
        margin: 0;
        color: var(--sp-primary-dark);
        font-size: 1.35rem;
        font-weight: 800;
        letter-spacing: -0.01em;
    }

    /* ---- Tabel ---- */
    .sp-table-card {
        margin-bottom: 28px;
        border: 1px solid var(--sp-border);
        border-radius: 18px;
        background-color: var(--sp-white);
        box-shadow: var(--sp-shadow-sm);
        overflow: hidden;
    }

    .sp-table-head {
        padding: 16px 22px;
        background: linear-gradient(90deg, var(--sp-primary), var(--sp-secondary));
    }

    .sp-table-head h4 {
        margin: 0;
        color: var(--sp-white);
        font-size: 1rem;
        font-weight: 800;
    }

    .sp-dash table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13.5px;
        margin-bottom: 0;
    }

    .sp-dash table thead th {
        background-color: var(--sp-primary-light);
        color: var(--sp-primary-dark);
        font-weight: 700;
        font-size: 12.5px;
        letter-spacing: 0.02em;
        padding: 12px 14px;
        text-align: center;
        border-bottom: 1px solid var(--sp-border);
    }

    .sp-dash table tbody td {
        padding: 12px 14px;
        border-bottom: 1px solid var(--sp-border);
        color: var(--sp-text);
        vertical-align: middle;
    }

    .sp-dash table tbody tr:last-child td {
        border-bottom: none;
    }

    .sp-dash table tbody tr:hover {
        background-color: var(--sp-primary-light);
    }

    .sp-toggle-phone {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        padding: 0;
        border: 1px solid var(--sp-border);
        border-radius: 9px;
        background-color: var(--sp-white);
        color: var(--sp-primary);
    }

    .sp-toggle-phone:hover {
        background-color: var(--sp-primary);
        border-color: var(--sp-primary);
        color: var(--sp-white);
    }

    .sp-phone-number {
        font-weight: 700;
        color: var(--sp-primary-dark);
    }

    @media (max-width: 767.98px) {
        .sp-hero {
            min-height: 360px;
        }

        .sp-doc {
            margin-top: -20px;
            padding: 28px 24px;
        }

        .sp-dash-title {
            margin-bottom: 38px;
        }
    }
</style>
@endpush

@section('content')

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Efek muncul saat elemen discroll ke layar (sederhana & ringan)
    var revealEls = document.querySelectorAll(".sp-reveal");
    if ("IntersectionObserver" in window && revealEls.length) {
        var revealObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add("sp-in");
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15, rootMargin: "0px 0px -40px 0px" });

        revealEls.forEach(function (el, i) {
            el.style.transitionDelay = Math.min(i * 90, 270) + "ms";
            revealObserver.observe(el);
        });
    } else {
        revealEls.forEach(function (el) { el.classList.add("sp-in"); });
    }

    document.querySelectorAll(".toggle-phone").forEach(function (btn) {
        btn.addEventListener("click", function () {
            let phoneSpan = this.nextElementSibling;

            if (phoneSpan.classList.contains("d-none")) {
                phoneSpan.classList.remove("d-none");
                this.innerHTML = '<i class="bi bi-eye-slash"></i>';
            } else {
                phoneSpan.classList.add("d-none");
                this.innerHTML = '<i class="bi bi-eye"></i>';
            }
        });
    });
});
</script>

<div class="sp-dash">

    <section class="sp-hero">
        <div class="sp-hero-inner">
            <h2 class="sp-dash-title">Selamat Datang di Smart Pelaut Jakarta</h2>
        </div>
    </section>

    <div class="container">
        <div class="sp-menu-grid-wrap">
            <div class="sp-menu-grid">
                <div class="sp-menu-card sp-reveal">
                    <div class="sp-menu-icon"><i class="bi bi-shield-check"></i></div>
                    <h3>Data Kepatuhan &amp; Pelanggaran</h3>
                    <p>Informasi tentang kepatuhan dan pelanggaran kapal di wilayah Jakarta</p>
                    <a href="{{ route('sailor.home.compliance') }}" class="sp-btn">
                        Lihat Data
                    </a>
                </div>
                <div class="sp-menu-card sp-reveal">
                    <div class="sp-menu-icon"><i class="bi bi-journal-text"></i></div>
                    <h3>Data Peraturan</h3>
                    <p>Kumpulan peraturan yang berlaku untuk pelayaran di wilayah Jakarta</p>
                    <a href="{{ route('sailor.home.regulation') }}" class="sp-btn">
                        Lihat Peraturan
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">

    <div class="sp-doc sp-reveal">
        <p>
            <strong>SMART PELAUT JAKARTA</strong> merupakan sebuah terobosan inovasi dalam pengawasan sumber daya kelautan dan perikanan di wilayah Jakarta.
            Sistem ini dirancang untuk menghadirkan pengawasan laut yang lebih partisipatif, adaptif, dan berbasis teknologi,
            dengan melibatkan peran aktif masyarakat pesisir, nelayan, serta pemangku kepentingan lainnya.
        </p>
        <p>
            Melalui pendekatan <em>"Sistem Masyarakat Aktif dan Responsif Teknologi dalam Pengawasan Laut Jakarta"</em>,
            SMART PELAUT JAKARTA mendorong terciptanya kolaborasi antara aparat pengawas Sumber Daya Kelautan dan Perikanan (SDKP)
            dengan masyarakat khususnya POKMASWAS (Kelompok Masyarakat Pengawasan) SDKP sesuai amanat UU No 31 tahun 2004 pasal 66
            sebagai mata dan telinga di lapangan.
            Masyarakat dapat menyampaikan laporan secara cepat, mudah, dan terintegrasi melalui platform digital yang disediakan.
            Teknologi ini memungkinkan proses pengawasan berjalan lebih efisien, transparan, dan responsif terhadap berbagai bentuk pelanggaran di laut,
            mulai dari praktik penangkapan ikan ilegal hingga aktivitas yang merusak ekosistem.
        </p>
        <p>
            Keunggulan dari sistem ini adalah adanya integrasi data dan informasi yang bisa diakses oleh petugas pengawas maupun instansi terkait secara real-time.
            Dengan demikian, koordinasi antar pihak dapat berjalan lebih cepat, penindakan lebih tepat sasaran,
            dan upaya pencegahan kerusakan laut lebih optimal.
        </p>
        <p>
            Hadirnya <strong>SMART PELAUT JAKARTA</strong> sekaligus menjadi bukti bahwa pengawasan laut tidak hanya bertumpu pada aparat,
            tetapi juga menghadirkan masyarakat sebagai mitra strategis melalui pemanfaatan teknologi informasi.
            Inovasi ini diharapkan mampu meningkatkan kesadaran kolektif, menumbuhkan budaya patuh aturan,
            serta menjaga kelestarian laut Jakarta untuk generasi mendatang.
        </p>
    </div>

    <div class="sp-section-head sp-reveal">
        <span class="sp-section-label">Basis Data Pengawasan Masyarakat</span>
        <h3>Database Pokmaswas Provinsi DKI Jakarta</h3>
    </div>

    <div class="sp-table-card sp-reveal">
        <div class="sp-table-head">
            <h4>Kota Jakarta Utara</h4>
        </div>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kecamatan/Kelurahan</th>
                        <th>Nama Pokmaswas</th>
                        <th>Nama, Ketua</th>
                        <th>No HP</th>
                        <th>Jumlah Anggota</th>
                        <th>Tahun Pembentukan</th>
                        <th>No. SK &amp; Tanggal</th>
                        <th>Kegiatan Pokok</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td>Kelurahan Kamal Muara</td>
                        <td>Kamal Bahari</td>
                        <td>H Karnadi</td>
                        <td class="text-center">
                            <button class="btn btn-sm sp-toggle-phone toggle-phone" data-phone="08583862744">
                                <i class="bi bi-eye"></i>
                            </button>
                            <span class="d-none phone-number sp-phone-number" style="display:inline-block; min-width:130px;">08583862744</span>
                        </td>
                        <td class="text-center">15</td>
                        <td class="text-center">2014</td>
                        <td>No. 74 Tahun 2020 <br> 23 Nov 2020</td>
                        <td>Pengawasan Perairan dan Pengolah Sumber Daya Kelautan dan Perikanan</td>
                    </tr>
                    <tr>
                        <td class="text-center">2</td>
                        <td>Kelurahan Pluit</td>
                        <td>Mora Lestari</td>
                        <td>Saruna Fauzi </td>
                        <td class="text-center">
                            <button class="btn btn-sm sp-toggle-phone toggle-phone" data-phone="082335581500">
                                <i class="bi bi-eye"></i>
                            </button>
                            <span class="d-none phone-number sp-phone-number" style="display:inline-block; min-width:130px;">082335581500</span>
                        </td>
                        <td class="text-center">20</td>
                        <td class="text-center">2014</td>
                        <td>No. 125/2014 <br> 16 Juni 2014</td>
                        <td>Pengawasan Perairan dan Pengolah Sumber Daya Kelautan dan Perikanan</td>
                    </tr>
                    <tr>
                        <td class="text-center">3</td>
                        <td>Kelurahan Kali Baru</td>
                        <td>Sepakat</td>
                        <td>Jumani</td>
                        <td class="text-center">
                            <button class="btn btn-sm sp-toggle-phone toggle-phone" data-phone="081293383748">
                                <i class="bi bi-eye"></i>
                            </button>
                            <span class="d-none phone-number sp-phone-number" style="display:inline-block; min-width:130px;">081293383748</span>
                        </td>
                        <td class="text-center">11</td>
                        <td class="text-center">2013</td>
                        <td>No. 73/2020 <br> 23 Nov 2020</td>
                        <td>Pengawasan Perairan dan Pengolah Sumber Daya Kelautan dan Perikanan</td>
                    </tr>
                    <tr>
                        <td class="text-center">4</td>
                        <td>Kelurahan Cilincing</td>
                        <td>Cilincing Raya</td>
                        <td>Edi</td>
                        <td class="text-center">
                            <button class="btn btn-sm sp-toggle-phone toggle-phone" data-phone="087808411515">
                                <i class="bi bi-eye"></i>
                            </button>
                            <span class="d-none phone-number sp-phone-number" style="display:inline-block; min-width:130px;">087808411515</span>
                        </td>
                        <td class="text-center">15</td>
                        <td class="text-center">2003</td>
                        <td>No. 62/2013 <br> 26 Maret 2013</td>
                        <td>Pengawasan Perairan dan Pengolah Sumber Daya Kelautan dan Perikanan</td>
                    </tr>
                    <tr>
                        <td class="text-center">5</td>
                        <td>Kelurahan Marunda</td>
                        <td>Marunda Centre</td>
                        <td>Kubil</td>
                        <td class="text-center">
                            <button class="btn btn-sm sp-toggle-phone toggle-phone" data-phone="085282053484">
                                <i class="bi bi-eye"></i>
                            </button>
                            <span class="d-none phone-number sp-phone-number" style="display:inline-block; min-width:130px;">085282053484</span>
                        </td>
                        <td class="text-center">10</td>
                        <td class="text-center">2015</td>
                        <td>No. 62/2013 <br> 26 Maret 2013</td>
                        <td>Pengawasan Perairan dan Pengolah Sumber Daya Kelautan dan Perikanan</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="sp-table-card sp-reveal">
        <div class="sp-table-head">
            <h4>Kabupaten Administrasi Kepulauan Seribu</h4>
        </div>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kecamatan/Kelurahan</th>
                        <th>Nama Pokmaswas</th>
                        <th>Nama, Ketua</th>
                        <th>No HP</th>
                        <th>Jumlah Anggota</th>
                        <th>Tahun Pembentukan</th>
                        <th>No. SK &amp; Tanggal</th>
                        <th>Kegiatan Pokok</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td>Kelurahan Untung Jawa</td>
                        <td>Gajahmada</td>
                        <td>Solatun </td>
                        <td class="text-center">
                            <button class="btn btn-sm sp-toggle-phone toggle-phone" data-phone="085813445143">
                                <i class="bi bi-eye"></i>
                            </button>
                            <span class="d-none phone-number sp-phone-number" style="display:inline-block; min-width:130px;">085813445143</span>
                        </td>
                        <td class="text-center">8</td>
                        <td class="text-center">2015</td>
                        <td>No. 07 Tahun 2021 <br> 22 Jan 2021</td>
                        <td>Pengawasan Perairan dan Konservasi</td>
                    </tr>
                    <tr>
                        <td class="text-center">2</td>
                        <td>Kelurahan Pulau Pari</td>
                        <td>Pulau Pari</td>
                        <td>Nahrudin </td>
                        <td class="text-center">
                            <button class="btn btn-sm sp-toggle-phone toggle-phone" data-phone="085777386394">
                                <i class="bi bi-eye"></i>
                            </button>
                            <span class="d-none phone-number sp-phone-number" style="display:inline-block; min-width:130px;">085777386394</span>
                        </td>
                        <td class="text-center">11</td>
                        <td class="text-center">2016</td>
                        <td>No. 2065/1-823.48 <br> 25 Okt 2016</td>
                        <td>Pengawasan Perairan dan Konservasi</td>
                    </tr>
                    <tr>
                        <td class="text-center">3</td>
                        <td>Kelurahan Pulau Pari (Pulau Lancang)</td>
                        <td>Barracuda</td>
                        <td>Mulyadi </td>
                        <td class="text-center">
                            <button class="btn btn-sm sp-toggle-phone toggle-phone" data-phone="087885185389">
                                <i class="bi bi-eye"></i>
                            </button>
                            <span class="d-none phone-number sp-phone-number" style="display:inline-block; min-width:130px;">087885185389</span>
                        </td>
                        <td class="text-center">14</td>
                        <td class="text-center">2010</td>
                        <td>No. 2064/1-823.48 <br> 25 Okt 2016</td>
                        <td>Pengawasan Perairan dan Konservasi</td>
                    </tr>
                    <tr>
                        <td class="text-center">4</td>
                        <td>Kelurahan Pulau Tidung</td>
                        <td>Pulau Payung</td>
                        <td>Jamaludin </td>
                        <td class="text-center">
                            <button class="btn btn-sm sp-toggle-phone toggle-phone" data-phone="081318160686">
                                <i class="bi bi-eye"></i>
                            </button>
                            <span class="d-none phone-number sp-phone-number" style="display:inline-block; min-width:130px;">081318160686</span>
                        </td>
                        <td class="text-center">13</td>
                        <td class="text-center">2016</td>
                        <td>No. 2063/1-823.48 <br> 25 Okt 2016</td>
                        <td>Pengawasan Perairan dan Konservasi</td>
                    </tr>
                    <tr>
                        <td class="text-center">5</td>
                        <td>Kelurahan Pulau Tidung</td>
                        <td>Pulau Tidung</td>
                        <td>Suhardi </td>
                        <td class="text-center">
                            <button class="btn btn-sm sp-toggle-phone toggle-phone" data-phone="08588861287">
                                <i class="bi bi-eye"></i>
                            </button>
                            <span class="d-none phone-number sp-phone-number" style="display:inline-block; min-width:130px;">08588861287</span>
                        </td>
                        <td class="text-center">25</td>
                        <td class="text-center">2014</td>
                        <td>No. 2061/1-823.48 <br> 25 Okt 2016</td>
                        <td>Pengawasan Perairan dan Konservasi</td>
                    </tr>
                    <tr>
                        <td class="text-center">6</td>
                        <td>Kelurahan Pulau Panggang</td>
                        <td>Pulau Panggang</td>
                        <td>Mastur </td>
                        <td class="text-center">
                            <button class="btn btn-sm sp-toggle-phone toggle-phone" data-phone="082261976224">
                                <i class="bi bi-eye"></i>
                            </button>
                            <span class="d-none phone-number sp-phone-number" style="display:inline-block; min-width:130px;">082261976224</span>
                        </td>
                        <td class="text-center">11</td>
                        <td class="text-center">2016</td>
                        <td>No. 2059/1-823.48 <br> 25 Okt 2016</td>
                        <td>Pengawasan Perairan dan Konservasi</td>
                    </tr>
                    <tr>
                        <td class="text-center">7</td>
                        <td>Kelurahan Pulau Kelapa</td>
                        <td>Sukma</td>
                        <td>Sukma </td>
                        <td class="text-center">
                            <button class="btn btn-sm sp-toggle-phone toggle-phone" data-phone="087884582419">
                                <i class="bi bi-eye"></i>
                            </button>
                            <span class="d-none phone-number sp-phone-number" style="display:inline-block; min-width:130px;">087884582419</span>
                        </td>
                        <td class="text-center">12</td>
                        <td class="text-center">2016</td>
                        <td>No. 2067/1-823.48 <br> 25 Okt 2016</td>
                        <td>Pengawasan Perairan dan Konservasi</td>
                    </tr>
                    <tr>
                        <td class="text-center">8</td>
                        <td>Kelurahan Pulau Kelapa</td>
                        <td>Pulau Sabira</td>
                        <td>M. Ali Kurniawan </td>
                        <td class="text-center">
                            <button class="btn btn-sm sp-toggle-phone toggle-phone" data-phone="08129587925">
                                <i class="bi bi-eye"></i>
                            </button>
                            <span class="d-none phone-number sp-phone-number" style="display:inline-block; min-width:130px;">08129587925</span>
                        </td>
                        <td class="text-center">19</td>
                        <td class="text-center">2012</td>
                        <td>No. 2062/1-823.48 <br> 25 Okt 2016</td>
                        <td>Pengawasan Perairan dan Konservasi</td>
                    </tr>
                    <tr>
                        <td class="text-center">9</td>
                        <td>Kelurahan Pulau Harapan</td>
                        <td>Pulau Harapan</td>
                        <td>Ishak </td>
                        <td class="text-center">
                            <button class="btn btn-sm sp-toggle-phone toggle-phone" data-phone="085884701103">
                                <i class="bi bi-eye"></i>
                            </button>
                            <span class="d-none phone-number sp-phone-number" style="display:inline-block; min-width:130px;">085884701103</span>
                        </td>
                        <td class="text-center">15</td>
                        <td class="text-center">2016</td>
                        <td>No. 2066/1-823.48 <br> 25 Okt 2016</td>
                        <td>Pengawasan Perairan dan Konservasi</td>
                    </tr>
                    <tr>
                        <td class="text-center">10</td>
                        <td>Kelurahan Pulau Kelapa</td>
                        <td>Pulau Kelapa Dua</td>
                        <td>Bahrudin </td>
                        <td class="text-center">
                            <button class="btn btn-sm sp-toggle-phone toggle-phone" data-phone="083897356221">
                                <i class="bi bi-eye"></i>
                            </button>
                            <span class="d-none phone-number sp-phone-number" style="display:inline-block; min-width:130px;">083897356221</span>
                        </td>
                        <td class="text-center">15</td>
                        <td class="text-center">2016</td>
                        <td>No. 2060/1-823.48 <br> 25 Okt 2016</td>
                        <td>Pengawasan Perairan dan Konservasi</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    </div>
</div>
@endsection