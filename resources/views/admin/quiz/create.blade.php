<x-app-layout title='Quiz Oluştur'>
    <x-slot name="header">
        {{ __('Quiz Oluştur') }}
    </x-slot>
    
    <div class="card">
        <div class="card-body">
            <form action="{{ route('quizzes.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Quiz Başlık</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Quiz Açıklama</label>
                    <textarea class="form-control" style="resize:none" name="description" id="description" rows="5">{{old('description')}}</textarea>
                </div>
                <div class="mb-3">
                    <input type="checkbox" @if (old('finished_at')) checked @endif id="isFinished">
                    <label for="isFinished" class="form-label">Bitiş tarihi olacak mı ?</label>

                </div>
                <div id="finishedInput" @if (!old('finished_at')) style="display: none" @endif class="mb-3">
                    <label for="finished_at" class="form-label">Bitiş Tarihi</label>
                    <input type="datetime-local" class="form-control" value="{{old('finished_at')}}" id="finished_at" name="finished_at">
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-success">Quiz Oluştur</button>
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
