<?php

namespace Greystoneweb\LivewireDataTables\Traits;

use Livewire\Attributes\Url;

trait WithFilters
{
    #[Url]
    public $search = '';

    #[Url]
    public $filters = [];

    public function mountWithFilters()
    {
        if (! request()->get('filters')) {
            $this->filters = $this->defaultFilters ?? [];
        }
    }

    public function updatedFilters()
    {
        if (method_exists($this, 'resetPage')) {
            $this->resetPage();
        }
    }

    public function resetFilters()
    {
        $this->filters = $this->defaultFilters ?? [];
    }

    protected function getFilter($filter)
    {
        $value = null;
        if ($filter === 'search') {
            $value = $this->search;
        } else {
            $value = $this->filters[$filter] ?? ($this->defaultFilters ?? null);
        }

        return ! empty($value) ? $value : false;
    }
}
