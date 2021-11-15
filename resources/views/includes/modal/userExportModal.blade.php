<div id="userExportModal" class="modal">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Export Transactions</h5>
            </div>
            <form class='form_to_submit' id="userExportForm" action='{{ URL::asset('/export/user/download') }}'>
            <div class="modal-body">
                <!-- ____________ FORM __________________ -->
                <div class="form-group row">
                    <div class="col">
                        <div class="row">
                            <div class="col-4">
                                <label for="amount" class="col-form-label">Credit Control No:</label>
                            </div>
                            <div class="col-8">
                                <select class='form-control select2 mt-2' name="ctrl" id="ctrl">
                                    <option value="">- Select Credit - </option>
                                    @isset($credits)
                                        @if ($credits->count() != 0)
                                            @foreach ($credits as $credit)
                                                <option value="{{$credit->control_no}}">{{$credit->control_no}}</option>
                                            @endforeach
                                        @endif
                                    @endisset
                                </select>
                                <span class="invalid-feedback" role="alert">
                                    <strong>Please select credit.</strong>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ____________ FORM END __________________ -->
            </div>
            <div class="modal-footer">
                <button id="userTransactionBtn" type="button" class="btn btn-primary">Download</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>