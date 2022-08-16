<?php

namespace App\Exports;

use App\User;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\BeforeExport;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class Exportacion implements 
    //FromView,
    ShouldAutoSize,
    WithStyles,
    WithEvents,
    WithDrawings,
    WithCustomStartCell,
    WithHeadingRow,
    FromView
    //FromCollection,
    //WithHeadings  
    
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public $datos;
    public $cantidad_datos;
    public $nombre;
    public $header;
    public $columnas;
    public $letra_columnas = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","Ñ","O","P","Q","R","S","T","U","V","W","X","Y","Z"];

    //Parametros a recibir
    public function __construct($nombre,$header)
    {   //dd($header);
        $this->nombre = $nombre;
        $this->header = $header;   
        $this->columnas = $this->letra_columnas[sizeof($header)-1];     
        $this->datos = DB::table($nombre)->get(); 
        $this->cantidad_datos = $this->datos->count();           
    }    

    public function headingRow(): int
    {
        return 2;
    }

    //Inicio de celdas
    public function startCell(): string
    {
        return 'A5';
    }   

    //Estilo de letra 
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('2')->getFont()->setBold(true);                                                                                                            
    }        

    //Estilos Generales
    public function registerEvents(): array
    {
        return [            
            AfterSheet::class    => function(AfterSheet $event) {  
                //Color Fondo Encabezados
                $event->sheet->getStyle('A1:'.$this->columnas.'1')->applyFromArray([                    
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['argb' => 'FF000000']
                    ],                
                ]);
                $event->sheet->getStyle('A5:'.$this->columnas.'5')->applyFromArray([                    
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['argb' => 'FF000000']
                    ],                
                ]);
                //Color Letras
                $event->sheet->getDelegate()->getStyle('A1:'.$this->columnas.'5')
                    ->getFont()
                    ->getColor()
                    ->setARGB('FFFFFFFF');                
                //Alinear Fecha a la Derecha
                $event->sheet->getDelegate()->getStyle('A1:'.$this->columnas.'1')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT); 
                                
                //Alinear Datos a la Izquierda
                $event->sheet->getDelegate()->getStyle('A6:'.$this->columnas.$this->cantidad_datos)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); 

                //Color Cabecera
                $event->sheet->getStyle('A2:'.$this->columnas.'4')->applyFromArray([                    
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                        'rotation' => 20,
                        'startColor' => [
                            'argb' => 'FF17dade',
                        ],
                        'endColor' => [
                            'argb' => 'FF350808',
                        ],
                    ],                
                ]);                  

                //Combinar Para fondo de Fecha
                $event->sheet->getDelegate()->mergeCells('A1:'.$this->columnas.'1');  
                //Combinar Para Degradado Horizontal
                $event->sheet->getDelegate()->mergeCells('A2:'.$this->columnas.'4');  
                //Combinar Para Degradado Vertical
                /*for($i=0; $i<sizeof($this->header); $i++){
                    $event->sheet->getDelegate()->mergeCells($this->letra_columnas[$i].'2:'.$this->letra_columnas[$i].'4');    
                } */                                 
                
                //Alinear titulo header al centro
                $event->sheet->getDelegate()->getStyle('A2:'.$this->columnas.'2')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); 
                $event->sheet->getDelegate()->getStyle('A2:'.$this->columnas.'2')
                    ->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                //Alinear titulo header al centro
                $event->sheet->getDelegate()->getStyle('A5:'.$this->columnas.'5')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); 
            },
        ];
    }

    //Imagen Cabecera
    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('img/logo.jpg'));
        $drawing->setHeight(60);
        $drawing->setCoordinates('A2');

        return $drawing;
    } 
    //Vista
    public function view(): View
    {
        return view('exports.excel', [
            'datos' => $this->datos,
            'header' => $this->header,
            'nombre' => $this->nombre,
        ]);
    }
    
}