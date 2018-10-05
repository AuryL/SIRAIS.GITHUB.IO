@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- <div class="col-md-8"> -->
            <div class="card">
                <div class="card-header"><strong>{{ __('MODIFICAR RIESGO') }}</strong></div>
                <br>
                <div class="card-body">

                    <form id="form_register" method="POST" action="{{ route('rgo_modificar') }}">
                        @csrf
                        <br>
                        <div id="div_flex_modificar_expediente">
                            <label class="col-form-label text-md-right">Selecciona el nombre del Subproceso que deseas consultar/modificar: </label>
                            <br> <br> <br>
                            <!-- Seleccionar el expediente del usuario que se desea Modificar -->
                            <div id="div_modificar_expediente" class="form-group{{ $errors->has('riesgo') ? ' has-error' : '' }}">
                                <select id="riesgo" name="riesgo" class="form-control" onchange="riesgoSelected(this.value)" required>
                                    <option selected value="0" disabled="disabled" > Riesgo </option>                               
                                    @foreach($rgos as $rgo => $value)
                                        <option id="riesgo" value="{{ $value->rgo_id }}">{{ $value->rgo_nombre_es }}</option>  
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
                        
                        <!-- ID -->
                        <input type="hidden" id="rgo_id" name="rgo_id" value="rgo_id">

                        <!-- **** NOMBRE **** -->
                        <div id="div_flex_dom">
                            <!-- Español -->
                            <label id="label_dom" for="rgo_nombre_es"><strong>{{ __('NOMBRE: ') }}</strong></label>

                            <div class="div_register_usernameName">
                                <label for="rgo_nombre_es" class="col-md-4 col-form-label text-md-right">{{ __(' Español: ') }}</label>

                                <div class="div_register_usernameName">
                                    <input id="rgo_nombre_es" type="text" class="form-control{{ $errors->has('rgo_nombre_es') ? ' is-invalid' : '' }}" name="rgo_nombre_es" value="{{ old('rgo_nombre_es') }}" required autofocus  disabled = "false">

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
                                    <input id="rgo_nombre_en" type="text" class="form-control{{ $errors->has('rgo_nombre_en') ? ' is-invalid' : '' }}" name="rgo_nombre_en" value="{{ old('rgo_nombre_en') }}" required autofocus  disabled = "false">

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
                                    <textarea rows="4" cols="50" id="rgo_detalles_es" type="text" class="form-control{{ $errors->has('rgo_detalles_es') ? ' is-invalid' : '' }}" name="rgo_detalles_es" value="{{ old('rgo_detalles_es') }}" required autofocus  disabled = "false">
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
                                    <textarea rows="4" cols="50" id="rgo_detalles_en" class="form-control{{ $errors->has('rgo_detalles_en') ? ' is-invalid' : '' }}" name="rgo_detalles_en" value="{{ old('rgo_detalles_en') }}" required autofocus  disabled = "false">
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
                        <!-- PROCESO -->
                        <div id="div_flex_modificar_expediente">
                            <div class="div_register_usernameName">
                                <label for="subproceso" class="col-md-4 col-form-label text-md-right">{{ __('Subproceso: ') }}</label>

                                <div class="div_register_usernameName"> 
                                    <select id="subproceso" name="subproceso" class="form-control" onchange="procRiesgo(this.value)" required  disabled = "false">
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
                                <label for="proceso" class="col-md-4 col-form-label text-md-right">{{ __(' Proceso: ') }}</label>

                                <div class="div_register_usernameName">
                                    <input id="proceso" type="text" class="form-control{{ $errors->has('proceso') ? ' is-invalid' : '' }}" name="proceso" value="{{ old('proceso') }}" disabled = "false" required autofocus >

                                    @if ($errors->has('proceso'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('proceso') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="div_register_usernameName">
                                <label for="dom_id" class="col-md-4 col-form-label text-md-right">{{ __(' Dominio: ') }}</label>

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
                                <label for="rgo_estado" class="col-md-4 col-form-label text-md-right">{{ __('Activo: ') }}</label>

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
                                    <button id="boton_modificar" onclick="validarRgo()" type="submit" class="btn btn-primary" disabled="true">
                                        {{ __('Modificar') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>



                        <!-- /////////////////////////////////////////////////// CONTROLES ///////////////////////////////////////////////////////////// -->
                    <div id="div_block_riesgo">
                        <div id="div_flex_riesgos_controles"> {{ __('CONTROLES') }}</div>
                            <!-- Seleccionar el expediente del usuario que se desea Modificar -->
                        <div id="div_control" class="form-group{{ $errors->has('riesgo') ? ' has-error' : '' }}">
                            <div id="div_controlSeleccionado" class="form-group{{ $errors->has('riesgo') ? ' has-error' : '' }}">
                                <select id="control" name="control" class="form-control" onchange="contRiesgo(this.value)" required>
                                    <option selected value="0" disabled="disabled" > Control </option>  
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
                                <label id="label_dom" for="cont_nombre_es"><strong>{{ __('NOMBRE: ') }}</strong></label>

                                <div class="div_register_usernameName">
                                    <label for="cont_nombre_es" class="col-md-4 col-form-label text-md-right">{{ __(' Español: ') }}</label>

                                    <div class="div_register_usernameName">
                                        <input id="cont_nombre_es" type="text" class="form-control{{ $errors->has('cont_nombre_es') ? ' is-invalid' : '' }}" name="cont_nombre_es" value="{{ old('cont_nombre_es') }}"  required autofocus disabled="true" >
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
                                    <label for="cont_nombre_en" class="col-md-4 col-form-label text-md-right">{{ __(' Inglés: ') }}</label>

                                    <div class="div_register_usernameName">
                                        <input id="cont_nombre_en" type="text" class="form-control{{ $errors->has('cont_nombre_en') ? ' is-invalid' : '' }}" name="cont_nombre_en" value="{{ old('cont_nombre_en') }}"  required autofocus disabled="true">
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
                                <label id="label_dom" for="cont_detalles_es"><strong>{{ __('DETALLES: ') }}</strong></label>
            
                                <div class="div_register_usernameName">
                                    <label for="cont_detalles_es" class="col-md-4 col-form-label text-md-right">{{ __('Español: ') }}</label>

                                    <div class="div_register_usernameName">
                                        <textarea rows="4" cols="50" id="cont_detalles_es" type="text" class="form-control{{ $errors->has('cont_detalles_es') ? ' is-invalid' : '' }}" name="cont_detalles_es" value="{{ old('cont_detalles_es') }}" required autofocus disabled="true">
                                        </textarea>
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
                                    <label for="cont_detalles_en" class="col-md-4 col-form-label text-md-right">{{ __('Inglés: ') }}</label>

                                    <div class="div_register_usernameName">
                                        <textarea rows="4" cols="50" id="cont_detalles_en" class="form-control{{ $errors->has('cont_detalles_en') ? ' is-invalid' : '' }}" name="cont_detalles_en" value="{{ old('cont_detalles_en') }}" required autofocus disabled="true">
                                        </textarea>
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
                                    <label for="cont_estado" class="col-md-4 col-form-label text-md-right">{{ __('Activo: ') }}</label>

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
                                        <button id="boton_modificar_control" class="btn btn-primary" disabled="true">Modificar</button>
                                        <!-- <input type="submit" id="boton_modificar_control" value="Modificar" class="btn btn-primary" disabled="true"> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  


                        <!-- /////////////////////////////////////////////////////////////////////////////////// -->
                        <div id="div_block_riesgo">
                            <div id="div_flex_riesgos_actividades"> {{ __('ACTIVIDADES') }}</div>
                                <!-- Seleccionar el expediente del usuario que se desea Modificar -->
                            <div id="div_actividad" class="form-group{{ $errors->has('actividad') ? ' has-error' : '' }}">
                                <div id="div_actividadSeleccionado" class="form-group{{ $errors->has('actividad') ? ' has-error' : '' }}">
                                    <select id="actividad" name="actividad" class="form-control" onchange="actRiesgo(this.value)" required>
                                        <option selected value="0" disabled="disabled" > Actividad </option>  
                                    </select>
                                    <br>
                                    @if ($errors->has('actividad'))
                                        <span class="invalid-feedback">
                                            <label class="label-texto"><strong>{{ $errors->first('actividad') }}</strong></label>
                                        </span>
                                    @endif
                                </div>
                                <!-- RIESGO ID -->
                                <input type="hidden" id="rgo_id_actividad" name="rgo_id_control" value="rgorgo_id_actividad">
                                <input type="hidden" id="act_id" name="act_id" value="act_id">
                                <!-- **** NOMBRE **** -->
                                <div id="div_flex_dom">
                                    <!-- Español -->
                                    <label id="label_dom" for="act_nombre_es"><strong>{{ __('NOMBRE: ') }}</strong></label>

                                    <div class="div_register_usernameName">
                                        <label for="act_nombre_es" class="col-md-4 col-form-label text-md-right">{{ __(' Español: ') }}</label>

                                        <div class="div_register_usernameName">
                                            <input id="act_nombre_es" type="text" class="form-control{{ $errors->has('act_nombre_es') ? ' is-invalid' : '' }}" name="act_nombre_es" value="{{ old('act_nombre_es') }}"  required autofocus disabled="true">

                                            @if ($errors->has('act_nombre_es'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('act_nombre_es') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <!-- Inglés-->
                                    <div class="div_register_usernameName">
                                        <label for="act_nombre_en" class="col-md-4 col-form-label text-md-right">{{ __(' Inglés: ') }}</label>

                                        <div class="div_register_usernameName">
                                            <input id="act_nombre_en" type="text" class="form-control{{ $errors->has('act_nombre_en') ? ' is-invalid' : '' }}" name="act_nombre_en" value="{{ old('act_nombre_en') }}"  required autofocus disabled="true">

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
                                    <label id="label_dom" for="act_detalles_es"><strong>{{ __('DETALLES: ') }}</strong></label>

                                    <div class="div_register_usernameName">
                                        <label for="act_detalles_es" class="col-md-4 col-form-label text-md-right">{{ __('Español: ') }}</label>

                                        <div class="div_register_usernameName">
                                            <textarea rows="4" cols="50" id="act_detalles_es" type="text" class="form-control{{ $errors->has('act_detalles_es') ? ' is-invalid' : '' }}" name="act_detalles_es" value="{{ old('act_detalles_es') }}" required autofocus disabled="true">
                                            </textarea>

                                            @if ($errors->has('act_detalles_es'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('act_detalles_es') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Inglés -->
                                    <div class="div_register_usernameName">
                                        <label for="act_detalles_en" class="col-md-4 col-form-label text-md-right">{{ __('Inglés: ') }}</label>

                                        <div class="div_register_usernameName">
                                            <textarea rows="4" cols="50" id="act_detalles_en" class="form-control{{ $errors->has('act_detalles_en') ? ' is-invalid' : '' }}" name="act_detalles_en" value="{{ old('act_detalles_en') }}" required autofocus disabled="true">
                                            </textarea>

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
                                        <label for="act_estado" class="col-md-4 col-form-label text-md-right">{{ __('Activo: ') }}</label>

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
                                            <button id="boton_modificar_actividad" onclick="validarAct()" type="submit" class="btn btn-primary" disabled="true">
                                                {{ __('Modificar') }}
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



