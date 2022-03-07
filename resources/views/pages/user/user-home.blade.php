@extends('layouts.app')

@section('js')
    <script src="{{ asset('js\user.js') }}" defer></script>
@endsection

@section('content')

<body class="body">
    <div class="container1">
        <div class="row text-center">
            <div class="col">
                <h1 class="p-0 m-0" style="font-family: Avanta Garde; font-size:4rem"><b>{{$user->uname}} </b></h1>
            </div>
        </div>
        <div class="row text-center mt-3">
            <div class="col-md">
                {!! QrCode::size(250)->generate($user->qrcode); !!}
            </div>
        </div>
        <div class="row text-center mt-3">
            <div class="col">
                <button class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#changeQRModal" >CHANGE QR CODE</button>
            </div>
        </div>
        <div class="row text-center mt-2">
            <div class="col">
                <div class="card">
                    <div class="card-header font-weight-bold p-0" style="font-size: 1.8rem">
                      TOTAL BALANCE
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <span id='totalBalance'><span style="font-size: 3.5rem">Loading ...</span></span>
                            </div>
                        </div>
                        <div class="row" style="font-size: 1.5rem">
                            <div class="col">
                                Credits:<br><span id='creditBalance' class="font-weight-bold">----</span>
                            </div>
                            <div class="col">
                                Used:<br><span id='completedBalance' class="font-weight-bold">----</span>
                            </div>
                            <div class="col">
                                Pending:<br><span id='pendingBalance' class="font-weight-bold">---</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                @livewire('user-pending-transactions')
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        Previous Transactions
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col">
                                <div id="usertransact2Table"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('includes.modal.changeQrModal')
    @include('includes.modal.transactionConfirmModal')
</body>

@endsection