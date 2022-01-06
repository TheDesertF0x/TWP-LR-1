<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Cup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::all();
        return view('game.index', ['games'=>$games]);
    }
    public function news()
    {
        $games=Game::all();
        $users=User::all();
        return view('game.news', ['games'=>$games, 'users'=>$users]);
    }
    public function create()
    {
        $cups=Cup::all();
        return view('game.create', ['cups'=>$cups]);
    }
    public function store()
    {
        $data = request()->validate([
            'date'=>'required|date',
            'stadium'=>'required|max:100',
            'level'=>'required|max:100',
            'winner'=>'required|max:100'
        ]);
        $game = new Game();
        $game->date = request('date');
        $game->stadium = request('stadium');
        $game->level = request('level');
        $game->winner = request('winner');
        $game->user_id = Auth::id();
        $game->cup_id = request('cup_id');
        $game->save();
        return redirect('/games');
    }
    public function edit(Game $game)
    {
        return view('game.edit', ['game'=>$game]);
    }
    public function update(Game $game)
    {
        $data = request()->validate([
            'date'=>'integer',
            'stadium'=>'required|max:100',
            'level'=>'required|max:100',
            'winner'=>'required|max:100'
        ]);
        $game->update($data);
        return redirect('games/'.$game->id);
    }
    public function show(Game $game)
    {
        return view('game.show', ['game'=>$game]);
    }
    public function destroy(Game $game)
    {
        $game->delete();
        return redirect('/games');
    }
}
