<?php

namespace App\Classes\DataTable;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Export implements FromQuery, WithHeadings
{
    use Exportable;

    public function __construct(protected DataTable $datatable)
    {

    }

    public function headings(): array
    {
        $columns = method_exists($this->datatable, 'getSelectedColumnObjectsProperty')
            ? $this->datatable->getSelectedColumnObjectsProperty()
            : $this->datatable->columns();

        $headings = array_map(
            fn ($column) => $column->getName(),
            $columns
        );

        array_unshift($headings, 'ID');

        return $headings;
    }

    public function query()
    {
        return $this->datatable->buildQuery();
    }
}
