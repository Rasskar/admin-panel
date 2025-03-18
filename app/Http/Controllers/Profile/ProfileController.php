<?php

namespace App\Http\Controllers\Profile;

use App\DTO\Profiles\UpdateProfileDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Mail\PasswordChangedMail;
use App\Models\Role;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Throwable;

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

    /**
     * @param ProfileUpdateRequest $request
     * @return JsonResponse
     */
    public function updateInfo(ProfileUpdateRequest $request): JsonResponse
    {
        try {
            $dto = new UpdateProfileDto(...$request->only('name', 'email', 'roleId', 'firstName', 'lastName'));

            $request->user()->update($dto->toArray());

            return response()->json(['status' => 'ok', 'message' => 'Profile updated successfully.']);
        } catch (Throwable $exception) {
            return response()->json(['message' => $exception->getMessage()], 500);
        }
    }

    /**
     * @param UpdatePasswordRequest $request
     * @return JsonResponse
     */
    public function updatePassword(UpdatePasswordRequest $request): JsonResponse
    {
        try {
            $user = $request->user();

            if (!$user->update(['password' => Hash::make($request->input('newPassword'))])) {
                throw new Exception("Password update error.");
            }

            Mail::to($user->email)->send(new PasswordChangedMail($user->name, $request->input('newPassword')));

            return response()->json(['status' => 'ok', 'message' => 'Password updated successfully.']);
        } catch (Throwable $exception) {
            return response()->json(['message' => $exception->getMessage()], 500);
        }
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
