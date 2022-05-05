<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\MainController;
use App\Models\Quiz;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'middleware' => ['auth',],
], function () {
    Route::get('/', [MainController::class, 'dashboard'])->name('dashboard');
    Route::get('quiz/detay/{slug}', [MainController::class, 'quizDetail'])->name('quiz.detail');
    Route::get('quiz/{slug}', [MainController::class, 'quiz'])->name('quiz.join');
    Route::post('quiz/{slug}/result', [MainController::class, 'result'])->name('quiz.result');
});

Route::group(
    [
        'middleware' => ['auth', 'isAdmin'],
        'prefix' => 'admin'
    ],
    function () {
        Route::get('quizzes/{id}', [QuizController::class, 'destroy'])->whereNumber('id')->name('quizzes.destroy');
        Route::get('quizzes/{id}/details', [QuizController::class, 'show'])->whereNumber('id')->name('quizzes.details');
        Route::get('quiz/{quiz_id}/questions/{id}', [QuestionController::class, 'destroy'])->whereNumber('quiz_id', 'id')->name('questions.destroy');
        Route::resource('quizzes', QuizController::class);
        Route::resource('quiz/{quiz_id}/questions', QuestionController::class);
    }
);
