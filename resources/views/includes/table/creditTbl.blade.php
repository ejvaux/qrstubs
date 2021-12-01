<div style="overflow-x:auto;">
    <table id="mytable" class="table table-bordred table-striped" style="width:100%;">  
        <thead>
        <tr> &nbsp; &nbsp; 
            <th><i class="fa fa-users"></i>&nbsp; &nbsp; &nbsp;NAME</th>
            <th>CONTROL NO</th>
            <th>CREDIT AMOUNT</th>
            <th>BALANCE</th>
            <th>EXPIRATION</th>
            <th style="text-align:center">ACTION</th>
        </tr>
        </thead>
        <tbody>
                @isset($users)
                    @if ($users->count() > 0)
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->name}}</td> 
                                @if ($user->credits != NULL)
                                    <td>{{$user->credits->control_no}}</td>
                                    <td>{{$user->credits->amount}}</td>
                                    <td>{{$user->credits->amount - $user->transactions->sum('price')}}</td>
                                    <td>{{$expr}}</td>
                                    <td><button class="btn btn-success" style="padding:0px 4px;" data-myid="{{$user->credits->id}}" data-myname="{{$user->name}}" data-myctrl="{{$user->credits->control_no}}" data-myamount="{{$user->credits->amount}}" data-toggle="modal" data-target="#amountModal" >Edit Credit</button></td>
                                @else
                                    <td>None</td>
                                    <td>None</td>
                                    <td>None</td>
                                    <td>None</td>
                                    <td></td>
                                @endif
                                
                                {{-- <td style="text-align:center">
                                @if ($user->credits != NULL)
                                    @if ($user->credits->control_no == $ctrl)
                                        
                                    @endif
                                @endif
                                                          
                                </td> --}}
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7">NO DATA</td>
                        </tr>
                    @endif
                @else
                    <tr>
                        <td colspan="7">NO DATA</td>
                    </tr>
                @endisset
        </tbody>
    </table>
</div>
<div class="row">
    <div class="col-md">
        @isset($users)
            {{-- {{ $employees->appends(request()->query())->links() }} --}}
            {!! $users->appends(\Request::except('page'))->render() !!}
            {{-- Input::except(array('page')) --}}
        @endisset                        
    </div>    
</div>