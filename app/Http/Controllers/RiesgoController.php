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

        // $procs = Proceso::all();
        // $subps = Subproceso::all();

        $idioma = app()->getLocale();        
        if($idioma == "es"){

            $doms = \DB::table('dominios')
            ->select('dominios.dom_id', 'dominios.dom_nombre_es', 'dominios.dom_detalles_es', 'dominios.dom_estado', 'created_at', 'updated_at')
            ->get();

            $procs = \DB::table('procesos')
            ->select('procesos.proc_id', 'procesos.proc_nombre_es', 'procesos.proc_detalles_es', 'procesos.proc_estado', 'created_at', 'updated_at')
            ->get();          
            
            $subps = \DB::table('subprocesos')
            ->select('subprocesos.subp_id', 'subprocesos.subp_nombre_es', 'subprocesos.subp_detalles_es', 'subprocesos.subp_estado', 'created_at', 'updated_at')
            ->get(); 


        }else{
            if($idioma == "en"){
                $doms = \DB::table('dominios')
                ->select('dominios.dom_id', 'dominios.dom_nombre_en', 'dominios.dom_detalles_en', 'dominios.dom_estado', 'created_at', 'updated_at')
                ->get();
    
                $procs = \DB::table('procesos')
                ->select('procesos.proc_id', 'procesos.proc_nombre_en', 'procesos.proc_detalles_en', 'procesos.proc_estado', 'created_at', 'updated_at')
                ->get();

                $subps = \DB::table('subprocesos')
                ->select('subprocesos.subp_id', 'subprocesos.subp_nombre_en', 'subprocesos.subp_detalles_en', 'subprocesos.subp_estado', 'created_at', 'updated_at')
                ->get();

            }
        }
        
        return view('/riesgo/rgo_viewAlta', ['user' => $user, 'userPerfil' => $userPerfil, 'idioma' => $idioma, 'doms' => $doms, 'procs' => $procs, 'subps' => $subps]);
    }




    // 
    public function altaRiesgo () {
        
        $user = Auth::user();    

        $userPerfil = \DB::table('perfils')
        ->select('perfils.*')
        ->where('perfils.per_id','=',$user->per_id)
        ->first();

        // $procs = Proceso::all();
        // $subps = Subproceso::all();

        $idioma = app()->getLocale();        
        if($idioma == "es"){

            $doms = \DB::table('dominios')
            ->select('dominios.dom_id', 'dominios.dom_nombre_es', 'dominios.dom_detalles_es', 'dominios.dom_estado', 'created_at', 'updated_at')
            ->get();

            $procs = \DB::table('procesos')
            ->select('procesos.proc_id', 'procesos.proc_nombre_es', 'procesos.proc_detalles_es', 'procesos.proc_estado', 'created_at', 'updated_at')
            ->get();          
            
            $subps = \DB::table('subprocesos')
            ->select('subprocesos.subp_id', 'subprocesos.subp_nombre_es', 'subprocesos.subp_detalles_es', 'subprocesos.subp_estado', 'created_at', 'updated_at')
            ->get(); 


        }else{
            if($idioma == "en"){
                $doms = \DB::table('dominios')
                ->select('dominios.dom_id', 'dominios.dom_nombre_en', 'dominios.dom_detalles_en', 'dominios.dom_estado', 'created_at', 'updated_at')
                ->get();
    
                $procs = \DB::table('procesos')
                ->select('procesos.proc_id', 'procesos.proc_nombre_en', 'procesos.proc_detalles_en', 'procesos.proc_estado', 'created_at', 'updated_at')
                ->get();

                $subps = \DB::table('subprocesos')
                ->select('subprocesos.subp_id', 'subprocesos.subp_nombre_en', 'subprocesos.subp_detalles_en', 'subprocesos.subp_estado', 'created_at', 'updated_at')
                ->get();

            }
        }

        $rules = array(
            'rgo_nombre_es' => 'required|string|max:45',
            'rgo_nombre_en' => 'required|string|max:45',
            'rgo_detalles_es' => 'required|string|max:280',
            'rgo_detalles_en' => 'required|string|max:280'
        );
        
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            // return Redirect::to('/home')
            //     ->withErrors($validator);
            return redirect('/riesgo/rgo_viewAlta')->with('status', $validator);

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
            // return Redirect::to('/proceso/proc_viewAlta');
            return redirect('/riesgo/rgo_viewAlta')->with('status', 'Riesgo creado correctamente');

        }
    }




    
    //  
    public function viewModificar () {

        $user = Auth::user();        

        // $doms = Dominio::all();
        // $procs = Proceso::all();
        // $subps = Subproceso::all();
        // $rgos = Riesgo::all();

        
        $idioma = app()->getLocale();        
        if($idioma == "es"){

            $doms = \DB::table('dominios')
            ->select('dominios.dom_id', 'dominios.dom_nombre_es', 'dominios.dom_detalles_es', 'dominios.dom_estado', 'created_at', 'updated_at')
            ->get();

            $procs = \DB::table('procesos')
            ->select('procesos.proc_id', 'procesos.proc_nombre_es', 'procesos.proc_detalles_es', 'procesos.proc_estado', 'created_at', 'updated_at')
            ->get();          
            
            $subps = \DB::table('subprocesos')
            ->select('subprocesos.subp_id', 'subprocesos.subp_nombre_es', 'subprocesos.subp_detalles_es', 'subprocesos.subp_estado', 'created_at', 'updated_at')
            ->get(); 

            $rgos = \DB::table('riesgos')
            ->select('riesgos.rgo_id', 'riesgos.rgo_nombre_es', 'riesgos.rgo_detalles_es', 'riesgos.rgo_estado', 'created_at', 'updated_at')
            ->get(); 


        }else{
            if($idioma == "en"){
                $doms = \DB::table('dominios')
                ->select('dominios.dom_id', 'dominios.dom_nombre_en', 'dominios.dom_detalles_en', 'dominios.dom_estado', 'created_at', 'updated_at')
                ->get();
    
                $procs = \DB::table('procesos')
                ->select('procesos.proc_id', 'procesos.proc_nombre_en', 'procesos.proc_detalles_en', 'procesos.proc_estado', 'created_at', 'updated_at')
                ->get();

                $subps = \DB::table('subprocesos')
                ->select('subprocesos.subp_id', 'subprocesos.subp_nombre_en', 'subprocesos.subp_detalles_en', 'subprocesos.subp_estado', 'created_at', 'updated_at')
                ->get();

                $rgos = \DB::table('riesgos')
                ->select('riesgos.rgo_id', 'riesgos.rgo_nombre_en', 'riesgos.rgo_detalles_en', 'riesgos.rgo_estado', 'created_at', 'updated_at')
                ->get(); 

            }
        }
        

        return view('/riesgo/rgo_viewModificar', ['user' => $user, 'idioma' => $idioma, 'doms' => $doms, 'procs' => $procs, 'subps' => $subps, 'rgos' => $rgos]);
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
            // return Redirect::to('home')
            //     ->withErrors($validator);
            return redirect('/riesgo/rgo_viewModificar')->with('status', $validator);

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

            // $doms = Dominio::all();
            // $procs = Proceso::all();
            // $subps = Subproceso::all();
            // $rgos = Riesgo::all();

            $idioma = app()->getLocale();        
            if($idioma == "es"){
    
                $doms = \DB::table('dominios')
                ->select('dominios.dom_id', 'dominios.dom_nombre_es', 'dominios.dom_detalles_es', 'dominios.dom_estado', 'created_at', 'updated_at')
                ->get();
    
                $procs = \DB::table('procesos')
                ->select('procesos.proc_id', 'procesos.proc_nombre_es', 'procesos.proc_detalles_es', 'procesos.proc_estado', 'created_at', 'updated_at')
                ->get();          
                
                $subps = \DB::table('subprocesos')
                ->select('subprocesos.subp_id', 'subprocesos.subp_nombre_es', 'subprocesos.subp_detalles_es', 'subprocesos.subp_estado', 'created_at', 'updated_at')
                ->get(); 
    
                $rgos = \DB::table('riesgos')
                ->select('riesgos.rgo_id', 'riesgos.rgo_nombre_es', 'riesgos.rgo_detalles_es', 'riesgos.rgo_estado', 'created_at', 'updated_at')
                ->get(); 
    
    
            }else{
                if($idioma == "en"){
                    $doms = \DB::table('dominios')
                    ->select('dominios.dom_id', 'dominios.dom_nombre_en', 'dominios.dom_detalles_en', 'dominios.dom_estado', 'created_at', 'updated_at')
                    ->get();
        
                    $procs = \DB::table('procesos')
                    ->select('procesos.proc_id', 'procesos.proc_nombre_en', 'procesos.proc_detalles_en', 'procesos.proc_estado', 'created_at', 'updated_at')
                    ->get();
    
                    $subps = \DB::table('subprocesos')
                    ->select('subprocesos.subp_id', 'subprocesos.subp_nombre_en', 'subprocesos.subp_detalles_en', 'subprocesos.subp_estado', 'created_at', 'updated_at')
                    ->get();
    
                    $rgos = \DB::table('riesgos')
                    ->select('riesgos.rgo_id', 'riesgos.rgo_nombre_en', 'riesgos.rgo_detalles_en', 'riesgos.rgo_estado', 'created_at', 'updated_at')
                    ->get(); 
    
                }
            }

            // redirect   
            // return view('/riesgo/rgo_viewModificar', ['user' => $user, 'userPerfil' => $userPerfil, 'idioma' => $idioma, 'doms' => $doms, 'procs' => $procs, 'subps' => $subps, 'rgos' => $rgos]);
            return redirect('/riesgo/rgo_viewModificar')->with('status', 'Modificación exitosa :D');
    
        }
    }    
}
