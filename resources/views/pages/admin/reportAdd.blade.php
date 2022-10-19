@extends('layouts.app')

@section('js')
    <script src="{{ asset('js/report/email.js') }}" defer></script>
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center mt-2">
        <div class="col-md-5">
            <div class="row">
                <div class="col-md">
                    <a class="btn btn-outline-primary" href="{{url('/admin/report')}}"><i class="fas fa-times"></i>Back</a>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md">
                    <div class="row">
                        <div class="col-md">
                            <div class="card">
                                <div class="card-header"><span class="font-weight-bold">Add Recipient</span></div>
                                <form id="email_details_form" action="{{url('email')}}" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="card-body">
                                    <!-- ____________ FORM __________________ -->

                                    @include('includes.forms.emailDetailsForm')

                                    <!-- ____________ FORM END __________________ -->
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-outline-success" name="submit" id="emailSubmitBtn"><i class="far fa-save"></i> Submit</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
