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


class RiesgoController extends Controller
{
    // 
    public function viewRiesgo () {

        $user = Auth::user();    

        $userPerfil = \DB::table('perfils')
        ->select('perfils.*')
        ->where('perfils.per_id','=',$user->per_id)
        ->first();

        $procs = Proceso::all();
        $subps = Subproceso::all();
        
        return view('/riesgo/rgo_viewAlta', ['user' => $user, 'userPerfil' => $userPerfil, 'procs' => $procs, 'subps' => $subps]);
    }




    // 
    public function altaRiesgo () {
        
        $user = Auth::user();    

        $userPerfil = \DB::table('perfils')
        ->select('perfils.*')
        ->where('perfils.per_id','=',$user->per_id)
        ->first();

        $procs = Proceso::all();
        $subps = Subproceso::all();

        $rules = array(
            'rgo_nombre_es' => 'required|string|max:45',
            'rgo_nombre_en' => 'required|string|max:45',
            'rgo_detalles_es' => 'required|string|max:280',
            'rgo_detalles_en' => 'required|string|max:280'
        );
        
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('/home')
                ->withErrors($validator);
        } else {
            // store
            $rgo = new Riesgo;
            $rgo->rgo_nombre_es = Input::get('rgo_nombre_es');
            $rgo->rgo_nombre_en = Input::get('rgo_nombre_en');
            $rgo->rgo_detalles_es = Input::get('rgo_detalles_es');
            $rgo->rgo_detalles_en = Input::get('rgo_detalles_en');                   
            $rgo->subp_id = Input::get('subproceso');
            $rgo->save();

            // redirect
            Session::flash('message', 'Successfully updated nerd!');
            // return Redirect::to('/proceso/proc_viewAlta');
            // return Redirect::to('home');
            return view('/riesgo/rgo_viewAlta',['user' => $user, 'userPerfil' => $userPerfil, 'procs' => $procs, 'subps' => $subps]);
        }
    }




    
    //  
    public function viewModificar () {

        $user = Auth::user();        

        $doms = Dominio::all();
        $procs = Proceso::all();
        $subps = Subproceso::all();
        $rgos = Riesgo::all();
        

        return view('/riesgo/rgo_viewModificar', ['user' => $user, 'doms' => $doms, 'procs' => $procs, 'subps' => $subps, 'rgos' => $rgos]);
    }




    // 
    public function modificar () {
        // validate
        $rules = array(
            'rgo_nombre_es' => 'required|string|max:45',
            'rgo_nombre_en' => 'required|string|max:45',
            'rgo_detalles_es' => 'required|string|max:280',
            'rgo_detalles_en' => 'required|string|max:280'
        );
        
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('home')
                ->withErrors($validator);
        } else {
            // store
            $rgoId = Input::get('rgo_id');

            $riesgo = \DB::table('riesgos')
            ->select('riesgos.*')
            ->where('riesgos.rgo_id','=',$rgoId)
            ->first();
            
            $rgo = Riesgo::find($riesgo->rgo_id);

            $rgo->rgo_nombre_es = Input::get('rgo_nombre_es');
            $rgo->rgo_nombre_en = Input::get('rgo_nombre_en');
            $rgo->rgo_detalles_es = Input::get('rgo_detalles_es');
            $rgo->rgo_detalles_en = Input::get('rgo_detalles_en'); 
            $rgo->subp_id = Input::get('subproceso'); 

            if((Input::get('rgo_estado')) == null) {
                $rgo->rgo_estado = 0;
            }else {
                $rgo->rgo_estado = 1;
            }
            $rgo->save();



            

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
            // return Redirect::to('/proceso/proc_viewAlta');       
        }
    }
}
