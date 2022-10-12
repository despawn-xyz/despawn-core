<?php

namespace Despawn\Http\Controllers\Profile;

use Despawn\Http\Controllers\Controller;
use Despawn\Http\Requests\Profile\ProfileMediaUpdateRequest;
use Illuminate\Http\Request;

class UserAvatarController extends Controller
{
    public function store(ProfileMediaUpdateRequest $request)
    {
        $avatar = $request->file('avatar');

        if ($avatar) {
            $request->user()->addMedia($avatar)
                ->toMediaCollection('avatar');
        }

        return back();
    }

    public function destroy(Request $request)
    {
        $request->user()->getFirstMedia('avatar')->delete();

        return back(303)->with('status', 'profile-photo-deleted');
    }
}