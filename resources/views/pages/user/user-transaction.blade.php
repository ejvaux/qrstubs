@extends('layouts.app')

@section('js')
    <script src="{{ asset('js\user.js') }}" defer></script>
@endsection

@section('content')
<body class="body">
    <div class="container1">
        @if(Auth::check() && Auth::user()->role_id == 3)
        <div class="card text-middle">
            <div class="card-header">
                <div class="row" style="margin: 20px 0px;">
                    <div class="col-md">
                        <h1 style="text-align:center;">Transactions</h1>
                    </div> 
                </div>
            </div>
            <div class="card-body">
                <div id="usertransactTable">
                    {{-- // TABLE DIRECT JS User Transaction --}}
                    {{-- @include('includes.table.userTbl') --}}
                </div>
            </div>
            
        </div>
        @else
            <div class="row justify-content-center" style="margin-bottom: 15%;">
                <p style="font-size:40px">* YOU DON'T HAVE ACCESS</p>
            </div>
        @endif

    </div> 
</body>

<footer style="position:absolute; width:100%;">
    @include('includes.footer')
</footer>


@endsection