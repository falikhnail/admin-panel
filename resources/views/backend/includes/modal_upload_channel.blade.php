<div class="modal fade" id="m_upload_channel" tabindex="-1" aria-labelledby="ModalUploadChannel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('backend.import_channel') }}" method="POST" enctype="multipart/form-data"
                id="form-upload-channel" class="needs-validation" novalidate>
                <div class="modal-header">
                    <h4 class="modal-title">Upload Report Channel</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <h6 class="mb-3">Pastikan Format Upload Sesuai <a class="link-danger"
                            href="{{ asset('template/template_report_channel.xlsx') }}">Template</a></h6>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="user">User</label>
                                <select class="form-select" id="user" name="user_id" required>
                                    <option value="" disabled selected>Pilih User</option>
                                    @foreach ($user as $u)
                                        <option value="{{ $u->id }}">{{ $u->nama }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Please Select User
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="reporting_period" name="reporting_period"
                                    placeholder="Masukkan Reporting Period Date" required>
                                <div class="invalid-feedback">
                                    Please Fill Reporting Period
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="release_date" name="release_date"
                                    placeholder="Masukkan Release Date" required>
                                <div class="invalid-feedback">
                                    Please Fill Schedule
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-md-12">
                            <div class="form-control mb-3">
                                <input type="file" class="form-control" name="upload_file" id="upload_file" required>
                                <div class="invalid-feedback">
                                    Please Insert File
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <button type="submit" id="btn-submit-upload" hidden></button> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-act btn-act-primary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn-act btn-act-primary" id="btn-upload-general">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
