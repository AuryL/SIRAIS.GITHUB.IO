<?php

namespace App\Exports;

use App\Riesgo;
use App\Control;
use App\Actividad;

use Illuminate\Contracts\View\View;
    
// Estilo excel
use Maatwebsite\Excel\Concerns\FromView;
//  ShouldAutoSize: Adjust the column sizes automatically. 
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;



class TreeExport implements FromView, ShouldAutoSize, WithEvents 
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
        $colores = ['background-color:#EBDEF0;', 'background-color:#D4E6F1;', 'background-color:#D4EFDF;', 'background-color:#FCF3CF;', 'background-color:#F6DDCC;', 'background-color:#FFCDD2;'];
        // $longitud = count($this->$actividads);

        return view('/tree/treeexcel', [
            // 'actividads' =>  $this->actividads, 'colores' => $colores, 'longitud' => $longitud
            'actividads' =>  $this->actividads, 'colores' => $colores
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
                        'name' => 'Arial',
                        'size' => 9,
                        'bold' => true,
                        'color' => array('rgb' => 'faebd7'),
                    ]
                ]);
                $event->sheet->getStyle('A2:N300')->applyFromArray([
                    'font' => [
                        'name' => 'Arial',
                        'size' => 11,
                    ]
                ]);
            }
        ];

        // return [
        //     AfterSheet::class    => function(AfterSheet $event) {
        //         $cellRange = 'A1:W1'; // All headers

        //         $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(10);
        //         $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setName('Tahoma');
        //         // $event->sheet->getDelegate()->getStyle($cellRange)->getBorders()->getTop()->applyFromArray( array( 'borderStyle' => Border::BORDER_DASHDOT, 'color' => array( 'rgb' => '808080' ) ) );
        //     },
        // ];

                ///////////////////////////////////////////// INTENTO 5
                // $range = "A1:J10";
                // $event->$sheet->setBorder($range, 'thin');

                ///////////////////////////////////////////// INTENTO 4
                // $event->sheet->getDelegate()->getStyle($cellRange)->getBorders()->getTop()->applyFromArray( array( 'borderStyle' => Border::BORDER_DASHDOT, 'color' => array( 'rgb' => '808080' ) ) );
                
                ///////////////////////////////////////////// INTENTO 3
                // $event->sheet->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

                
                ///////////////////////////////////////////// INTENTO 2
                // $event->sheet->styleCells(
                //     'B2:G8',
                //     [
                //         'borders' => [
                //             'outline' => [
                //                 'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                //                 'color' => ['argb' => 'FFFF0000'],
                //             ],
                //         ]
                //     ]
                // );

            //     $event->$sheet->cell('A1', function($cell){
            //         $cell->setBorder('thin','thin','thin','thin');
            //     });
        
            

            ///////////////////////////////////////////// INTENTO 1
            // AfterSheet::class    => function(AfterSheet $event) {
            //     $event->sheet->styleCells(
            //         'B1:D1',
            //         [
            //             'borders' => [
            //                 'outline' => [
            //                     'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
            //                     'color' => ['argb' => 'EB2B02'],
            //                 ],
    
            //             ],
            //             'font' => array(
            //                 'name'      =>  'Calibri',
            //                 'size'      =>  15,
            //                 'bold'      =>  true,
            //                 'color' => ['argb' => 'EB2B02'],
            //             )
            //         ]
            //     );
            // },
            
        // ];

        // return [
        //     AfterSheet::class => function (AfterSheet $event) {
        //         $event->sheet->getStyle('A1:N1')->applyFromArray([
        //             'font' => [
        //                 'bold' => true,
        //                 'color' => array('rgb' => 'ad0404'),
        //             ]
        //         ]);
        //     }
        // ];
    }
}