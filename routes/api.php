<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization, X-Auth-Token');
header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, HEAD, OPTIONS');

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use App\User;
Use App\Dominio;
Use App\Proceso;
Use App\Subproceso;
Use App\Riesgo;
Use App\Control;
Use App\Actividad;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('riesgos', function() {
    // If the Content-Type and Accept headers are set to 'application/json', 
    // this will return a JSON structure. This will be cleaned up later.
    return Riesgo::all();
});


/////////////////// ACTIVIDADES /////////////////////
Route::post('treeexcel', 'TreeController@export')->name('treeexcel');



/////////////////// Coloca solo las actividaes y controles que va seleccionando, sin concateniar /////////////////////
// ACTIVIDADES
// cargar_actividades:  Obtiene los actividades que correspondan con el rgo_id seleccionado en el checkbox del arbol y el rgo_id de la actividad
Route::get('cargar_actividades/{cont_id}', function($cont_id) {
    $actividades = Actividad::where('cont_id',$cont_id);
    return $actividades->get();// regresa en tree.js -> $.get("http://127.0.0.1:8000/api/cargar_actividades/" + cont_id, function (data) { 
                               // los controles que coincidan con cont_id
});
// CONTROLES
// cargar_controles: Obtiene los controles que correspondan con el rgo_id seleccionado en el checkbox del arbol y el rgo_id del  control
Route::get('cargar_controles/{rgo_id}', function($rgo_id) {
    $controles = Control::where('rgo_id',$rgo_id);
    return $controles->get(); // regresa en tree.js -> $.get("http://127.0.0.1:8000/api/cargar_controles/" + rgo_id, function (data) { 
                              // los controles que coincidan con rgo_id
});
// MODIFICAR CONTROLES - RIESGO
Route::get('cargar_controlRiesgo/{cont_id}', function($cont_id) {
    $control = Control::where('cont_id',$cont_id);
    return $controles->get(); // regresa en tree.js -> $.get("http://127.0.0.1:8000/api/cargar_controles/" + rgo_id, function (data) { 
                              // los controles que coincidan con rgo_id
});







/////////////////// va añadiendo los controles y actividades /////////////////////
// Obtiene los controles que correspondan con el rgo_id seleccionado en el checkbox del arbol y el rgo_id del  control
Route::get('addContr/{rgo_id}', function($rgo_id) {
    $controles = Control::where('rgo_id',$rgo_id);
    return $controles->get(); // regresa en tree.js -> $.get("http://127.0.0.1:8000/api/addContr/" + rgo_id, function (data) { 
                              // los controles que coincidan con rgo_id
});
// Obtiene las actividades que correspondan con el rgo_id seleccionado en el checkbox del arbol y el rgo_id del  control
Route::get('addAct/{cont_id}', function($cont_id) {
    $actividades = Actividad::where('cont_id',$cont_id);
    return $actividades->get(); // regresa en tree.js -> $.get("http://127.0.0.1:8000/api/addAct/" + cont_id, function (data) { 
                              // las actividades que coincidan con cont_id
});


/////////////////// DATOS USUARIO /////////////////////
Route::get('cargar_datosUser/{username}', function($username) {
    $usuario = User::where('username',$username);
    return $usuario->get(); 
});



/////////////////// DATOS DOMINIO /////////////////////
Route::get('cargar_datosdom/{dominio}', function($dominio) {
    $dom = Dominio::where('dom_id',$dominio);
    return $dom->get(); 
});



/////////////////// DATOS PROCESO /////////////////////
Route::get('cargar_datosFiltroDominio/{dominio}', function($dominio) {
    $proceso = Proceso::where('dom_id',$dominio);
    return $proceso->get(); 
});
Route::get('cargar_datosProc/{proceso}', function($proceso) {
    $proc = Proceso::where('proc_id',$proceso);
    return $proc->get(); 
});




