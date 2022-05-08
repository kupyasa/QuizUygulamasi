<x-app-layout title='Sorular'>
    <x-slot name="header">
        {{ $quiz->title }} Quizine Ait Sorular
    </x-slot>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <a href="{{ route('quizzes.index') }}" class="btn btn-secondary my-3"> <i
                    class="fa fa-arrow-left"></i>
                Quizlere Geri Dön</a>
                <a href="{{ route('questions.create', ['quiz_id' => $quiz->id]) }}" class="btn btn-primary my-3"> <i
                        class="fa fa-plus"></i>
                    Soru
                    Oluştur</a>
            </div>
            <table class="table table-bordered table-dark table-hover">
                <thead>
                    <tr>
                        <th scope="col">Soru</th>
                        <th scope="col">Fotoğraf</th>
                        <th scope="col">1.Cevap</th>
                        <th scope="col">2.Cevap</th>
                        <th scope="col">3.Cevap</th>
                        <th scope="col">4.Cevap</th>
                        <th scope="col">Doğru Cevap</th>
                        <th scope="col" style="width: 125px">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quiz->questions as $question)
                        <tr>
                            <td>{{ $question->question }}</td>
                            @if ($question->image)
                                <td><a href=" {{ asset($question->image) }}" target="_blank" class="btn btn-sm btn-info">Fotoğrafı görüntüle</a></td>
                            @else
                                <td>Fotoğraf yok</td>
                            @endif
                            <td>{{ $question->answer1 }}</td>
                            <td>{{ $question->answer2 }}</td>
                            <td>{{ $question->answer3 }}</td>
                            <td>{{ $question->answer4 }}</td>
                            @if ($question->correct_answer == 'answer1')
                                <td class="text-success">{{ $question->answer1 }}</td>
                            @elseif($question->correct_answer == 'answer2')
                                <td class="text-success">{{ $question->answer2 }}</td>
                            @elseif($question->correct_answer == 'answer3')
                                <td class="text-success">{{ $question->answer3 }}</td>
                            @elseif($question->correct_answer == 'answer4')
                                <td class="text-success">{{ $question->answer4 }}</td>
                            @endif

                            <td>
                                <a href="{{ route('questions.edit', ['quiz_id' => $quiz->id, 'question' => $question->id]) }}"
                                    class="btn btn-primary"><i class="fa fa-pen"></i></a>
                                <a href="{{ route('questions.destroy', ['quiz_id' => $quiz->id, 'question' => $question->id]) }}"
                                    class="btn btn-danger"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
