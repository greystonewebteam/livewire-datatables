<?php

namespace Greystoneweb\LivewireDataTables\Traits;

use Greystoneweb\LivewireDataTables\Export;
use Maatwebsite\Excel\Excel;

trait Exportable
{
    abstract protected function fileName(): string;

    public function export()
    {
        return $this->exporterInstance()->download($this->fileName(), Excel::CSV);
    }

    public function exporterInstance(): Export
    {
        return new Export($this);
    }
}
