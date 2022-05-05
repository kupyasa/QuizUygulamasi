<x-app-layout title="Quiz Sonucu">
    <x-slot name="header">
        {{ $quiz->title }} Sonucu
    </x-slot>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title text-center">Puan : {{$quiz->my_result->point}}</h4>
            @foreach ($quiz->questions as $question)
                <div class="my-3">
                    @if ($question->correct_answer === $question->my_answer->answer)
                        <i class="fa fa-check text-success"></i>
                    @else
                        <i class="fa fa-times text-danger"></i>
                    @endif
                    <strong>#{{ $loop->iteration }}</strong> {{ $question->question }}
                </div>
                @if ($question->image)
                    <div class="my-6">
                        <img src="{{ asset($question->image) }}" class="img-fluid mx-auto d-block" alt="Soru Fotoğrafı"
                            width="40%">
                    </div>
                @endif
                <div class="form-check">
                    <input class="form-check-input" style="opacity:1.0" type="radio" name="{{ $question->id }}"
                        id="{{ $question->id }}answer1" value="answer1"
                        @if ($question->my_answer->answer === 'answer1') checked @endif disabled>
                    <label class="form-check-label" style="opacity:1.0" for="{{ $question->id }}answer1">
                        @if ($question->correct_answer === 'answer1')
                            <span class="text-success">{{ $question->answer1 }} (Cevaplayanlardan %{{$question->correct_percentage}} doğru bildi.) </span>
                        @else
                            <span class="text-danger">{{ $question->answer1 }}</span>
                        @endif

                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" style="opacity:1.0" type="radio" name="{{ $question->id }}"
                        id="{{ $question->id }}answer2" value="answer2"
                        @if ($question->my_answer->answer === 'answer2') checked @endif disabled>
                    <label class="form-check-label" style="opacity:1.0" for="{{ $question->id }}answer2">
                        @if ($question->correct_answer === 'answer2')
                            <span class="text-success">{{ $question->answer2 }} (Cevaplayanlardan %{{$question->correct_percentage}} doğru bildi.) </span>
                        @else
                            <span class="text-danger">{{ $question->answer2 }}</span>
                        @endif
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" style="opacity:1.0" type="radio" name="{{ $question->id }}"
                        id="{{ $question->id }}answer3" value="answer3"
                        @if ($question->my_answer->answer === 'answer3') checked @endif disabled>
                    <label class="form-check-label" style="opacity:1.0" for="{{ $question->id }}answer3">
                        @if ($question->correct_answer === 'answer3')
                            <span class="text-success">{{ $question->answer3 }} (Cevaplayanlardan %{{$question->correct_percentage}} doğru bildi.) </span>
                        @else
                            <span class="text-danger">{{ $question->answer3 }}</span>
                        @endif
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" style="opacity:1.0" type="radio" name="{{ $question->id }}"
                        id="{{ $question->id }}answer4" value="answer4"
                        @if ($question->my_answer->answer === 'answer4') checked @endif disabled>
                    <label class="form-check-label" style="opacity:1.0" for="{{ $question->id }}answer4">
                        @if ($question->correct_answer === 'answer4')
                            <span class="text-success">{{ $question->answer4 }} (Cevaplayanlardan %{{$question->correct_percentage}} doğru bildi.) </span>
                        @else
                            <span class="text-danger">{{ $question->answer4 }}</span>
                        @endif
                    </label>
                </div>
                <hr>
            @endforeach
        </div>
    </div>
</x-app-layout>
