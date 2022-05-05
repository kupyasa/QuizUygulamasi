<x-app-layout title="Quiz Detay">
    <x-slot name="header">
        {{ $quiz->title }}
    </x-slot>
    <div class="card">
        <div class="card-body">
            <a href="{{ route('quizzes.index') }}" class="btn btn-secondary my-3"> <i class="fa fa-arrow-left"></i>
                Quizlere Geri Dön</a>
            <div class="row">
                <div class="col-lg-4">
                    <ol class="list-group mb-3">
                        @if ($quiz->finished_at)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                Son Katılım Tarihi
                                <span
                                    class="badge bg-danger rounded-pill">{{ $quiz->finished_at ? date('Y-m-d H:i', strtotime($quiz->finished_at)) : 'Yok' }}</span>
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
                    <p class="card-text my-6">{{ $quiz->description }}</p>
                    <table class="table table-bordered table-dark table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Ad Soyad</th>
                                <th scope="col">Puan</th>
                                <th scope="col">Doğru</th>
                                <th scope="col">Yanlış</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quiz->results as $result)
                                <tr>
                                    <th scope="row">{{ $result->user->name }}</th>
                                    <td><span class="badge bg-primary">{{ $result->point }}</span> </td>
                                    <td>
                                        <span class="badge bg-success">{{ $result->correct }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-danger">{{ $result->wrong }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
