@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">@lang('menu.arbol')</div>

                <div class="card-body">
                    <div id="div_flex_tree">
                        <div id="div_block_tree">
                            <p>@lang('tree.instr1')</p>
                            <input type="hidden" id="idioma" name="idioma" value="{{$idioma}}">
                            @if($idioma == 'es')
                                <div id="div_tree">
                                    <ul class="tree_menu">
                                        @foreach($dominios as $dominio => $value1) <!-- Dominio -->
                                            <li data-jstree='{"opened":false}'>{{ $value1->dom_nombre_es }} 
                                                <ul>
                                                @foreach($procesos as $proceso => $value2) <!-- Proceso -->
                                                    @if($value1->dom_id == $value2->dom_id)
                                                        <li>{{ $value2->proc_nombre_es }}
                                                            <ul>
                                                                @foreach($subprocesos as $subproceso => $value3) <!-- Subproceso -->
                                                                    @if($value2->proc_id == $value3->proc_id)
                                                                        <li>{{ $value3->subp_nombre_es }}
                                                                            <ul>
                                                                                @foreach($riesgos as $riesgo => $value4) <!-- Riesgo -->
                                                                                    @if($value3->subp_id == $value4->subp_id)
                                                                                        <!-- Funcion cargarActividadesYControles, que por medio del rgo_id, selecciona las actividades y controles correspondientes a dicho riesgo -->
                                                                                        <!-- La funcion esta en el archivo tree.js -->
                                                                                        <li>{{ $value4->rgo_nombre_es }}
                                                                                            <ul>
                                                                                                @foreach($controls as $control => $value5) <!-- Riesgo -->
                                                                                                    @if($value4->rgo_id == $value5->rgo_id)
                                                                                                        <!-- Funcion cargarActividadesYControles, que por medio del rgo_id, selecciona las actividades y controles correspondientes a dicho riesgo -->
                                                                                                        <!-- La funcion esta en el archivo tree.js -->
                                                                                                        <li value="{{ $value5 -> cont_id }}" name="{{ $value4 -> rgo_id }}" onclick="cargarActividadesYControlesAlClick(this.attributes['name'].value, this.value)">{{ $value5->cont_nombre_es }}
                                                                                                            <ul>
                                                                                                                @foreach($actividads as $actividad => $value6) <!-- Riesgo -->
                                                                                                                    @if($value5->cont_id == $value6->cont_id)
                                                                                                                        <!-- Funcion cargarActividadesYControles, que por medio del rgo_id, selecciona las actividades y controles correspondientes a dicho riesgo -->
                                                                                                                        <!-- La funcion esta en el archivo tree.js -->
                                                                                                                        <li>{{ $value6->act_nombre_es }}</li>
                                                                                                                    @endif
                                                                                                                @endforeach
                                                                                                            </ul>
                                                                                                        </li>
                                                                                                    @endif
                                                                                                @endforeach
                                                                                            </ul>                                                                                    
                                                                                        </li>
                                                                                    @endif
                                                                                @endforeach
                                                                            </ul>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                    @endif
                                                @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @elseif($idioma == 'en')
                                <div id="div_tree">
                                    <ul class="tree_menu">
                                        @foreach($dominios as $dominio => $value1) <!-- Dominio -->
                                            <li data-jstree='{"opened":false}'>{{ $value1->dom_nombre_en }} 
                                                <ul>
                                                @foreach($procesos as $proceso => $value2) <!-- Proceso -->
                                                    @if($value1->dom_id == $value2->dom_id)
                                                        <li>{{ $value2->proc_nombre_en }}
                                                            <ul>
                                                                @foreach($subprocesos as $subproceso => $value3) <!-- Subproceso -->
                                                                    @if($value2->proc_id == $value3->proc_id)
                                                                        <li>{{ $value3->subp_nombre_en }}
                                                                            <ul>
                                                                                @foreach($riesgos as $riesgo => $value4) <!-- Riesgo -->
                                                                                    @if($value3->subp_id == $value4->subp_id)
                                                                                        <!-- Funcion cargarActividadesYControles, que por medio del rgo_id, selecciona las actividades y controles correspondientes a dicho riesgo -->
                                                                                        <!-- La funcion esta en el archivo tree.js -->
                                                                                        <li>{{ $value4->rgo_nombre_en }}
                                                                                            <ul>
                                                                                                @foreach($controls as $control => $value5) <!-- Riesgo -->
                                                                                                    @if($value4->rgo_id == $value5->rgo_id)
                                                                                                        <!-- Funcion cargarActividadesYControles, que por medio del rgo_id, selecciona las actividades y controles correspondientes a dicho riesgo -->
                                                                                                        <!-- La funcion esta en el archivo tree.js -->
                                                                                                        <li value="{{ $value5 -> cont_id }}" name="{{ $value4 -> rgo_id }}" onclick="cargarActividadesYControlesAlClick(this.attributes['name'].value, this.value)">{{ $value5->cont_nombre_en }}
                                                                                                            <ul>
                                                                                                                @foreach($actividads as $actividad => $value6) <!-- Riesgo -->
                                                                                                                    @if($value5->cont_id == $value6->cont_id)
                                                                                                                        <!-- Funcion cargarActividadesYControles, que por medio del rgo_id, selecciona las actividades y controles correspondientes a dicho riesgo -->
                                                                                                                        <!-- La funcion esta en el archivo tree.js -->
                                                                                                                        <li>{{ $value6->act_nombre_en }}</li>
                                                                                                                    @endif
                                                                                                                @endforeach
                                                                                                            </ul>
                                                                                                        </li>
                                                                                                    @endif
                                                                                                @endforeach
                                                                                            </ul>                                                                                    
                                                                                        </li>
                                                                                    @endif
                                                                                @endforeach
                                                                            </ul>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                    @endif
                                                @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>



                        <div id="div_block">
                            <h6>@lang('tree.instr2')</h6>
                            <div id="div_block_tabla_controles">
                                
                                <!-- En el contenedor div_controles, se coloca una Tabla (mediante javascript en tree.js), que contiene el control y sus detalles,al cual, el usuario le ha dado click -->
                                <div id="div_controles"></div>     
                            </div> 
                            <!-- Tabla que contiene el numero total de Dominios, Procesos, Subprocesos, Riesgos, Controles y Actividades  y el numero de checkbox seleccionados de los mismos, asi como el porcentaje entre el tital y los seleccionados, correspondientemente-->
                            <p>@lang('tree.instr3')</p>
                            <table class="tabla_porcentajes" border="1">
                                <!-- thead: define el encabezado de la tabla -->
                                <thead class="cabecera_tabla">
                                <!-- Por cada fila que querramos agregar, sera un elemento <tr> mas -->
                                    <tr>
                                        <!-- Por cada celda que querramos agregar, sera un elemento <td> -->
                                        <td class="td_cabecera"></td>
                                        <td class="td_cabecera"><strong>Total</strong></td>
                                        <td class="td_cabecera"><strong>@lang('tree.tabla_porcentaje_seleccionados')</strong></td>
                                        <td class="td_cabecera"><strong>%</strong></td>
                                    </tr>
                                </thead>
                                <!-- tbody: define el cuerpo de la tabla -->
                                <tbody class="cuerpo_tabla">
                                    <tr id="dominio">
                                    </tr>
                                    <tr id="proceso">
                                    </tr>
                                    <tr id="subproceso">
                                    </tr>
                                    <tr id="riesgo">
                                    </tr>
                                    <tr id="control">
                                    </tr>
                                    <tr id="actividad">
                                    </tr>
                                </tbody>          
                            </table>
                                
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <!-- Mensaje de elemento creado correctamente -->
                        @if (session('status'))
                            <div id="mensajeStatus" class="alert alert-success">  
                                <span class="boton" onclick="cerraranuncio('mensajeStatus')">x</span>
                                {{ session('status') }}
                            </div>
                        @endif

                        <form  onsubmit="return checkSubmit();">
                            <div class="col sm-12">
                                <!-- Funcion  generarExcel(): Genera un excel, con base a las opciones seleccionadas en el arbol(tree) -->
                                <!-- La funcion se encuentra en el archivo tree.js -->
                                <button id="boton_excel" onclick="generarExcel()"  type="submit" class="btn btn-primary">
                                    @lang('boton.boton_excel')
                                </button>

                            </div>
                        </form>
                        
                        <div id="div_vistaPrevia">
                        <br>
                        <p>@lang('tree.instr4')</p>
                            
                            <!-- Tabla que contiene  -->
                            <table class="tabla_vistaPrevia" border="1">
                                <!-- thead: define el encabezado de la tabla -->
                                <thead class="cabecera_tabla">
                                <!-- Por cada fila que querramos agregar, sera un elemento <tr> mas -->
                                    <tr>
                                        <!-- Por cada celda que querramos agregar, sera un elemento <td> -->
                                        <td class="td_cabecera"><strong>@lang('menu.dominio')</strong></td>
                                        <td class="td_cabecera"><strong>@lang('menu.proceso')</strong></td>
                                        <td class="td_cabecera"><strong>@lang('menu.subp')</strong></td>
                                        <td class="td_cabecera"><strong>@lang('menu.riesgo')</strong></td>
                                        <td class="td_cabecera"><strong>@lang('menu.control')</strong></td>
                                        <td class="td_cabecera"><strong>@lang('menu.actividad')</strong></td>
                                    </tr>
                                </thead>
                                <!-- tbody: define el cuerpo de la tabla -->
                                <tbody class="cuerpo_tabla_vistaPrevia">
                                    
                                </tbody>          
                            </table>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
