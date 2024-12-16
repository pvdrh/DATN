<?php

namespace App\Exports;

use App\Models\Transaction;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransactionsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    private $filters;
    private $counter = 1;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Transaction::with(['customer', 'service', 'user', 'agency']);

        // Apply filters
        if (!empty($this->filters['agency_id'])) {
            $query->where('agency_id', $this->filters['agency_id']);
        }
        if (!empty($this->filters['start_date'])) {
            $query->whereDate('created_at', '>=', $this->filters['start_date']);
        }
        if (!empty($this->filters['end_date'])) {
            $query->whereDate('created_at', '<=', $this->filters['end_date']);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'STT',
            'Tên khách hàng',
            'Tên dịch vụ',
            'Người tạo',
            'Đại lý',
            'Số tiền',
            'Ngày tạo',
        ];
    }

    public function map($row): array
    {
        return [
            $this->counter++,
            $row->customer->name ?? '-',
            $row->service->name ?? '-',
            $row->user->name ?? '-',
            $row->agency->name ?? '-',
            number_format($row->amount, 0, ',', '.') . ' VNĐ',
            Carbon::parse($row->created_at)->format('d-m-Y H:i'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            'A' => ['alignment' => ['horizontal' => 'center']],
            'F' => ['alignment' => ['horizontal' => 'center']],
            'G' => ['alignment' => ['horizontal' => 'center']],
        ];
    }
}
