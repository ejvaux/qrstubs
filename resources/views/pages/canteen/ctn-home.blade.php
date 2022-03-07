@extends('layouts.app')

@section('js')
    <script src="{{ asset(mix('/js/canteen.js')) }}" defer></script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <div class="col">
                        @include('emp.canteenScanning')
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        @livewire('canteen-pending-transactions')
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        @include('emp.canteenTotal')
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--@include('emp.canteenScanning')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @livewire('canteen-pending-transactions')
            </div>
        </div>
    </div>
    @include('emp.canteenTotal')--}}
@endsection