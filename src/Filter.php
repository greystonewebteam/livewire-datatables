<?php

namespace Greystoneweb\LivewireDataTables;

use BadMethodCallException;
use Greystoneweb\LivewireDataTables\Filters\DateFilter;
use Greystoneweb\LivewireDataTables\Filters\SelectFilter;

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
