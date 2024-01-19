<?php

namespace Greystoneweb\LivewireDataTables;

use Illuminate\Support\Facades\Blade;

class Column
{
    protected $selectable = true;

    protected $default = true;

    protected $formatCallback = null;

    protected $hide = false;

    protected $classes = [];

    protected $searchableCallback = null;

    protected $sortable = false;

    protected $sortableCallback = null;

    public function __construct(protected string $name, protected ?string $column = null)
    {

    }

    public static function make($name, $column = null)
    {
        return new static($name, $column);
    }

    public function getColumn(): string
    {
        return $this->column ?? str()->snake($this->name);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function selectable($bool = true)
    {
        $this->selectable = $bool;

        return $this;
    }

    public function getSelectable()
    {
        return $this->selectable;
    }

    public function default($bool = true)
    {
        $this->default = $bool;

        return $this;
    }

    public function getDefault()
    {
        return $this->default;
    }

    public function format(callable $callback)
    {
        $this->formatCallback = $callback;

        return $this;
    }

    public function blade($template)
    {
        $this->formatCallback = function ($value, $row) use ($template) {
            return Blade::render($template, compact('value', 'row'));
        };

        return $this;
    }

    public function display($row)
    {
        $value = $row->{$this->getColumn()};

        if (! $this->formatCallback) {
            return $value;
        }

        return call_user_func($this->formatCallback, $value, $row, $this);
    }

    public function hide($bool = true)
    {
        $this->hide = $bool;

        return $this;
    }

    public function getHide()
    {
        return $this->hide;
    }

    public function sortable($callback = null)
    {
        $this->sortableCallback = $callback;

        $this->sortable = true;

        return $this;
    }

    public function isSortable()
    {
        return $this->sortable;
    }

    public function getSortableCallback()
    {
        return $this->sortableCallback;
    }

    public function searchable($callback = null)
    {
        if ($callback) {
            $this->searchableCallback = $callback;

            return $this;
        }

        $this->searchableCallback = function ($query, $search) {
            $query->orWhere($this->getColumn(), 'like', "%{$search}%");
        };

        return $this;
    }

    public function getSearchableCallback()
    {
        return $this->searchableCallback;
    }

    public function addClass($class)
    {
        $this->classes[] = $class;

        return $this;
    }

    public function getClasses()
    {
        return $this->classes;
    }
}
