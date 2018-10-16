@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- <div class="col-md-8"> -->
            <div class="card">
                <div class="card-header"><strong>@lang('dominio.titulo_modificar')</strong></div>
                <br>
                <div class="card-body">
                    
                    <form id="form_dom" method="POST" action="{{ route('dom_modificar') }}">
                    
                        <div id="div_flex_modificar_expediente">
                            <label class="col-form-label text-md-right">@lang('dominio.instr_modificar')</label>
                            <br> <br> <br>
                            <!-- Seleccionar el expediente del usuario que se desea Modificar -->
                            <div id="div_modificar_expediente" class="form-group{{ $errors->has('dominio') ? ' has-error' : '' }}">
                                <select id="dominio" name="dominio" class="form-control" onchange="dominioSelected(this.value)" required>
                                    <option selected value="0" disabled="disabled" >@lang('selects.select_dominio')</option>                               
                                    @foreach($doms as $dom => $value)

                                        @if($idioma == "es")
                                            <option id="dominio" value="{{ $value->dom_id }}">{{ $value->dom_nombre_es }}</option>  
                                        @elseif($idioma == "en")
                                            <option id="dominio" value="{{ $value->dom_id }}">{{ $value->dom_nombre_en }}</option>  
                                        @endif
                                        
                                    @endforeach  
                                </select>
                                @if ($errors->has('dominio'))
                                    <span class="invalid-feedback">
                                        <label class="label-texto"><strong>{{ $errors->first('dominio') }}</strong></label>
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

                        {!! session()->get('error') !!} 

                        <!-- ID -->
                        <input type="hidden" id="dom_id" name="dom_id" value="dom_id">

                        <!-- NOMBRE -->
                        <div id="div_flex_dom">
                            <!-- Español -->
                            <label id="label_dom" for="dom_nombre_es"><strong>@lang('menu.nombre')</strong></label>
                            <div class="div_register_usernameName">
                                <label for="dom_nombre_es" class="col-md-4 col-form-label text-md-right">@lang('menu.espaniol')</label>

                                <div class="div_register_usernameName">
                                    <input id="dom_nombre_es" placeholder="Ciberseguridad" type="text" class="form-control{{ $errors->has('dom_nombre_es') ? ' is-invalid' : '' }}" name="dom_nombre_es" value="{{ old('dom_nombre_es') }}" required autofocus disabled="true" pattern="[A-Za-z0-9]+">

                                    @if ($errors->has('dom_nombre_es'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('dom_nombre_es') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Inglés -->
                            <div class="div_register_usernameName">
                                <label for="dom_nombre_en" class="col-md-4 col-form-label text-md-right">@lang('menu.ingles')</label>

                                <div class="div_register_usernameName">
                                    <input id="dom_nombre_en"  placeholder="Cybersecurity"  type="text" class="form-control{{ $errors->has('dom_nombre_en') ? ' is-invalid' : '' }}" name="dom_nombre_en" value="{{ old('dom_nombre_en') }}" required autofocus disabled="true" pattern="[A-Za-z0-9]+">

                                    @if ($errors->has('dom_nombre_en'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('dom_nombre_en') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- DETALLES -->
                        <div id="div_flex_dom">
                        <!-- Español -->
                        <label id="label_dom" for="dom_detalles_es"><strong>@lang('menu.detalles')</strong></label>
    
                            <div class="div_register_usernameName">
                                <label for="dom_detalles_es" class="col-md-4 col-form-label text-md-right">@lang('menu.espaniol')</label>

                                <div class="div_register_usernameName">                                
                                <textarea rows="4" cols="50" id="dom_detalles_es" placeholder="@lang('dominio.placeholder_dominio_es')"  type="text" class="form-control{{ $errors->has('dom_detalles_es') ? ' is-invalid' : '' }}" name="dom_detalles_es" value="{{ old('dom_detalles_es') }}" required autofocus disabled="true" pattern="[A-Za-z0-9]+"></textarea>
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
                                    <textarea rows="4" cols="50" id="dom_detalles_en" placeholder="@lang('dominio.placeholder_dominio_en')"  class="form-control{{ $errors->has('dom_detalles_en') ? ' is-invalid' : '' }}" name="dom_detalles_en" value="{{ old('dom_detalles_en') }}" required autofocus disabled="true" pattern="[A-Za-z0-9]+"></textarea>

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
                                <label for="dom_estado" class="col-md-4 col-form-label text-md-right">@lang('selects.activo')</label>

                                <div class="div_register_usernameName">
                                    <input type="checkbox" value="1" id="dom_estado" name="dom_estado" disabled="true">

                                    @if ($errors->has('dom_estado'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('dom_estado') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Boton -->
                            <div id="div_boton_registrar" class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <br>
                                    <button id="boton_modificar" onclick="validarDom()" type="submit" class="btn btn-primary" disabled="true">
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




