@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- <div class="col-md-8"> -->
            <div class="card">
                <div class="card-header"><strong>{{ __('ALTA RIESGO') }}</strong></div>
                <br>
                <div class="card-body">

                    <form id="form_register" method="POST" action="{{ route('rgo_alta') }}">
                        @csrf
                        <br>
                        <div id="div_flex_modificar_expediente">
                            <label class="col-form-label">Como {{ $userPerfil->per_nombre_es }} tienes los permisos para dar de alta Riesgos. Porfavor complete los campos solicitados correctamente: </label>                            
                            <div id="div_boton_registrar" class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button id="boton_alta" onclick="validarRgo()" type="submit" class="btn btn-primary">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('Alta ') }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </button>
                                </div>
                            </div>
                        </div>
                        <br>

                        <!-- **** NOMBRE **** -->
                        <div id="div_flex_dom">
                            <!-- Español -->
                            <label id="label_dom" for="rgo_nombre_es"><strong>{{ __('NOMBRE: ') }}</strong></label>

                            <div class="div_register_usernameName">
                                <label for="rgo_nombre_es" class="col-md-4 col-form-label text-md-right">{{ __(' Español: ') }}</label>

                                <div class="div_register_usernameName">
                                    <input id="rgo_nombre_es" type="text" class="form-control{{ $errors->has('rgo_nombre_es') ? ' is-invalid' : '' }}" name="rgo_nombre_es" value="{{ old('rgo_nombre_es') }}" required autofocus pattern="[A-Za-z0-9]+[\$%&_-|<>#\]+">

                                    @if ($errors->has('rgo_nombre_es'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('rgo_nombre_es') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Inglés-->
                            <div class="div_register_usernameName">
                                <label for="rgo_nombre_en" class="col-md-4 col-form-label text-md-right">{{ __(' Inglés: ') }}</label>

                                <div class="div_register_usernameName">
                                    <input id="rgo_nombre_en" type="text" class="form-control{{ $errors->has('rgo_nombre_en') ? ' is-invalid' : '' }}" name="rgo_nombre_en" value="{{ old('rgo_nombre_en') }}" required autofocus pattern="[A-Za-z0-9]+[\$%&_-|<>#\]+">

                                    @if ($errors->has('rgo_nombre_en'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('rgo_nombre_en') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <br>
                        <!-- **** DETALLES **** -->
                        <div id="div_flex_dom">
                        <!-- Español -->
                            <label id="label_dom" for="rgo_detalles_es"><strong>{{ __('DETALLES: ') }}</strong></label>
        
                            <div class="div_register_usernameName">
                                <label for="rgo_detalles_es" class="col-md-4 col-form-label text-md-right">{{ __('Español: ') }}</label>

                                <div class="div_register_usernameName">
                                    <textarea rows="4" cols="50" id="rgo_detalles_es" type="text" class="form-control{{ $errors->has('rgo_detalles_es') ? ' is-invalid' : '' }}" name="rgo_detalles_es" value="{{ old('rgo_detalles_es') }}" required autofocus pattern="[A-Za-z0-9]+[\$%&_-|<>#\]+">
                                    </textarea>

                                    @if ($errors->has('rgo_detalles_es'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('rgo_detalles_es') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Inglés -->
                            <div class="div_register_usernameName">
                                <label for="rgo_detalles_en" class="col-md-4 col-form-label text-md-right">{{ __('Inglés: ') }}</label>

                                <div class="div_register_usernameName">
                                    <textarea rows="4" cols="50" id="rgo_detalles_en" class="form-control{{ $errors->has('rgo_detalles_en') ? ' is-invalid' : '' }}" name="rgo_detalles_en" value="{{ old('rgo_detalles_en') }}" required autofocus pattern="[A-Za-z0-9]+[\$%&_-|<>#\]+">
                                    </textarea>

                                    @if ($errors->has('rgo_detalles_en'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('rgo_detalles_en') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <br>                   
                        <!-- subproceso -->
                        <div id="div_flex_modificar_expediente">
                            <div class="div_register_usernameName">
                                <label for="subproceso" class="col-md-4 col-form-label text-md-right">{{ __('Subproceso: ') }}</label>

                                <div class="div_register_usernameName"> 
                                    <select id="subproceso" name="subproceso" class="form-control" onchange="procRiesgo(this.value)" required>
                                        <option selected value="0" disabled="disabled" > Subproceso </option>                               
                                        @foreach($subps as $subp => $value)
                                            <option id="subproceso" value="{{ $value->subp_id }}">{{ $value->subp_nombre_es }}</option>  
                                        @endforeach  
                                    </select>
                                    <br>
                                    @if ($errors->has('subproceso'))
                                        <span class="invalid-feedback">
                                            <label class="label-texto"><strong>{{ $errors->first('subproceso') }}</strong></label>
                                        </span>
                                    @endif                                    
                                </div>
                            </div>

                            <div class="div_register_usernameName">
                                <label for="proc_id" class="col-md-4 col-form-label text-md-right">{{ __(' Proceso: ') }}</label>

                                <div class="div_register_usernameName">
                                    <input id="proc_id" type="text" class="form-control{{ $errors->has('proc_id') ? ' is-invalid' : '' }}" name="procesp" value="{{ old('proc_id') }}" disabled = "false" required autofocus pattern="[A-Za-z0-9]+[\$%&_-|<>#\]+">

                                    @if ($errors->has('proc_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('proc_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



