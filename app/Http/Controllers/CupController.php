<?php

namespace App\Http\Controllers;

use App\Models\Cup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class CupController extends Controller
{
    public function index()
    {
        $cups=Cup::all();
        return view('cup.index', ['cups'=>$cups]);
    }
    public function create()
    {
        return view('cup.create');
    }
    public function store()
    {
        $data = request()->validate([
            'year'=>'integer',
            'place'=>'required|max:100',
            'country'=>'required|max:100',
            'winner'=>'max:100',
            'logo'=>'max:150'
        ]);
        $cup = new Cup();
        $cup->year = request('year');
        $cup->place = request('place');
        $cup->country = request('country');
        $cup->winner = request('winner');
        $cup->logo = request('logo');
        $cup->user_id = Auth::id();
        $cup->save();
        return redirect('/cups');
    }
    public function edit(Cup $cup)
    {
        if (!Gate::allows('cup-change', $cup)){
            return response('Недостаточно прав для редактирования этого объекта!', 403);
        }
        else return view('cup.edit', ['cup'=>$cup]);
    }
    public function update(Cup $cup)
    {
        if (!Gate::allows('cup-change', $cup)){
            return response('Недостаточно прав для обновления этого объекта!', 403);
        }
        else {
            $data = request()->validate([
                'year'=>'integer',
                'place'=>'required|max:100',
                'country'=>'required|max:100',
                'winner'=>'max:100',
                'logo'=>'max:150'
            ]);
            $cup->update($data);
            return redirect('cups/'.$cup->id);
        }
    }
    public function show(Cup $cup)
    {
        return view('cup.show', ['cup'=>$cup]);
    }
    public function destroy(Cup $cup)
    {
        if (!Gate::allows('cup-change', $cup)){
            return response('Недостаточно прав для удаления этого объекта!', 403);
        }
        else
        {
            $cup->delete();
            return redirect('/cups');
        }
    }
    public function restore(int $cup_num)
    {
        $cup = Cup::withTrashed()->find($cup_num)->restore();
        return redirect('/cups');
    }

    public function force_delete(int $cup_num)
    {
        $cup = Cup::withTrashed()->find($cup_num)->forceDelete();
        return redirect('/cups');
    }
}
