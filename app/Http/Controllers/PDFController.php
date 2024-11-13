<?php

namespace App\Http\Controllers;

use App\Models\CustomExam;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function customExamsDownload($id)
    {
        $custom_exam = CustomExam::with(['questions.options'])->find($id);
        $view = \Illuminate\Support\Facades\View::make('pdf.custom_exam_pdf', compact('custom_exam'));
        $contents = $view->render();

        $mpdf = new \Mpdf\Mpdf(['format' => 'A4']);
        $mpdf->SetWatermarkText($custom_exam->name, 45);
        $mpdf->showWatermarkText = true;
        $mpdf->watermarkTextAlpha = 0.2;
        $mpdf->setFooter("মুদ্রণ করা হয়েছে: || {PAGENO} of {nbpg}");
        $mpdf->WriteHTML($contents);
        $mpdf->Output("{$custom_exam->name}.pdf", 'I');
    }
    
}
