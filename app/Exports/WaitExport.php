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
            'D' => 12,
            'E' => 7,   
            'F' => 5,
            'G' => 10,
            'H' => 12,
            'I' => 3,
            'J' => 3,
            'K' => 3,
            'L' => 3,   
            'M' => 10,
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
        ->leftJoin('spareparts', 'waitings.sparepart_id', '=', 'spareparts.id')
        ->join('statuses', 'waitings.status_id', '=', 'statuses.id')
        ->join('warehouses', 'waitings.warehouse_id', '=', 'warehouses.id')       
        ->where('warehouse_id', $sklad_id)
        ->where('status_id', '!=', 2)
        ->select('waitings.crm_id', 'waitings.sap_kod', 'spareparts.name as sapname', 'warehouses.Kod as warehouseskod',
        'waitings.how', 'waitings.created_at', 'statuses.name as statusname', 'waitings.order')
        ->count() + 2;
        $style = [
            'A1:M1'    => [   'borders' => 
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
                'A'.$i.':M'.$i    => [   'borders' => 
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
        ->leftJoin('spareparts', 'waitings.sparepart_id', '=', 'spareparts.id')
        ->join('statuses', 'waitings.status_id', '=', 'statuses.id')
        ->join('warehouses', 'waitings.warehouse_id', '=', 'warehouses.id')       
        ->where('warehouse_id', $sklad_id)
        ->where('status_id', '!=', 2)
        ->select('waitings.crm_id', 'spareparts.sap_kod as sap_kod', 'spareparts.name as sapname', 'warehouses.Kod as warehouseskod',
        'waitings.how', 'waitings.created_at', 'statuses.name as statusname', 'waitings.order', 'warehouses.name as servisname')
        ->get();

        return View('exports.allwaits', [
            'waits' => $waits
        ]);
    }        
}
