<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

use App\User;
use App\Perfil;
use App\Dominio;
use App\Proceso;
use App\Subproceso;
use App\Riesgo;
use App\Control;
use App\Actividad;

use Auth;
use Redirect;
use Session;
use Validator;

class ControlController extends Controller
{
    // 
    public function viewModificar ($riesgo, $cont_id) {

        $user = Auth::user();    

        $userPerfil = \DB::table('perfils')
        ->select('perfils.*')
        ->where('perfils.per_id','=',$user->per_id)
        ->first();

        $rgo = Riesgo::where('rgo_id',$riesgo)->first();
        
        // echo($rgo)->rgo_id;
        
        $control = \DB::table('controls')
        ->select('controls.*')
        ->leftjoin('riesgos', 'riesgos.rgo_id','=', 'controls.rgo_id')
        ->where('riesgos.rgo_id', '=', $riesgo)
        ->where('controls.rgo_id', '=', $riesgo)
        ->where('controls.cont_id', '=', $cont_id)
        ->first();  

        // echo($control->cont_nombre_es);

        
        return view('/control/cont_viewModificar', ['user' => $user, 'userPerfil' => $userPerfil, 'rgo' => $rgo, 'control' => $control]);
    }

    // 
    public function post (Request $request) {

        /*************************** PRUEBA 1 *************************/
        // validate
        $rules = array(
            'cont_nombre_es' => 'required|string|max:45',
            'cont_nombre_en' => 'required|string|max:45',
            'cont_detalles_es' => 'required|string|max:280',
            'cont_detalles_en' => 'required|string|max:280'
        );
        
        $validator = Validator::make($request->all(), $rules);
        
        // process the login
        if ($validator->fails()) {
            return response()->json($validator->error(), 400);
        }else{
        
            // store
            $input = $request->all();

            // $contId = $request->cont_id;
            // $cont = Control::findOrFail($contId); 
            // $cont->update($input);       
            $cont = Control::create($input);
        
            return response()->json(['details' => $cont], 200);      
             
        }

    }
}
