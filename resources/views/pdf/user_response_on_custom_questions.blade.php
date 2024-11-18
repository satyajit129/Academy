<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $custom_exam->name }}</title>
    <style>
        body {
            font-family: kalpurush, Arial, sans-serif;

        }

        .exam-header {
            text-align: center;
            background-color: #fff;
            border-radius: 10px;
            padding: 10px;
            border-bottom: 2px solid #004d99;
        }

        .exam-header h2 {
            color: #004d99;
            margin-bottom: 0px;
        }

        .exam-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            font-size: 14px;
            font-weight: 500;
            color: #333;
        }

        .exam-item {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .exam-item strong {
            font-weight: 600;
            color: #004d99;
        }

        .exam-item span {
            color: #555;
            font-weight: 400;
        }

        .exam-body {
            font-size: 12px;
        }
    </style>
</head>
<body>

    <div style="width: 100%">
        <div class="exam-header">
            <h2>প্রশ্নপত্র</h2>

            <div class="exam-details">
                <div class="exam-item">
                    <strong>পরীক্ষার নাম:</strong> <span>{{ $custom_exam->name }}</span>
                </div>
                <div class="exam-item">
                    <strong>মোট নম্বর:</strong> <span>{{ $custom_exam->number_of_questions }}</span>
                </div>
                <div class="exam-item">
                    <strong>পাশ মার্ক:</strong> <span>{{ $custom_exam->passing_marks }}</span>
                </div>
                <div class="exam-item">
                    <strong>মোট সময়:</strong> <span>{{ $custom_exam->exam_duration }} মিনিট</span>
                </div>
                <div class="exam-item">
                    <strong>নাম:</strong> <span>{{ $user_info->name }} </span>
                </div>
            </div>
        </div>

    <div class="exam-body" >
        <div class="exam-questions" >
            @if ($custom_exam->questions->isEmpty())
                <p class="text-center">No questions assigned.</p>
            @else
                <div class="questions-container">
                    <table class="table" style="width: 100%; border-spacing: 20px;">
                        @php
                            $questionNumber = 1;
                        @endphp
    
                            @foreach ($questions_data as $index => $question)
                                @if ($index % 2 == 0)
                                    <tr>
                                @endif

                                <td class="question-card" style="width: 50%; vertical-align: top;">
                                    <div class="question-header">
                                        <p style="text-align: justify;">
                                            <strong>{{ $questionNumber }} &nbsp;</strong>{{ $question['question_text'] }}
                                        </p>
                                    </div>
                                    <div class="question-options">
                                        <div>
                                            @foreach ($question['options'] as $optionIndex => $option)
                                                <div>
                                                    <label for="option{{ $option->id }}">
                                                        @php
                                                            $bengali_letters = ['ক', 'খ', 'গ', 'ঘ'];
                                                        @endphp
                                                        {{ $bengali_letters[$optionIndex] ?? '' }}. 
                                                        @if ($option->is_correct)
                                                            <span style="color: green;">{{ $option->option_text }}</span>
                                                        @else
                                                            {{ $option->option_text }}
                                                        @endif
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="user-answer">
                                        @if(!is_null($question['user_answer']) && isset($question['user_answer']))
                                            <strong>আপনার উত্তরঃ </strong> {{ $question['user_answer'] }}
                                        @endif
                                    </div>
                                    
                                </td>

                                @php
                                    $questionNumber++;
                                @endphp

                                @if ($index % 2 == 1 || $loop->last)
                                    </tr>
                                @endif
                            @endforeach

                    </table>
                </div>
            @endif
        </div>
    </div>
    

</body>
</html>
