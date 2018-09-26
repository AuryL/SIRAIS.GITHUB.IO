@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- <div class="col-md-8"> -->
            <div class="card">
                <div class="card-header">
                    <p class="caja_cabecera_titulo">
                        <a href="{{ route('rgo_viewModificar',[]) }}">
                            <strong>Regresar</strong>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </a> {{ __('MODIFICAR ACTIVIDAD') }}</p>
                </div>
                <br>
                <div class="card-body">

                    <form id="form_register" method="POST" action="{{ route('act_modificar') }}">
                        @csrf
                        <br>
                        <div id="div_flex_modificar_expediente">
                            <label class="col-form-label text-md-right">En seguida se muestra el actividad <strong>{{ $actividad->act_nombre_es }}</strong> a modificar</label>
                            <div id="div_boton_registrar" class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button id="boton_modificar" onclick="validarAct()" type="submit" class="btn btn-primary">
                                        {{ __('Modificar') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <br>
                        
                        <!-- RIESGO ID -->
                        <input type="hidden" id="rgo_id" name="rgo_id" value="{{$rgo->rgo_id}}">
                        
                        <input type="hidden" id="act_id" name="act_id" value="{{$actividad->act_id}}">

                        <!-- **** NOMBRE **** -->
                        <div id="div_flex_dom">
                            <!-- Español -->
                            <label id="label_dom" for="act_nombre_es"><strong>{{ __('NOMBRE: ') }}</strong></label>

                            <div class="div_register_usernameName">
                                <label for="act_nombre_es" class="col-md-4 col-form-label text-md-right">{{ __(' Español: ') }}</label>

                                <div class="div_register_usernameName">
                                    <input id="act_nombre_es" type="text" class="form-control{{ $errors->has('act_nombre_es') ? ' is-invalid' : '' }}" name="act_nombre_es" value="{{ $actividad->act_nombre_es}}" required autofocus >

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
                                    <input id="act_nombre_en" type="text" class="form-control{{ $errors->has('act_nombre_en') ? ' is-invalid' : '' }}" name="act_nombre_en" value="{{ $actividad->act_nombre_en}}" required autofocus >

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
                                    <textarea rows="4" cols="50" id="act_detalles_es" type="text" class="form-control{{ $errors->has('act_detalles_es') ? ' is-invalid' : '' }}" name="act_detalles_es" value="{{ old('rgo_nombre_es') }}" required autofocus >
                                        {{$actividad->act_detalles_es}}
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
                                    <textarea rows="4" cols="50" id="act_detalles_en" class="form-control{{ $errors->has('act_detalles_en') ? ' is-invalid' : '' }}" name="act_detalles_en" value="{{ old('rgo_nombre_es') }}" required autofocus >
                                        {{$actividad->act_detalles_en}}
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
                        <!-- RIESGO -->
                        <div id="div_flex_modificar_expediente">

                            <div class="div_register_usernameName">
                                <label for="riesgo" class="col-md-4 col-form-label text-md-right">{{ __(' Riesgo: ') }}</label>

                                <div class="div_register_usernameName">
                                    <input id="riesgo" type="text" class="form-control{{ $errors->has('riesgo') ? ' is-invalid' : '' }}" name="riesgo" value="{{ $rgo->rgo_nombre_es}}" disabled = "false" required autofocus >

                                    @if ($errors->has('riesgo'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('riesgo') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Estado -->
                            <div class="div_register_usernameName">
                                <label for="act_estado" class="col-md-4 col-form-label text-md-right">{{ __('Activo: ') }}</label>

                                <div class="div_register_usernameName">
                                    @if($actividad->act_estado == 1)
                                        <input type="checkbox" value="{{$actividad->act_estado}}" id="act_estado" name="act_estado" checked>
                                    @elseif($actividad->act_estado == 0)
                                        <input type="checkbox" value="{{$actividad->act_estado}}" id="act_estado" name="act_estado">
                                    @endif

                                    @if ($errors->has('act_estado'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('act_estado') }}</strong>
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



