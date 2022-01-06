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
            margin-bottom: 5px;
        }
        th, td {
            border: 1px solid black;
        }
        td.icon{
            border: none;
        }
    </style>
    <x-slot name="header">
        <x-h2>
            {{__('Континентальный кубок '.$cup->getYearAttribute().'г.')}}
        </x-h2>
    </x-slot>

    <div class="flex justify-center max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <div>
                <div style="display: inline-block; margin-left: 5px">
                    <form action="/cups" method="get">
                        <button><i class="fa fa-arrow-left"></i></button>
                    </form>
                </div>
                @can('cup-change', [$cup])
                    <div style="display: inline-block">
                        <form action="/cups/{{$cup->id}}/edit" method="get">
                            <button><i class="fas fa-pen"></i></button>
                        </form>
                    </div>
                    <div style="display: inline-block; float:right; margin-right:5px">
                        <form action="/cups/{{$cup->id}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button><i class="fa fa-times"></i></button>
                        </form>
                    </div>
                @endcan
            </div>
            <h2>Континентальный кубок {{$cup->getYearAttribute()}} г.</h2>
            <div style="text-align: center">
                <img src="{{ asset($cup->getWinnerLogoAttribute()) }}" style="width: 240px; height: 230px; display:inline">
                <p>Победитель: {{ $cup->getWinnerAttribute() }}</p>
            </div>
            <div style="text-align: center">
                Страна и место проведения суперфинала: {{$cup->getPlaceAttribute()}}, {{$cup->getCountryAttribute()}}
            </div>
            <div style="text-align: center">
                Создатель записи: {{$cup->getOwnerNameAttribute()}}
            </div>
            <details style="text-align: center">
                <summary>Матчи</summary>
                @if (count($games=\App\Models\Cup::find($cup->id)->games))
                    <table align="center">
                        <tr>
                            <th>
                                Дата
                            </th>
                            <th>
                                Стадион
                            </th>
                            <th>
                                Уровень
                            </th>
                            <th>
                                Победитель
                            </th>
                            <th>
                                Создатель записи
                            </th>
                            <th>
                                Опубликовано
                            </th>
                        </tr>
                        @foreach($games=\App\Models\Cup::find($cup->id)->games as $game)
                            <tr>
                                <td align="center" valign="center">
                                    {{ $game->getDateAttribute() }}
                                </td>
                                <td align="center" valign="center">
                                    {{ $game->getStadiumAttribute() }}
                                </td>
                                <td align="center" valign="center">
                                    {{ $game->getLevelAttribute() }}
                                </td>
                                <td align="center" valign="center">
                                    {{ $game->getWinnerAttribute() }}
                                </td>
                                <td align="center" valign="center">
                                    @if(auth()->user()->friends->contains($game->user_id))
                                        <span style="color: blue">{{ $game->getOwnerNameAttribute() }}</span>
                                    @else
                                        {{ $game->getOwnerNameAttribute() }}
                                    @endif
                                </td>
                                <td align="center" valign="center">
                                    {{ $game->updated_at }}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <strong style="text-align: center">No games in database</strong>
                @endif
            </details>
        </div>
    </div>
</x-app-layout>

