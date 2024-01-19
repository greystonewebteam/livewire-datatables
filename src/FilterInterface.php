<?php

namespace Greystoneweb\LivewireDataTables;

interface FilterInterface
{
    public function __construct($name);

    public function render();
}
