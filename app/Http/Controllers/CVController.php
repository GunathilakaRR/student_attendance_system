<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class CVController extends Controller
{
    public function cvGenerate(Request $request)
    {

        // Capture form data
        $formData = $request->all();

        // Generate HTML representation of the CV
        // $html = view('student.cv', $formData)->render();
        $html = view('cv_template', ['data' => $data])->render();


        // Convert HTML to PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $pdfContent = $dompdf->output();

        // Offer PDF download
        return response()->streamDownload(
            function () use ($pdfContent) {
                echo $pdfContent;
            },
            'generated_cv.pdf'

        );
        // $pdf = PDF::loadView('student.cv', ['data' => $request->all()]);


        // return $pdf->download('cv.pdf');
    }
}
