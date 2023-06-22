<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View {
    $user = $request->user();

    return view('profile.edit', compact('user'));
    }


    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse {
    $user = $request->user();

    $user->first_name = $request->first_name;
    $user->middle_name = $request->middle_name;
    $user->last_name = $request->last_name;

    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }
    //password update too but Check if the password field exists in the request
    if ($request->has('password')) {
        $user->password = Hash::make($request->input('password'));
    }

    $user->save();

    return Redirect::route('profile.edit')->with('status', 'Profile information updated successfully.');
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
