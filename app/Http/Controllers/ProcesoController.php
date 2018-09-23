<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\User;
use App\Perfil;
use App\Dominio;
use App\Proceso;

use Auth;
use Redirect;
use Session;
use Validator;


class ProcesoController extends Controller
{
       // 
       public function viewProceso () {

            $user = Auth::user();    

            $userPerfil = \DB::table('perfils')
            ->select('perfils.*')
            ->where('perfils.per_id','=',$user->per_id)
            ->first();

            $doms = Dominio::all();
            
            return view('/proceso/proc_viewAlta', ['user' => $user, 'userPerfil' => $userPerfil, 'doms' => $doms]);
    }




    // 
    public function altaProceso () {
        
        $user = Auth::user();    

        $userPerfil = \DB::table('perfils')
        ->select('perfils.*')
        ->where('perfils.per_id','=',$user->per_id)
        ->first();

        $doms = Dominio::all();

        $rules = array(
            'proc_nombre_es' => 'required|string|max:45',
            'proc_nombre_en' => 'required|string|max:45',
            'proc_detalles_es' => 'required|string|max:280',
            'proc_detalles_en' => 'required|string|max:280'
        );
        
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('/home')
                ->withErrors($validator);
        } else {
            // store
            $proc = new Proceso;
            $proc->proc_nombre_es = Input::get('proc_nombre_es');
            $proc->proc_nombre_en = Input::get('proc_nombre_en');
            $proc->proc_detalles_es = Input::get('proc_detalles_es');
            $proc->proc_detalles_en = Input::get('proc_detalles_en');                   
            $proc->dom_id = Input::get('dom_id');
            $proc->save();

            // redirect
            Session::flash('message', 'Successfully updated nerd!');
            // return Redirect::to('/proceso/proc_viewAlta');
            return Redirect::to('home');
            // return view('/proceso/proc_viewAlta',['user' => $user, 'userPerfil' => $userPerfil, 'doms' => $doms]);
        }
    }




    
    //  
    public function viewModificar () {

        $user = Auth::user();        

        $procs = Proceso::all();
        $doms = Dominio::all();

        return view('/proceso/proc_viewModificar', ['user' => $user, 'procs' => $procs, 'doms' => $doms]);
    }




    // 
    public function modificar () {
        // validate
        $rules = array(
            'proc_nombre_es' => 'required|string|max:45',
            'proc_nombre_en' => 'required|string|max:45',
            'proc_detalles_es' => 'required|string|max:280',
            'proc_detalles_en' => 'required|string|max:280',  
        );
        
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('home')
                ->withErrors($validator);
        } else {
            // store
            $procId = Input::get('proc_id');

            $proceso = \DB::table('procesos')
            ->select('procesos.*')
            ->where('procesos.proc_id','=',$procId)
            ->first();
            
            $proc = Proceso::find($proceso->proc_id);

            $proc->proc_nombre_es = Input::get('proc_nombre_es');
            $proc->proc_nombre_en = Input::get('proc_nombre_en');
            $proc->proc_detalles_es = Input::get('proc_detalles_es');
            $proc->proc_detalles_en = Input::get('proc_detalles_en'); 
            if((Input::get('proc_estado')) == null) {
                $proc->proc_estado = 0;
            }else {
                $proc->proc_estado = 1;
            }
            $proc->save();


            

            $user = Auth::user();
            $userPerfil = \DB::table('perfils')
            ->select('perfils.*')
            ->where('perfils.per_id','=',$user->per_id)
            ->first();
            $procs = Proceso::all();
            $doms = Dominio::all();



            // // redirect
            Session::flash('message', 'Successfully updated nerd!');     
            return view('/proceso/proc_viewModificar', ['user' => $user, 'userPerfil' => $userPerfil,  'procs' => $procs, 'doms' => $doms]);
            // return Redirect::to('/proceso/proc_viewAlta');       
        }
    }
}
