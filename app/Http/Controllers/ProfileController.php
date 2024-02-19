<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Oculo;
use App\Models\Historial;

class ProfileController extends Controller
{   
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {   
        // Obtemos os oculos e o historial do utilizador
        $userID = Auth::user()->id;
        $oculos = Oculo::where('user_id', $userID)->get();
        $historial = Historial::where('user_id', $userID)->get();
        return view('profile.edit', [
            'user' => $request->user(),
            'oculos' => $oculos,
            'historial' => $historial]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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
