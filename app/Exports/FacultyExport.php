<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class FacultyExport implements WithMultipleSheets
{
    use Exportable;
    
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function sheets(): array
    {
        $sheets = [];

        $sheets[] = new FacultyAcademicBackgroundExport($this->data);
        $sheets[] = new FacultyEducationalBackgroundExport($this->data);
        $sheets[] = new FacultyProfessionalActivitiesExport($this->data);
        $sheets[] = new FacultyCommunityServiceExport($this->data);

        return $sheets;
    }
}
