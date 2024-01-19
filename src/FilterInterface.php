<?php

namespace App\Classes\DataTable;

interface FilterInterface
{
    public function __construct($name);

    public function render();
}
