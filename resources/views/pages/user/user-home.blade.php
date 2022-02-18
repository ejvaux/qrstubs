@extends('layouts.app')

@section('js')
    <script src="{{ asset('js\user.js') }}" defer></script>
@endsection

@section('content')

<body class="body">
    <div class="container1">
        <div class="row text-center">
            <div class="col">
                <h1 class="p-0 m-0" style="font-family: Avanta Garde; font-size:4rem"><b>{{$user->uname}} </b></h1><br>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-md"></div>
            <div class="col-md">
                {!! QrCode::size(250)->generate($user->qrcode); !!}
            </div>
            <div class="col-md"></div>
        </div>
        <div class="row text-center mt-3">
            <div class="col">
                <button class="btn btn-success px-5" data-toggle="modal" data-target="#changeQRModal" >Change QRCode</button>
            </div>
        </div>
        <div class="row text-center mt-3">
            {{--<div class="col"></div>--}}
            <div class="col">
                {{--<h1 style="font-family: Avanta Garde; color:blue; font-size:3rem">
                    <b> Balance:<span id='userBalance'>{{$balance}}</span> </b>
                </h1>--}}
                <div class="card" style="font-size: 1.8rem">
                    <div class="card-header font-weight-bold p-0">
                      TOTAL BALANCE
                    </div>
                    <div class="card-body">
                        {{--<h1 style="font-family: Avanta Garde; color:blue;">
                            <b> REMAINING: <span id='userBalance'>{{$balance}}</span> </b>
                        </h1>--}}
                        <div class="row">
                            <div class="col">
                                <span id='totalBalance' style="font-size: 3.5rem">Loading ...</span>
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
            {{--<div class="col"></div>--}}
        </div>
        @livewire('user-pending-transactions')
        <br><br>
        <h4>Last 3 transactions</h4>
        <div id="usertransact2Table">
            {{-- // TABLE DIRECT JS User Transaction --}}
            {{-- @include('includes.table.user2Tbl') --}}
        </div>
    </div>

    {{-- Share Credit Modal--}}
    <div class="modal modal-primary fade" id="shareModal" tabindex="-1" data-backdrop="false" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="margin-left:0.83em; margin-top:0.3em; font-size: 1.5em; font-weight: bold;">Share Credit Amount</h5>
                    <button type="button" name="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="shareCreditForm" method="POST" >
                    @csrf
                <div class="modal-body">
                    @include('includes.sharecredit')
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="generatedBtn" class="btn btn-primary">Generate</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Change QR Modal--}}
    <div class="modal modal-primary fade" id="changeQRModal" tabindex="-1" data-backdrop="false" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <div class="col-md-3"></div> --}}
                    <div class="col-md-4"><h4><b>CONFIRMATION</b></h4></div>
                    <button type="button" name="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="changeQRForm" method="POST" action="{{ url('generateQR') }}" >
                    @csrf
                <div class="modal-body">
                    <input type="hidden" name="employee_id" id="emp_id" value="{{Auth::user()->id}}">
                    <input type="hidden" name="username" id="uname" value="{{Auth::user()->uname}}">
                    <h4>Are you sure you want to change your QR code?</h4>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success mr-auto" type="submit" id="newQrBtn" >Yes, Definitely!</button>
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button></div>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>
@include('includes.modal.transactionConfirmModal')
<footer style="position:absolute; width:100%;">
    @include('includes.footer')
</footer>


@endsection