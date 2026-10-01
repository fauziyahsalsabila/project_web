@extends('sailor.layouts.app-master')

@push('title')
    <title>Dashboard Smart Pelaut Jakarta</title>
@endpush

@push('css')
<style>
    body {
        background: #fff;
    }

    .sailor-admin-dashboard {
        min-height: calc(100vh - 150px);
        padding: 36px 0 56px;
        background: #fff;
    }

    .sailor-admin-dashboard h1 {
        margin: 0 0 24px;
        color: #17384a;
        font-size: 23px;
        font-weight: 700;
    }

    .sailor-admin-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .sailor-admin-card {
        display: flex;
        min-height: 196px;
        flex-direction: column;
        align-items: flex-start;
        justify-content: space-between;
        padding: 24px;
        border: 1px solid #dceaf1;
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 2px 8px rgba(23, 56, 74, 0.06);
        transition: border-color 0.18s ease, box-shadow 0.18s ease;
    }

    .sailor-admin-card:hover {
        border-color: #9fc7df;
        box-shadow: 0 6px 18px rgba(23, 56, 74, 0.1);
    }

    .sailor-admin-card-heading {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .sailor-admin-card-icon {
        display: inline-flex;
        width: 40px;
        height: 40px;
        flex: 0 0 40px;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: #e8f3fa;
        color: #0a4a8e;
        font-size: 16px;
    }

    .sailor-admin-card h2 {
        margin: 0;
        color: #0a4a8e;
        font-size: 18px;
        font-weight: 700;
    }

    .sailor-admin-card p {
        margin: 14px 0 22px;
        color: #526d7b;
        line-height: 1.5;
    }

    .sailor-admin-card .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border-radius: 6px;
        font-weight: 600;
    }

    @media (max-width: 767px) {
        .sailor-admin-dashboard {
            padding: 28px 0 40px;
        }

        .sailor-admin-grid {
            grid-template-columns: 1fr;
            gap: 14px;
        }

        .sailor-admin-card {
            min-height: 176px;
            padding: 20px;
        }

        .sailor-admin-card-heading {
            align-items: flex-start;
        }
    }
</style>
@endpush

@section('content')
<main class="sailor-admin-dashboard">
    <div class="container">
        <h1>Selamat Datang, Admin!</h1>

        <div class="sailor-admin-grid">
            <section class="sailor-admin-card">
                <div>
                    <div class="sailor-admin-card-heading">
                        <span class="sailor-admin-card-icon"><i class="fas fa-clipboard-check" aria-hidden="true"></i></span>
                        <h2>Data Kepatuhan &amp; Pelanggaran</h2>
                    </div>
                    <p>Kelola data kepatuhan dan pelanggaran kapal</p>
                </div>
                <a href="{{ route('compliance.index') }}" class="btn btn-primary">Kelola <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
            </section>

            <section class="sailor-admin-card">
                <div>
                    <div class="sailor-admin-card-heading">
                        <span class="sailor-admin-card-icon"><i class="fas fa-file-alt" aria-hidden="true"></i></span>
                        <h2>Data Peraturan</h2>
                    </div>
                    <p>Kelola data peraturan kelautan</p>
                </div>
                <a href="{{ route('regulation.index') }}" class="btn btn-primary">Kelola <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
            </section>
        </div>
    </div>
</main>
@endsection