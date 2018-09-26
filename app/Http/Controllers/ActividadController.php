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

class ActividadController extends Controller
{
    // 
    public function viewModificar ($riesgo, $act_id) {

        $user = Auth::user();    

        $userPerfil = \DB::table('perfils')
        ->select('perfils.*')
        ->where('perfils.per_id','=',$user->per_id)
        ->first();

        $rgo = Riesgo::where('rgo_id',$riesgo)->first();
        
        // echo($rgo)->rgo_id;
        
        $actividad = \DB::table('actividads')
        ->select('actividads.*')
        ->leftjoin('riesgos', 'riesgos.rgo_id','=', 'actividads.rgo_id')
        ->where('riesgos.rgo_id', '=', $riesgo)
        ->where('actividads.rgo_id', '=', $riesgo)
        ->where('actividads.act_id', '=', $act_id)
        ->first();  

        // echo($actividad->act_nombre_es);

        
        return view('/actividad/act_viewModificar', ['user' => $user, 'userPerfil' => $userPerfil, 'rgo' => $rgo, 'actividad' => $actividad]);
    }

    // 
    public function modificar () {
        // validate
        $rules = array(
            'act_nombre_es' => 'required|string|max:45',
            'act_nombre_en' => 'required|string|max:45',
            'act_detalles_es' => 'required|string|max:280',
            'act_detalles_en' => 'required|string|max:280'
        );
        
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('home')
                ->withErrors($validator);
        } else {
            // store
            $actId = Input::get('act_id');

            $act = actividad::where('act_id',$actId)->first();    

            $act->act_nombre_en = Input::get('act_nombre_en');
            $act->act_detalles_es = Input::get('act_detalles_es');
            $act->act_detalles_en = Input::get('act_detalles_en'); 
            $act->rgo_id = Input::get('rgo_id'); 

            if((Input::get('act_estado')) == null) {
                $act->act_estado = 0;
            }else {
                $act->act_estado = 1;
            }
            $act->save();



            

            $user = Auth::user();
            $userPerfil = \DB::table('perfils')
            ->select('perfils.*')
            ->where('perfils.per_id','=',$user->per_id)
            ->first();
            $doms = Dominio::all();
            $procs = Proceso::all();
            $subps = Subproceso::all();
            $rgos = Riesgo::all();



            // redirect
            Session::flash('message', 'Successfully updated nerd!');     
            return view('/riesgo/rgo_viewModificar', ['user' => $user, 'userPerfil' => $userPerfil, 'doms' => $doms, 'procs' => $procs, 'subps' => $subps, 'rgos' => $rgos]);
            return Redirect::to('/proceso/proc_viewAlta');       
        }
    }
}
