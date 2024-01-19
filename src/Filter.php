<?php

namespace App\Classes\DataTable;

use App\Classes\DataTable\Filters\DateFilter;
use App\Classes\DataTable\Filters\SelectFilter;
use BadMethodCallException;

class Filter
{
    protected static $types = [
        'select' => SelectFilter::class,
        'date' => DateFilter::class,
    ];

    public static function __callStatic($name, $arguments)
    {
        if (! isset(self::$types[$name])) {
            throw new BadMethodCallException('Filter type does not exist');
        }

        return new self::$types[$name](...$arguments);
    }
}
