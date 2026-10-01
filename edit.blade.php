                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Kepatuhan & Pelanggaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" enctype="multipart/form-data" action="{{ route('compliance.update', $compliance['id']) }}" class="compliance">
                    @csrf
                    @method('put')
                    
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date">Tanggal</label>
                                    <input type="date" class="form-control" id="date" name="date"
                                        value="{{ $compliance['date'] }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ship_name">Nama Kapal</label>
                                    <input type="text" class="form-control" id="ship_name" name="ship_name"
                                        value="{{ $compliance['ship_name'] }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="owner_name">Nama Pemilik</label>
                                    <input type="text" class="form-control" id="owner_name" name="owner_name"
                                        value="{{ $compliance['owner_name'] }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="captain_name">Nama Nahkoda</label>
                                    <input type="text" class="form-control" id="captain_name" name="captain_name"
                                        value="{{ $compliance['captain_name'] }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address">Alamat</label>
                                    <textarea class="form-control" id="address" name="address" rows="2" required>{{ $compliance['address'] }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="gt">GT</label>
                                    <input type="number" class="form-control" id="gt" name="gt"
                                        value="{{ $compliance['gt'] }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fishing_gear_type">Jenis Alat Tangkap</label>
                                    <input type="text" class="form-control" id="fishing_gear_type" name="fishing_gear_type"
                                        value="{{ $compliance['fishing_gear_type'] }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="coordinates">Koordinat</label>
                                    <input type="text" class="form-control" id="coordinates" name="coordinates"
                                        value="{{ $compliance['coordinates'] }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="catch_type">Jenis Hasil Tangkapan</label>
                                    <input type="text" class="form-control" id="catch_type" name="catch_type"
                                        value="{{ $compliance['catch_type'] }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="compliance">Kepatuhan</label>
                                    <select class="form-control" id="compliance" name="compliance" required>
                                        <option value="patuh" {{ $compliance['compliance'] == 'patuh' ? 'selected' : '' }}>Patuh</option>
                                        <option value="tidak patuh" {{ $compliance['compliance'] == 'tidak patuh' ? 'selected' : '' }}>Tidak Patuh</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="document">Upload Dokumen</label>
                                    <input type="file" class="form-control" id="document" name="document">
                                    @if($compliance['document_path'] && is_file(public_path('uploads/compliance/' . basename($compliance['document_path']))))
                                        <div class="form-text">Dokumen saat ini:
                                            <a href="{{ route('documents.compliance', ['filename' => $compliance['document_path']]) }}" target="_blank">Lihat</a>
                                        </div>
                                    @elseif($compliance['document_path'])
                                        <div class="form-text text-danger">File dokumen belum tersedia.</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>