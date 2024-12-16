<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CustomersExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    private $counter = 1;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $agency_id = auth()->user()->agency_id;
        if (!empty($agency_id)) {
            return Customer::with('agency', 'services')->where('agency_id', $agency_id)->get();
        }

        return Customer::with('agency', 'services')->get();
    }

    public function headings(): array
    {
        return [
            'STT',
            'Tên khách hàng',
            'Giới tính',
            "Số điện thoại",
            "Ngày sinh",
            "Chi nhánh",
            'Gói đã đăng ký',
        ];
    }

    public function map($row): array
    {
        return [
            $this->counter++,
            $row->name ?: '-',
            $row->gender ? 'Nam' : 'Nữ',
            $row->phone ?: '-',
            $row->dob ? Carbon::parse($row->dob)->format('d-m-Y') : '-',
            $row->agency->name,
            $row->services ? $row->services->implode('name', ', ') : '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            'A' => ['alignment' => ['horizontal' => 'center']],
            'C' => ['alignment' => ['horizontal' => 'center']],
            'E' => ['alignment' => ['horizontal' => 'center']],
        ];
    }
}