// PROCESO
Route::get('cargar_datosFiltroDominio/{dominio}', function($dominio) {
    $proceso = Proceso::where('dom_id',$dominio);
    return $proceso->get(); 
});
Route::get('cargar_datosFiltroProceso/{proceso}', function($proceso) {
    $subp = Subproceso::where('proc_id',$proceso);
    return $subp->get(); 
});
/////////////////// DATOS Dominio asociado al Subproceso /////////////////////
Route::get('cargar_subpId/{proceso}', function($proceso) {
    $proc = Proceso::where('proc_id',$proceso);
    return $proc->get(); 
});
/////////////////// DATOS Dominio asociado al Subproceso /////////////////////
Route::get('cargar_domId/{dom_id}', function($dom_id) {
    $dominio = Dominio::where('dom_id',$dom_id);
    return $dominio->get(); 
});
/////////////////// DATOS Subproceso /////////////////////
Route::get('cargar_datosSubp/{subproceso}', function($subproceso) {
    $subp = Subproceso::where('subp_id',$subproceso);
    return $subp->get(); 
});





///////////////////////RIESGOS - CONTROLES / ACTIVIDDES///////////////////////// cargar_datosFiltroSubp
Route::post('modificarControl', 'ControlController@post');
Route::post('modificarActividad', 'ActividadController@post');











// RIESGO
Route::get('cargar_datosFiltroDominio/{dominio}', function($dominio) {
    $proceso = Proceso::where('dom_id',$dominio);
    return $proceso->get(); 
});
Route::get('cargar_datosFiltroProceso/{proceso}', function($proceso) {
    $subp = Subproceso::where('proc_id',$proceso);
    return $subp->get(); 
});
/////////////////// DATOS Dominio asociado al Subproceso /////////////////////
Route::get('cargar_datosFiltroSubp/{subproceso}', function($subproceso) {
    $rgo = Riesgo::where('subp_id',$subproceso);
    return $rgo->get(); 
});

/////////////////// DATOS Proceso asociado al Riesgo /////////////////////
Route::get('cargar_rgoId/{subproceso}', function($subproceso) {
    $subp = Subproceso::where('subp_id',$subproceso);
    return $subp->get(); 
});
/////////////////// DATOS Dominio asociado al Subproceso /////////////////////
Route::get('cargar_procId/{proc_id}', function($proc_id) {
    $proceso = Proceso::where('proc_id',$proc_id);
    return $proceso->get(); 
});

/////////////////// DATOS Subproceso /////////////////////
Route::get('cargar_datosRgo/{riesgo}', function($riesgo) {
    $rgo = Riesgo::where('rgo_id',$riesgo);
    return $rgo->get(); 
});
/////////////////////////////////////
Route::get('cargar_contSelect/{riesgo}', function($riesgo) {
    $control = Control::where('rgo_id',$riesgo);
    return $control->get(); 
});
/////////////////////////////////////
Route::get('cargar_actSelect/{control}', function($control) {
    $actividad = Actividad::where('cont_id',$control);
    return $actividad->get(); 
});
///////////////////////////////////////////////
Route::get('cargar_contRiesgo/{cont_id}', function($cont_id) {
    $cont = Control::where('cont_id',$cont_id);    
    return $cont->get(); 
});
///////////////////////////////////////////////
Route::get('cargar_actControl/{act_id}', function($act_id) {
    $act = Actividad::where('act_id',$act_id);    
    return $act->get(); 
});








///////////////////////////////////////////////
Route::get('cargar_control/{riesgo}/{cont_id}', function($riesgo) {
    $control = \DB::table('controls')
    ->select('controls.*')
    ->leftjoin('riesgos', 'riesgos.rgo_id','=', 'controls.rgo_id')
    ->where('riesgos.rgo_id', '=', $riesgo)
    ->where('controls.rgo_id', '=', $riesgo)
    ->where('controls.cont_id', '=', $cont_id)
    ->first();

    return $control; 
});





////////////////////////// OBTENER Dominios, Procesos, Subprocesos, Riesgos, Controles, Actividades/////////////////////
Route::get('cargar_allElementsTree', function() {
    $dom = Dominio::all();
    $proc = Proceso::all();
    $subp = Subproceso::all();
    $rgo = Riesgo::all();    
    $cont = Control::all();
    $act = Actividad::all(); 
    
    $allElements = [$dom, $proc, $subp, $rgo, $cont, $act];    
    // $allElements = [$dom, $proc, $subp, $rgo, $cont];

    return $allElements;
});



