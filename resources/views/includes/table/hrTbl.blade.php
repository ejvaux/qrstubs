<div style="overflow-x:auto;">
    <table id="mytable" class="table table-bordred table-striped" style="width:100%;">  
        <thead>
        <tr> &nbsp; &nbsp; 
            <th><i class="fa fa-users"></i>&nbsp; &nbsp; &nbsp;USERNAME</th>
            <th>NAME</th>
            <th>CREDIT AMOUNT</th>
            <th>DEPARTMENT</th>
            <th colspan="2" style="text-align:center">ACTION</th>
        </tr>
        </thead>
        <tbody>
            @if(Auth::check() && Auth::user()->role_id == 1)
                @isset($users)
                    @if ($users->count() > 0)
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->uname}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->credit->amount}}</td>
                                <td>{{$user->department->name}}</td>
                                <td width="150" style="text-align:center">
                                    <button class="btn btn-success" data-myid="{{$user->id}}" data-myuname="{{$user->uname}}" data-myname="{{$user->name}}" data-amount="{{$user->credit->amount}}" data-mydepartment="{{$user->department->name}}"data-toggle="modal" data-target="#editModal" >Edit</button>
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
                    
                @else
                    <td colspan="8">-- ACCOUNT NOT PERMITTED --</td>
            @endif
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