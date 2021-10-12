@extends('layouts.app')

@section('js')
{{--<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery-2.2.4.min.js"></script>--}}
{{--<script type="text/javascript" src="js/jquery.printPage.js"></script>--}}
<script src="{{ asset('js/printThis.js') }}" defer></script>
{{--<script src="{{ asset('js/print/printstub.js') }}" defer></script>--}}
<script src="{{ asset('js/print/printpage.js') }}" defer></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Print</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{--<a class="btn btn-outline-secondary" href="{{ url('test') }}">print</a>--}}
                    <a id="prnt" class="btn btn-outline-secondary" href="#">Print Stubs</a>
                </div>
            </div>
        </div>
    </div>
</div>
@include('print.printModal')
{{--<div id="printview"></div>--}}
@endsection
