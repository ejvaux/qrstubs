@extends('layouts.app')

@section('js')
    <script src="{{ asset('js\ctn.js') }}" defer></script>
@endsection

@section('content')
<body class="body">
    <div class="container1">
        <div class="card text-middle">
            <div class="card-header">
                <div class="row" style="margin: 20px 0px;">
                    <div class="col-md">
                        <h1 style="text-align:center;">Transactions</h1>
                    </div> 
                </div>
            </div>
            <div class="card-body">
                <div id="canteenTable">
                    {{-- // TABLE DIRECT JS SUPERVISOR --}}
                </div>
            </div>
        </div>

    </div> 
</body>
<footer style="position:absolute; width:100%;">
    @include('includes.footer')
</footer>


@endsection