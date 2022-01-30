<?php

namespace App\Exports;

use App\Models\sparepart;
use Maatwebsite\Excel\Concerns\FromCollection;

class SparePartExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return sparepart::all();
    }
}
