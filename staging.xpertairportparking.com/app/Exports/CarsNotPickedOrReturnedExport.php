<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class CarsNotPickedOrReturnedExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }
}
