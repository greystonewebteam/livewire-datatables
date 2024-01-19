<?php

namespace App\Classes\DataTable\Filters;

use App\Classes\DataTable\FilterInterface;

class SelectFilter implements FilterInterface
{
    protected $options;

    public function __construct(protected $name)
    {

    }

    public function render()
    {
        return view('livewire.datatable.filters.select', [
            'name' => $this->name,
            'options' => $this->options,
        ]);
    }

    public function options($options)
    {
        $this->options = $options;

        return $this;
    }
}
