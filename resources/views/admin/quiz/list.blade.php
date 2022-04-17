<x-app-layout title='Quizler'>
    <x-slot name="header">
        {{ __('Quizler') }}
    </x-slot>

    <div class="card">
        <div class="card-body">
            <a href="{{route('quizzes.create')}}" class="btn btn-primary my-3"> <i class="fa fa-plus"></i> Quiz Oluştur</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Quiz</th>
                        <th scope="col">Durum</th>
                        <th scope="col">Bitiş Tarihi</th>
                        <th scope="col">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quizzes as $quiz)
                        <tr>
                            <th scope="row">{{$quiz->title}}</th>
                            <td>{{$quiz->status}}</td>
                            <td>{{$quiz->finished_at}}</td>
                            <td class="justify-content-between">
                                <a href="btn  btn-primary"><i class="fa fa-pen"></i></a>
                                <a href="btn  btn-danger"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$quizzes->links()}}
        </div>
    </div>
</x-app-layout>
