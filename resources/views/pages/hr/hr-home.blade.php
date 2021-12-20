@extends('layouts.app')

@section('js')
    <script src="{{ asset('js\hr.js') }}" defer></script>
    <script src="{{ asset('js\export\userExport.js') }}" defer></script>
    <script src="{{ asset('js\import\creditImport.js') }}" defer></script>
@endsection

@section('content')
<body class="body">
<div class="container1">
    @if(Auth::check() && Auth::user()->role_id == 1)
    <div class="card text-middle">
        <div class="card-header">
            <div class="row" style="margin: 20px 0px;">
                <div class="col-md-4 text-md-left">
                    <button class="btn btn-success" data-toggle="modal" data-target="#regModal">Register</button>
                </div>
                <div class="col-md-4 text-md-center">
                    <h1>HR</h1>
                </div>
                <div class="col-md-4 text-md-right">
                    {{-- <form id="searchNForm" method="POST">
                    {{ csrf_field() }}
                        <div class="input-group">
                            <input type="search" class="form-control" name="searchtxt"
                                placeholder="Search name here.." > <span class="input-group-btn"></span>
                            <button type="submit" id="sn-search-button" style="
                            height: calc(1.6em + 0.75rem + 2px);">Go</button>
                        </div>
                    </form> --}}
                    <a href="{{ url('/download/Template.xlsx')}}" class="btn btn-success">Template</a></div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#allemp-tab" role="tab">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#allcredit-tab" role="tab">Credits</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#summary-tab" role="tab">Summary</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="allemp-tab" role="tabpanel">
                    @include('pages.hr.empTab')
                </div>
                <div class="tab-pane" id="allcredit-tab" role="tabpanel">
                    @include('pages.hr.creditTab')
                </div>
                <div class="tab-pane" id="summary-tab" role="tabpanel">
                    @include('pages.hr.summaryTab')
                </div>
            </div>
        </div>
        {{-- Register Modal--}}
        <div class="modal modal-primary fade" id="regModal" tabindex="-1" data-backdrop="false" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 style="margin-left:0.83em; margin-top:0.3em; font-size: 1.5em; font-weight: bold;">Register User's Account</h5>
                            <button type="button" name="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="addUserForm" method="POST" action="{{ url('registerUser') }}">
                            @csrf
                        <div class="modal-body">
                            @include('includes.regform')
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="registerBtn" class="btn btn-primary">Save Data</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- End of Registration --}}

            {{-- Editing content--}}

            <div class="modal modal-primary fade" id="editModal" tabindex="-1" data-backdrop="false" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 style="margin-left:0.83em; margin-top:0.3em; font-size: 1.5em; font-weight: bold;">Edit Employee Data</h5>
                            <button type="button" name="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form id="editUserForm" action="{{route('hrc.update','test')}}" method="POST">
                                {{csrf_field()}}
                                {{method_field('patch')}}
                            <div class="modal-body">
                                @include('includes.editform')
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            {{--End of editing --}}

            {{-- Editing Amount Content--}}

            <div class="modal modal-primary fade" id="amountModal" tabindex="-1" data-backdrop="false" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 style="margin-left:0.83em; margin-top:0.3em; font-size: 1.5em; font-weight: bold;">Edit Credit Amount</h5>
                            <button type="button" name="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form id="editAmountForm" method="POST" action="{{ url('updateAmount') }}">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                                    <div class="col-md-7">
                                        <input type="hidden" name="credit_id" id="cred_id" value="">
                                        <input disabled id="name" name="name" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="control_no" class="col-md-4 col-form-label text-md-right">Control No.</label>

                                    <div class="col-md-7">
                                            <input disabled id="ctrl" name="ctrl" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="amount" class="col-md-4 col-form-label text-md-right">Credit Amount</label>
                                    <div class="col-md-7">
                                            <input id="amount" name="amount" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            {{--End of editing --}}


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

