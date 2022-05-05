<x-app-layout title="Quiz">
    <x-slot name="header">
        {{ $quiz->title }}
    </x-slot>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('quiz.result', ['slug' => $quiz->slug]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @foreach ($quiz->questions as $question)
                    <div class="my-3"><strong>#{{ $loop->iteration }}</strong> {{ $question->question }}
                    </div>
                    @if ($question->image)
                        <div class="my-6">
                            <img src="{{ asset($question->image) }}" class="img-fluid mx-auto d-block"
                                alt="Soru Fotoğrafı" width="40%">
                        </div>
                    @endif
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="{{ $question->id }}"
                            id="{{ $question->id }}answer1" value="answer1" required>
                        <label class="form-check-label" for="{{ $question->id }}answer1">
                            {{ $question->answer1 }}
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="{{ $question->id }}"
                            id="{{ $question->id }}answer2" value="answer2" required>
                        <label class="form-check-label" for="{{ $question->id }}answer2">
                            {{ $question->answer2 }}
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="{{ $question->id }}"
                            id="{{ $question->id }}answer3" value="answer3" required>
                        <label class="form-check-label" for="{{ $question->id }}answer3">
                            {{ $question->answer3 }}
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="{{ $question->id }}"
                            id="{{ $question->id }}answer4" value="answer4" required>
                        <label class="form-check-label" for="{{ $question->id }}answer4">
                            {{ $question->answer4 }}
                        </label>
                    </div>
                    <hr>
                @endforeach
                <div class="text-end">
                    <button type="submit" class="btn btn-danger mt-3">Quizi Bitir</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
