@extends('layouts.app')

@section('js')
{{--<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery-2.2.4.min.js"></script>--}}
<script type="text/javascript" src="js/jquery.printPage.js"></script>
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

                    <button>print</button>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
