### Introduction



## Basic Example

Using the make command:
`php artisan make:datatable Users/UsersTable`

Will create two files: `Users/UsersTable.php` and `users/users-table-row.blade.php` in your Livewire directories.

## Features

### Sorting

To enable sorting just call the `sortable()` method on a column.

```php
public function columns(): array
{
    return [
        Column::make('Name')
            ->sortable()
    ];
}

```

If the column header label differs from the database column, be sure to specify it with the second parameter in the `make()` method.

```php
Column::make('Name', 'full_name')
    ->sortable()
```

If you need any custom sort logic to be applied, you can pass a callback to the `sortable()` method.

```php
Column::make('Name')
    ->sortable(function ($query, $direction) {
        $query->orderBy('last_name', $direction);
    })
```

### Filters

### Search

### Exporting Results
To use this feature, you'll have to install [Laravel Excel](https://laravel-excel.com/).

Example:

Inside your component class:
```php
use Greystoneweb\LivewireDataTables\DataTable;
use Greystoneweb\LivewireDataTables\Traits\Exportable;

class UsersTable extends DataTable
{
    // Use the Exportable trait
    use Exportable;

    // Define a fileName method that returns the filename
    protected function fileName(): string
    {
        return 'users'.date('Y-m-d').'.csv';
    }
    ...
}
```

And then you can call the `export()` method from your view with `wire:click` and all of the results will be automatically be exported to CSV with filters/sorts applied. If the exported file doesn't look quite right, you can create a custom `Export` instance that extends `Greystoneweb\LivewireDataTables\Export` and return it in a method called `exporterInstance` on the datatable component. This is particularly useful when dealing with relationships.

Example:

Your component:
```php
use Greystoneweb\LivewireDataTables\DataTable;
use Greystoneweb\LivewireDataTables\Export;
use Greystoneweb\LivewireDataTables\Traits\Exportable;

class UsersTable extends DataTable
{
    // Use the Exportable trait
    use Exportable;

    // Define a fileName method that returns the filename
    protected function fileName(): string
    {
        return 'users'.date('Y-m-d').'.csv';
    }

    public function exporterInstance(): Export
    {
        return new UsersExport($this);
    }
    ...
}
```

Your custom exporter:
```php
use Greystoneweb\LivewireDataTables\Export;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport extends Export implements WithMapping
{
    public function headings(): array
    {
        return [
            'Name',
            'Organization',
            'Email',
        ];
    }

    public function map($user): array
    {
        return [
            $user->name,
            $user->organization->name,
            $user->email,
        ];
    }
}
```