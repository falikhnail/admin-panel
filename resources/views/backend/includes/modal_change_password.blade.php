<div class="modal fade" id="m_change_pw" tabindex="-1" aria-labelledby="ModalChangePassword" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('backend.change_password') }}" method="POST" id="form-change-password"
                class="needs-validation" novalidate>
                <div class="modal-header">
                    <h4 class="modal-title">Change Current Password</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Type New Password" required>
                                <label for="password">New Password</label>
                                <div class="invalid-feedback" id="invalid-pw">
                                    Please Fill Password
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="retype-password" name="retype-password"
                                    placeholder="Type New Password" required>
                                <label for="retype-password">Retype Password</label>
                                <div class="invalid-feedback" id="invalid-retype">
                                    Please Fill Retype-Password
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-act btn-act-primary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn-act btn-act-primary" id="btn-change-pw">Apply</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#password, #retype-password').on('keyup', (event) => {
        if ($('#password').val().length < 4 || $('#retype-password').val().length < 4) {
            $('#password').removeClass('is-valid').addClass('is-invalid')
            $('#retype-password').removeClass('is-valid').addClass('is-invalid')

            $('.invalid-feedback').text("Password doesn't match. Min char is 4")
        } else {
            if ($('#password').val() != $('#retype-password').val()) {
                $('#password').removeClass('is-valid').addClass('is-invalid')
                $('#retype-password').removeClass('is-valid').addClass('is-invalid')

                $('.invalid-feedback').text("Password doesn't match")
            } else {
                $('#password').removeClass('is-invalid').addClass('is-valid')
                $('#retype-password').removeClass('is-invalid').addClass('is-valid')
            }
        }

        $('#btn-change-pw').prop('disabled', $('.invalid-feedback').is(':visible'))
    })
</script>
