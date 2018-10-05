<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\User;
use App\Perfil;
use App\Dominio;
use App\Proceso;
use App\Subproceso;

use Auth;
use Redirect;
use Session;
use Validator;


class SubprocesoController extends Controller
{
       // 
    public function viewSubproceso () {

        $user = Auth::user();    

        $userPerfil = \DB::table('perfils')
        ->select('perfils.*')
        ->where('perfils.per_id','=',$user->per_id)
        ->first();

        $procs = Proceso::all();
        $subps = Subproceso::all();
        
        return view('/subproceso/subp_viewAlta', ['user' => $user, 'userPerfil' => $userPerfil, 'procs' => $procs, 'subps' => $subps]);
    }




    // 
    public function altaSubproceso () {
        
        $user = Auth::user();    

        $userPerfil = \DB::table('perfils')
        ->select('perfils.*')
        ->where('perfils.per_id','=',$user->per_id)
        ->first();

        $procs = Proceso::all();
        $subp = Subproceso::all();

        $rules = array(
            'subp_nombre_es' => 'required|string|max:45',
            'subp_nombre_en' => 'required|string|max:45',
            'subp_detalles_es' => 'required|string|max:280',
            'subp_detalles_en' => 'required|string|max:280'
        );
        
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('/home')
                ->withErrors($validator);
        } else {
            // store
            $subp = new Subproceso;
            $subp->subp_nombre_es = Input::get('subp_nombre_es');
            $subp->subp_nombre_en = Input::get('subp_nombre_en');
            $subp->subp_detalles_es = Input::get('subp_detalles_es');
            $subp->subp_detalles_en = Input::get('subp_detalles_en');                   
            $subp->proc_id = Input::get('proceso');
            $subp->save();


            
            $userPerfil = \DB::table('perfils')
            ->select('perfils.*')
            ->where('perfils.per_id','=',$user->per_id)
            ->first();    
            $procs = Proceso::all();
            $subps = Subproceso::all();

            // redirect
            Session::flash('message', 'Successfully updated nerd!');
            // return Redirect::to('/proceso/proc_viewAlta');
            // return Redirect::to('home');
            return view('/subproceso/subp_viewAlta',['user' => $user, 'userPerfil' => $userPerfil, 'procs' => $procs, 'subps' => $subps]);
        }
    }





    //  
    public function viewModificar () {

        $user = Auth::user();        

        $doms = Dominio::all();
        $procs = Proceso::all();
        $subps = Subproceso::all();

        return view('/subproceso/subp_viewModificar', ['user' => $user, 'doms' => $doms, 'procs' => $procs, 'subps' => $subps]);
    }




    // 
    public function modificar () {
        // validate
        $rules = array(
            'subp_nombre_es' => 'required|string|max:45',
            'subp_nombre_en' => 'required|string|max:45',
            'subp_detalles_es' => 'required|string|max:280',
            'subp_detalles_en' => 'required|string|max:280'
        );
        
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('home')
                ->withErrors($validator);
        } else {
            // store
            $subpId = Input::get('subp_id');

            $subproceso = \DB::table('subprocesos')
            ->select('subprocesos.*')
            ->where('subprocesos.subp_id','=',$subpId)
            ->first();
            
            $subp = Subproceso::find($subproceso->subp_id);

            $subp->subp_nombre_es = Input::get('subp_nombre_es');
            $subp->subp_nombre_en = Input::get('subp_nombre_en');
            $subp->subp_detalles_es = Input::get('subp_detalles_es');
            $subp->subp_detalles_en = Input::get('subp_detalles_en'); 
            $subp->proc_id = Input::get('proceso'); 

            if((Input::get('subp_estado')) == null) {
                $subp->subp_estado = 0;
            }else {
                $subp->subp_estado = 1;
            }
            $subp->save();



            

            $user = Auth::user();
            $userPerfil = \DB::table('perfils')
            ->select('perfils.*')
            ->where('perfils.per_id','=',$user->per_id)
            ->first();
            $subps = Subproceso::all();
            $procs = Proceso::all();



            // // redirect
            Session::flash('message', 'Successfully updated nerd!');     
            return view('/subproceso/subp_viewModificar', ['user' => $user, 'userPerfil' => $userPerfil, 'subps' => $subps, 'procs' => $procs]);
            // return Redirect::to('/proceso/proc_viewAlta');       
        }
    }
}
