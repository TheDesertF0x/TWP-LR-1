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
            {{__('Список кубков')}}
        </x-h2>
    </x-slot>

    <div class="flex justify-center max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <div style="display: flex">
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
                <div style="float: left; margin-left: 5px">
                    <form action="/news" method="get">
                        <button ><i class="fas fa-newspaper"></i></button>
                    </form>
                </div>
            </div>
            @if (count($cups) > 0 OR (count(\App\Models\Cup::onlyTrashed()->get()) > 0 AND \Illuminate\Support\Facades\Auth::user()->is_admin))
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
                        <td class="icon">
                            <form action="/cups/create" method="get">
                                <button ><i class="fa fa-plus"></i></button>
                            </form>
                        </td>
                    </tr>
                    @foreach($cups as $cup)
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
                                <a href={{ route('users.show', ['user'=>$cup->getOwnerNameAttribute()]) }}>
                                    {{ $cup->getOwnerNameAttribute() }}
                                </a>
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
                            @include('cup.deleted_cups', [$cup])
                        @endforeach
                    @endif
                </table>
            @else
                <strong style="text-align: center">No cups in database</strong>
                <div style="text-align: center">
                    <form action="/cups/create" method="get">
                        <button ><i class="fa fa-plus"></i></button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
