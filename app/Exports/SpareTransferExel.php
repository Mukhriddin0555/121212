<?php

namespace App\Exports;


use App\Models\warehouse;
use App\Models\SpareTransfer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;


class SpareTransferExel implements FromView, WithStyles, WithColumnWidths, WithColumnFormatting   
{
    protected int $id;
    
    function __construct($id)
    {
        $this->id = $id;
        
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function columnFormats(): array
    {
        return [
            'i' => NumberFormat::FORMAT_NUMBER,
        ];
    }
    public function columnWidths(): array
    {
        return [
            'A' => 18,
            'B' => 35, 
            'C' => 5,
            'D' => 5,
            'E' => 25,  
        ];
    }
    public function styles(Worksheet $sheet)
    {
        $style = [
            'A1:A1'    => [    
                'font' => [
                    'bold' => true,
                    'size' => 10,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
                    ],
                        ],

            'A5:A7'    => [  
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
                    ],
                    'font' => [
                        'size' => 12,
                    ],
                ],
            'B5:D5'    => [    
                'font' => [
                    'bold' => true,
                    'size' => 8,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
                    ],
                ],
            'B7:D7'    => [    
                'font' => [
                    'bold' => true,
                    'size' => 8,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
                    ],
                        ],
            'A9:E9'    => [   'borders' => 
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
                                'font' => [
                                    'bold' => true,
                                    'size' => 8,
                                ],
                        ],
            'A10:E10'    => [   'borders' => 
                                [   'allBorders' => 
                                    [   'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,]
                                ],
                                'font' => [
                                    'size' => 8,
                                ],
                                'alignment' => [
                                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
                                    ],
                        ],
            'C16:C19'    => [   
                                'font' => [
                                    'size' => 35,
                                ],
                                'alignment' => [
                                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                                    ],
                        ],
            'C21:C24'    => [   
                                'font' => [
                                    'size' => 35,
                                ],
                                'alignment' => [
                                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                                    ],
                        ],
            
        ];        
        return $style;
    }
    public function view(): View
    {
        $transfer = SpareTransfer::where('transfer_id', $this->id)->first();
        $fromhouse = warehouse::find($transfer->user_id);
        $tohouse = warehouse::find($transfer->to_user_id);

        return View('exports.transfer', ['transfer' => $transfer, 'fromhouse' => $fromhouse, 'tohouse' => $tohouse]);
    }   
}
