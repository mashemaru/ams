<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\WithTitle;

class FacultyEducationalBackgroundExport implements FromView, ShouldAutoSize, WithEvents, WithTitle
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('faculty.exports.faculty_teaching_experience_dlsu', [
            'user' => $this->data
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->styleCells(
                    'A1:Z999',
                    [
                        'alignment' => array(
                            'horizontal' => Alignment::HORIZONTAL_LEFT,
                        )
                    ]
                );
            },
        ];
    }
    
    public function title(): string
    {
        return 'Educational Experience';
    }
}