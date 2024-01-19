<?php

namespace App\Classes\DataTable\Traits;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Attributes\Url;

trait WithSorting
{
    #[Url()]
    public array $sorts = [];

    public string $defaultSortColumn = '';

    public string $defaultSortDirection = 'asc';

    public array $appliedSorts = [];

    public function mountWithSorting()
    {
        if (! empty($this->defaultSortColumn)) {
            $this->sorts[$this->defaultSortColumn] = $this->defaultSortDirection;
        }
    }

    public function applySorts(Builder $query)
    {
        if (empty($this->sorts)) {
            return;
        }

        foreach ($this->columns() as $column) {
            if (! $column->isSortable() || ! isset($this->sorts[$column->getColumn()])) {
                continue;
            }

            $direction = $this->sorts[$column->getColumn()];

            $this->appliedSorts[$column->getColumn()] = [
                'name' => $column->getName(),
                'direction' => $direction,
            ];

            if ($callback = $column->getSortableCallback()) {
                $callback($query, $direction);

                continue;
            }

            $query->orderBy($column->getColumn(), $direction);
        }
    }

    public function toggleSort($column)
    {
        if (isset($this->sorts[$column])) {
            if ($this->sorts[$column] === 'asc') {
                $this->sorts[$column] = 'desc';

                return;
            }

            unset($this->sorts[$column]);

            return;
        }

        $this->sorts[$column] = 'asc';
    }

    public function removeSort($column)
    {
        unset($this->sorts[$column]);
    }

    public function resetSorts()
    {
        $this->reset('sorts');
    }
}
