<?php

namespace App\Http\Controllers\Profile;

use App\DTO\Profiles\UpdateProfileDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function edit(Request $request): View
    {
        return view('admin-panel.profile.edit', [
            'user' => $request->user(),
            'roles' => Role::all()
        ]);
    }

    public function updateInfo(ProfileUpdateRequest $request)
    {
        try {
            echo "<pre>";
            print_r($request);
            echo "</pre>";

            return response()->json([], 200);
            //$dto = new UpdateProfileDto(...$request);
        } catch (\Throwable $exception) {
            return response()->json(['message' => $exception->getMessage()], 500);
        }
    }

    public function updatePassword()
    {

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
