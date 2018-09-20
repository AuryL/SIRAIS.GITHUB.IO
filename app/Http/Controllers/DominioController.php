<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\User;
use App\Perfil;
use App\Dominio;

use Auth;
use Redirect;
use Session;
use Validator;


class DominioController extends Controller
{
    // 
    public function viewDominio () {

        $user = Auth::user();        

        // $userPerfil = Perfil::where('per_id',$user->per_id);

        $userPerfil = \DB::table('perfils')
        ->select('perfils.*')
        ->where('perfils.per_id','=',$user->per_id)
        ->first();

        // echo ($userPerfil);
        return view('/dominio/dom_viewAlta', ['user' => $user, 'userPerfil' => $userPerfil]);
    }



    // 
    public function altaDominio () {
        
        $user = Auth::user();
        $userPerfil = User::where('per_id',$user->per_id);

        $rules = array(
            'dom_nombre_es' => 'required|string|max:45',
            'dom_nombre_en' => 'required|string|max:45',
            'dom_detalles_es' => 'required|string|max:280',
            'dom_detalles_en' => 'required|string|max:280'
        );
        
        $validator = Validator::make(Input::all(), $rules);

        // $hola= Input::get('dom_nombre_es');
        // echo($hola);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('/home')
                ->withErrors($validator);
        } else {
            // store
            $dom = new Dominio;
            $dom->dom_nombre_es = Input::get('dom_nombre_es');
            $dom->dom_nombre_en = Input::get('dom_nombre_en');
            $dom->dom_detalles_es = Input::get('dom_detalles_es');
            $dom->dom_detalles_en = Input::get('dom_detalles_en');
            $dom->save();

            // redirect
            Session::flash('message', 'Successfully updated nerd!');
            return Redirect::to('/dominio/dom_viewAlta');
        }
    }
}
