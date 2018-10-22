@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- <div class="col-md-8"> -->
            <div class="card">
                <div class="card-header"><strong>@lang('proceso.titulo_alta')</strong></div>
                <br>
                <div class="card-body">

                    <form id="form_register" method="POST" action="{{ route('proc_alta') }}" onsubmit="return checkSubmit_alta_dom();">
                        @csrf
                        <br>
                        <div id="div_flex_modificar_expediente">
                            <label class="col-form-label">@lang('proceso.instr_alta', ['perfil' => $userPerfil->per_nombre_en])</label>                            
                        </div>
                        <br>

                        <!-- Mensaje de elemento creado correctamente -->
                        <!-- @if (session('status'))
                            <div id="mensajeStatus" class="alert alert-success">  
                                <span class="boton" onclick="cerraranuncio('mensajeStatus')">x</span>
                                {{ session('status') }}
                            </div>
                        @endif -->


                        @if (count($errors) > 0)
                            <div class="alert alert-error">  
                                <strong>Whoops!</strong> Hay algunos problemas con tus inputs<br><br>
                                <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                    </ul>
                            </div>
                        @elseif (session('status')) 
                            <div id="mensajeStatus" class="alert alert-success">  
                                <span class="boton" onclick="cerraranuncio('mensajeStatus')">x</span>
                                {{ session('status') }}
                            </div>
                        @endif


                        <!-- DOMINIO -->
                        <!-- <div id="div_flex"> -->
                        <div id="div_flex_modificar_expediente">
                            <div class="div_register_usernameName">
                                <label for="dom_id" class="col-md-4 col-form-label text-md-right">@lang('selects.dominio')</label>

                                <div id="div_register_usernameName" class="form-group{{ $errors->has('dominio') ? ' has-error' : '' }}">
                                    <select id="dom_id" name="dom_id" class="form-control" required>
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
                            </div>

                            
                            
                            <!-- Boton -->
                            <div id="div_boton_registrar" class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <br>
                                    <button id="boton_alta_dom" onclick="validarProc()" type="submit" class="btn btn-primary">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@lang('boton.boton_registrar')&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </button>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" id="idioma" name="idioma" value="{{$idioma}}">

                        <!-- **** NOMBRE **** -->
                        <div id="div_flex_dom">
                            <!-- Español -->
                            <label id="label_dom" for="proc_nombre_es"><strong>@lang('menu.nombre')</strong></label>

                            <div class="div_register_usernameName">
                                <label for="proc_nombre_es" class="col-md-4 col-form-label text-md-right">@lang('menu.espaniol')</label>

                                <div class="div_register_usernameName">
                                    <input id="proc_nombre_es" type="text" class="form-control{{ $errors->has('proc_nombre_es') ? ' is-invalid' : '' }}"  placeholder="Ciberseguridad" name="proc_nombre_es" value="{{ old('proc_nombre_es') }}" required autofocus pattern="^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$">

                                    @if ($errors->has('proc_nombre_es'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('proc_nombre_es') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Inglés-->
                            <div class="div_register_usernameName">
                                <label for="proc_nombre_en" class="col-md-4 col-form-label text-md-right">@lang('menu.ingles')</label>

                                <div class="div_register_usernameName">
                                    <input id="proc_nombre_en" type="text" class="form-control{{ $errors->has('proc_nombre_en') ? ' is-invalid' : '' }}" placeholder="Cybersecurity" name="proc_nombre_en" value="{{ old('proc_nombre_en') }}" required autofocus pattern="^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$">

                                    @if ($errors->has('proc_nombre_en'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('proc_nombre_en') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <br>
                        <!-- **** DETALLES **** -->
                        <div id="div_flex_dom">
                        <!-- Español -->
                            <label id="label_dom" for="proc_detalles_es"><strong>@lang('menu.detalles')</strong></label>
        
                            <div class="div_register_usernameName">
                                <label for="proc_detalles_es" class="col-md-4 col-form-label text-md-right">@lang('menu.espaniol')</label>

                                <div class="div_register_usernameName">
                                    <textarea rows="4" cols="50" id="proc_detalles_es" placeholder="Escribe el detalle del proceso en idioma español aquí..."   type="text" class="form-control{{ $errors->has('proc_detalles_es') ? ' is-invalid' : '' }}" name="proc_detalles_es" value="{{ old('proc_detalles_es') }}" required autofocus pattern="[A-Za-z0-9]+[\$%{[}].,;*&_-|<>#\]+"></textarea>

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
                                    <textarea rows="4" cols="50" id="proc_detalles_en" placeholder="Escribe el detalle del dominio en idioma inglés aquí..."   class="form-control{{ $errors->has('proc_detalles_en') ? ' is-invalid' : '' }}" name="proc_detalles_en" value="{{ old('proc_detalles_en') }}" required autofocus pattern="[A-Za-z0-9]+[\$%{[}].,;*&_-|<>#\]+"></textarea>

                                    @if ($errors->has('proc_detalles_en'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('proc_detalles_en') }}</strong>
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



