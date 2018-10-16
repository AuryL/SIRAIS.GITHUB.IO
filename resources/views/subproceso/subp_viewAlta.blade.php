@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- <div class="col-md-8"> -->
            <div class="card">
                <div class="card-header"><strong>@lang('subp.titulo_alta')</strong></div>
                <br>
                <div class="card-body">

                    <form id="form_register" method="POST" action="{{ route('subp_alta') }}">
                        @csrf
                        <br>
                        <div id="div_flex_modificar_expediente">
                            <label class="col-form-label">@lang('subp.instr_alta', ['perfil' => $userPerfil->per_nombre_en])</label>                            
                            <div id="div_boton_registrar" class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button id="boton_alta" onclick="validarSubp()" type="submit" class="btn btn-primary">
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
                        
                        <!-- **** NOMBRE **** -->
                        <div id="div_flex_dom">
                            <!-- Español -->
                            <label id="label_dom" for="subp_nombre_es"><strong>@lang('menu.nombre')</strong></label>

                            <div class="div_register_usernameName">
                                <label for="subp_nombre_es" class="col-md-4 col-form-label text-md-right">@lang('menu.espaniol')</label>

                                <div class="div_register_usernameName">
                                    <input id="subp_nombre_es" placeholder="Modelo gobierno en la Fabrica Digital. " type="text" class="form-control{{ $errors->has('subp_nombre_es') ? ' is-invalid' : '' }}" name="subp_nombre_es" value="{{ old('subp_nombre_es') }}" required autofocus >

                                    @if ($errors->has('subp_nombre_es'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('subp_nombre_es') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Inglés-->
                            <div class="div_register_usernameName">
                                <label for="subp_nombre_en" class="col-md-4 col-form-label text-md-right">@lang('menu.ingles')</label>

                                <div class="div_register_usernameName">
                                    <input id="subp_nombre_en" placeholder="Government model in the Digital Factory. " type="text" class="form-control{{ $errors->has('subp_nombre_en') ? ' is-invalid' : '' }}" name="subp_nombre_en" value="{{ old('subp_nombre_en') }}" required autofocus >

                                    @if ($errors->has('subp_nombre_en'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('subp_nombre_en') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <br>
                        <!-- **** DETALLES **** -->
                        <div id="div_flex_dom">
                        <!-- Español -->
                            <label id="label_dom" for="subp_detalles_es"><strong>@lang('menu.detalles')</strong></label>
        
                            <div class="div_register_usernameName">
                                <label for="subp_detalles_es" class="col-md-4 col-form-label text-md-right">@lang('menu.espaniol')</label>

                                <div class="div_register_usernameName">
                                    <textarea rows="4" cols="50" id="subp_detalles_es" placeholder="@lang('subp.placeholder_subproceso_es')"  type="text" class="form-control{{ $errors->has('subp_detalles_es') ? ' is-invalid' : '' }}" name="subp_detalles_es" value="{{ old('subp_detalles_es') }}" required autofocus ></textarea>

                                    @if ($errors->has('subp_detalles_es'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('subp_detalles_es') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Inglés -->
                            <div class="div_register_usernameName">
                                <label for="subp_detalles_en" class="col-md-4 col-form-label text-md-right">@lang('menu.ingles')</label>

                                <div class="div_register_usernameName">
                                    <textarea rows="4" cols="50" id="subp_detalles_en" placeholder="@lang('subp.placeholder_subproceso_en')" class="form-control{{ $errors->has('subp_detalles_en') ? ' is-invalid' : '' }}" name="subp_detalles_en" value="{{ old('subp_detalles_en') }}" required autofocus ></textarea>

                                    @if ($errors->has('subp_detalles_en'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('subp_detalles_en') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <br>  

                        <!-- PROCESO -->
                        <div id="div_flex_modificar_expediente">
                            <div class="div_register_usernameName">
                                <label for="proceso" class="col-md-4 col-form-label text-md-right">@lang('selects.proceso')</label>

                                <div class="div_register_usernameName"> 
                                    <select id="proceso" name="proceso" class="form-control" onchange="domSubproceso(this.value)" required>
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

                        <!-- <div id="div_flex_modificar_expediente">
                            <div class="div_register_usernameName">
                                <label for="subp_estado" class="col-md-4 col-form-label text-md-right">{{ __('Activo: ') }}</label>

                                <div class="div_register_usernameName">
                                    <input type="checkbox" value="1" id="subp_estado" name="subp_estado">

                                    @if ($errors->has('subp_estado'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('subp_estado') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div id="div_boton_registrar" class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button id="boton_alta_dom" onclick="validarSubp()" type="submit" class="btn btn-primary" disabled="true">
                                        {{ __('Modificar') }}
                                    </button>
                                </div>
                            </div>
                        </div> -->

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



