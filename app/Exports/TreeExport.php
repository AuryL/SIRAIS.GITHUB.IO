<?php

namespace App\Exports;

use App\Riesgo;
use App\Control;
use App\Actividad;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

// Estilo excel
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;

class TreeExport implements FromView, WithEvents 
{
    // private $controls;
    // public function __construct($controls)
    // {
    //     $this->controls = $controls;
    // }
    // public function view(): View
    // {
    //     return view('/tree/treeexcel', [
    //         'controls' =>  $this->controls
    //     ]);
    // }



    private $actividads;
    public function __construct($actividads)
    {
        $this->actividads = $actividads;
    }
    public function view(): View
    {
        return view('/tree/treeexcel', [
            'actividads' =>  $this->actividads
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


    // Estilo de Excel
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:N1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => array('rgb' => '00ff00'),
                    ]
                ]);
            }
        ];
    }
}