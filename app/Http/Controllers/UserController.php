<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth.custom');
    }

    public function show()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        return view('users.profile', ['user' => $user]);
    }

    public function edit()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        return view('users.edit', ['user' => $user]);
    }

    public function update(UpdateUserRequest $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $data = $request->validated();

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }
            $data['profile_photo'] = $request->file('profile_photo')->store('profile_photos', 'public');
        }

        $user->update($data);

        return redirect()->route('users.show')->with('success', 'Profile updated successfully.');
    }
}
