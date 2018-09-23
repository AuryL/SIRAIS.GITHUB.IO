@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- <div class="col-md-8"> -->
            <div class="card">
                <div class="card-header"><strong>{{ __('MODIFICAR USUARIO') }}</strong></div>
                <br>
                <div class="card-body">
                    
                    <form id="form_register" method="POST" action="{{ route('us_modificar') }}">
                    
                        <div id="div_flex_modificar_expediente">
                            <label class="col-form-label text-md-right">Selecciona el expediente del usuario que deseas consultar/modificar: </label>
                            <br> <br> <br>
                            <!-- Seleccionar el expediente del usuario que se desea Modificar -->
                            <div id="div_modificar_expediente" class="form-group{{ $errors->has('usernameSelected') ? ' has-error' : '' }}">
                                <select id="usernameSelected" name="usernameSelected" class="form-control" onchange="expedienteSelected(this.value)" required>
                                    <option selected value="0" disabled="disabled" > Expediente </option>                               
                                    @foreach($usuarios as $usuario => $value)
                                        <option id="usernameSelected" value="{{ $value->username }}">{{ $value->username }}</option>  
                                    @endforeach  
                                </select>
                                <br>
                                @if ($errors->has('usernameSelected'))
                                    <span class="invalid-feedback">
                                        <label class="label-texto"><strong>{{ $errors->first('usernameSelected') }}</strong></label>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @csrf


                        <div id="div_flex">
                            <!-- Expediente -->
                            <!-- <div class="form-group row"> -->
                            <div class="div_register_usernameName">
                                <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Expediente: ') }}</label>

                                <div class="div_register_usernameName">
                                    <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus pattern="[A-Za-z0-9]+">

                                    @if ($errors->has('username'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Nombre -->
                            <div class="div_register_usernameName">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre: ') }}</label>

                                <div class="div_register_usernameName">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus pattern="[A-Za-z]+">

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div id="div_flex">
                            <!-- Apellido Paterno -->
                            <div class="div_register_usernameName">
                                <label for="us_apellidopat" class="col-md-4 col-form-label text-md-right">{{ __('Apellido Paterno: ') }}</label>

                                <div class="div_register_usernameName">
                                    <input id="us_apellidopat" type="text" class="form-control{{ $errors->has('us_apellidopat') ? ' is-invalid' : '' }}" name="us_apellidopat" value="{{ old('us_apellidopat') }}" required autofocus pattern="[A-Za-z]+">

                                    @if ($errors->has('us_apellidopat'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('us_apellidopat') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Apellido Materno -->
                            <div class="div_register_usernameName">
                                <label for="us_apellidomat" class="col-md-4 col-form-label text-md-right">{{ __('Apellido Materno') }}</label>

                                <div class="div_register_usernameName">
                                    <input id="us_apellidomat" type="text" class="form-control{{ $errors->has('us_apellidomat') ? ' is-invalid' : '' }}" name="us_apellidomat" value="{{ old('us_apellidomat') }}" required autofocus pattern="[A-Za-z]+">

                                    @if ($errors->has('us_apellidomat'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('us_apellidomat') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div id="div_flex">
                            <!-- Extensión -->
                            <div class="div_register_usernameName">
                                <label for="us_extension" class="col-md-4 col-form-label text-md-right">{{ __('Extensión: ') }}</label>

                                <div class="div_register_usernameName">
                                    <input id="us_extension" type="text" class="form-control{{ $errors->has('us_extension') ? ' is-invalid' : '' }}" name="us_extension" value="{{ old('us_extension') }}" required autofocus pattern="[0-9]+">

                                    @if ($errors->has('us_extension'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('us_extension') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="div_register_usernameName">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email: ') }}</label>

                                <div class="div_register_usernameName">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div id="div_flex">
                            <!-- Perfil -->
                            <div id="div_register_usernameName" class="form-group{{ $errors->has('per_id') ? ' has-error' : '' }}">

                                <label for="per_id" class="col-md-4 col-form-label text-md-right">{{ Form::label('per_id', 'Perfil: ') }}</label>

                                <select id="per_id" name="per_id" class="form-control" required>
                                    <option selected value="0" disabled="disabled" > Perfil </option>                               
                                    @foreach($perfiles as $perfil => $value)
                                        <option value="{{ $value->per_id }}">{{ $value->per_nombre_es }}</option>  
                                    @endforeach  
                                </select>
                                <br>
                                @if ($errors->has('per_id'))
                                    <span class="invalid-feedback">
                                        <label class="label-texto"><strong>{{ $errors->first('per_id') }}</strong></label>
                                    </span>
                                @endif
                            </div>

                            <!-- Dominio -->
                            <div id="div_register_usernameName" class="form-group{{ $errors->has('dom_id') ? ' has-error' : '' }}">

                                <label for="dom_id" class="col-md-4 col-form-label text-md-right">{{ Form::label('dom_id', 'Dominio: ') }}</label>

                                <select id="dom_id" name="dom_id" class="form-control" required>
                                    <option selected value="0" disabled="disabled" > Dominio </option>
                                    @foreach($dominios as $dominio => $value)
                                        <option value="{{ $value->dom_id }}">{{ $value->dom_nombre_es }}</option>  
                                    @endforeach                           
                                                                    
                                </select>
                                <br>
                                @if ($errors->has('dom_id'))
                                    <span class="invalid-feedback">
                                        <label class="label-texto"><strong>{{ $errors->first('dom_id') }}</strong></label>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- <div id="div_flex">                         -->
                        <!-- Password -->
                            <!-- <div class="div_register_usernameName">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña: ') }}</label>

                                <div class="div_register_usernameName">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> -->

                            <!-- Confirmar Password -->
                            <!-- <div class="div_register_usernameName">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña: ') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div> -->
                        <!-- </div> -->



                        <div id="div_flex">
                            <!-- Estado -->
                            <div class="div_register_usernameName">
                                <label for="us_estado" class="col-md-4 col-form-label text-md-right">{{ __('Activo: ') }}</label>

                                <div class="div_register_usernameName">
                                    <input type="checkbox" value="1" id="us_estado" name="us_estado">

                                    @if ($errors->has('us_estado'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('us_estado') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        

                        <div id="div_boton_registrar" class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="boton_modificar" onclick="validar()" type="submit" class="btn btn-primary" disabled="true">
                                    {{ __('Modificar') }}
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




