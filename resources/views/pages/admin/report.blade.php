@extends('layouts.app')

@section('js')
    <script src="{{ asset('js/admin.js?v=1') }}" defer></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md">
                    @include('includes.messages')
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <a class="btn btn-outline-primary pb-1 m-0" href="{{url('/email/create')}}">Add Email Address</a>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md">
                    <div class="card">
                        <div class="card-header">
                            <span class="font-weight-bold">Cutoff Report Email Settings</span>
                        </div>

                        <div class="card-body">
                            <!-- ____________ FORM __________________ -->

                                @include('includes.table.emailsettingsTbl')

                            <!-- ____________ FORM END __________________ -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--@include('emp.empEditModal')--}}
@endsection
