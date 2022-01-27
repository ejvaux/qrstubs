<div id="transactionConfirmModal" class="modal">
    <div class="modal-dialog modal-sm modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm</h5>
            </div>
            <form class='form_to_submit' id="transactionConfirmForm"  method="POST" action='{{ URL::asset('/export/transaction/download') }}'>
            <input type="hidden" id="canteenId" name="canteenId" value="{{Auth::user()->id}}">
            <input type="hidden" id="transactionId" name="transactionId" value="">
            <div class="modal-body">
                <!-- ____________ FORM __________________ -->
                TEST
                <!-- ____________ FORM END __________________ -->
            </div>
            <div class="modal-footer">
                <button type="button" data-value='1' class="transactionConfirmBtn btn btn-primary">Accept</button>
                <button type="button" data-value='2' class="transactionConfirmBtn btn btn-warning">Cancel</button>
            </div>
            </form>
        </div>
    </div>
</div>