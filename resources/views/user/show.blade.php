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
            margin-bottom: 10px;
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
            {{__('Список кубков, добавленных пользователем '.$user->name)}}
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
            @if ($cups=\App\Models\User::find($user->id)->cups != null)
                <table align="center">
                    <tr>
                        <th>
                            Год
                        </th>
                        <th colspan="2">
                            Место и страна проведения суперфинала
                        </th>
                        <th>
                            Победитель
                        </th>
                        <th>
                            Логотип победителя
                        </th>
                        <th>
                            Создатель записи
                        </th>
                    </tr>
                    @foreach($cups=\App\Models\User::find($user->id)->cups as $cup)
                        <tr>
                            <td align="center" valign="center">
                                <a href="/cups/{{ $cup->id }}">{{ $cup->getYearAttribute() }}</a>
                            </td>
                            <td align="center" valign="center">
                                {{ $cup->getPlaceAttribute() }}
                            </td>
                            <td align="center" valign="center">
                                {{ $cup->getCountryAttribute() }}
                            </td>
                            <td align="center" valign="center">
                                {{ $cup->getWinnerAttribute() }}
                            </td>
                            <td align="center" valign="center">
                                <img src="{{ asset($cup->getWinnerLogoAttribute()) }}" style="width: 120px; height: 115px">
                            </td>
                            <td align="center" valign="center">
                                {{ $cup->getOwnerNameAttribute() }}
                            </td>
                            @can('cup-change', [$cup])
                                <td class="icon">
                                    <form action="/cups/{{$cup->id}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button><i class="fa fa-times"></i></button>
                                    </form>
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                    @if (\Illuminate\Support\Facades\Auth::user()->is_admin)
                        @foreach(\App\Models\Cup::onlyTrashed()->get() as $cup)
                            @if ($user->id == $cup->user_id)
                                @include('cup.deleted_cups', [$cup])
                            @endif
                        @endforeach
                    @endif
                </table>
            @else
                <strong style="text-align: center">No cups in database</strong>
            @endif
        </div>
    </div>
</x-app-layout>

