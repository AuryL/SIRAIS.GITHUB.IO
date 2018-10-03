<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

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
        // validate
        $rules = array(
            'cont_nombre_es' => 'required|string|max:45',
            'cont_nombre_en' => 'required|string|max:45',
            'cont_detalles_es' => 'required|string|max:280',
            'cont_detalles_en' => 'required|string|max:280'
        );
        
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('home')
                ->withErrors($validator);
        } else {
            // store
            $contId = $request->cont_id;
            $cont = Control::where('cont_id',$contId)->first();    

            $cont->cont_nombre_en = $request->cont_nombre_en;
            $cont->cont_detalles_es = $request->cont_detalles_es;
            $cont->cont_detalles_en = $request->cont_detalles_en; 
            $cont->rgo_id = $request->rgo_id; 

            if(($request->cont_estado) == null) {
                $cont->cont_estado = 0;
            }else {
                $cont->cont_estado = 1;
            }
            $cont->save();

            $response = array(
                'status' => 'success',
                'msg' => $request->message,
            );
            return response()->json($response); 

            // $user = Auth::user();
            // $userPerfil = \DB::table('perfils')
            // ->select('perfils.*')
            // ->where('perfils.per_id','=',$user->per_id)
            // ->first();
            // $doms = Dominio::all();
            // $procs = Proceso::all();
            // $subps = Subproceso::all();
            // $rgos = Riesgo::all();



            // // redirect
            // Session::flash('message', 'Successfully updated nerd!');     

            // return view('/riesgo/rgo_viewModificar', ['user' => $user, 'userPerfil' => $userPerfil, 'doms' => $doms, 'procs' => $procs, 'subps' => $subps, 'rgos' => $rgos]);
            
            // return $cont;

            // return Redirect::to('/proceso/proc_viewAlta');
            // return response()->json(['success'=>'Data is successfully added']);       
        }
    }
}
