@extends('sailor.home.app-master')

@php
    $isAdmin = auth()->check() && auth()->user()->role === 'admin';
@endphp

@push('title')
    <title>SMART PELAUT JAKARTA</title>
@endpush

@push('css')
<style>
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
        --sp-shadow-sm: 0 8px 18px rgba(23, 56, 74, 0.08);
        --sp-shadow-md: 0 14px 28px rgba(23, 56, 74, 0.12);
    }

    .sp-compliance {
        width: 100%;
        overflow-x: hidden;
        color: var(--sp-text);
        background: #f7fbff;
    }

    .sp-compliance-hero {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 180px;
        width: 100%;
        margin: 0 0 18px;
        padding: 30px 20px;
        overflow: hidden;
        background-color: var(--sp-primary-dark);
        background-image:
            linear-gradient(135deg, rgba(0, 45, 78, 0.90) 0%, rgba(0, 70, 116, 0.80) 45%, rgba(0, 91, 150, 0.62) 100%),
            url('{{ asset('assets/img/smartpelaut/halutama.jpg') }}');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .sp-compliance-hero-inner {
        position: relative;
        z-index: 2;
        max-width: 760px;
        text-align: center;
    }

    .sp-compliance-title {
        margin: 0;
        color: var(--sp-white);
        font-size: clamp(1.8rem, 3vw, 2.6rem);
        font-weight: 800;
        letter-spacing: -0.02em;
        text-shadow: 0 3px 14px rgba(0, 0, 0, 0.3);
    }

    .sp-compliance-title::after {
        content: "";
        display: block;
        width: 70px;
        height: 4px;
        margin: 16px auto 0;
        border-radius: 50px;
        background: var(--sp-accent);
    }

    .sp-panel {
        margin-bottom: 16px;
        border: 1px solid var(--sp-border);
        border-radius: 20px;
        background: var(--sp-white);
        box-shadow: var(--sp-shadow-sm);
        overflow: hidden;
    }

    .sp-panel-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 18px 22px;
        background: linear-gradient(90deg, var(--sp-primary) 0%, var(--sp-secondary) 100%);
    }

    .sp-panel-header h5 {
        margin: 0;
        color: var(--sp-white);
        font-size: 1.05rem;
        font-weight: 800;
    }

    .sp-panel-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 86px;
        padding: 7px 12px;
        border-radius: 50px;
        background-color: rgba(255,255,255,0.14);
        color: var(--sp-white);
        font-size: 0.8rem;
        font-weight: 700;
    }

    .sp-pagination-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        padding: 12px 16px;
        border-top: 1px solid var(--sp-border);
        background: #f9fcff;
    }

    .sp-pagination-meta {
        color: var(--sp-text-muted);
        font-size: 0.84rem;
        font-weight: 600;
    }

    .sp-pagination-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .sp-perpage-form {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--sp-text-muted);
        font-size: 0.8rem;
        font-weight: 600;
    }

    .sp-perpage-form .form-select {
        min-width: 84px;
        border: 1px solid var(--sp-border);
        border-radius: 10px;
        padding: 7px 12px;
        background: var(--sp-white);
        color: var(--sp-text);
    }

    .sp-pagination .page-link {
        min-width: 40px;
        height: 38px;
        padding: 0 12px;
        border: 1px solid var(--sp-border);
        border-radius: 10px;
        background: var(--sp-white);
        color: var(--sp-primary-dark);
        font-weight: 700;
    }

    .sp-pagination .page-item.active .page-link {
        background: linear-gradient(90deg, var(--sp-primary), var(--sp-secondary));
        border-color: transparent;
        color: var(--sp-white);
    }

    .sp-pagination .page-item.disabled .page-link {
        opacity: 0.5;
        pointer-events: none;
    }

    .sp-filter-card {
        margin-bottom: 16px;
        border: 1px solid var(--sp-border);
        border-radius: 18px;
        background: var(--sp-white);
        box-shadow: 0 8px 20px rgba(23, 56, 74, 0.06);
    }

    .sp-filter-card .card-body {
        padding: 22px;
    }

    .sp-form-control,
    .sp-form-select {
        border: 1px solid var(--sp-border);
        border-radius: 12px;
        background: #fff;
        box-shadow: none;
    }

    .sp-form-control:focus,
    .sp-form-select:focus {
        border-color: var(--sp-secondary);
        box-shadow: 0 0 0 0.2rem rgba(0, 168, 198, 0.12);
    }

    .sp-filter-btn,
    .sp-reset-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 56px;
        border-radius: 12px;
        font-weight: 700;
    }

    .sp-filter-btn {
        background: linear-gradient(90deg, var(--sp-primary) 0%, var(--sp-secondary) 100%);
        border: none;
        color: var(--sp-white);
    }

    .sp-reset-btn {
        border: 1px solid var(--sp-border);
        background: var(--sp-white);
        color: var(--sp-primary-dark);
    }

    .sp-table-wrap {
        padding: 0;
    }

    .sp-table {
        width: 100%;
        margin: 0;
        border-collapse: collapse;
        font-size: 0.9rem;
    }

    .sp-table thead th {
        padding: 14px 12px;
        background: var(--sp-primary-light);
        color: var(--sp-primary-dark);
        font-size: 0.76rem;
        font-weight: 800;
        letter-spacing: 0.02em;
        text-transform: uppercase;
        border-bottom: 1px solid var(--sp-border);
        text-align: center;
    }

    .sp-table tbody td {
        padding: 13px 12px;
        vertical-align: middle;
        border-bottom: 1px solid var(--sp-border);
        background: var(--sp-white);
    }

    .sp-table tbody tr:hover td {
        background: #f5fbff;
    }

    .sp-doc-link,
    .sp-doc-link:hover {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 34px;
        padding: 7px 12px;
        border: 1px solid rgba(0, 91, 150, 0.25);
        border-radius: 10px;
        background: rgba(0, 91, 150, 0.04);
        color: var(--sp-primary-dark);
        font-weight: 700;
        text-decoration: none;
    }

    .sp-status-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 110px;
        padding: 8px 12px;
        border-radius: 999px;
        font-size: 0.78rem;
        font-weight: 700;
    }

    .sp-status-badge.success {
        background: rgba(25, 135, 84, 0.12);
        color: #146c43;
    }

    .sp-status-badge.danger {
        background: rgba(220, 53, 69, 0.10);
        color: #b02a37;
    }

    .sp-empty {
        padding: 36px 16px;
        text-align: center;
        color: var(--sp-text-muted);
    }

    .sp-compliance .container {
        padding-top: 0 !important;
        padding-bottom: 12px !important;
    }

    @media (max-width: 767.98px) {
        .sp-compliance-hero {
            min-height: 150px;
            padding: 26px 16px;
        }

        .sp-panel-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .sp-table {
            font-size: 0.82rem;
        }
    }
