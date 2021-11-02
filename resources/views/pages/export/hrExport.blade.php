@extends('layouts.app')

@section('js')
    {{--<script src="{{ asset('js/emp/emp.js') }}" defer></script>--}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><span class="font-weight-bold">HR - Export</span></div>

                <div class="card-body">
                    <!-- ____________ FORM __________________ -->

                    <div class="form-group row">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-5">
                                    <label for="product_number" class="col-form-label">Credits:</label>
                                </div>
                                <div class="col-7">
                                    <input class='form-control' type="text" name="product_number" id="product_number">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-5">
                                    <label for="authorized_vendor" class="col-form-label">Authorized Vendor:</label>
                                </div>
                                <div class="col-7">
                                    <input class='form-control' type="text" name="authorized_vendor" id="authorized_vendor">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-5">
                                    <label for="vendor_pn" class="col-form-label">Vendor P/N:</label>
                                </div>
                                <div class="col-7">
                                    <input class='form-control' type="text" name="vendor_pn" id="vendor_pn">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ____________ FORM END __________________ -->
                </div>
            </div>
        </div>
    </div>
</div>
@include('emp.empEditModal')
@endsection
