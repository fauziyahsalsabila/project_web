@extends('sailor.home.app-master')

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

    .sp-regulation {
        width: 100%;
        overflow-x: hidden;
        color: var(--sp-text);
        background: #f7fbff;
    }

    .sp-regulation-hero {
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

    .sp-regulation-hero-inner {
        position: relative;
        z-index: 2;
        max-width: 760px;
        text-align: center;
    }

    .sp-regulation-title {
        margin: 0;
        color: var(--sp-white);
        font-size: clamp(1.8rem, 3vw, 2.6rem);
        font-weight: 800;
        letter-spacing: -0.02em;
        text-shadow: 0 3px 14px rgba(0, 0, 0, 0.3);
    }

    .sp-regulation-title::after {
        content: "";
        display: block;
        width: 70px;
        height: 4px;
        margin: 16px auto 0;
        border-radius: 50px;
        background: var(--sp-accent);
    }

    .sp-panel {
        margin-bottom: 28px;
        border: 1px solid var(--sp-border);
        border-radius: 20px;
        background: var(--sp-white);
        box-shadow: 0 8px 20px rgba(23, 56, 74, 0.06);
        overflow: hidden;
    }

    .sp-panel-body {
        padding: 22px;
    }

    .sp-search-form {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .sp-search-form .form-control {
        flex: 1;
        min-height: 52px;
        border: 1px solid var(--sp-border);
        border-radius: 12px;
        background: var(--sp-white);
        box-shadow: none;
    }

    .sp-search-form .form-control:focus {
        border-color: var(--sp-secondary);
        box-shadow: 0 0 0 0.2rem rgba(0, 168, 198, 0.12);
    }

    .sp-search-btn,
    .sp-reset-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 52px;
        padding: 10px 18px;
        border-radius: 12px;
        font-weight: 700;
    }

    .sp-search-btn {
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
        text-align: left;
    }

    .sp-table thead th:last-child {
        text-align: right;
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

    .sp-table tbody td:last-child {
        text-align: right;
    }

    .sp-doc-link,
    .sp-doc-link:hover {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 38px;
        padding: 8px 14px;
        border: 1px solid rgba(0, 91, 150, 0.25);
        border-radius: 10px;
        background: rgba(0, 91, 150, 0.04);
        color: var(--sp-primary-dark);
        font-weight: 700;
        text-decoration: none;
    }

    .sp-empty {
        padding: 36px 16px;
        text-align: center;
        color: var(--sp-text-muted);
    }

    @media (max-width: 767.98px) {
        .sp-regulation-hero {
            min-height: 210px;
            padding: 50px 16px;
        }

        .sp-search-form {
            flex-wrap: wrap;
        }

        .sp-search-btn,
        .sp-reset-btn {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
<div class="sp-regulation">
    <section class="sp-regulation-hero">
        <div class="sp-regulation-hero-inner">
            <h2 class="sp-regulation-title">Daftar Peraturan</h2>
        </div>
    </section>

    <div class="container py-4">
        <div class="sp-panel">
            <div class="sp-panel-body">
                <form method="GET" class="sp-search-form">
                    <input type="text" class="form-control" name="search" placeholder="Cari peraturan..." value="{{ $request->has('search') ? $request->search : '' }}">
                    <button type="submit" class="btn sp-search-btn">Cari</button>
                    <a href="{{ route('sailor.home.regulation') }}" class="btn sp-reset-btn">Reset</a>
                </form>
            </div>
        </div>

        <div class="sp-panel sp-table-wrap">
            <div class="table-responsive">
                <table class="sp-table table-hover">
                    <thead>
                        <tr>
                            <th>Peraturan</th>
                            <th>Tanggal Dibuat</th>
                            <th>Dokumen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($regulation))
                            @foreach ($regulation as $item)
                                <tr>
                                    <td>{{ htmlspecialchars($item['name']) }}</td>
                                    <td>{{ date('d M Y', strtotime($item['created_at'])) }}</td>
                                    <td>
                                        @if($item['document_path'] && is_file(public_path('uploads/regulation/' . basename($item['document_path']))))
                                            <a href="{{ route('documents.regulation', ['filename' => $item['document_path']]) }}" target="_blank" class="sp-doc-link">
                                                <i class="fas fa-file-pdf me-1"></i> Lihat Dokumen
                                            </a>
                                        @else
                                            <span class="text-muted">File belum tersedia</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3">
                                    <div class="sp-empty">
                                        <i class="fas fa-search fa-3x mb-3"></i>
                                        <p class="mb-0">Tidak ada data yang ditemukan.</p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection