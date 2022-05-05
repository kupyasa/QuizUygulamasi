<x-app-layout title='Quizler'>
    <x-slot name="header">
        {{ __('Quizler') }}
    </x-slot>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <form class="row" method="GET" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="col">
                        <input type="text" name="title" placeholder="Quiz Adı" class="form-control"
                            value="{{ request()->get('title') }}">
                    </div>
                    <div class="col">
                        <select class="form-select" onchange="this.form.submit()" name="status" id="status">
                            <option @if (request()->get('status') === '') selected @endif value="">Durum Seçiniz</option>
                            <option @if (request()->get('status') === 'draft') selected @endif value="draft">Taslak</option>
                            <option @if (request()->get('status') === 'passive') selected @endif value="passive">Yayında değil
                            </option>
                            <option @if (request()->get('status') === 'publish') selected @endif value="publish">Yayında</option>
                        </select>
                    </div>
                    @if (request()->get('status') || request()->get('title'))
                        <div class="col">
                            <a href="{{ route('quizzes.index') }}" class="btn btn-secondary">
                                Sıfırla
                            </a>
                        </div>
                    @endif
                </form>
                <div class="text-end">
                    <a href="{{ route('quizzes.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus">
                        </i>
                        Quiz Oluştur
                    </a>
                </div>
            </div>
            <table class="table table-bordered table-dark table-hover">
                <thead>
                    <tr>
                        <th scope="col">Quiz</th>
                        <th scope="col">Soru Sayısı</th>
                        <th scope="col">Durum</th>
                        <th scope="col">Bitiş Tarihi</th>
                        <th scope="col">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quizzes as $quiz)
                        <tr>
                            <th scope="row">{{ $quiz->title }}</th>
                            <td>{{ $quiz->questions_count }}</td>
                            <td>
                                @switch($quiz->status)
                                    @case('publish')
                                        @if (!$quiz->finished_at)
                                            <span class="badge bg-success">Yayında</span>
                                        @elseif($quiz->finished_at >
    now()->setTimezone(new DateTimeZone('Asia/Istanbul'))->format('Y-m-d H:i:s'))
                                            <span class="badge bg-success">Yayında</span>
                                        @else
                                            <span class="badge bg-secondary">Tarihi Geçmiş</span>
                                        @endif
                                    @break

                                    @case('passive')
                                        <span class="badge bg-danger">Yayında değil</span>
                                    @break

                                    @case('draft')
                                        <span class="badge bg-warning">Taslak</span>
                                    @break
                                @endswitch
                            </td>
                            <td>
                                {{ $quiz->finished_at ? date('Y-m-d H:i', strtotime($quiz->finished_at)) : '-' }}
                            </td>
                            <td>
                                <a href="{{ route('quizzes.details', $quiz->id) }}" class="btn btn-secondary"><i
                                        class="fa fa-info"></i></a>
                                <a href="{{ route('questions.index', $quiz->id) }}" class="btn btn-warning"><i
                                        class="fa fa-question"></i></a>
                                <a href="{{ route('quizzes.edit', $quiz->id) }}" class="btn btn-primary"><i
                                        class="fa fa-pen"></i></a>
                                <a href="{{ route('quizzes.destroy', $quiz->id) }}" class="btn btn-danger"><i
                                        class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $quizzes->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>
