@extends('sailor.layouts.app-master')

@push('title')
    <title>Peraturan - Admin SMART PELAUT JAKARTA</title>
@endpush

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-group{
            margin-bottom: 1rem;
        }
    </style>

@endpush

@section('content')
    <main class="main-content admin-dashboard">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Kelola Peraturan</h1>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#regulationModal">
                    <i class="fas fa-plus me-1"></i> Tambah Peraturan
                </button>
            </div>

            @if(Session::has('success'))            
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('success') }}                    
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>                
            @endif

            @if(Session::has('error'))            
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ Session::get('error') }}
                    <?= $_SESSION['error'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>                
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Peraturan</th>
                                    <th>Dokumen</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($regulation as $row): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['name']) ?></td>
                                        <td>
                                            @if ($row['document_path'] && is_file(public_path('uploads/regulation/' . basename($row['document_path'])))) 
                                                <a href="{{ route('documents.regulation', ['filename' => $row['document_path']]) }}" target="_blank" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-file-pdf"></i> Lihat Dokumen
                                                </a>
                                            @else
                                                <span class="text-muted">File belum tersedia</span>
                                            @endif
                                        </td>
                                        <td><?= date('d M Y', strtotime($row['created_at'])) ?></td>
                                        <td>
                                            <form onsubmit="return confirm('Apakah Anda yakin ingin menghapus peraturan ini?')" method="post" action="{{ route('regulation.destroy', $row['id']) }}" style="display:inline-block">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="_method" value="delete">
                                                <button class="btn btn-sm btn-primary"><i class="fas fa-trash"></i> Hapus</button> 
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal Form -->
    <div class="modal fade" id="regulationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Peraturan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" enctype="multipart/form-data" id="add_regulation" data-csrf="{{ csrf_token() }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nama Peraturan</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="document">Upload Dokumen</label>
                            <input type="file" class="form-control" id="document" name="document">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="add_regulation" class="btn btn-primary">Tambah Peraturan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>                                                    
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $('#add_regulation').on('submit', function(e){
        e.preventDefault();
        
        let formData = new FormData($('#add_regulation')[0]);
        formData.append('_token', $(this).data('csrf'));
        
        let csrf = $(this).data('csrf');

        $.ajax({
            url: '{{ route('regulation.store') }}',
            type: 'post',
            datatype: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data){
                if(data.status=='success'){
                    alert(data.message);
                    window.location.reload();
                }
                else{
                    alert(data.message);
                }
            },
            error: function(){
                alert('Sorry, couldn\'t process your request!')
            }
        });        
    });	

</script>
@endpush

