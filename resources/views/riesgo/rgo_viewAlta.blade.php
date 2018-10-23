@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- <div class="col-md-8"> -->
            <div class="card">
                <div class="card-header"><strong>@lang('riesgo.titulo_alta')</strong></div>
                <br>
                <div class="card-body">

                    <!-- El metodo que se usa poder bloquear el boton en lo que se esta enviando la informacion para guardarla a la DB,
                    se encuentra en riesgo.js  "checkSubmit_alta" -->
                    <form id="form_register" method="POST" action="{{ route('rgo_alta') }}" onsubmit="return checkSubmit_alta();"> 
                        @csrf
                        <br>
                        <div id="div_flex_modificar_expediente">
                            <label class="col-form-label">@lang('riesgo.instr_alta', ['perfil' => $userPerfil->per_nombre_en])</label>                            
                            <div id="div_boton_registrar" class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button id="boton_alta" onclick="validarRgo()" type="submit" class="btn btn-primary">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@lang('boton.boton_registrar')&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </button>
                                </div>
                            </div>
                        </div>
                        <br>

                        <!-- Mensaje de elemento creado correctamente -->
                        @if (session('status'))
                            <div id="mensajeStatus" class="alert alert-success">  
                                <span class="boton" onclick="cerraranuncio('mensajeStatus')">x</span>
                                {{ session('status') }}
                            </div>
                        @endif

                        <input type="hidden" id="idioma" name="idioma" value="{{$idioma}}">


                        <!-- subproceso -->
                        <div id="div_flex_modificar_expediente">
                            <div class="div_register_usernameName">
                                <label for="subproceso" class="col-md-4 col-form-label text-md-right">@lang('selects.subp')</label>

                                <div class="div_register_usernameName"> 
                                    <select id="subproceso" name="subproceso" class="form-control" onchange="procRiesgo(this.value)" required>
                                        <option selected value="0" disabled="disabled" > @lang('selects.select_subp') </option>                               
                                        @foreach($subps as $subp => $value)

                                            @if($idioma == "es")
                                                <option id="subproceso" value="{{ $value->subp_id }}">{{ $value->subp_nombre_es }}</option>  
                                            @elseif($idioma == "en")
                                                <option id="subproceso" value="{{ $value->subp_id }}">{{ $value->subp_nombre_en }}</option>  
                                            @endif

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
                            <!-- Proceso asociado -->
                            <div class="div_register_usernameName">
                                <label for="proc_id" class="col-md-4 col-form-label text-md-right">@lang('selects.proceso')</label>

                                <div class="div_register_usernameName">
                                    <input id="proc_id" type="text" class="form-control{{ $errors->has('proc_id') ? ' is-invalid' : '' }}" name="procesp" value="{{ old('proc_id') }}" disabled = "false" required autofocus>

                                    @if ($errors->has('proc_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('proc_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <!-- Dominio asociado-->
                            <div class="div_register_usernameName">
                                <label for="dom_id" class="col-md-4 col-form-label text-md-right">@lang('selects.dominio')</label>

                                <div class="div_register_usernameName">
                                    <input id="dom_id" type="text" class="form-control{{ $errors->has('dom_id') ? ' is-invalid' : '' }}" name="dominio" value="{{ old('dom_id') }}" disabled = "false" required autofocus >

                                    @if ($errors->has('dom_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('dom_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        
                        <!-- **** NOMBRE **** -->
                        <div id="div_flex_dom">
                            <!-- Español -->
                            <label id="label_dom" for="rgo_nombre_es"><strong>@lang('menu.nombre')</strong></label>

                            <div class="div_register_usernameName">
                                <label for="rgo_nombre_es" class="col-md-4 col-form-label text-md-right">@lang('menu.espaniol')</label>
  
                                <div class="div_register_usernameName">
                                    <input id="rgo_nombre_es" placeholder="Estrategia de Transformación Digita." type="text" class="form-control{{ $errors->has('rgo_nombre_es') ? ' is-invalid' : '' }}" name="rgo_nombre_es" value="{{ old('rgo_nombre_es') }}" required autofocus pattern="^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$">

                                    @if ($errors->has('rgo_nombre_es'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('rgo_nombre_es') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Inglés-->
                            <div class="div_register_usernameName">
                                <label for="rgo_nombre_en" class="col-md-4 col-form-label text-md-right">@lang('menu.ingles')</label>

                                <div class="div_register_usernameName">
                                    <input id="rgo_nombre_en" placeholder="Digital Transformation Strategy. " type="text" class="form-control{{ $errors->has('rgo_nombre_en') ? ' is-invalid' : '' }}" name="rgo_nombre_en" value="{{ old('rgo_nombre_en') }}" required autofocus pattern="^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$">

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
                            <label id="label_dom" for="rgo_detalles_es"><strong>@lang('menu.detalles')</strong></label>
        
                            <div class="div_register_usernameName">
                                <label for="rgo_detalles_es" class="col-md-4 col-form-label text-md-right">@lang('menu.espaniol')</label>

                                <div class="div_register_usernameName">
                                    <textarea rows="4" cols="50" id="rgo_detalles_es" placeholder="@lang('riesgo.placeholder_riesgo_es')" type="text" class="form-control{{ $errors->has('rgo_detalles_es') ? ' is-invalid' : '' }}" name="rgo_detalles_es" value="{{ old('rgo_detalles_es') }}" required autofocus  pattern="[A-Za-z0-9]+[\$%{[}].,;*&_-|<>#\]+"></textarea>

                                    @if ($errors->has('rgo_detalles_es'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('rgo_detalles_es') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Inglés -->
                            <div class="div_register_usernameName">
                                <label for="rgo_detalles_en" class="col-md-4 col-form-label text-md-right">@lang('menu.ingles')</label>

                                <div class="div_register_usernameName">
                                    <textarea rows="4" cols="50" id="rgo_detalles_en" placeholder="@lang('riesgo.placeholder_riesgo_en')" class="form-control{{ $errors->has('rgo_detalles_en') ? ' is-invalid' : '' }}" name="rgo_detalles_en" value="{{ old('rgo_detalles_en') }}" required autofocus  pattern="[A-Za-z0-9]+[\$%{[}].,;*&_-|<>#\]+"></textarea>

                                    @if ($errors->has('rgo_detalles_en'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('rgo_detalles_en') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <br>                   
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



