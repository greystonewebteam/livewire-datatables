<?php

namespace Tests\Feature;

use Livewire\Livewire;
use Tests\TestCase;
use Tests\TestDataTable;
use Workbench\App\Models\TestModel;

class DataTableTest extends TestCase
{
    public function test_it_renders()
    {
        // Renders with no results
        Livewire::test(TestDataTable::class)
            ->assertOk();

        // Renders with results
        TestModel::factory(15)->create();
        Livewire::test(TestDataTable::class)
            ->assertOk();
    }
}
