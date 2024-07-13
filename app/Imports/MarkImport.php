<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Models\Marks;
use App\Models\Student;
// use App\Imports\Student;

class MarkImport implements ToCollection
{
    /**
    * @param Collection $collection
    */



    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            // Check if the student exists
            $student = Student::where('registration_number', $row[0])->first();

            if ($student) {
                // Check if marks already exist for this student
                $marks = Marks::where('registration_number', $row[0])->first();

                if ($marks) {
                    // Update existing marks
                    $marks->update([
                        'subject1_marks' => $row[1],
                        'subject2_marks' => $row[2],
                        'subject3_marks' => $row[3],
                        'subject4_marks' => $row[4],
                        'subject5_marks' => $row[5],
                    ]);
                } else {
                    // Create new marks record
                    Marks::create([
                        'registration_number' => $row[0],
                        'subject1_marks' => $row[1],
                        'subject2_marks' => $row[2],
                        'subject3_marks' => $row[3],
                        'subject4_marks' => $row[4],
                        'subject5_marks' => $row[5],
                    ]);
                }
            }
        }
    }


    
    // public function collection(Collection $rows)
    // {
    //     foreach ($rows as $row)
    //     {

    //         $student = Student::where('registration_number', $row[0])->first();

    //         if ($student) {
    //             Marks::create([
    //                 'registration_number' => $row[0],
    //                 'subject1_marks' => $row[1],
    //                 'subject2_marks' => $row[2],
    //                 'subject3_marks' => $row[3],
    //                 'subject4_marks' => $row[4],
    //                 'subject5_marks' => $row[5],
    //             ]);
    //         }
    //     }
    // }
}
