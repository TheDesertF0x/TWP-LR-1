

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
            margin: 5px;
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
            {{__('Обновления друзей')}}
        </x-h2>
    </x-slot>

    <div class="flex justify-center max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <div style="display: flex">
                <div style="float: left; margin-left: 5px">
                    <form action="/cups" method="get">
                        <button ><i class="fas fa-trophy"></i></button>
                    </form>
                </div>
                <div style="float: left; margin-left: 5px">
                    <form action="/games" method="get">
                        <button ><i class="fas fa-hockey-puck"></i></button>
                    </form>
                </div>
                <div style="float: left; margin-left: 5px">
                    <form action="/users" method="get">
                        <button ><i class="fa fa-users"></i></button>
                    </form>
                </div>
            </div>
            @if(count(\App\Models\Game::all()->sortByDesc('updated_at')) > 0 AND count(auth()->user()->friends) > 0)
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
                    @foreach($games=(\App\Models\Game::all()->sortByDesc('updated_at')) as $game)
                        @if(auth()->user()->friends->contains($game->user_id))
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
                        @endif
                    @endforeach
                </table>
            @else
                <strong style="text-align: center">You have no friends</strong>
            @endif
        </div>
    </div>
</x-app-layout>

