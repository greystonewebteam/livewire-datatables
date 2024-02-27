<?php

namespace Tests;

use Greystoneweb\LivewireDataTables\Column;
use Greystoneweb\LivewireDataTables\DataTable;
use Greystoneweb\LivewireDataTables\Filter;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Workbench\App\Models\TestModel;

class TestDataTable extends DataTable
{
    public function query(): Builder
    {
        return TestModel::query();
    }

    public function columns(): array
    {
        return [
            Column::make('Test'),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::select('Test')
                ->options([]),
        ];
    }

    public function rowView(): string
    {
        return 'test-models-row';
    }
}
