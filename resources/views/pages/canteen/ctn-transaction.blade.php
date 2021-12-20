@extends('layouts.app')

@section('js')
    <script src="{{ asset('js\ctn.js') }}" defer></script>
    <script src="{{ asset(mix('/js/cntnExport.js')) }}" defer></script>
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
                <div class="row">
                    <div class="col"></div>
                    <div class="col-3 text-right">
                        <button id="trnsctBtn" class="btn btn-outline-secondary">Export</button>
                    </div>
                </div>
                <div class="row mt-0">
                    <div class="col">
                        <div id="canteenTable">
                            {{-- // TABLE DIRECT JS SUPERVISOR --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
@include('includes.modal.transactionExportModal')
<footer style="position:absolute; width:100%;">
    @include('includes.footer')
</footer>


@endsection