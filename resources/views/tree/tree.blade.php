@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">ARBOL DE RIESGOS</div>

                <div class="card-body">

                    <div id="div_flex_tree">
                        <div id="div_block_tree">
                            <p>Selecciona los riesgos que consideres dentro del arbol de dominios: </p>
                            <div id="div_tree">
                                <ul class="tree_menu">
                                    @foreach($dominios as $dominio => $value1) <!-- Dominio -->
                                        <li data-jstree='{"opened":false}'>{{ $value1->dom_nombre_es }} 
                                            <!-- data-jstree='{"opened":false}' es parte del plugin jstree y permite colocar la estructura html en forma de arbol -->
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
                                                                                    <li value="{{ $value4 -> rgo_id }}">{{ $value4->rgo_nombre_es }}</li>
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
                        </div>
                        <div id="div_block">
                            <h6>CONTROLES ASOCIADO</h6>
                            <div id="div_controles">
                            </div>

                            <h6>ACTIVIDADES ASOCIADAS</h6>
                            <div id="div_actividades">
                            </div>            
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col sm-12">
                            <!-- Funcion  generarExcel(): Genera un excel, con base a las opciones seleccionadas en el arbol(tree) -->
                            <!-- La funcion se encuentra en el archivo tree.js -->
                            <button class="btn btn-primary" onclick="generarExcel()">Generar Excel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection