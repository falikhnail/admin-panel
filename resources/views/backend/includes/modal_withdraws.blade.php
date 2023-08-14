<div class="modal fade" id="m_withdraws" tabindex="-1" aria-labelledby="ModalWithdraws" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Withdraws</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <?php
                $textBtn = $userSession->tipe_user === 'admin' ? 'Approve' : 'Withdraws Now';
                $route = $userSession->tipe_user === 'admin' ? route('backend.withdraw_approve') : route('backend.withdraw_request');
                $fieldValidate = $userSession->tipe_user === 'admin' ? 'disabled' : 'required';
                $balanceTitle = $userSession->tipe_user === 'admin' ? 'User Balance' : 'Balance';
                ?>
                <form action="{{ $route }}" method="POST" id="withdraws-form" class="needs-validation"
                    novalidate>
                    <input type="hidden" id="userId" name="userId" hidden />
                    <input type="hidden" id="withdrawId" name="withdrawId" hidden />
                    <input type="hidden" id="status" name="status" hidden />
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="balance" disabled
                                    value="{{ $balance }}">
                                <label for="balance">{{ $balanceTitle }}</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control number" id="amount" name="amount"
                                    {{ $fieldValidate }}>
                                <label for="amount">Amount</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-act btn-act-primary" data-bs-dismiss="modal">Close</button>
                @if ($userSession->tipe_user === 'admin')
                    <button type="button" class="btn-act btn-act-primary"
                        id="declined-withdraws">Declined</button>
                @endif
                <button type="button" class="btn-act btn-act-primary"
                    id="submit-withdraws">{{ $textBtn }}</button>
            </div>
        </div>
    </div>
</div>
