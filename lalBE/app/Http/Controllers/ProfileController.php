<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    use HttpResponses;

    public function index()
    {
        return Profile::where('user_id', Auth::user()->id)->get();
    }

    public function store(Request $request)
    {
        $profile = Profile::create([
            'user_id' => Auth::user()->id,
            'userName' => $request->userName,
        ]);

        return $profile;
    }

    public function update(Request $request, Profile $profile)
    {
        if (Auth::user()->id !== $profile->user_id) {
            return $this->error('', 'You are not authorized to make this request', 403);
        }

        $profile->update($request->all());

        return $profile;
    }

    private function isNotAuthorized($profile)
    {
        if (Auth::user()->id !== $profile->user_id) {
            return $this->error('', 'You are not authorized to make this request', 403);
        }
    }
}
