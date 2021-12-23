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
            {{__('Список пользователей')}}
        </x-h2>
    </x-slot>

    <div class="flex justify-center max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <div style="text-align: left; margin-left: 2.5px">
                <form action="/cups" method="get">
                    <button><i class="fa fa-arrow-left"></i></button>
                </form>
            </div>
            @forelse($users as $user)
                <div class="mt-2 mb-1 text-sm text-black-500" style="text-underline: #1a202c; text-align: center">
                    <a href={{ route('users.show', ['user'=>$user->name]) }}>
                        {{ $user->name }}
                    </a>
                </div>
            @empty
                <strong>No users in database<</strong>
            @endforelse
        </div>
    </div>
</x-app-layout>
