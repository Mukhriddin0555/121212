<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class WaitExport implements FromView, WithStyles, WithColumnWidths, WithColumnFormatting
{   

    public function columnFormats(): array
    {
        return [
            'a' => NumberFormat::FORMAT_NUMBER,
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 13,
            'B' => 23, 
            'C' => 45,
            'D' => 7,
            'E' => 5,   
            'F' => 10,
            'G' => 12,
            'H' => 10,        
        ];
    }
    public function styles(Worksheet $sheet)
    {
        $user = Auth::User()->id;
        $sklad_id = DB::table('warehouses')
        ->where('user_id', $user)
        ->get();
        $sklad_id = $sklad_id[0]->id;
        $waits = DB::table('waitings')
        ->leftJoin('spareparts', 'waitings.sap_kod', '=', 'spareparts.sap_kod')
        ->join('statuses', 'waitings.status_id', '=', 'statuses.id')
        ->join('warehouses', 'waitings.warehouse_id', '=', 'warehouses.id')       
        ->where('warehouse_id', $sklad_id)
        ->select('waitings.crm_id', 'waitings.sap_kod', 'spareparts.name as sapname', 'warehouses.Kod as warehouseskod',
        'waitings.how', 'waitings.created_at', 'statuses.name as statusname', 'waitings.order')
        ->count() + 2;
        $style = [
            'A1:H1'    => [   'borders' => 
                                [   'allBorders' => 
                                    [   'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,]
                                ],
                                'fill' => [
                                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                                    'rotation' => 90,
                                    'startColor' => [
                                        'argb' => 'FF6AA2FF',
                                    ],
                                ],
                        ],
        ];
        $i = 2;
        while($i < $waits){
            $stylein = [
                // Style the first row as bold text.
                'A'.$i.':H'.$i    => [   'borders' => 
                                [   'allBorders' => 
                                    [   'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,]
                                ],
                        ],
                // Styling a specific cell by coordinate.
                //'B2:B8' => ['font' => ['italic' => true]],
    
                // Styling an entire column.
                //'A:D'  => ['font' => ['size' => 16]],
            ];
            $style += $stylein;
            $i++;


        }
        
        return $style;
    }

    public function view(): View
    {
        $user = Auth::User()->id;
        $sklad_id = DB::table('warehouses')
        ->where('user_id', $user)
        ->get();
        $sklad_id = $sklad_id[0]->id;
        $waits = DB::table('waitings')
        ->leftJoin('spareparts', 'waitings.sap_kod', '=', 'spareparts.sap_kod')
        ->join('statuses', 'waitings.status_id', '=', 'statuses.id')
        ->join('warehouses', 'waitings.warehouse_id', '=', 'warehouses.id')       
        ->where('warehouse_id', $sklad_id)
        ->select('waitings.crm_id', 'waitings.sap_kod', 'spareparts.name as sapname', 'warehouses.Kod as warehouseskod',
        'waitings.how', 'waitings.created_at', 'statuses.name as statusname', 'waitings.order')
        ->get();

        return View('exports.allwaits', [
            'waits' => $waits
        ]);
    }        
}
