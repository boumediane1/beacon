<?php

namespace App\Exports;

use App\Models\Port;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class VesselsExport implements WithMultipleSheets
{
    use Exportable;

    public function sheets(): array {
        $sheets = [];
        $ports = Port::query()->orderBy('name')->get();

        foreach ($ports as $port) {
            $sheets[] = new VesselsPerPortSheet($port);
        }

        return $sheets;
    }
}
