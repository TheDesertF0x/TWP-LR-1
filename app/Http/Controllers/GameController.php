<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::all();
        return view('game.index', ['games'=>$games]);
    }
    public function store()
    {
        $data = request()->validate([
            //остановился тут на записи полей
        ]);
        $games = new Game();
        $games->date = request('date');
        $games->stadium = request('stadium');
        $games->level = request('level');
        $games->first_team = request('first_team');
        $games->second_team = request('second_team');
        $games->num_of_pucks_first = request('num_of_pucks_first');
        $games->num_of_pucks_second = request('num_of_pucks_second');
        $games->winner = request('winner');
        $games->save();
        return redirect('/games');
    }
    public function edit(Game $game)
    {
        return view('game.edit', ['game'=>$game]);
    }
    public function update(Game $game)
    {
        $data = request()->validate([
            'year'=>'integer',
            'place'=>'required|max:100',
            'country'=>'required|max:100'
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
