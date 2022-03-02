@extends('layouts.app')

@section('js')
    <script src="{{ asset(mix('/js/canteen.js')) }}" defer></script>
@endsection

@section('content')
    @include('emp.canteenScanning')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @livewire('canteen-pending-transactions')
            </div>
        </div>
    </div>
    @include('emp.canteenTotal')
@endsection