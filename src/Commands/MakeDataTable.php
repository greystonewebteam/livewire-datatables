<?php

namespace Greystoneweb\LivewireDataTables\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeDataTable extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:datatable {name} {--view=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new datatable livewire component';

    protected $type = 'DataTable';

    protected $rowView;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->rowView = $this->option('view') ?? $this->getRowViewName($this->argument('name'));

        parent::handle();

        // Create the row view
        $path = resource_path('/views/'.str_replace('.', '/', $this->rowView).'.blade.php');
        $this->makeDirectory($path);

        $this->files->put($path, file_get_contents($this->getRowViewStub()));
    }

    public function getRowViewStub()
    {
        if (file_exists($customStub = base_path('stubs/datatable-row.stub'))) {
            return $customStub;
        }

        return __DIR__.'/../../stubs/datatable-row.stub';
    }

    public function getStub()
    {
        if (file_exists($customStub = base_path('stubs/DataTable.stub'))) {
            return $customStub;
        }

        return __DIR__.'/../../stubs/DataTable.stub';
    }

    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub, $name)
            ->replaceView($stub, $name)
            ->replaceClass($stub, $name);
    }

    protected function replaceView(&$stub, $name)
    {
        $stub = str_replace('{{view}}', $this->getRowViewName($name), $stub);

        return $this;
    }

    protected function getRowViewName($name)
    {
        if ($this->rowView) {
            return $this->rowView;
        }

        if (str_contains($name, '\\')) {
            $parts = explode('\\', $name);
        } else {
            $parts = explode('/', $name);
        }

        $parts = array_map(fn ($part) => str()->snake($part, '-'), $parts);

        $basePath = trim(str_replace(
            [resource_path('/views'), '/'],
            ['', '.'],
            config('livewire.view_path')
        ), '.');

        return $basePath.'.'.implode('.', $parts).'-row';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return config('livewire.class_namespace');
    }
}
