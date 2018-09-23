@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- <div class="col-md-8"> -->
            <div class="card">
                <div class="card-header"><strong>{{ __('MODIFICAR DOMINIO') }}</strong></div>
                <br>
                <div class="card-body">
                    
                    <form id="form_register" method="POST" action="{{ route('dom_modificar') }}">
                    
                        <div id="div_flex_modificar_expediente">
                            <label class="col-form-label text-md-right">Selecciona el nombre del dominio que deseas consultar/modificar: </label>
                            <br> <br> <br>
                            <!-- Seleccionar el expediente del usuario que se desea Modificar -->
                            <div id="div_modificar_expediente" class="form-group{{ $errors->has('dominio') ? ' has-error' : '' }}">
                                <select id="dominio" name="dominio" class="form-control" onchange="dominioSelected(this.value)" required>
                                    <option selected value="0" disabled="disabled" > Dominio </option>                               
                                    @foreach($doms as $dom => $value)
                                        <option id="dominio" value="{{ $value->dom_id }}">{{ $value->dom_nombre_es }}</option>  
                                    @endforeach  
                                </select>
                                <br>
                                @if ($errors->has('dominio'))
                                    <span class="invalid-feedback">
                                        <label class="label-texto"><strong>{{ $errors->first('dominio') }}</strong></label>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @csrf

                        <!-- ID -->
                        <input type="hidden" id="dom_id" name="dom_id" value="dom_id">

                        <!-- NOMBRE -->
                        <div id="div_flex">
                            <!-- Español -->
                            <div class="div_register_usernameName">
                                <label for="dom_nombre_es" class="col-md-4 col-form-label text-md-right">{{ __('Español: ') }}</label>

                                <div class="div_register_usernameName">
                                    <input id="dom_nombre_es" type="text" class="form-control{{ $errors->has('dom_nombre_es') ? ' is-invalid' : '' }}" name="dom_nombre_es" value="{{ old('dom_nombre_es') }}" required autofocus pattern="[A-Za-z0-9]+">

                                    @if ($errors->has('dom_nombre_es'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('dom_nombre_es') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Inglés -->
                            <div class="div_register_usernameName">
                                <label for="dom_nombre_en" class="col-md-4 col-form-label text-md-right">{{ __('Inglés: ') }}</label>

                                <div class="div_register_usernameName">
                                    <input id="dom_nombre_en" type="text" class="form-control{{ $errors->has('dom_nombre_en') ? ' is-invalid' : '' }}" name="dom_nombre_en" value="{{ old('dom_nombre_en') }}" required autofocus pattern="[A-Za-z0-9]+">

                                    @if ($errors->has('dom_nombre_en'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('dom_nombre_en') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- DETALLES -->
                        <div id="div_flex">
                            <!-- Español -->
                            <div class="div_register_usernameName">
                                <label for="dom_detalles_es" class="col-md-4 col-form-label text-md-right">{{ __('Español: ') }}</label>

                                <div class="div_register_usernameName">                                
                                <textarea rows="4" cols="50" id="dom_detalles_es" type="text" class="form-control{{ $errors->has('dom_detalles_es') ? ' is-invalid' : '' }}" name="dom_detalles_es" value="{{ old('dom_detalles_es') }}" required autofocus pattern="[A-Za-z0-9]+">
                                </textarea>
                                    @if ($errors->has('dom_detalles_es'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('dom_detalles_es') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Inglés -->
                            <div class="div_register_usernameName">
                                <label for="dom_detalles_en" class="col-md-4 col-form-label text-md-right">{{ __('Inglés: ') }}</label>

                                <div class="div_register_usernameName">
                                    <textarea rows="4" cols="50" id="dom_detalles_en" class="form-control{{ $errors->has('dom_detalles_en') ? ' is-invalid' : '' }}" name="dom_detalles_en" value="{{ old('dom_detalles_en') }}" required autofocus pattern="[A-Za-z0-9]+">
                                    </textarea>

                                    @if ($errors->has('dom_detalles_en'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('dom_detalles_en') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        
                        <!-- ESTADO -->
                        <div id="div_flex">
                            <div class="div_register_usernameName">
                                <label for="dom_estado" class="col-md-4 col-form-label text-md-right">{{ __('Activo: ') }}</label>

                                <div class="div_register_usernameName">
                                    <input type="checkbox" value="1" id="dom_estado" name="dom_estado">

                                    @if ($errors->has('dom_estado'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('dom_estado') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        

                        <div id="div_boton_registrar" class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="boton_modificar" onclick="validarDom()" type="submit" class="btn btn-primary" disabled="true">
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




