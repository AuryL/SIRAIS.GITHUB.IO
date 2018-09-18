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
        
        $usuarios = User::all();
        $perfiles = Perfil::all();
        $dominios = Dominio::all();

        return view('user/us_viewModificar', ['usuarios' => $usuarios, 'perfiles' => $perfiles, 'dominios' => $dominios]);
    }




    // 
    function modificar () 
    {
         //////////////
        // validate
        $rules = array(
            'username' => 'required|string|max:45',
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
            return Redirect::to('register')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store

            $expediente = Input::get('username');
            // $user = User::where('username',$expediente);

            $usuario = \DB::table('users')
            ->select('users.*')
            ->where('users.username','=',$expediente)
            ->first();
            
            $user = User::find($usuario->us_id);

            // echo ($user);

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

            // redirect
            Session::flash('message', 'Successfully updated nerd!');
            return Redirect::to('/home');
        }
        // return view('user/us_viewModificar', ['usuarios' => $usuarios, 'perfiles' => $perfiles, 'dominios' => $dominios]);
    }

}


