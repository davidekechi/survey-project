<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class QuestionController extends Controller
{
    public function index() 
    {
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
}
