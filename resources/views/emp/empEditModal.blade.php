<div id="editModal" class="modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit</h5>
            </div>
            <form class='form_to_submit' id="add_new_comp_form"  method="POST" action='{{url("components")}}'>
            <input type="hidden" id="user_id" name="user_id">
            <div class="modal-body">
                <!-- ____________ FORM __________________ -->

                <div class="form-group row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-5">
                                <label for="product_number" class="col-form-label">Credits:</label>
                            </div>
                            <div class="col-7">
                                <input class='form-control form-control' type="text" name="product_number" id="product_number">
                            </div>
                        </div>
                    </div>
                    {{--<div class="col-6">
                        <div class="row">
                            <div class="col-5">
                                <label for="authorized_vendor" class="col-form-label">Authorized Vendor:</label>
                            </div>
                            <div class="col-7">
                                <input class='form-control form-control' type="text" name="authorized_vendor" id="authorized_vendor">
                            </div>
                        </div>
                    </div>--}}
                </div>
                {{--<div class="form-group row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-5">
                                <label for="vendor_pn" class="col-form-label">Vendor P/N:</label>
                            </div>
                            <div class="col-7">
                                <input class='form-control form-control' type="text" name="vendor_pn" id="vendor_pn">
                            </div>
                        </div>
                    </div>
                </div>--}}
                <!-- ____________ FORM END __________________ -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="printNow" type="button" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>