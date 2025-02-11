<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Question;

class SurveyQuestionsSeeder extends Seeder
{

    protected $survey_questions = [
        [
            'slug' => 'question_1',
            'question' => 'How satisfied are you with your current work-life balance? (0 - Not at all, 5 - Extremely)',
        ],
        [
            'slug' => 'question_2',
            'question' => 'How often do you feel productive during your workday? (0 - Never, 5 - Always)',
        ],
        [
            'slug' => 'question_3',
            'question' => 'How well do you manage stress in your daily life? (0 - Not at all, 5 - Very well)',
        ],
        [
            'slug' => 'question_4',
            'question' => 'How would you rate your communication skills in a team setting? (0 - Poor, 5 - Excellent)',
        ],
        [
            'slug' => 'question_5',
            'question' => 'How comfortable are you with adapting to new technologies? (0 - Not at all, 5 - Very comfortable)',
        ],
        [
            'slug' => 'question_6',
            'question' => 'How confident are you in your problem-solving abilities? (0 - Not confident, 5 - Very confident)',
        ],
        [
            'slug' => 'question_7',
            'question' => 'How satisfied are you with your personal growth over the past year? (0 - Not at all, 5 - Extremely)',
        ],
        [
            'slug' => 'question_8',
            'question' => 'How likely are you to recommend your current workplace to others? (0 - Never, 5 - Very likely)',
        ],
        [
            'slug' => 'question_9',
            'question' => 'How well do you balance teamwork and independent work? (0 - Poor, 5 - Excellent)',
        ],
        [
            'slug' => 'question_10',
            'question' => 'How effective do you feel your time management skills are? (0 - Not effective, 5 - Very effective)',
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->survey_questions as $question) {
            Question::updateOrCreate([ 'slug' => $question['slug'] ], $question);
        }

    }
}
