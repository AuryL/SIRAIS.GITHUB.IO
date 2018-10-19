<?php

namespace App\Http\Controllers;

use App\User;
use App\Perfil;
use App\Dominio;
use App\Proceso;
use App\Subproceso;
use App\Riesgo;
use App\Control;
use App\Actividad;

use App\Exports\TreeExport;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Auth;
use Redirect;
use Session;
use Validator;


class UserController extends Controller
{

    // 
    function viewModificar () 
    {
        $user = Auth::user();
        
        $userPerfil = \DB::table('perfils')
        ->select('perfils.*')
        ->where('perfils.per_id','=',$user->per_id)
        ->get();

        $usuarios = User::all();
        // $perfiles = Perfil::all();
        // $dominios = Dominio::all();

        
        // echo(app()->getLocale());
        $idioma = app()->getLocale();

        if($idioma == "es"){

            $dominios = \DB::table('dominios')
            ->select('dominios.dom_id', 'dominios.dom_nombre_es', 'dominios.dom_detalles_es', 'dominios.dom_estado', 'created_at', 'updated_at')
            ->get();

            $perfiles = \DB::table('perfils')
            ->select('perfils.per_id', 'perfils.per_nombre_es', 'perfils.per_descripcion_es', 'perfils.per_estado', 'created_at', 'updated_at')
            ->get();

            return view('user/us_viewModificar', ['usuarios' => $usuarios, 'idioma' => $idioma, 'perfiles' => $perfiles, 'dominios' => $dominios, 'userPerfil' => $userPerfil]);          

        }else{
            if($idioma == "en"){
                $dominios = \DB::table('dominios')
                ->select('dominios.dom_id', 'dominios.dom_nombre_en', 'dominios.dom_detalles_en', 'dominios.dom_estado', 'created_at', 'updated_at')
                ->get();
    
                $perfiles = \DB::table('perfils')
                ->select('perfils.per_id', 'perfils.per_nombre_en', 'perfils.per_descripcion_en', 'perfils.per_estado', 'created_at', 'updated_at')
                ->get();

                return view('user/us_viewModificar', ['usuarios' => $usuarios, 'idioma' => $idioma, 'perfiles' => $perfiles, 'dominios' => $dominios, 'userPerfil' => $userPerfil]);

                
            }
        }
    }




    // 
    function modificar () 
    {
         //////////////
        // validate
        $rules = array(
            'username' => 'required|string|max:45|unique:users',
            'name' => 'required|string|max:45',
            'us_apellidopat' => 'required|string|max:45',
            'us_apellidomat' => 'required|string|max:45',
            // 'us_extension' => 'required|integer',
            // 'email' => 'required|string|email|max:255|unique:users',
            // 'per_id' => 'required|integer|max:15',
            // 'dom_id' => 'required|integer|max:15',
            // 'password' => 'required|string|min:6|confirmed',  
        );

        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {             
            // return redirect('/user/us_viewModificar')->with('status', $validator);
            // return redirect('/user/us_viewModificar')->with('status', 'Validación fallida :(');
            return redirect('/user/us_viewModificar')->with('status', $validator);


        } else {
            
            
            // store
            $id_Usuario = Input::get('us_id');

            $usuario = \DB::table('users')
            ->select('users.*')
            ->where('users.us_id','=',$id_Usuario)
            ->first();
            
            $user = User::find($usuario->us_id);

            // echo($user);
            $user->username = Input::get('username');
            $user->name = Input::get('name');
            $user->us_apellidopat = Input::get('us_apellidopat');
            $user->us_apellidomat = Input::get('us_apellidomat');
            $user->us_extension = Input::get('us_extension');
            $user->email = Input::get('email');            
            $user->per_id = Input::get('per_id');         
            $user->dom_id = Input::get('dom_id');  

            if((Input::get('us_estado')) == null) {
                $user->us_estado = 0;
            }else {
                $user->us_estado = 1;
            }
            
            $user->save();

            // if( $guardarEnDB ){
            //     return redirect('/user/us_viewModificar')->with('status', 'Modificación exitosa :D');

            // } else {
                return redirect('/user/us_viewModificar')->with('status', 'Modificación exitosa :D');
// 
            // }

        }
        // return view('user/us_viewModificar', ['usuarios' => $usuarios, 'perfiles' => $perfiles, 'dominios' => $dominios]);
    }

}


