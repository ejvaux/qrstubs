<div id="transactionExportModal" class="modal">
    <div class="modal-dialog modal-lg modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Export Transactions</h5>
            </div>
            <form class='form_to_submit' id="transactionExportForm"  method="POST" action='{{ URL::asset('/export/transaction/download') }}'>
            <input type="hidden" id="canteenId" name="canteenId" value="{{Auth::user()->canteen_id}}">
            <div class="modal-body">
                <!-- ____________ FORM __________________ -->

                <div class="row">
                    <div class="col-6">
                        <label for="fromDate" class="col-form-label col-form-label-lg">Date</label>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">From</div>
                            </div>
                            <input type="date" class="form-control" id="fromDate" name="fromDate" value="{{Date('Y-m-d')}}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">To</div>
                            </div>
                            <input type="date" class="form-control" id="toDate" name="toDate" value="{{Date('Y-m-d')}}">
                        </div>
                    </div>
                </div>
                <!-- ____________ FORM END __________________ -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="exportTransactionBtn" type="button" class="btn btn-primary">Download</button>
            </div>
            </form>
        </div>
    </div>
</div>