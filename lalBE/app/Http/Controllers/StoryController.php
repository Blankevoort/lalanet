<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoryController extends Controller
{
    use HttpResponses;

    public function index()
    {
        return Story::all();
    }

    public function store(Request $request)
    {
        $story = Story::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'story' => $request->story,
        ]);

        return $story;
    }

    public function update(Request $request, Story $story)
    {
        if (Auth::user()->id !== $story->user_id) {
            return $this->error('', 'You are not authorized to make this request', 403);
        }

        $story->update($request->all());

        return $story;
    }

    public function destroy(Story $story)
    {
        return $this->isNotAuthorized($story) ? $this->isNotAuthorized($story) : $story->delete();
    }

    public function userStories()
    {
        return Story::where('user_id', Auth::user()->id)->get();
    }

    private function isNotAuthorized($story)
    {
        if (Auth::user()->id !== $story->user_id) {
            return $this->error('', 'You are not authorized to make this request', 403);
        }
    }
}
