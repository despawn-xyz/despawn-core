<?php

namespace Despawn\Http\Controllers\Profile;

use Despawn\Http\Controllers\Controller;
use Despawn\Http\Requests\Profile\ProfileInformationUpdateRequest;
use Inertia\Inertia;

class UserProfileController extends Controller
{
    public function show()
    {
        return Inertia::modal('Profile/Show')
            ->basePageRoute('home');
    }

    public function update(ProfileInformationUpdateRequest $request)
    {
        // TODO: if settings require email to be verified, unset the verified_at column
        $request->user()->update($request->safe(['name', 'email']));

        return back();
    }
}