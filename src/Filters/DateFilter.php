<?php

namespace App\Classes\DataTable\Filters;

use App\Classes\DataTable\FilterInterface;

class DateFilter implements FilterInterface
{
    protected $range = false;

    public function __construct(protected $name)
    {
    }

    public function render()
    {
        return view('livewire.datatable.filters.date', [
            'name' => $this->name,
            'range' => $this->range,
        ]);
    }

    public function range($range = true)
    {
        $this->range = $range;

        return $this;
    }
}
