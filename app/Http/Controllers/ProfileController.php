<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Traits\UploadFile;

class ProfileController extends Controller
{
    use UploadFile;
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('backend.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request)//: RedirectResponse
    {
        $request->validated(); 
        $input = $request->all(); 
        // $request->user()->fill($request->validated());

        if ($request->hasfile('profile')) {
            $image = $this->uploadImage($request->file('profile'), 'uploads/images/profile', 'users', 
                ['id' => $request->user()->id ], 'profile');
            
            $input['profile'] = $image;
        }
        $request->user()->fill($input);

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $request->user()->save();

        return response()->json([ 'success' => true,'message' => 'Profile updated succeessfully !','url'=>route('admin.profile.edit')],200);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)//: RedirectResponse
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
