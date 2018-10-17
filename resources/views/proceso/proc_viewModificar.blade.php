@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- <div class="col-md-8"> -->
            <div class="card">
                <div class="card-header"><strong>@lang('proceso.titulo_modificar')</strong></div>
                <br>
                <div class="card-body">
                    
                    <form id="form_register" method="POST" action="{{ route('proc_modificar') }}" onsubmit="return checkSubmit();">
                    
                        <div id="div_flex_modificar_expediente">
                            <label class="col-form-label text-md-right">@lang('proceso.instr_modificar')</label>
                            <br> <br> <br>
                            <!-- Seleccionar el expediente del usuario que se desea Modificar -->
                            <div id="div_modificar_expediente" class="form-group{{ $errors->has('proceso') ? ' has-error' : '' }}">
                                <select id="proceso" name="proceso" class="form-control" onchange="procesoSelected(this.value)" required>
                                    <option selected value="0" disabled="disabled" > @lang('selects.select_proceso') </option>                               
                                    @foreach($procs as $proc => $value)

                                        @if($idioma == "es")
                                            <option id="proceso" value="{{ $value->proc_id }}">{{ $value->proc_nombre_es }}</option>  
                                        @elseif($idioma == "en")
                                            <option id="proceso" value="{{ $value->proc_id }}">{{ $value->proc_nombre_en }}</option>  
                                        @endif

                                    @endforeach  
                                </select>
                                <br>
                                @if ($errors->has('proceso'))
                                    <span class="invalid-feedback">
                                        <label class="label-texto"><strong>{{ $errors->first('proceso') }}</strong></label>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @csrf

                        <!-- Mensaje de elemento creado correctamente -->
                        @if (session('status'))
                            <div id="mensajeStatus" class="alert alert-success">  
                                <span class="boton" onclick="cerraranuncio('mensajeStatus')">x</span>
                                {{ session('status') }}
                            </div>
                        @endif

                        <!-- ID -->
                        <input type="hidden" id="proc_id" name="proc_id" value="proc_id">

                        <!-- NOMBRE -->
                        <div id="div_flex_dom">
                            <!-- Español -->
                            <label id="label_dom" for="proc_nombre_es"><strong>@lang('menu.nombre')</strong></label>
                            <div class="div_register_usernameName">
                                <label for="proc_nombre_es" class="col-md-4 col-form-label text-md-right">@lang('menu.espaniol')</label>

                                <div class="div_register_usernameName">
                                    <input id="proc_nombre_es" placeholder="Modelo de Gobierno de Transformación Digital."  type="text" class="form-control{{ $errors->has('proc_nombre_es') ? ' is-invalid' : '' }}" name="proc_nombre_es" value="{{ old('proc_nombre_es') }}" required autofocus disabled="true" pattern="[A-Za-z0-9]+[\$%&_-|<>#\]+">

                                    @if ($errors->has('proc_nombre_es'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('proc_nombre_es') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Inglés -->
                            <div class="div_register_usernameName">
                                <label for="proc_nombre_en" class="col-md-4 col-form-label text-md-right">@lang('menu.ingles')</label>

                                <div class="div_register_usernameName">
                                    <input id="proc_nombre_en" placeholder="Model of Government of Digital Transformation." type="text" class="form-control{{ $errors->has('proc_nombre_en') ? ' is-invalid' : '' }}" name="proc_nombre_en" value="{{ old('proc_nombre_en') }}" required autofocus disabled="true" pattern="[A-Za-z0-9]+[\$%&_-|<>#\]+">

                                    @if ($errors->has('proc_nombre_en'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('proc_nombre_en') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- DETALLES -->
                        <div id="div_flex_dom">
                        <!-- Español -->
                        <label id="label_dom" for="proc_detalles_es"><strong>@lang('menu.detalles')</strong></label>
    
                            <div class="div_register_usernameName">
                                <label for="proc_detalles_es" class="col-md-4 col-form-label text-md-right">@lang('menu.espaniol')</label>

                                <div class="div_register_usernameName">                                
                                <textarea rows="4" cols="50" id="proc_detalles_es" placeholder="@lang('proceso.placeholder_proceso_es')"  ctype="text" class="form-control{{ $errors->has('proc_detalles_es') ? ' is-invalid' : '' }}" name="proc_detalles_es" value="{{ old('proc_detalles_es') }}" required autofocus disabled="true" pattern="[A-Za-z0-9]+[\$%&_-|<>#\]+"></textarea>
                                    @if ($errors->has('proc_detalles_es'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('proc_detalles_es') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Inglés -->
                            <div class="div_register_usernameName">
                                <label for="proc_detalles_en" class="col-md-4 col-form-label text-md-right">@lang('menu.ingles')</label>

                                <div class="div_register_usernameName">
                                    <textarea rows="4" cols="50" id="proc_detalles_en" placeholder="@lang('proceso.placeholder_proceso_en')"  class="form-control{{ $errors->has('proc_detalles_en') ? ' is-invalid' : '' }}" name="proc_detalles_en" value="{{ old('proc_detalles_en') }}" required autofocus disabled="true" pattern="[A-Za-z0-9]+[\$%&_-|<>#\]+"></textarea>

                                    @if ($errors->has('proc_detalles_en'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('proc_detalles_en') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        
                        <div id="div_flex">
                            <!-- ESTADO -->
                            <div class="div_register_usernameName">
                                <label for="proc_estado" class="col-md-4 col-form-label text-md-right">@lang('selects.activo')</label>

                                <div class="div_register_usernameName">
                                    <input type="checkbox" value="1" id="proc_estado" name="proc_estado" disabled="true" >

                                    @if ($errors->has('proc_estado'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('proc_estado') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- DOMINIO -->
                            <div id="div_register_usernameName" class="form-group{{ $errors->has('dom_id') ? ' has-error' : '' }}">

                                <label for="dom_id" class="col-md-4 col-form-label text-md-right">@lang('selects.dominio')</label>

                                <select id="dom_id" name="dom_id" class="form-control" required disabled="true" >
                                    <option selected value="0" disabled="disabled" > @lang('selects.select_dominio') </option>
                                    @foreach($doms as $dom => $value)

                                        @if($idioma == "es")
                                            <option value="{{ $value->dom_id }}">{{ $value->dom_nombre_es }}</option>  
                                        @elseif($idioma == "en")
                                            <option value="{{ $value->dom_id }}">{{ $value->dom_nombre_en }}</option>  
                                        @endif

                                    @endforeach                           
                                                                    
                                </select>
                                <br>
                                @if ($errors->has('dom_id'))
                                    <span class="invalid-feedback">
                                        <label class="label-texto"><strong>{{ $errors->first('dom_id') }}</strong></label>
                                    </span>
                                @endif
                            </div>
                        

                            <div id="div_boton_registrar" class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <br>
                                    <button id="boton_modificar" onclick="validarProc()" type="submit" class="btn btn-primary" disabled="true">
                                        @lang('boton.boton_modificar')
                                    </button>
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
                        