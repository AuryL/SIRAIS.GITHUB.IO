<?php

namespace App\Exports;

use App\Riesgo;
use App\Control;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class TreeExport implements FromView
{
    private $controls;
    public function __construct($controls)
    {
        $this->controls = $controls;
    }
    public function view(): View
    {
        return view('/tree/treeexcel', [
            'controls' =>  $this->controls
        ]);
    }

    // private $riesgos;
    // public function __construct($riesgos)
    // {
    //     $this->riesgos = $riesgos;
    // }
    // public function view(): View
    // {
    //     return view('/tree/treeexcel', [
    //         'riesgos' =>  $this->riesgos
    //     ]);
    // }
}