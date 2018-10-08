@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- <div class="col-md-8"> -->
        <div class="card">
            <div class="card-header"><strong>@lang('dominio.titulo_alta')</strong></div>
            <br>
            <div class="card-body">
                
                <form id="form_dom" method="POST" action="{{ route('dom_alta') }}">
                    @csrf
                    <br>
                    <div id="div_flex_modificar_expediente">
                        <label class="col-form-label">@lang('dominio.instr_alta', ['perfil' => $userPerfil->per_nombre_en])</label>                            
                        <div id="div_boton_registrar" class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="boton_alta_dom" onclick="validarDom()" type="submit" class="btn btn-primary">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@lang('boton.boton_registrar')&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </button>
                            </div>
                        </div>
                    </div>
                    <br>
                    <!-- **** NOMBRE **** -->
                    <!-- <div id="div_flex_dom"> -->
                        <div id="div_flex_dom">
                            <!-- Español -->
                            <label id="label_dom" for="dom_nombre_es"><strong>@lang('menu.nombre')</strong></label>

                            <div class="div_register_usernameName">
                                <label for="dom_nombre_es" class="col-md-4 col-form-label text-md-right">@lang('menu.espaniol')</label>

                                <div class="div_register_usernameName">
                                    <input id="dom_nombre_es" type="text" class="form-control{{ $errors->has('dom_nombre_es') ? ' is-invalid' : '' }}" name="dom_nombre_es" value="{{ old('dom_nombre_es') }}" required autofocus pattern="[A-Za-z0-9]+">

                                    @if ($errors->has('dom_nombre_es'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('dom_nombre_es') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Inglés-->
                            <div class="div_register_usernameName">
                                <label for="dom_nombre_en" class="col-md-4 col-form-label text-md-right">@lang('menu.ingles')</label>

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
                    <!-- </div> -->
                    <br>
                    <!-- **** DETALLES **** -->
                    <div id="div_flex_dom">
                    <!-- Español -->
                        <label id="label_dom" for="dom_detalles_es"><strong>@lang('menu.detalles')</strong></label>
    
                        <div class="div_register_usernameName">
                            <label for="dom_detalles_es" class="col-md-4 col-form-label text-md-right">@lang('menu.espaniol')</label>

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
                            <label for="dom_detalles_en" class="col-md-4 col-form-label text-md-right">@lang('menu.ingles')</label>

                            <div class="div_register_usernameName">
                                <!-- <input id="dom_detalles_en" type="text" class="form-control{{ $errors->has('dom_detalles_en') ? ' is-invalid' : '' }}" name="dom_detalles_en" value="{{ old('dom_detalles_en') }}" required autofocus pattern="[A-Za-z]+"> -->

                                <!-- <textarea rows="4" cols="50" name="comment" form="usrform"></textarea> -->
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
                    <br>
                    
                </form>
            </div>
        </div>
    </div>
</div>

@endsection




