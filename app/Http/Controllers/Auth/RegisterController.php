<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Dominio;
use App\Perfil;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
// use Illuminate\Support\MessageBag;

use Auth;
use Redirect;
use Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'register';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // Este constructor hace que solo los usuarios que no están loggeados, puedan acceder a la página de registro.
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    // Ahora,deben iniciar sesión para acceder a la pag registro
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:45',
            'name' => 'required|string|max:45',
            'us_apellidopat' => 'required|string|max:45',
            'us_apellidomat' => 'required|string|max:45',
            // 'us_extension' => 'required|number',
            'email' => 'required|string|email|max:255|unique:users',
            'per_id' => 'required|integer|max:15',
            'dom_id' => 'required|integer|max:15',
            // 'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        try{
            $usuario = User::create([            
                'username' => $data['username'],            
                'name' => $data['name'],                   
                'us_apellidopat' => $data['us_apellidopat'],        
                'us_apellidomat' => $data['us_apellidomat'], 
                'us_extension' => $data['us_extension'],
                'email' => $data['email'],
                'per_id' => $data['per_id'],
                'dom_id' => $data['dom_id'],
                // 'password' => Hash::make($data['password']),
            ]);
        
            return  $usuario;
            
        }catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }


    // 
    public function showRegistrationForm()
    {

        $user = Auth::user();   

        $userPerfil = \DB::table('perfils')
        ->select('perfils.*')
        ->where('perfils.per_id','=',$user->per_id)
        ->first();

        // $dominios = Dominio::all();
        // $perfiles = Perfil::all();

        // echo(app()->getLocale());
        $idioma = app()->getLocale();

        if($idioma == "es"){

            $dominios = \DB::table('dominios')
            ->select('dominios.dom_id', 'dominios.dom_nombre_es', 'dominios.dom_detalles_es', 'dominios.dom_estado', 'created_at', 'updated_at')
            ->get();

            $perfiles = \DB::table('perfils')
            ->select('perfils.per_id', 'perfils.per_nombre_es', 'perfils.per_descripcion_es', 'perfils.per_estado', 'created_at', 'updated_at')
            ->get();

            return view('auth.register')->with(['idioma' => $idioma, '  userPerfil' => $userPerfil, 'idioma' => $idioma, 'dominios' => $dominios, 'perfiles' => $perfiles]);

        }else{
            if($idioma == "en"){
                $dominios = \DB::table('dominios')
                ->select('dominios.dom_id', 'dominios.dom_nombre_en', 'dominios.dom_detalles_en', 'dominios.dom_estado', 'created_at', 'updated_at')
                ->get();
    
                $perfiles = \DB::table('perfils')
                ->select('perfils.per_id', 'perfils.per_nombre_en', 'perfils.per_descripcion_en', 'perfils.per_estado', 'created_at', 'updated_at')
                ->get();

                return view('auth.register')->with(['idioma' => $idioma, 'userPerfil' => $userPerfil, 'dominios' => $dominios, 'perfiles' => $perfiles]);

                
            }
        }
    }



    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }
}
