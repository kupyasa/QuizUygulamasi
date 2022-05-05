<x-app-layout title='Soru Güncelle'>
    <x-slot name="header">
        {{ $question->question }} Düzenle
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form
                action="{{ route('questions.update', ['quiz_id' => $question->quiz_id, 'question' => $question->id]) }}"
                method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="question" class="form-label">Soru Düzenle</label>
                    <textarea class="form-control" style="resize:none" name="question" id="question"
                        rows="5">{{ $question->question }}</textarea>
                </div>
                <div class="mb-3">

                    <label for="image" class="form-label">Fotoğraf</label>
                    @if ($question->image)
                        <div class="mb-6"">
                        <a href=" {{ asset($question->image) }}"
                            target="_blank"><img src="{{ asset($question->image) }}" class="img-fluid mx-auto d-block"
                                alt="Soru Fotoğrafı" width="40%">
                            </a>
                        </div>
                    @endif
                    <input class="form-control" type="file" id="image" name="image">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="answer1" class="form-label">1. Cevap</label>
                            <textarea class="form-control" style="resize:none" name="answer1" id="answer1"
                                rows="4">{{ $question->answer1 }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="answer2" class="form-label">2. Cevap</label>
                            <textarea class="form-control" style="resize:none" name="answer2" id="answer2"
                                rows="4">{{ $question->answer2 }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="answer3" class="form-label">3. Cevap</label>
                            <textarea class="form-control" style="resize:none" name="answer3" id="answer3"
                                rows="4">{{ $question->answer3 }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="answer4" class="form-label">4. Cevap</label>
                            <textarea class="form-control" style="resize:none" name="answer4" id="answer4"
                                rows="4">{{ $question->answer4 }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="correct_answer"> Doğru cevabı seçin.</label>
                    <select class="form-select" name="correct_answer" id="correct_answer">
                        <option @if ($question->correct_answer === 'answer1') selected @endif value="answer1">1.Cevap</option>
                        <option @if ($question->correct_answer === 'answer2') selected @endif value="answer2">2.Cevap</option>
                        <option @if ($question->correct_answer === 'answer3') selected @endif value="answer3">3.Cevap</option>
                        <option @if ($question->correct_answer === 'answer4') selected @endif value="answer4">4.Cevap</option>
                    </select>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">Soru Düzenle</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
