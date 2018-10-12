<?php

namespace App\Http\Controllers;

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

use Maatwebsite\Excel\Excel;

class TreeController extends Controller
{
    private $excel;

    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }
    

    // Funcion que envia a la vista tree.blade.php las variables pasadas en el arreglo del return view
    public function viewTree()
    {        
        $user = Auth::user();

        $idioma = app()->getLocale();
        // echo(app()->getLocale());
     
        $dominios = Dominio::all();
        $procesos = Proceso::all();
        $subprocesos = Subproceso::all();
        $riesgos = Riesgo::all();
        $controls = Control::all();
        $actividads = Actividad::all();
        
        // if($idioma == "es"){

        //     $dominios = \DB::table('dominios')
        //     ->select('dominios.dom_id', 'dominios.dom_nombre_es', 'dominios.dom_detalles_es', 'dominios.dom_estado', 'created_at', 'updated_at')
        //     ->get();

        //     $procesos = \DB::table('procesos')
        //     ->select('procesos.proc_id', 'procesos.proc_nombre_es', 'procesos.proc_detalles_es', 'procesos.proc_estado', 'created_at', 'updated_at')
        //     ->get();

        //     $subprocesos = \DB::table('subprocesos')
        //     ->select('subprocesos.subp_id', 'subprocesos.subp_nombre_es', 'subprocesos.subp_detalles_es', 'subprocesos.subp_estado', 'created_at', 'updated_at')
        //     ->get();
            
        //     $riesgos = \DB::table('riesgos')
        //     ->select('riesgos.rgo_id', 'riesgos.rgo_nombre_es', 'riesgos.rgo_detalles_es', 'riesgos.rgo_estado', 'created_at', 'updated_at')
        //     ->get();
            
        //     $controls = \DB::table('controls')
        //     ->select('controls.id', 'controls.cont_nombre_es', 'controls.cont_detalles_es', 'controls.cont_estado', 'created_at', 'updated_at')
        //     ->get();
            
        //     $actividads = \DB::table('actividads')
        //     ->select('actividads.id', 'actividads.act_nombre_es', 'actividads.act_detalles_es', 'actividads.act_estado', 'created_at', 'updated_at')
        //     ->get();
            

        // }else
        //     if($idioma == "en"){
        //         $dominios = \DB::table('dominios')
        //         ->select('dominios.dom_id', 'dominios.dom_nombre_en', 'dominios.dom_detalles_en', 'dominios.dom_estado', 'created_at', 'updated_at')
        //         ->get();
    
        //         $procesos = \DB::table('procesos')
        //         ->select('procesos.proc_id', 'procesos.proc_nombre_en', 'procesos.proc_detalles_en', 'procesos.proc_estado', 'created_at', 'updated_at')
        //         ->get();
    
        //         $subprocesos = \DB::table('subprocesos')
        //         ->select('subprocesos.subp_id', 'subprocesos.subp_nombre_en', 'subprocesos.subp_detalles_en', 'subprocesos.subp_estado', 'created_at', 'updated_at')
        //         ->get();
                
        //         $riesgos = \DB::table('riesgos')
        //         ->select('riesgos.rgo_id', 'riesgos.rgo_nombre_en', 'riesgos.rgo_detalles_en', 'riesgos.rgo_estado', 'created_at', 'updated_at')
        //         ->get();
                
        //         $controls = \DB::table('controls')
        //         ->select('controls.cont_id', 'controls.cont_nombre_en', 'controls.cont_detalles_en', 'controls.cont_estado', 'created_at', 'updated_at')
        //         ->get();
                
        //         $actividads = \DB::table('actividads')
        //         ->select('actividads.act_id', 'actividads.act_nombre_en', 'actividads.act_detalles_en', 'actividads.act_estado', 'created_at', 'updated_at')
        //         ->get();
        //     }
        // }

        return view('/tree/tree', ['idioma' => $idioma, 'dominios' => $dominios, 'procesos' => $procesos, 'subprocesos' => $subprocesos, 'riesgos' => $riesgos, 'controls' => $controls, 'actividads' => $actividads]);
    }

    // 
    public function export() 
    {
        // $riesgos = request('riesgos');
        // return $this->excel->download(new TreeExport($riesgos), 'riesgos.xlsx');

        // $controls = request('controls');
        // return $this->excel->download(new TreeExport($controls), 'riesgos.xlsx');
     
        $actividads = request('actividads');
        return $this->excel->download(new TreeExport($actividads), 'riesgos.xlsx');

    }
}
