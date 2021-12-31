<?php

namespace App\Exports;

use App\Models\Vessel;
use App\Models\Port;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
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
        return Vessel::query()
            ->where('port_id', $this->port->id);
    }

    public function title(): string {
        return $this->port->name;
    }

    public function map($vessel): array {
        return [
            $vessel->name,
            $vessel->registration_number,
            $vessel->activity->name,

            $vessel->beacon->uin,
            $vessel->beacon->serial_number_manufacturer,
            $vessel->beacon->serial_number_sar,
            $vessel->beacon->model->type->name,
            $vessel->beacon->model->name,
            $vessel->beacon->registration_date,
            $vessel->beacon->expiration_date,
            $vessel->beacon->manufacturer->name,
            $vessel->beacon->status ? 'Active' : 'Inactive',

            $vessel->user ? $vessel->user->name : '',
            $vessel->user ? $vessel->user->email : '',
            $vessel->user ? $vessel->user->phone_number : '',
            $vessel->user ? $vessel->user->secondary_phone_number : '',
            $vessel->user ? $vessel->user->address : ''
        ];
    }

    public function headings(): array {
        return [
            'Vessel',
            'Registration number',
            'Activity',
            'UIN',
            'S/N manufacturer',
            'S/N SAR',
            'Type',
            'Model',
            'Registration date',
            'Battery expiration date',
            'Company',
            'Status',
            'Owner',
            'Email',
            'Phone number',
            'Secondary phone number',
            'Address'
        ];
    }

    public function styles(Worksheet $sheet) {
        $sheet->getStyle('A1:P1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1:P1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getRowDimension(1)->setRowHeight(32);
        $sheet->getStyle('A1:P1')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('FFFFFFFF'));
        $sheet->getStyle('A1:P1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('4B5563');
        $sheet->getStyle('A1:P1')->getFont()->getColor()->setRGB('FFFFFF');
        //$sheet->getDefaultRowDimension()->setRowHeight(32);

        foreach ($sheet->getColumnIterator() as $column) {
            $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
        }
    }




}
