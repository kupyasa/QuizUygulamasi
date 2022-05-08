<x-app-layout title="Quiz Detay">
    <x-slot name="header">
        {{ $quiz->title }}
    </x-slot>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4">
                    <ol class="list-group mb-3">
                        @if ($quiz->finished_at)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                Son Katılım Tarihi
                                <span
                                    class="badge bg-danger rounded-pill">{{ $quiz->finished_at ? date('Y-m-d H:i', strtotime($quiz->finished_at)): 'Yok' }}</span>
                            </li>
                        @endif
                        @if ($quiz->my_result)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                Sıralama
                                <span class="badge bg-primary rounded-pill">#{{ $quiz->my_rank }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                Puan
                                <span class="badge bg-primary rounded-pill">{{ $quiz->my_result->point }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                Doğru
                                <span class="badge bg-success rounded-pill">{{ $quiz->my_result->correct }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                Yanlış
                                <span class="badge bg-danger rounded-pill">{{ $quiz->my_result->wrong }}</span>
                            </li>
                        @endif
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            Soru Sayısı
                            <span class="badge bg-secondary rounded-pill">{{ $quiz->questions_count }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            Katılımcı Sayısı
                            <span
                                class="badge bg-secondary rounded-pill">{{ $quiz->details ? $quiz->details['participants'] : 0 }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            Ortalama Puan
                            <span
                                class="badge bg-secondary rounded-pill">{{ $quiz->details ? $quiz->details['avarage_point'] : '-' }}</span>
                        </li>
                    </ol>
                    @if ($quiz->details)
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">İlk 10</h5>
                                <ol class="list-group list-group-numbered">
                                    @foreach ($quiz->topTen as $item)
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            @if ($item->user->profile_photo_url)
                                                <img src="{{ $item->user->profile_photo_url }}"
                                                    alt="{{ $item->user->name }}"
                                                    class="rounded-full h-8 w-8 object-cover">
                                            @endif
                                            <span
                                                @if (auth()->user()->id === $item->user->id) class="text-danger" @endif>{{ $item->user->name }}</span>
                                            <span class="badge bg-primary rounded-pill">{{ $item->point }}</span>
                                        </li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-lg-8">
                    <p class="card-text">{{ $quiz->description }}</p>
                    @if ($quiz->my_result)
                        <div class="text-end">
                            <a href="{{ route('quiz.join', ['slug' => $quiz->slug]) }}" class="btn btn-warning">Quizi
                                görüntüle</a>
                        </div>
                    @elseif($quiz->finished_at > now()->setTimezone(new DateTimeZone('Asia/Istanbul'))->format('Y-m-d H:i:s') || $quiz->finished_at == null)
                        <div class="text-end">
                            <a href="{{ route('quiz.join', ['slug' => $quiz->slug]) }}" class="btn btn-primary">Quize
                                katıl</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
