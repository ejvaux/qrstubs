<div style="overflow-x:auto;">
    <table id="mytable" class="table table-bordred table-striped" style="width:100%;">  
        <thead>
        <tr> &nbsp; &nbsp; 
            <th><i class="fa fa-users"></i>&nbsp; &nbsp; &nbsp;USERNAME</th>
            <th>NAME</th>
            <th>CREDIT</th>
            <th>ROLE</th>
            <th>DEPARTMENT</th>
            <th colspan="2" style="text-align:center">ACTION</th>
        </tr>
        </thead>
        <tbody>
            @if(Auth::check() && Auth::user()->role_id == 1)
                @isset($employees)
                    @if ($employees->count() > 0)
                        @foreach ($employees as $employee)
                            <tr>
                                <td>{{$employee->name}}</td>
                                <td>{{$employee->gender}}</td>
                                <td>{{$employee->email}}</td>
                                <td>{{$employee->phone}}</td>
                                <td>{{$employee->position->name}}</td>
                                <td>{{$employee->department->name}}</td>
                                <td width="150" style="text-align:center">
                                    <button class="btn btn-success" data-myid="{{$employee->id}}" data-myname="{{$employee->name}}" data-myemail="{{$employee->email}}" data-myphone="{{$employee->phone}}" data-myposition="{{$employee->position->name}}" data-mydepartment="{{$employee->department->name}}"data-toggle="modal" data-target="#editModal" >Edit</button>
                                    <button class="btn btn-danger" data-myid="{{$employee->id}}" data-toggle="modal" data-target="#deleteModal" >Delete</button>                                   
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
        @isset($employees)
            {{-- {{ $employees->appends(request()->query())->links() }} --}}
            {!! $employees->appends(\Request::except('page'))->render() !!}
            {{-- Input::except(array('page')) --}}
        @endisset                        
    </div>    
</div>