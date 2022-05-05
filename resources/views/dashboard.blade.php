<x-app-layout title="Anasayfa">
    <x-slot name="header">
        {{ __('Anasayfa') }}
    </x-slot>

    <div class="row">
        <div class="col-8">
            <div class="list-group">
                @foreach ($quizzes as $quiz)
                    <a href="{{ route('quiz.detail', $quiz->slug) }}" class="list-group-item list-group-item-action"
                        aria-current="true">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ $quiz->title }}</h5>
                            <small>Bitiş Tarihi :
                                {{ $quiz->finished_at ?  date('Y-m-d H:i', strtotime($quiz->finished_at)) : 'Yok' }}</small>
                        </div>
                        <p class="mb-1"> {{ Str::limit($quiz->description, 100) }}</p>
                        <small>{{ $quiz->questions_count }} Soru</small>
                    </a>
                @endforeach
                <div class="mt-3">
                    {{ $quizzes->withQueryString()->links() }}
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header bg-info">
                    Tamamladığım Quizler ve Puanlarım
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($user_results as $result)
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <a href="{{ route('quiz.detail', ['slug' => $result->quiz->slug]) }}" class="text-dark" style="text-decoration: none">
                                {{ $result->quiz->title }}
                            </a>
                            <span class="badge bg-primary rounded-pill">{{ $result->point }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
