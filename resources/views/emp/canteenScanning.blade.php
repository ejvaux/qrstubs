{{--@extends('layouts.app')

@section('js')
    <script src="{{ asset('js/emp/emp.js') }}" defer></script>
@endsection

@section('content')--}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><span class="font-weight-bold">Canteen Scanning</span></div>

                <div class="card-body">
                    <!-- ____________ FORM __________________ -->

                <div class="form-group row">
                    <div class="col">
                        <div class="row">
                            <div class="col-4">
                                <label for="product_number" class="col-form-label">Enter amount:</label>
                            </div>
                            <div class="col-8">
                                <input class='form-control form-control' type="text" name="product_number" id="product_number">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ____________ FORM END __________________ -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="scanqrBtn" type="button" class="btn btn-primary">Scan QR</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('includes.modal.scanModal')
{{--@endsection--}}
