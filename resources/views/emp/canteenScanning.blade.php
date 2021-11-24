{{--@extends('layouts.app')

@section('js')
    <script src="{{ asset('js/emp/emp.js') }}" defer></script>
@endsection

@section('content')--}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span class="font-weight-bold" style="font-size:1rem">CANTEEN SCANNING</span>
                    {{--<div class="row">
                        <div class="col">
                            <span class="font-weight-bold" style="font-size: 10 rem">Canteen Scanning</span>
                        </div>
                        <div class="col">
                            <select id="cameraSelect" name="camera" class="form-control" disabled>
                                <option value="check">Loading Cameras . . .</option>
                            </select>
                        </div>
                    </div>--}}
                </div>

                <div class="card-body">
                    <!-- ____________ FORM __________________ -->
                <div class="form-group row">
                    <div class="col">
                        <select id="cameraSelect" name="camera" class="form-control" disabled>
                            <option value="check">Loading Cameras . . .</option>
                        </select>
                    </div>
                </div>

                <div id="noscan">
                    <div class="row">
                        <div class="col text-center">
                            <span id="msg">* * * PLEASE SCAN QR CODE * * *</span>
                        </div>
                    </div>
                </div>
                <div id="scan" class="d-none scan">
                    <input id="empId" type="hidden" name="userId">
                    <div class="form-group row">
                        <div class="col">
                            <div class="row">
                                <div class="col-4">
                                    <label for="empNum" class="col-form-label">Employee #:</label>
                                </div>
                                <div class="col-8">
                                    <input class='form-control form-control-lg' type="text" name="empNum" id="empNum" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <div class="row">
                                <div class="col-4">
                                    <label for="empName" class="col-form-label">Name:</label>
                                </div>
                                <div class="col-8">
                                    <input class='form-control form-control-lg' type="text" name="empName" id="empName" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <div class="row">
                                <div class="col-4">
                                    <label for="empDept" class="col-form-label">Department:</label>
                                </div>
                                <div class="col-8">
                                    <input class='form-control form-control-lg' type="text" name="empDept" id="empDept" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <div class="row">
                                <div class="col-4">
                                    <label for="amount" class="col-form-label">Enter amount:</label>
                                </div>
                                <div class="col-8">
                                    <input class='form-control form-control-lg' min="0" type="number" name="amount" id="amount" onkeyup="if(this.value<0){this.value= this.value * -1}" oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null">
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Please type the amount.</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ____________ FORM END __________________ -->
                </div>
                <div class="modal-footer text-center">
                    <button id="transactBtn" type="button" class="btn btn-success scan d-none">TRANSACT</button>
                    <button id="scanqrBtn" type="button" class="btn btn-primary">SCAN</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('includes.modal.scanModal')
{{--@endsection--}}
