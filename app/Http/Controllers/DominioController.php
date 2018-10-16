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

        try{
            $user = Auth::user();        

            $userPerfil = \DB::table('perfils')
            ->select('perfils.*')
            ->where('perfils.per_id','=',$user->per_id)
            ->first();

            return view('/dominio/dom_viewAlta', ['user' => $user, 'userPerfil' => $userPerfil]);

        }catch (Exception $e) {
            return redirect()->to('/home')->withErrors(['message1'=>'Sorry, Error']);
        }
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


        // process the login
        if ($validator->fails()) {
            // return Redirect::to('/home')
            //     ->withErrors($validator);
            return redirect('/dominio/dom_viewAlta')->with('status', $validator);


        } else {
            // store
            $dom = new Dominio;
            $dom->dom_nombre_es = Input::get('dom_nombre_es');
            $dom->dom_nombre_en = Input::get('dom_nombre_en');
            $dom->dom_detalles_es = Input::get('dom_detalles_es');
            $dom->dom_detalles_en = Input::get('dom_detalles_en');
            $dom->save();

            // redirect
            // return Redirect::to('/dominio/dom_viewAlta');

            return redirect('/dominio/dom_viewAlta')->with('status', 'Dominio creado correctamente');
        }
    }





    //  
    public function viewModificar () {

        $user = Auth::user();        

        // $doms = Dominio::all();
         $idioma = app()->getLocale();

         if($idioma == "es"){
 
             $doms = \DB::table('dominios')
             ->select('dominios.dom_id', 'dominios.dom_nombre_es', 'dominios.dom_detalles_es', 'dominios.dom_estado', 'created_at', 'updated_at')
             ->get();
 
         }else{
             if($idioma == "en"){
                 $doms = \DB::table('dominios')
                 ->select('dominios.dom_id', 'dominios.dom_nombre_en', 'dominios.dom_detalles_en', 'dominios.dom_estado', 'created_at', 'updated_at')
                 ->get();
                 
             }
         }

            return view('/dominio/dom_viewModificar', ['user' => $user, 'idioma' => $idioma, 'doms' => $doms]);
        }




    // 
    public function modificar () {

        
        $user = Auth::user(); 
        $idioma = app()->getLocale();

        // validate
        $rules = array(
            'dom_nombre_es' => 'required|string|max:45',
            'dom_nombre_en' => 'required|string|max:45',
            'dom_detalles_es' => 'required|string|max:280',
            'dom_detalles_en' => 'required|string|max:280',  
        );
        
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            // return Redirect::to('home')
            //     ->withErrors($validator);
            return redirect('/dominio/dom_viewModificar')->withErrors('status',  $validator);

        } else {
            // store
            $domId = Input::get('dom_id');

            $dominio = \DB::table('dominios')
            ->select('dominios.*')
            ->where('dominios.dom_id','=',$domId)
            ->first();
            
            $dom = Dominio::find($dominio->dom_id);

            $dom->dom_nombre_es = Input::get('dom_nombre_es');
            $dom->dom_nombre_en = Input::get('dom_nombre_en');
            $dom->dom_detalles_es = Input::get('dom_detalles_es');
            $dom->dom_detalles_en = Input::get('dom_detalles_en'); 
            if((Input::get('dom_estado')) == null) {
                $dom->dom_estado = 0;
            }else {
                $dom->dom_estado = 1;
            }
            $dom->save();

            $idioma = app()->getLocale();
            if($idioma == "es"){
                $doms = \DB::table('dominios')
                ->select('dominios.dom_id', 'dominios.dom_nombre_es', 'dominios.dom_detalles_es', 'dominios.dom_estado', 'created_at', 'updated_at')
                ->get();
            }else{
                if($idioma == "en"){
                    $doms = \DB::table('dominios')
                    ->select('dominios.dom_id', 'dominios.dom_nombre_en', 'dominios.dom_detalles_en', 'dominios.dom_estado', 'created_at', 'updated_at')
                    ->get(); 
                }
            }

            // return view('dominio/dom_viewModificar', ['user' => $user, 'idioma' => $idioma, 'doms' => $doms, 'dom' => $dom])->with('status', 'Dominio modificado correctamente');
            return redirect('/dominio/dom_viewModificar')->with('status', 'Modificación exitosa :D');

        }
    }
}