</style>
@endpush

@section('content')
<div class="sp-compliance">
    <section class="sp-compliance-hero">
        <div class="sp-compliance-hero-inner">
            <h2 class="sp-compliance-title">Data Kepatuhan &amp; Pelanggaran</h2>
        </div>
    </section>

    <div class="container py-4">
        <div class="sp-panel">
            <div class="sp-panel-header">
                <h5><i class="fas fa-database me-2"></i> Data Kepatuhan dan Pelanggaran</h5>
                <span class="sp-panel-badge">{{ $compliance->total() }} Data</span>
            </div>
        </div>

        <div class="sp-filter-card">
            <div class="card-body">
                <form method="GET" action="{{ route('sailor.home.compliance') }}" class="row g-3">
                    <div class="col-md-2">
                        <div class="form-floating">
                            <input type="text" class="form-control sp-form-control" id="ship_name" name="ship_name" placeholder="Nama Kapal" value="{{ request('ship_name') }}">
                            <label for="ship_name"><i class="fas fa-ship me-1"></i> Nama Kapal</label>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-floating">
                            <input type="text" class="form-control sp-form-control" id="owner_name" name="owner_name" placeholder="Nama Pemilik" value="{{ request('owner_name') }}">
                            <label for="owner_name"><i class="fas fa-user-tie me-1"></i> Nama Pemilik</label>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-floating">
                            <select class="form-select sp-form-select" id="fishing_gear_type" name="fishing_gear_type">
                                <option value="">Semua</option>
                                @foreach ($fishingGearTypes as $fishingGearType)
                                    <option value="{{ $fishingGearType }}" {{ request('fishing_gear_type') === $fishingGearType ? 'selected' : '' }}>{{ $fishingGearType }}</option>
                                @endforeach
                            </select>
                            <label for="fishing_gear_type"><i class="fas fa-fish me-1"></i> Jenis Alat Tangkap</label>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-floating">
                            <input type="date" class="form-control sp-form-control" id="date_from" name="date_from" value="{{ request('date_from') }}">
                            <label for="date_from"><i class="fas fa-calendar-day me-1"></i> Dari</label>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-floating">
                            <input type="date" class="form-control sp-form-control" id="date_to" name="date_to" value="{{ request('date_to') }}">
                            <label for="date_to"><i class="fas fa-calendar-check me-1"></i> Sampai</label>
                        </div>
                    </div>

                    <div class="col-md-1 d-grid">
                        <button type="submit" class="btn sp-filter-btn"><i class="fas fa-filter"></i></button>
                    </div>
                    <div class="col-md-1 d-grid">
                        <a href="{{ route('sailor.home.compliance') }}" class="btn sp-reset-btn"><i class="fas fa-redo"></i></a>
                    </div>
                </form>
            </div>
        </div>

        <div class="sp-panel sp-table-wrap">
            <div class="table-responsive">
                <table class="sp-table align-middle table-hover">
                    <thead>
                        <tr>
                            <th><i class="fas fa-calendar-day me-1"></i> Tanggal</th>
                            <th><i class="fas fa-ship me-1"></i> Nama Kapal</th>
                            <th><i class="fas fa-user-tie me-1"></i> Pemilik</th>
                            <th><i class="fas fa-user me-1"></i> Nahkoda</th>
                            <th><i class="fas fa-map-marker-alt me-1"></i> Alamat</th>
                            <th>GT</th>
                            <th><i class="fas fa-fish me-1"></i> Jenis Alat Tangkap</th>
                            <th><i class="fas fa-location-crosshairs me-1"></i> Koordinat</th>
                            <th><i class="fas fa-drumstick-bite me-1"></i> Hasil Tangkapan</th>
                            @if ($isAdmin)
                                <th><i class="fas fa-file-alt me-1"></i> Dokumen</th>
                                <th><i class="fas fa-check-circle me-1"></i> Kepatuhan</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($compliance as $item)
                            <tr>
                                <td class="text-center fw-semibold">{{ date('d M Y', strtotime($item['date'])) }}</td>
                                <td>{{ $item['ship_name'] }}</td>
                                <td>{{ $item['owner_name'] }}</td>
                                <td>{{ $item['captain_name'] }}</td>
                                <td>{{ $item['address'] ?: '-' }}</td>
                                <td class="text-center">{{ $item['gt'] }}</td>
                                <td>{{ $item['fishing_gear_type'] }}</td>
                                <td><code>{{ $item['coordinates'] }}</code></td>
                                <td>{{ $item['catch_type'] }}</td>
                                @if ($isAdmin)
                                    <td class="text-center">
                                        @if($item['document_path'] && is_file(public_path('uploads/compliance/' . basename($item['document_path']))))
                                            <a href="{{ route('documents.compliance', ['filename' => $item['document_path']]) }}" target="_blank" class="sp-doc-link">
                                                <i class="fas fa-file-pdf me-1"></i> Lihat
                                            </a>
                                        @else
                                            <span class="sp-status-badge danger">File belum tersedia</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($item['compliance'] == 'patuh')
                                            <span class="sp-status-badge success"><i class="fas fa-check-circle me-1"></i> Patuh</span>
                                        @else
                                            <span class="sp-status-badge danger"><i class="fas fa-times-circle me-1"></i> Tidak Patuh</span>
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $isAdmin ? 11 : 9 }}">
                                    <div class="sp-empty">
                                        <i class="fas fa-search fa-2x mb-2"></i>
                                        <p class="mb-0">Tidak ada data ditemukan</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="sp-pagination-bar">
                <div class="sp-pagination-meta">
                    Menampilkan {{ $compliance->firstItem() ?? 0 }}-{{ $compliance->lastItem() ?? 0 }} dari {{ $compliance->total() }} data
                </div>

                <div class="sp-pagination-actions">
                    <form method="GET" class="sp-perpage-form">
                        @foreach (request()->except(['page', 'per_page']) as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <label for="per_page">Baris</label>
                        <select id="per_page" name="per_page" class="form-select" onchange="this.form.submit()">
                            @foreach ([10, 20, 50] as $option)
                                <option value="{{ $option }}" {{ request('per_page', 10) == $option ? 'selected' : '' }}>{{ $option }}</option>
                            @endforeach
                        </select>
                    </form>

                    <nav aria-label="Pagination" class="sp-pagination">
                        @php
                            $paginator = $compliance;
                            $onEachSide = 2;
                            $currentPage = $paginator->currentPage();
                            $lastPage = $paginator->lastPage();
                            $start = max($currentPage - $onEachSide, 1);
                            $end = min($start + 4, $lastPage);
                            if ($end - $start < 4) {
                                $start = max($end - 4, 1);
                            }
                        @endphp

                        <ul class="pagination mb-0">
                            <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $paginator->previousPageUrl() ?? '#' }}" aria-label="Previous">&laquo;</a>
                            </li>

                            @for ($page = $start; $page <= $end; $page++)
                                <li class="page-item {{ $page == $currentPage ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $paginator->url($page) }}">{{ $page }}</a>
                                </li>
                            @endfor

                            <li class="page-item {{ !$paginator->hasMorePages() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $paginator->nextPageUrl() ?? '#' }}" aria-label="Next">&raquo;</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
