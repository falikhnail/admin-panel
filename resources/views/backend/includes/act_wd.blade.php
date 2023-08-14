<div class="text-center">
    <?php
    if ($wd->status === 'approved') {
        $text = 'View Approval';
    } elseif ($wd->status === 'pending') {
        $text = $userSession->tipe_user === 'admin' ? 'Approve' : 'Request Approval';
    } elseif ($wd->status === 'rejected') {
        $text = $userSession->tipe_user === 'admin' ? 'View Rejected' : 'Resubmit Approval';
    } else {
        $text = 'Info';
    }
    ?>
    <a class='btn-act btn-act-primary btn-act-md' data-toggle="tooltip" title="Print" data-json="{{ json_encode($wd) }}" data-balance="{{ $balance }}" data-url-invoice="{{ $urlInvoice }}" href="javascript:;"  id="btn-approval">
        {{ $text }}
    </a>
</div>
