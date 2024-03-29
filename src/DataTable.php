<?php

namespace Greystoneweb\LivewireDataTables;

use Greystoneweb\LivewireDataTables\Traits\WithFilters;
use Greystoneweb\LivewireDataTables\Traits\WithSorting;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

abstract class DataTable extends Component
{
    use WithFilters, WithPagination, WithSorting;

    public bool $showSearch = true;

    public bool $showPerPage = true;

    public $perPage = 10;

    protected $searchPlaceholder = 'Search';

    protected $emptyMessage = 'No results found';

    protected $listeners = [
        'refreshDatatable' => '$refresh',
    ];

    protected $selectableColumns = null;

    abstract public function query(): Builder;

    abstract public function columns(): array;

    public function rowView(): string
    {
        return '';
    }

    public function filters(): array
    {
        return [];
    }

    public function actionsView(): ?string
    {
        return null;
    }

    public function footerView(): ?string
    {
        return null;
    }

    public function modals(): ?string
    {
        return null;
    }

    public function buildQuery()
    {
        $query = $this->query();

        $query->when($this->getFilter('search'), function ($query, $search) {
            $query->where(function ($query) use ($search) {
                foreach ($this->columns() as $column) {
                    if (! ($callback = $column->getSearchableCallback())) {
                        continue;
                    }

                    $callback($query, $search);
                }
            });
        });

        $this->applySorts($query);

        if (! isset($this->selectableColumns) || empty($this->selectedColumns)) {
            return $query;
        }

        return $query->select('id', ...$this->selectedColumns);
    }

    public function render()
    {
        $selectableColumns = $this->selectableColumns ?? false;

        return view(config('livewire-datatables.view'), [
            'rowView' => $this->rowView(),
            'rows' => $this->buildQuery()
                ->paginate($this->perPage),
            'columns' => $this->columns(),
            'filterOptions' => $this->filters(),
            'actionsView' => $this->actionsView(),
            'footerView' => $this->footerView(),
            'modals' => $this->modals(),
            'searchPlaceholder' => $this->searchPlaceholder,
            'selectableColumns' => $selectableColumns,
            'emptyMessage' => $this->emptyMessage,
        ]);
    }
}
