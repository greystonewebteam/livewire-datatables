<?php

namespace Greystoneweb\LivewireDataTables\Traits;

trait WithSelectableColumns
{
    protected $selectableColumns = true;

    public $selectedColumns = [];

    protected $defaultColumns = [];

    public function mountWithSelectableColumns()
    {
        $this->resetColumns();
    }

    public function getSelectedColumnObjectsProperty()
    {
        return array_filter($this->columns(), function ($column) {
            return (empty($column->getName()) || in_array($column->getColumn(), $this->selectedColumns)) && ! $column->getHide();
        });
    }

    public function getDefaultColumns()
    {
        $columns = array_filter($this->columns(), function ($column) {
            return ! empty($column->getName()) && $column->getDefault();
        });

        return array_map(fn ($column) => $column->getColumn(), $columns);
    }

    public function resetColumns()
    {
        $this->selectedColumns = $this->getDefaultColumns();
    }
}
