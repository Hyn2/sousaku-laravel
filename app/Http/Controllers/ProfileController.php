<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show(User $user): View
    {
        $userPositions = $user->positions;
        return view('profile.main', ['user'=>$user, 'userPositions'=>$userPositions]);
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $regions = new RegionController();
        $positions = new PositionController();
        return view('profile.edit', [
            'user' => $request->user(),
            'userPosition' => $request->user()->positions,
            'regions' => $regions(),
            'positions' => $positions(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        // 이전 포지션 값
        $oldPositions = $request->user()->positions;
        foreach ($oldPositions as $oldPosition) {
            $request->user()->positions()->detach($oldPosition->id);
        }

        // 변경하려고 하는 포지션 값
        $positions = $request->positions;
        foreach($positions as $position) {
            $request->user()->positions()->attach($position);
        }

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.show', ['user' => $request->user()]);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
