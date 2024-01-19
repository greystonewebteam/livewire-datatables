<?php

namespace Greystoneweb\LivewireDataTables\Filters;

use Greystoneweb\LivewireDataTables\FilterInterface;

class DateFilter implements FilterInterface
{
    protected $range = false;

    public function __construct(protected $name)
    {
    }

    public function render()
    {
        return view('livewire-datatables::filters.date', [
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
