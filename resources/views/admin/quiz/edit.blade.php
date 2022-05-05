<x-app-layout title='Quiz Güncelle'>
    <x-slot name="header">
        {{ __('Quiz Güncelle') }}
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('quizzes.update', $quiz->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="title" class="form-label">Quiz Başlık</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $quiz->title }}"
                        required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Quiz Açıklama</label>
                    <textarea class="form-control" style="resize:none" name="description" id="description"
                        rows="5">{{ $quiz->description }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="status"> Quiz durumunu seçin.</label>
                    <select class="form-select" name="status" id="status">
                        <option @if ($quiz->status === 'draft') selected @endif value="draft">Taslak</option>
                        <option @if ($quiz->status === 'passive') selected @endif value="passive">Yayında değil</option>
                        <option @if ($quiz->questions_count < 4) disabled @endif
                            @if ($quiz->status === 'publish') selected @endif value="publish">Yayında</option>
                    </select>
                </div>
                <div class="mb-3">
                    <input type="checkbox" @if ($quiz->finished_at) checked @endif id="isFinished">
                    <label for="isFinished" class="form-label">Bitiş tarihi olacak mı ?</label>
                </div>
                <div id="finishedInput" @if (!$quiz->finished_at) style="display: none" @endif
                    class="mb-3">
                    <label for="finished_at" class="form-label">Bitiş Tarihi</label>
                    <input type="datetime-local" class="form-control"
                        @if ($quiz->finished_at) value="{{ date('Y-m-d\TH:i', strtotime($quiz->finished_at)) }}" @endif
                        id="finished_at" name="finished_at">
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-success">Quiz Güncelle</button>
                </div>
            </form>
        </div>
    </div>
    <x-slot name="js">
        <script>
            $('#isFinished').change(function() {
                if ($('#isFinished').is(':checked')) {
                    $('#finishedInput').show();
                } else {
                    $('#finishedInput').hide();
                }
            })
        </script>
    </x-slot>
</x-app-layout>
