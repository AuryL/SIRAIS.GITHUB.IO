@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- <div class="col-md-8"> -->
            <div class="card">
                <div class="card-header"><strong>@lang('riesgo.titulo_modificar')</strong></div>
                <br>
                <div class="card-body">

                    <form id="form_register" method="POST" action="{{ route('rgo_modificar') }}">
                        @csrf
                        <br>
                        <div id="div_flex_modificar_expediente">
                            <label class="col-form-label text-md-right">@lang('riesgo.instr_modificar')</label>
                            <br> <br> <br>
                            <!-- Seleccionar el expediente del usuario que se desea Modificar -->
                            <div id="div_modificar_expediente" class="form-group{{ $errors->has('riesgo') ? ' has-error' : '' }}">
                                <select id="riesgo" name="riesgo" class="form-control" onchange="riesgoSelected(this.value)" required>
                                    <option selected value="0" disabled="disabled" >@lang('selects.select_riesgo')</option>                               
                                    @foreach($rgos as $rgo => $value)

                                        @if($idioma == "es")
                                            <option id="riesgo" value="{{ $value->rgo_id }}">{{ $value->rgo_nombre_es }}</option> 
                                        @elseif($idioma == "en")
                                            <option id="riesgo" value="{{ $value->rgo_id }}">{{ $value->rgo_nombre_en }}</option> 
                                        @endif

                                    @endforeach  
                                </select>
                                <br>
                                @if ($errors->has('riesgo'))
                                    <span class="invalid-feedback">
                                        <label class="label-texto"><strong>{{ $errors->first('riesgo') }}</strong></label>
                                    </span>
                                @endif
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

                        <!-- ID -->
                        <input type="hidden" id="rgo_id" name="rgo_id" value="rgo_id">

                        <!-- **** NOMBRE **** -->
                        <div id="div_flex_dom">
                            <!-- Español -->
                            <label id="label_dom" for="rgo_nombre_es"><strong>@lang('menu.nombre')</strong></label>

                            <div class="div_register_usernameName">
                                <label for="rgo_nombre_es" class="col-md-4 col-form-label text-md-right">@lang('menu.espaniol')</label>

                                <div class="div_register_usernameName">
                                    <input id="rgo_nombre_es" placeholder="Estrategia de Transformación Digita." type="text" class="form-control{{ $errors->has('rgo_nombre_es') ? ' is-invalid' : '' }}" name="rgo_nombre_es" value="{{ old('rgo_nombre_es') }}" required autofocus  disabled = "false">

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
                                    <input id="rgo_nombre_en" placeholder="Digital Transformation Strategy. " type="text" class="form-control{{ $errors->has('rgo_nombre_en') ? ' is-invalid' : '' }}" name="rgo_nombre_en" value="{{ old('rgo_nombre_en') }}" required autofocus  disabled = "false">

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
                                    <textarea rows="4" cols="50" id="rgo_detalles_es" placeholder="@lang('riesgo.placeholder_riesgo_es')" type="text" class="form-control{{ $errors->has('rgo_detalles_es') ? ' is-invalid' : '' }}" name="rgo_detalles_es" value="{{ old('rgo_detalles_es') }}" required autofocus  disabled = "false"></textarea>

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
                                    <textarea rows="4" cols="50" id="rgo_detalles_en" placeholder="@lang('riesgo.placeholder_riesgo_en')" class="form-control{{ $errors->has('rgo_detalles_en') ? ' is-invalid' : '' }}" name="rgo_detalles_en" value="{{ old('rgo_detalles_en') }}" required autofocus  disabled = "false"></textarea>

                                    @if ($errors->has('rgo_detalles_en'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('rgo_detalles_en') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <br>                   
                        <!-- SUBPROCESO -->
                        <div id="div_flex_modificar_expediente">
                            <div class="div_register_usernameName">
                                <label for="subproceso" class="col-md-4 col-form-label text-md-right">@lang('selects.subp')</label>

                                <div class="div_register_usernameName"> 
                                    <select id="subproceso" name="subproceso" class="form-control" onchange="procRiesgo(this.value)" required  disabled = "false">
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

                            <div class="div_register_usernameName">
                                <label for="proc_id" class="col-md-4 col-form-label text-md-right">@lang('selects.proceso')</label>

                                <div class="div_register_usernameName">
                                    <input id="proc_id" type="text" class="form-control{{ $errors->has('proc_id') ? ' is-invalid' : '' }}" name="proc_id" value="{{ old('proc_id') }}" disabled = "false" required autofocus >

                                    @if ($errors->has('proc_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('proc_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

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

                        <div id="div_flex_modificar_expediente">
                        <!-- Estado --> 
                            <div class="div_register_usernameName">
                                <label for="rgo_estado" class="col-md-4 col-form-label text-md-right">@lang('selects.activo')</label>

                                <div class="div_register_usernameName">
                                    <input type="checkbox" value="1" id="rgo_estado" name="rgo_estado" disabled="true">

                                    @if ($errors->has('rgo_estado'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('rgo_estado') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div id="div_boton_registrar" class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <br>
                                    <button id="boton_modificar" onclick="validarRgo()" type="submit" class="btn btn-primary" disabled="true">
                                        @lang('boton.boton_modificar')
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>



                        <!-- /////////////////////////////////////////////////// CONTROLES ///////////////////////////////////////////////////////////// -->
                    <div id="div_block_riesgo">
                        <div id="div_flex_riesgos_controles"> @lang('menu.controles')</div>
                            <!-- Seleccionar el expediente del usuario que se desea Modificar -->
                        <div id="div_control" class="form-group{{ $errors->has('riesgo') ? ' has-error' : '' }}">
                            <div id="div_controlSeleccionado" class="form-group{{ $errors->has('riesgo') ? ' has-error' : '' }}">
                                <select id="control" name="control" class="form-control" onchange="contRiesgo(this.value)" required>
                                    <option selected value="0" disabled="disabled" > @lang('selects.select_control') </option>  
                                </select>
                                <br>
                                @if ($errors->has('control'))
                                    <span class="invalid-feedback">
                                        <label class="label-texto"><strong>{{ $errors->first('control') }}</strong></label>
                                    </span>
                                @endif
                            </div>
                            <!-- RIESGO ID -->
                            <input type="hidden" id="rgo_id_control" name="rgo_id_control" value="rgorgo_id_control_id}">
                            <span id="rgo_id_control_error"></span>

                            <input type="hidden" id="cont_id" name="cont_id" value="cont_id">
                            <span id="cont_id_error"></span>
                            <!-- **** NOMBRE **** -->
                            <div id="div_flex_dom">
                                <!-- Español -->
                                <label id="label_dom" for="cont_nombre_es"><strong>@lang('menu.nombre')</strong></label>

                                <div class="div_register_usernameName">
                                    <label for="cont_nombre_es" class="col-md-4 col-form-label text-md-right">@lang('menu.espaniol')</label>

                                    <div class="div_register_usernameName">
                                        <input id="cont_nombre_es" placeholder="Compromiso continuo." type="text" class="form-control{{ $errors->has('cont_nombre_es') ? ' is-invalid' : '' }}" name="cont_nombre_es" value="{{ old('cont_nombre_es') }}"  required autofocus disabled="true" >
                                        <span id="cont_nombre_es_error"></span>

                                        @if ($errors->has('cont_nombre_es'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('cont_nombre_es') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <!-- Inglés-->
                                <div class="div_register_usernameName">
                                    <label for="cont_nombre_en" class="col-md-4 col-form-label text-md-right">@lang('menu.ingles')</label>

                                    <div class="div_register_usernameName">
                                        <input id="cont_nombre_en" placeholder="Continuous commitment. " type="text" class="form-control{{ $errors->has('cont_nombre_en') ? ' is-invalid' : '' }}" name="cont_nombre_en" value="{{ old('cont_nombre_en') }}"  required autofocus disabled="true">
                                        <span id="cont_nombre_en_error"></span>

                                        @if ($errors->has('cont_nombre_en'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('cont_nombre_en') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <br>
                            <!-- **** DETALLES **** -->
                            <div id="div_flex_dom">
                            <!-- Español -->
                                <label id="label_dom" for="cont_detalles_es"><strong>@lang('menu.detalles')</strong></label>
            
                                <div class="div_register_usernameName">
                                    <label for="cont_detalles_es" class="col-md-4 col-form-label text-md-right">@lang('menu.espaniol')</label>

                                    <div class="div_register_usernameName">
                                        <textarea rows="4" cols="50" id="cont_detalles_es" placeholder="@lang('riesgo.placeholder_control_es')" type="text" class="form-control{{ $errors->has('cont_detalles_es') ? ' is-invalid' : '' }}" name="cont_detalles_es" value="{{ old('cont_detalles_es') }}" required autofocus disabled="true"></textarea>
                                        <span id="cont_detalles_es_error"></span>

                                        @if ($errors->has('cont_detalles_es'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('cont_detalles_es') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Inglés -->
                                <div class="div_register_usernameName">
                                    <label for="cont_detalles_en" class="col-md-4 col-form-label text-md-right">@lang('menu.ingles')</label>

                                    <div class="div_register_usernameName">
                                        <textarea rows="4" cols="50" id="cont_detalles_en" placeholder="@lang('riesgo.placeholder_control_en')" class="form-control{{ $errors->has('cont_detalles_en') ? ' is-invalid' : '' }}" name="cont_detalles_en" value="{{ old('cont_detalles_en') }}" required autofocus disabled="true"></textarea>
                                        <span id="cont_detalles_en_error"></span>

                                        @if ($errors->has('cont_detalles_en'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('cont_detalles_en') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <br>              
                            <!-- Estado -->
                            <div id="div_flex_modificar_expediente">
                                <div class="div_register_usernameName">
                                    <label for="cont_estado" class="col-md-4 col-form-label text-md-right">@lang('selects.activo')</label>

                                    <div class="div_register_usernameName">
                                        <input type="checkbox" value="1" id="cont_estado" name="cont_estado" disabled="true">
                                        <span id="cont_estado_error"></span>

                                        @if ($errors->has('cont_estado'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('cont_estado') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div id="div_boton_registrar" class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <br>
                                        <button id="boton_modificar_control" class="btn btn-primary" disabled="true">@lang('boton.boton_modificar')</button>
                                        <!-- <input type="submit" id="boton_modificar_control" value="Modificar" class="btn btn-primary" disabled="true"> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  


                    <!-- ///////////////////////////////////////// ACTIVIDADES ////////////////////////////////////////// -->
                    <div id="div_block_riesgo">
                        <div id="div_flex_riesgos_actividades"> @lang('menu.actividades')</div>
                            <!-- Seleccionar el expediente del usuario que se desea Modificar -->
                        <div id="div_actividad" class="form-group{{ $errors->has('actividad') ? ' has-error' : '' }}">
                            <div id="div_actividadSeleccionado" class="form-group{{ $errors->has('actividad') ? ' has-error' : '' }}">
                                <select id="actividad" name="actividad" class="form-control" onchange="actControl(this.value)" required>
                                    <option selected value="0" disabled="disabled" > @lang('selects.select_actividad') </option>  
                                </select>
                                <br>
                                @if ($errors->has('actividad'))
                                    <span class="invalid-feedback">
                                        <label class="label-texto"><strong>{{ $errors->first('actividad') }}</strong></label>
                                    </span>
                                @endif
                            </div>
                            <!-- RIESGO ID -->
                            <input type="hidden" id="cont_id_actividad" name="cont_id_actividad" value="cont_id_actividad">
                            <input type="hidden" id="act_id" name="act_id" value="act_id">
                            <!-- **** NOMBRE **** -->
                            <div id="div_flex_dom">
                                <!-- Español -->
                                <label id="label_dom" for="act_nombre_es"><strong>@lang('menu.nombre')</strong></label>

                                <div class="div_register_usernameName">
                                    <label for="act_nombre_es" class="col-md-4 col-form-label text-md-right">@lang('menu.espaniol')</label>

                                    <div class="div_register_usernameName">
                                        <input id="act_nombre_es" placeholder="Revision del diseño del gobierno de la Fabrica Digital." type="text" class="form-control{{ $errors->has('act_nombre_es') ? ' is-invalid' : '' }}" name="act_nombre_es" value="{{ old('act_nombre_es') }}" placeholder="Nombre" required autofocus disabled="true">

                                        @if ($errors->has('act_nombre_es'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('act_nombre_es') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <!-- Inglés-->
                                <div class="div_register_usernameName">
                                    <label for="act_nombre_en" class="col-md-4 col-form-label text-md-right">@lang('menu.ingles')</label>

                                    <div class="div_register_usernameName">
                                        <input id="act_nombre_en" placeholder="Revision of the design of the government of the Digital Factory." type="text" class="form-control{{ $errors->has('act_nombre_en') ? ' is-invalid' : '' }}" name="act_nombre_en" value="{{ old('act_nombre_en') }}"  required autofocus disabled="true">

                                        @if ($errors->has('act_nombre_en'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('act_nombre_en') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <br>
                            <!-- **** DETALLES **** -->
                            <div id="div_flex_dom">
                            <!-- Español -->
                                <label id="label_dom" for="act_detalles_es"><strong>@lang('menu.detalles')</strong></label>

                                <div class="div_register_usernameName">
                                    <label for="act_detalles_es" class="col-md-4 col-form-label text-md-right">@lang('menu.espaniol')</label>

                                    <div class="div_register_usernameName">
                                        <textarea rows="4" cols="50" id="act_detalles_es"  placeholder="@lang('riesgo.placeholder_actividad_es')" type="text" class="form-control{{ $errors->has('act_detalles_es') ? ' is-invalid' : '' }}" name="act_detalles_es" value="{{ old('act_detalles_es') }}" required autofocus disabled="true"></textarea>

                                        @if ($errors->has('act_detalles_es'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('act_detalles_es') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Inglés -->
                                <div class="div_register_usernameName">
                                    <label for="act_detalles_en" class="col-md-4 col-form-label text-md-right">@lang('menu.ingles')</label>

                                    <div class="div_register_usernameName">
                                        <textarea rows="4" cols="50" id="act_detalles_en" placeholder="@lang('riesgo.placeholder_actividad_en')" class="form-control{{ $errors->has('act_detalles_en') ? ' is-invalid' : '' }}" name="act_detalles_en" value="{{ old('act_detalles_en') }}" required autofocus disabled="true"></textarea>

                                        @if ($errors->has('act_detalles_en'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('act_detalles_en') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <br>              
                            <!-- Estado -->
                            <div id="div_flex_modificar_expediente">
                                <div class="div_register_usernameName">
                                    <label for="act_estado" class="col-md-4 col-form-label text-md-right">@lang('selects.activo')</label>

                                    <div class="div_register_usernameName">
                                        <input type="checkbox" value="1" id="act_estado" name="act_estado" disabled="true">

                                        @if ($errors->has('act_estado'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('act_estado') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div id="div_boton_registrar" class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <br>
                                        <button id="boton_modificar_actividad" type="submit" class="btn btn-primary" disabled="true">
                                            @lang('boton.boton_modificar')
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



