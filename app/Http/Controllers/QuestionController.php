<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Answer;
use App\Http\Resources\Question\QuestionCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class QuestionController extends Controller
{
    public function index(Request $request) 
    {
        if ($request->param) {
            $questions = new QuestionCollection(Question::where('status', 1)->get());

            return response()->json(['data' => $questions], 200);
        }

        return Question::where('status', 1)->paginate(5);
    }

    public function store(Request $request)
    {
        foreach ($request->answers as $answer) {
            $answer_data = [
                'user_id' => $request->user()->id,
                'question_id' => Question::where('slug', $answer['question'])->value('id'),
                'answer' => $answer['answer'],
            ];

            Answer::create($answer_data);
        }

        return response()->json(['message' => 'success'], 200);
        
    }

    public function getAnswers(Request $request)
    {
        $answers = Answer::where('question_id', $request->question_id)
            ->selectRaw('answer, COUNT(*) as count')
            ->groupBy('answer')
            ->pluck('count', 'answer')
            ->toArray();

        $answers = array_replace(['0' => 0, '1' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0], $answers);

        $answers['total'] = array_sum($answers);

        return response()->json(['data' => $answers], 200);
    }
}
