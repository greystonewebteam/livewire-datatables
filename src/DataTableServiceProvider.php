<?php

namespace Greystoneweb\LivewireDataTables;

use Illuminate\Support\ServiceProvider;

class DataTableServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'livewire-datatables');

        $this->publishes([
            __DIR__.'/../config/livewire-datatables.php' => config_path('livewire-datatables.php'),
        ]);
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/livewire-datatables.php', 'livewire-datatables'
        );
    }
}
