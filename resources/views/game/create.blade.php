<x-app-layout>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        h1 {
            text-align: center;
        }
        h2 {
            text-align: center;
        }
        table {
            border: 2px solid black;
            width: 100%;
        }
        label{
            margin-left: 5px;
            margin-right: 5px;
        }
        input{
            margin-left: 5px;
            margin-right: 5px;
        }
        button{
            margin-bottom: 2px;
        }
    </style>
    <x-slot name="header">
        <x-h2>
            {{__('Добавление матча')}}
        </x-h2>
    </x-slot>

    <div class="flex justify-center max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <div>
                <div style="display: inline-block; margin-left: 5px">
                    <form action="/games" method="get">
                        <button><i class="fa fa-arrow-left" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
            <form action="/games" enctype="multipart/form-data" method="post">
                @csrf
                <div class="form-group row text-center">
                    <x-label for="game-date" class="col-4 col-form-label">Дата проведения:</x-label>
                    <x-input id="game-date"
                             type="integer"
                             class="form-control col-8 {{ $errors->has('date') ? ' is-invalid' : '' }}"
                             name="date"
                             value=""
                             autofocus></x-input>

                    @if ($errors->has('date'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('date')}}</strong>
                                </span>
                    @endif
                </div>

                <div class="form-group row text-center">
                    <x-label for="game-stadium" class="col-4 col-form-label">Стадион:</x-label>
                    <x-input id="game-stadium"
                             type="text"
                             class="form-control col-8 {{ $errors->has('stadium') ? ' is-invalid' : '' }}"
                             name="stadium"
                             value=""></x-input>

                    @if ($errors->has('stadium'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('stadium')}}</strong>
                                </span>
                    @endif
                </div>

                <div class="form-group row text-center">
                    <x-label for="game-level" class="col-4 col-form-label">Уровень матча:</x-label>
                    <x-input id="game-level"
                             type="text"
                             class="form-control col-8 {{ $errors->has('level') ? ' is-invalid' : '' }}"
                             name="level"
                             value=""></x-input>

                    @if ($errors->has('level'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('level')}}</strong>
                                </span>
                    @endif
                </div>

                <div class="form-group row text-center">
                    <x-label for="game-winner" class="col-4 col-form-label">Победитель матча:</x-label>
                    <x-input id="game-winner"
                             type="text"
                             class="form-control col-8 {{ $errors->has('winner') ? ' is-invalid' : '' }}"
                             name="winner"
                             value=""></x-input>

                    @if ($errors->has('winner'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('winner')}}</strong>
                                </span>
                    @endif
                </div>

                <div class="form-group row text-center">
                    <x-label for="game-cup_id">Кубок:</x-label>
                    <select name="cup_id" style="text-align: center">
                        @foreach($cups as $cup)
                            <option value={{$cup->id}}>{{$cup->year.'г. '.$cup->country}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-2 text-sm text-gray-500" style="text-align: center">
                    <x-button type="submit" class="btn btn-primary">Добавить</x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>


