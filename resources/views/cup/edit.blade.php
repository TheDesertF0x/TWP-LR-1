
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
            margin-bottom: 3px;
        }
    </style>
    <x-slot name="header">
        <x-h2>
            {{__('Редактирование кубка ').$cup->getYearAttribute().'г.'}}
        </x-h2>
    </x-slot>

    <div class="flex justify-center max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <div>
                <div style="display: inline-block; margin-left: 5px">
                    <form action="/cups" method="get">
                        <button><i class="fa fa-arrow-left" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
            <form action="/cups/{{$cup->id}}" enctype="multipart/form-data" method="post">
                @csrf
                @method('PATCH')
                <div class="form-group row">
                    <x-label for="cup-year" class="col-4 col-form-label">Год проведения:</x-label>
                    <x-input id="cup-year"
                           type="integer"
                           class="form-control col-8 {{ $errors->has('year') ? ' is-invalid' : '' }}"
                           name="year"
                           value="{{old('year') ?? $cup->year}}"
                             autofocus></x-input>

                    @if ($errors->has('year'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('year')}}</strong>
                                </span>
                    @endif
                </div>

                <div class="form-group row">
                    <x-label for="cup-place" class="col-4 col-form-label">Место проведения суперфинала:</x-label>
                    <x-input id="cup-place"
                           type="text"
                           class="form-control col-8 {{ $errors->has('place') ? ' is-invalid' : '' }}"
                           name="place"
                           value="{{old('place') ?? $cup->place}}"></x-input>

                    @if ($errors->has('place'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('place')}}</strong>
                                </span>
                    @endif
                </div>

                <div class="form-group row">
                    <x-label for="cup-country" class="col-4 col-form-label">Страна проведения суперфинала:</x-label>
                    <x-input id="cup-country"
                           type="text"
                           class="form-control col-8 {{ $errors->has('country') ? ' is-invalid' : '' }}"
                           name="country"
                           value="{{old('country') ?? $cup->country}}"></x-input>

                    @if ($errors->has('cup-country'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('cup-country')}}</strong>
                                </span>
                    @endif
                </div>

                <div class="form-group row">
                    <x-label for="cup-winner" class="col-4 col-form-label">Победитель турнира:</x-label>
                    <x-input id="cup-winner"
                           type="text"
                           class="form-control col-8 {{ $errors->has('winner') ? ' is-invalid' : '' }}"
                           name="winner"
                           value="{{old('winner') ?? $cup->winner}}"></x-input>

                    @if ($errors->has('cup-winner'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('cup-winner')}}</strong>
                                </span>
                    @endif
                </div>

                <div class="form-group row">
                    <x-label for="cup-logo" class="col-4 col-form-label">Логотип победителя:</x-label>
                    <x-input id="cup-logo"
                           type="text"
                           class="form-control col-8 {{ $errors->has('logo') ? ' is-invalid' : '' }}"
                           name="logo"
                           value="{{old('logo') ?? $cup->logo}}"></x-input>

                    @if ($errors->has('cup-logo'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{$errors->first('cup-logo')}}</strong>
                                </span>
                    @endif
                </div>

                <div class="mt-2 text-sm text-gray-500" style="text-align: center">
                    <x-button type="submit" class="btn btn-primary">Сохранить</x-button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>

