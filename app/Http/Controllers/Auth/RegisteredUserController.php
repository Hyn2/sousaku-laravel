<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\RegionController;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $regions = new RegionController();
        $positions = new PositionController();
        return view('auth.register', ['regions' => $regions(), 'positions' => $positions()]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'region_id' => ['required', 'numeric'],
            'gender' => ['required', 'string', 'size:1'],
            'positions'=> ['required', 'array'],
            'contact' => ['required', 'string'],
            'bio' => ['required', 'string'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'region_id' => $request->region_id,
            'gender' => $request->gender,
            'contact' => $request->contact,
            'bio' => $request->bio,
        ]);

        $positions = $request->positions;
        foreach ($positions as $position) {
            $user->positions()->attach($position);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
