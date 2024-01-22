<?php

namespace Greystoneweb\LivewireDataTables;

use Greystoneweb\LivewireDataTables\Commands\MakeDataTable;
use Illuminate\Support\ServiceProvider;

class DataTableServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeDataTable::class,
            ]);
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'livewire-datatables');

        $this->publishes([
            __DIR__.'/../config/livewire-datatables.php' => config_path('livewire-datatables.php'),
            __DIR__.'/../stubs/DataTable.stub' => base_path('stubs/DataTable.stub'),
            __DIR__.'/../stubs/datatable-row.stub' => base_path('stubs/datatable-row.stub'),
        ]);
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/livewire-datatables.php', 'livewire-datatables'
        );
    }
}
