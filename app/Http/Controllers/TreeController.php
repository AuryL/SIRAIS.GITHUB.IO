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

        $dominios = Dominio::all();
        $procesos = Proceso::all();
        $subprocesos = Subproceso::all();
        $riesgos = Riesgo::all();
        $controles = Control::all();
        $actividades = Actividad::all();

        return view('/tree/tree', ['dominios' => $dominios, 'procesos' => $procesos, 'subprocesos' => $subprocesos, 'riesgos' => $riesgos, 'controles' => $controles, 'actividades' => $actividades]);
    }

    // 
    public function export() 
    {
        $riesgos = request('riesgos');
        return $this->excel->download(new TreeExport($riesgos), 'riesgos.xlsx');
    }
}
