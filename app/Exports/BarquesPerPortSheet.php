<?php

namespace App\Exports;

use App\Models\Barque;
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

class BarquesPerPortSheet implements FromQuery, WithTitle, WithMapping, WithHeadings, WithStyles
{
    private $port;

    public function __construct(Port $port) {
        $this->port = $port;
    }

    public function query() {
        return Barque::query()->where('port_id', $this->port->id);
    }

    public function title(): string {
        return $this->port->name;
    }

    public function map($barque): array {
        return [
            $barque->name,
            $barque->registration_number,
            $barque->activity->name,

            $barque->beacon->uin,
            $barque->beacon->serial_number,
            $barque->beacon->model->type->name,
            $barque->beacon->model->name,
            $barque->beacon->registration_date,
            $barque->beacon->expiration_date,
            $barque->beacon->manufacturer->name,
            $barque->beacon->status ? 'Active' : 'Inactive',

            $barque->user ? $barque->user->name : '',
            $barque->user ? $barque->user->email : '',
            $barque->user ? $barque->user->phone_number : '',
            $barque->user ? $barque->user->secondary_phone_number : '',
            $barque->user ? $barque->user->address : ''
        ];
    }

    public function headings(): array {
        return [
            'Barque',
            'Registration number',
            'Activity',
            'UIN',
            'Serial number',
            'Type',
            'Model',
            'Registration date',
            'Expiration date',
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
