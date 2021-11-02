<div style="overflow-x:auto;">
    <table id="mytable" class="table table-bordred table-striped" style="width:100%;">  
        <thead>
        <tr> &nbsp; &nbsp; 
            <th><i class="fa fa-users"></i>&nbsp; &nbsp; &nbsp;USERNAME</th>
            <th>NAME</th>
            <th>DEPARTMENT</th>
            <th>CREDIT AMOUNT</th>
            {{-- <th>BALANCE</th> --}}
            <th colspan="3" style="text-align:center">ACTION</th>
        </tr>
        </thead>
        <tbody>
                @isset($users)
                    @if ($users->count() > 0)
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->uname}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->department->name}}</td>
                                @if ($user->latest_credit->control_no == $ctrl)
                                    <td>{{$user->latest_credit->amount}}</td>
                                @elseif($user->latest_credit->control_no == NULL)
                                    <td>0</td>
                                @endif
                                <td colspan="3" style="text-align:center">
                                    <button class="btn btn-primary" data-myid="{{$user->id}}" data-myuname="{{$user->uname}}" data-myname="{{$user->name}}" data-mydepartment="{{$user->department_id}}"data-toggle="modal" data-target="#editModal" >Info</button>
                                    <button disabled class="btn btn-success" data-myid="{{$user->id}}" data-myname="{{$user->name}}" data-toggle="modal" data-target="#amountModal" >Amount</button>
                                    <button class="btn btn-danger" data-myid="{{$user->id}}" data-toggle="modal" data-target="#deleteModal" >Delete</button>                                   
                                </td>
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