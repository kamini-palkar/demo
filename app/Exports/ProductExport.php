<?php

namespace App\Exports;

use App\Models\Product;
use App\Products;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return product::select('name','price','details')->get();
        // return product::all();
    }

    public function headings(): array
    {
        return ["Name", "Price", "Details"];
    }
}
