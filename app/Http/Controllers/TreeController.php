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
