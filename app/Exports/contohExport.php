<?php

namespace App\Exports;

use App\Models\contoh;
use Maatwebsite\Excel\Concerns\FromCollection;

class contohExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return contoh::all();
    }
}
