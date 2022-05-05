<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Quiz;
use App\Models\Result;
use DateTimeZone;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function dashboard()
    {
        $quizzes = Quiz::where([['status', '=', 'publish']])->where(function($query){
            $query->whereNull('finished_at')->orWhere('finished_at','>',now()->setTimezone(new DateTimeZone('Asia/Istanbul'))->format('Y-m-d H:i:s'));
        })->withCount('questions')->paginate(5);
        $user_results = auth()->user()->results;
        return view('dashboard', compact('quizzes','user_results'));
    }

    public function quizDetail($slug)
    {
        $quiz = Quiz::where([['slug', '=', $slug]])->with('my_result', 'topTen.user')->withCount('questions')->first() ?? abort(404, 'Quiz Bulunamadı');
        
        return view('quiz_detail', compact('quiz'));
    }

    public function quiz($slug)
    {
        $quiz = Quiz::where([['slug', '=', $slug]])->withCount('questions')->with('questions.my_answer','my_result')->first() ?? abort(404, 'Quiz Bulunamadı');
        if ($quiz->my_result) {
            
            return view('quiz_result',compact('quiz'));
        }
        return view('quiz', compact('quiz'));
    }

    public function result(Request $request, $slug)
    {
        $quiz = Quiz::where([['slug', '=', $slug]])->withCount('questions')->with('questions', 'my_result')->first() ?? abort(404, 'Quiz Bulunamadı');
        if ($quiz->my_result) {
            abort(404, 'Bu Quize daha önce katıldınız');
        }

        $correct = 0;

        foreach ($quiz->questions as $question) {
            Answer::create(
                [
                    'user_id' => auth()->user()->id,
                    'question_id' => $question->id,
                    'answer' => $request->post($question->id)
                ]
            );
            if ($question->correct_answer === $request->post($question->id)) {
                $correct++;
            }
        }

        Result::create([
            'user_id' => auth()->user()->id,
            'quiz_id' => $quiz->id,
            'point' => (($correct / $quiz->questions_count) * 100),
            'correct' => $correct,
            'wrong' => ($quiz->questions_count - $correct)
        ]);


        return redirect()->route('quiz.detail', ['slug' => $slug])->withSuccess('Quiz tamamlandı. Puanın : ' . round((($correct / $quiz->questions_count) * 100)));
    }
}
