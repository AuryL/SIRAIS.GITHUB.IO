@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
				<div class="col-md-8">
					<div class="card">						
						<div class="card-header"> <strong> INICIO DE SESIÃ“N </strong></div>
							<div class="div_login">
                    <form id="form_login" class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
						{{ csrf_field() }}
						@if(session()->has('login_error'))
							<div class="alert alert-success">
								{{ session()->get('login_error') }}
							</div>
						@endif

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}" align="middle">
                            <label class="col-md-4 control-label"><strong>Expediente</strong></label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="username" value="{{ old('username') }}">

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}" align="middle">
                            <label class="col-md-4 control-label"><strong>Password</strong></label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group" align="middle"> 
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Recordarme
                                    </label>
                                </div>
                            </div>
                        </div>
						
                        <div class="form-group" align="middle">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i>Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">Olvidaste tu contraseÃ±a?</a>
                            </div>
                        </div>
                    </form>
					        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection