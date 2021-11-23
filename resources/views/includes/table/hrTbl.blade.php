<div style="overflow-x:auto;">
    <table id="mytable" class="table table-bordred table-striped" style="width:100%;">  
        <thead>
        <tr> &nbsp; &nbsp; 
            <th>STATUS</th>
            <th>USERNAME</th>
            <th>EMAIL</th>
            <th>NAME</th>
            <th>DEPARTMENT</th>
            <th style="text-align:center">ACTION</th>
        </tr>
        </thead>
        <tbody>
                @isset($users)
                    @if ($users->count() > 0)
                        @foreach ($users as $user)
                            <tr>
                                @if ($user->status ==0)
                                    <td><button class="btn btn-success" style="padding:0px 5px;">Active</button></td>
                                @else
                                    <td><button class="btn btn-danger" style="padding:0px 5px;">Inactive</button></td>
                                @endif
                                <td>{{$user->uname}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->department->name}}</td>
                                <td style="text-align:center">
                                    <button class="btn btn-primary" style="padding:0px 4px;" data-myid="{{$user->id}}" data-myemail="{{$user->email}}" data-myuname="{{$user->uname}}" data-myname="{{$user->name}}" data-mydepartment="{{$user->department_id}}" data-mystatus="{{$user->status}}" data-toggle="modal" data-target="#editModal" >Edit Info</button>    
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