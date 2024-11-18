<?php

namespace App\Http\Controllers;

use App\Models\CustomExam;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
    public function downloadQuestionPdf(Request $request)
    {
        $custom_exam_id = $request->custom_question_id;
        $user_info = User::find($request->user_id);
        $user_responses = json_decode($request->all_question_with_user_answer, true);
        $custom_exam = CustomExam::with(['questions.options'])->find($custom_exam_id);
        $questions_data = [];

        foreach ($custom_exam->questions as $question) {
            $question_data = [
                'id' => $question->id,
                'question_text' => $question->question_text,
                'options' => $question->options,
                'user_answer' => null, 
            ];

            foreach ($user_responses as $response) {
                if ($response['question_id'] == $question->id) {
                    if (!empty($response['user_answer'])) {
                        $selected_option = $question->options->firstWhere('id', $response['user_answer']);
                        
                        $question_data['user_answer'] = $selected_option->option_text;
                    }
                }
            }

            $questions_data[] = $question_data;
        }

        // Generate the PDF
        $view = \Illuminate\Support\Facades\View::make('pdf.user_response_on_custom_questions', compact('custom_exam', 'user_info', 'questions_data'));
        $contents = $view->render();
        $mpdf = new \Mpdf\Mpdf(['format' => 'A4']);
        // Get current date and time for the footer
        $current_date_time = Carbon::now()->translatedFormat('d F Y h:i A');
        $mpdf->setFooter("Printed on: {$current_date_time} || Page {PAGENO} of {nbpg}");
        $mpdf->WriteHTML($contents);
        $mpdf->Output("{$custom_exam->name}.pdf", 'D');
    }


}
