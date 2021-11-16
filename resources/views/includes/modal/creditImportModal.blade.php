<div id="creditImportModal" class="modal">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Transactions</h5>
            </div>
            <form class='form_to_submit' id="creditImportForm" action='{{ URL::asset('/import/credits') }}'>
            <div class="modal-body">
                <!-- ____________ FORM __________________ -->
                <div class="form-group row">
                    {{--<div class="col">
                        <div class="row">
                            <div class="col-4">
                                <label for="amount" class="col-form-label">Select File:</label>
                            </div>
                            <div class="col">
                                <input type="file" name="userImportFile" id="userImportFile">
                                <span class="invalid-feedback" role="alert">
                                    <strong>Please select credit.</strong>
                                </span>
                            </div>
                        </div>
                    </div>--}}
                    <div class="col">
                        <input type="file" name="userImportFile" id="userImportFile">
                        <span class="invalid-feedback" role="alert">
                            <strong>Please select credit.</strong>
                        </span>
                    </div>
                </div>
                {{--<div class="row">
                    <div class="col">
                        <div id="upAlert" class="alert alert-success" style="display: none" role="alert">
                        </div>
                    </div>
                </div>--}}
                <!-- ____________ FORM END __________________ -->
            </div>
            <div class="modal-footer">
                <button id="creditUploadBtn" type="button" class="btn btn-primary">Upload</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>