@extends('layouts.app')

@section('js')
    <script src="{{ asset('js/emp/emp.js') }}" defer></script>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><span class="font-weight-bold">EMPLOYEE LIST</span></div>

                <div class="card-body">
                    <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Employee Num.</th>
                                <th scope="col">Name</th>
                                <th scope="col">Position</th>
                                <th scope="col">Credits</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($emps) > 0)
                                @foreach($emps as $emp)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$emp->uname}}</td>
                                        <td>{{$emp->name}}</td>
                                        <td>{{$emp->role}}</td>
                                        <td><input class='form-control form-control-sm' type="text" name="product_number" id="product_number" value="0"></td>
                                        <td><button class="editbtn btn btn-outline-secondary py-0" data-arr="{{$emp}}">Edit</button></td>
                                    </tr>
                                @endforeach
                            @else
                                <p>No Employee Found</p>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('emp.empEditModal')
{{--<div id="printview"></div>--}}
@endsection
