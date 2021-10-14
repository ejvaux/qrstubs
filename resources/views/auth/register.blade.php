@extends('layouts.app')

@section('js')
    <script src="{{ asset('js\reg.js') }}" defer></script>
@endsection

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
                                <input id="uname" type="text" class="form-control{{ $errors->has('uname') ? ' is-invalid' : '' }}" value="{{ old('uname') }}" name="uname" required autofocus>
                                @if ($errors->has('uname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('uname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        <input type="hidden" name="qrcode">
                        <input type="hidden" name="credit_id">

                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                            <div class="col-md-6">
                                <div class="row" style="font-size: 15px; margin-top: 8px;">
                                    <div class="col-md-3">
                                        <input type="radio" name="role" value="hr" checked/> HR
                                    </div>
                                    <div class="col-md-5">
                                        <input type="radio" name="role" value="canteen" />  Canteen
                                    </div>
                                    <div class="col-md-4">
                                        <input type="radio" name="role" value="user" />  User
                                    </div>
                                </div>
                                
                                <div class="canteen select" style="display:none;">
                                    <select id="canteen" name="canteen" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                        <option class="hidden" selected disabled>-- Select Canteen --</option>
                                        <option class="" >Canteen1</option>
                                        <option class="" >Canteen2</option>
                                    </select>
                                </div>
                                <div class="user select" style="display:none;">
                                    <select id="department" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" name="department"  required autofocus>
                                        <option class="hidden" selected disabled>-- Select Department --</option>
                                        <option class="" >Taiwanase Sup</option>
                                        <option class="" >Chinese Sup</option>
                                    </select>
                                </div>
                                
                                
                                
                                <!-- <select id="role" name="role"  class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}"  required autofocus>
                                    <option class="hidden" selected disabled>-- Select Role --</option>
                                    
                                </select>
                                @if ($errors->has('role'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                @endif -->
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
