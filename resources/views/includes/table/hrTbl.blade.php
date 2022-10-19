<div class="row" style="overflow-x:auto;">
    <div class="col-md">
        <table id="mytable" class="table table-bordred table-striped" style="width:100%;">
            <thead>
            <tr>
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
                                        <td><span class="badge badge-success">Active</span></td>
                                    @else
                                        <td><span class="badge badge-danger">Inactive</span></td>
                                    @endif
                                    <td>{{$user->uname}}</td>
                                    @isset($user->email)
                                        <td>{{$user->email}}</td>
                                    @else
                                        <td>N/A</td>
                                    @endisset
                                        <td>{{$user->name}}</td>
                                    @isset($user->department->name)
                                        <td>{{$user->department->name}}</td>
                                    @else
                                        <td>N/A</td>
                                    @endisset
                                    <td style="text-align:center">
                                        <button class="btn btn-outline-primary py-0" data-myid="{{$user->id}}" data-myemail="{{$user->email}}" data-myuname="{{$user->uname}}" data-myname="{{$user->name}}" data-mydepartment="{{$user->department_id}}" data-mystatus="{{$user->status}}" data-toggle="modal" data-target="#editModal" >Edit</button>
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