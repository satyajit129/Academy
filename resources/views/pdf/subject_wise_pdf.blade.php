<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>প্রশ্নপত্র</title>
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
            font-size: 18px;
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
                    <strong>বিষয় :</strong> <span>{{ $custom_exam->name }}</span>
                </div>
        </div>
        <div class="exam-body" style="padding: 20px;">
            <div class="exam-questions" style="margin-top: 20px;">
                @if ($custom_exam->questions->isEmpty())
                    <p class="text-center">No questions assigned.</p>
                @else
                <div class="questions-container">
                    <table class="table" style="width: 100%;">
                        @php
                            $questionNumber = 1; 
                        @endphp
                
                        @foreach ($custom_exam->questions as $index => $question)
                            @if ($index % 2 == 0)
                                <tr>
                            @endif
                
                            <td class="question-card" style="width: 50%; vertical-align: top;">
                                <div class="question-header">
                                    <p style="text-align: justify;">
                                        <strong>{{ $questionNumber }} &nbsp;</strong>{{ $question->question_text }}
                                    </p>
                                </div>
                                <div class="question-options" style="padding-left: 20px;">
                                    @foreach ($question->options as $option)
                                        <div class="form-check" style="margin-bottom: 10px;">
                                            <input class="form-check-input" type="radio" id="option{{ $option->id }}"
                                                   name="question{{ $question->id }}" value="{{ $option->id }}">
                                            <label class="form-check-label" for="option{{ $option->id }}">
                                                {{ $option->option_text }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            @php
                                $questionNumber++;
                            @endphp
                            @if ($index % 2 == 1)
                                </tr>
                            @endif
                        @endforeach
                        @if (count($custom_exam->questions) % 2 != 0)
                            <td style="width: 50%;"></td>
                        @endif
                    </table>
                </div>
                
                @endif
            </div>
        </div>
    </div>
</body>

</html>
