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
        $userPosts = $user->posts;
        return view('profile.main', ['user' => $user, 'userPositions' => $userPositions, 'userPosts' => $userPosts]);
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
        $request->user()->positions()->detach();

        // 변경하려고 하는 포지션 값
        $positions = $request->positions;
        $request->user()->positions()->attach($positions);

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $updateUser = $request->user()->save();

        return Redirect::route('profile.show', ['user' => $request->user()])
            ->with($updateUser ? "success" : "fail", $updateUser ? "프로필이 수정되었습니다." : "프로필 수정에 실패하였습니다.");
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

        $user->positions()->detach();
        $deleteUser = $user->delete();
        if(!$deleteUser) return Redirect::to('/')->with('fail', '계정 삭제에 실패하였습니다.');

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('success', '회원 탈퇴가 완료되었습니다.');
    }
}
