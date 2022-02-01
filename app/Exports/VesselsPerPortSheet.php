<?php

namespace App\Exports;

use App\Models\Vessel;
use App\Models\Port;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class VesselsPerPortSheet implements FromQuery, WithTitle, WithMapping, WithHeadings, WithStyles
{
    private $port;

    public function __construct(Port $port) {
        $this->port = $port;
    }

    public function query() {
        return Vessel::query()->where('port_id', $this->port->id)->with('user', 'activity', 'port', 'beacon.manufacturer', 'beacon.model.type', 'beacon.status');
    }

    public function title(): string {
        return $this->port->name;
    }

    public function map($vessel): array {
        return [
            $vessel->registration_number,
            $vessel->name,
            $vessel->port->name,
            $vessel->mmsi,
            $vessel->tac,
            $vessel->activity->name,
            $vessel->beacon->uin,
            $vessel->beacon->serial_number_manufacturer,
            $vessel->beacon->serial_number_sar,
            Carbon::parse($vessel->beacon->registration_date)->format('d/m/Y'),
            Carbon::parse($vessel->beacon->expiration_date)->format('d/m/Y'),
            $vessel->beacon->manufacturer->name,
            $vessel->beacon->model->type->name,
            $vessel->beacon->model->name,
            $vessel->beacon->status->name,
            $vessel->user ? $vessel->user->name : '',
            $vessel->user ? $vessel->user->email : '',
            $vessel->user ? $vessel->user->phone_number : '',
            $vessel->user ? $vessel->user->secondary_phone_number : '',
            $vessel->user ? $vessel->user->emergency_contact_name : '',
            $vessel->user ? $vessel->user->emergency_contact_phone_number : '',
            $vessel->user ? $vessel->user->secondary_emergency_contact_name : '',
            $vessel->user ? $vessel->user->secondary_emergency_contact_phone_number : ''
        ];
    }

    public function headings(): array {
        return [
            'REGISTRATION NUMBER',
            'UNIT NAME',
            'PORT',
            'MMSI',
            'TAC',
            'ACTIVITY TYPE',
            'UIN',
            'SERIAL NUMBER MANUFACTURER',
            'SERIAL NUMBER SAR',
            'REGISTRATION DATE',
            'BATTERY EXPIRATION DATE',
            'MANUFACTURER',
            'BEACON TYPE',
            'MODEL',
            'BEACON STATUS',
            'OWNER',
            'EMAIL',
            'PHONE NUMBER',
            'SECONDARY PHONE NUMBER',
            'ADDRESS',
            'EMERGENCY CONTACT NAME',
            'EMERGENCY CONTACT PHONE NUMBER',
            'SECONDARY EMERGENCY CONTACT NAME',
            'SECONDARY EMERGENCY CONTACT PHONE NUMBER'
        ];
    }

    public function styles(Worksheet $sheet) {
        $sheet->getStyle('A1:X1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1:X1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
//        $sheet->getRowDimension(1)->setRowHeight(32);
//        $sheet->getStyle('A1:P1')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('FFFFFFFF'));
        $sheet->getStyle('A1:X1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('6b7280');
        $sheet->getStyle('A1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('eab308');
        $sheet->getStyle('G1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('eab308');
        $sheet->getStyle('P1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('eab308');

        $sheet->getStyle('A1:X1')->getFont()->getColor()->setRGB('FFFFFF');
//        $sheet->getDefaultRowDimension()->setRowHeight(32);

        foreach ($sheet->getColumnIterator() as $column) {
            $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
        }
    }




}
