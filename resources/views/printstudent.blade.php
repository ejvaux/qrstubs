@extends('layouts.app')

@section('js')
<script src="{{ asset('js/print.js') }}" defer></script>
@endsection

@section('content')
<center>
    <br><br>
    <a href="{{ url('/prnpreview') }}" class="btnprn btn">Print Preview</a></center>
<h1>Course List </h1>
<table class="table">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Course</th>
    </tr>
    @foreach($students as $student)
    <tr>
        <td>{{ $student->id }}</td>
        <td>{{ $student->name }}</td>
        <td>{{ $student->email }}</td>
        <td>{{ $student->course }}</td>
    </tr>
    @endforeach
    </center>
    @endsection