<div class="modal fade" id="m_upload_general" tabindex="-1" aria-labelledby="ModalUploadGeneral" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Upload Report General</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <h6 class="mb-3">Pastikan Format Upload Sesuai <a class="link-danger"
                        href="{{ asset('template/template_general.xlsx') }}">Template</a></h6>
                <form action="{{ route('backend.import_general') }}" method="POST" enctype="multipart/form-data" id="form-upload-general" class="needs-validation" novalidate>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-control mb-3">
                                <input type="file" class="form-control" name="upload_file" id="upload_file" required>
                                <div class="invalid-feedback">
                                    Please Insert File
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" id="btn-submit-upload" hidden></button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-act btn-act-primary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn-act btn-act-primary" id="btn-upload-general">Upload</button>
            </div>
        </div>
    </div>
</div>
