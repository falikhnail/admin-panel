<div class="modal fade" id="m_bank_account" tabindex="-1" aria-labelledby="ModalBankAccount" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Bank Account</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="client"
                                disabled value="{{ $bankAccount->nama }}">
                            <label for="client">Client Name</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="bank_name"
                                disabled value="{{ $bankAccount->bank_name }}">
                            <label for="bank_name">Bank Name</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="acc_numb"
                                disabled value="{{ $bankAccount->account_number }}">
                            <label for="acc_numb">Account Number</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="acc_name"
                                disabled value="{{ $bankAccount->account_name }}">
                            <label for="acc_name">Name On Account</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-act btn-act-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
