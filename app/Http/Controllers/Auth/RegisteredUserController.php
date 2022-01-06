<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cup;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function show(User $user)
    {
        $cups= Cup::where('user_id', '=', $user->id)->get();
        $not_friends = User::where('id', '!=', $user->id);
        $not_friends = $not_friends->whereNotIn('id', $user->friends->modelKeys());
        $not_friends = $not_friends->get();
        $friends = $user->friends;
        $objects = new Collection();
        if ($user->friends->count() > 0) {
            foreach ($user->friends as $f) {
                $objects = $objects->concat(Cup::whereIn('id', $f->$cups->modelKeys())->get());
            }
        }
        return view('user.show', compact('user', 'cups', 'friends', 'not_friends', 'objects'));
    }

    public function getAddFriend(User $user)
    {
        auth()->user()->addFriend($user);
        $user->addFriend(auth()->user());
        return Redirect::back();
    }

    public function getRemoveFriend(User $user)
    {
        auth()->user()->removeFriend($user);
        $user->removeFriend(auth()->user());
        return Redirect::back();
    }
}
