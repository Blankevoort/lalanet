<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lalaey;

class ShowLalaeys extends Controller
{
    public function index()
    {
        $lalaeys = Lalaey::all();

        return view('../Admin/LalaeyControlPanel/LalaeysShow', [
            'lalaeys' => $lalaeys
        ]);
    }

    public function create()
    {
        return view('../Admin/LalaeyControlPanel.LalaeyUplaod');
    }

    public function show($id)
    {
        $lalaey = Lalaey::find($id);

        return view('../Admin/LalaeyControlPanel.LalaeyInfos')->with('lalaey', $lalaey);
    }

    public function store(Request $request)
    {
        $request->validate([
            'Name' => 'required',
            'Lang' => 'required',
            'Type' => 'required',
            'Description' => 'max:500',
            'Audio' => 'mimes:mp3|max:15000',
        ]);

        $NewAudioeName = time() . '-' . $request->Name . '.' . $request->Audio->extension();

        $request->Audio->move(storage_path('app/public/Lalaeys'), $NewAudioeName);

        $lalaey = Lalaey::create([
            'Name' => $request->input('Name'),
            'Lang' => $request->input('Lang'),
            'Type' => $request->input('Type'),
            'Description' => $request->input('Description'),
            'Audio_Path' => $NewAudioeName,
        ]);

        return redirect('/lalaey');
    }

    public function edit($id)
    {
        $lalaey = Lalaey::find($id);

        return view('Admin/LalaeyControlPanel.LalaeyEdit')->with('lalaey', $lalaey);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'Name' => 'required',
            'Lang' => 'required',
            'Type' => 'required',
            'Description' => 'max:5000',
        ]);

        $NewAudioeName = time() . '-' . $request->Name . '.' . $request->Audio->extension();

        $request->Audio->move(storage_path('app/public/Lalaeys'), $NewAudioeName);

        $lalaey = Lalaey::where('id', $id)->update([
            'Name' => $request->input('Name'),
            'Lang' => $request->input('Lang'),
            'Type' => $request->input('Type'),
            'Description' => $request->input('Description'),
            'Audio_Path' => $NewAudioeName,
        ]);

        return redirect('/lalaey');
    }

    public function destroy(Lalaey $lalaey)
    {
        $lalaey->delete();

        return redirect('/lalaey');
    }
}

