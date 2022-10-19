@extends('layouts.app')

@section('js')
    <script src="{{ asset('js/report/email.js') }}" defer></script>
@endsection

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="row">
                <div class="col-md">
                    <a class="btn btn-outline-primary" href="{{url('/admin/report')}}"><i class="fas fa-times"></i>Back</a>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md">
                    <div class="card">
                        <div class="card-header"><span class="font-weight-bold">Edit Recipient Details</span></div>
                        <form id="email_details_form" action="{{url('email/'.$email->id)}}" method="post">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="card-body">
                            <!-- ____________ FORM __________________ -->

                            @include('includes.forms.emailDetailsForm')

                            <!-- ____________ FORM END __________________ -->
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-success" name="submit" id="emailSubmitBtn">Save</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
