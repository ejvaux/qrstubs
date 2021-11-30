@extends('layouts.app')



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body" > 
                    <form method="POST" action="{{ route('register') }}">
                        @csrf


                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>
                            
                            <div class="col-md-6">
                                <input id="uname" type="text" class="form-control{{ $errors->has('uname') ? ' is-invalid' : '' }}" placeholder="*Company ID No." value="{{ old('uname') }}" name="uname" required autofocus>
                                @if ($errors->has('uname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('uname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="*Email" value="{{ old('email') }}" name="email" autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="*Full name" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        <input type="hidden" id="qrcode" name="qrcode" value=" ">
                        

                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>
                            <div class="col-md-6">
                            <select id="role_id" name="role_id" class="form-control{{ $errors->has('role_id') ? ' is-invalid' : '' }}" value="{{ old('role_id') }}" required autofocus>
                                    <option value=" "class="" selected disabled>-- Select Role --</option>
                                    @foreach ($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}} </option>
                                    @endforeach
                            </select>
                                @if ($errors->has('role'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>    
                        <div class="form-group row">
                            <label for="department" class="col-md-4 col-form-label text-md-right">{{ __('Department') }}</label>
                            <div class="col-md-6">
                                <select id="department_id" name="department_id" class="form-control{{ $errors->has('department_id') ? ' is-invalid' : '' }}" value="{{ old('department_id') }}" required autofocus>
                                    <option value=" " class="hidden" selected>-- Select Department --</option>
                                    @foreach ($departments as $department)
                                        <option value="{{$department->id}}">{{$department->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>       
                            
                        <div class="form-group row">
                            <label for="canteen" class="col-md-4 col-form-label text-md-right">{{ __('Canteen') }}</label>
                            <div class="col-md-6">
                                <select id="canteen_id" name="canteen_id" class="form-control{{ $errors->has('canteen') ? ' is-invalid' : '' }}" value="{{ old('canteen') }}" required autofocus>
                                    <option value=" " class="hidden" selected>-- Select Canteen --</option>
                                    @foreach ($canteens as $canteen)
                                        <option value="{{$canteen->id}}">{{$canteen->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>             

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
