<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Track;
use Inertia\Inertia;

class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tracks = Track::where('display', true)->with("playlists")->orderBy('artist')->get();

        foreach ($tracks as $track) {
            
        }

        return Inertia::render('Track/index', [
            'tracks' => $tracks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Track/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'artist' => ['required', 'string', 'min:3', 'max:255'],
            'image' => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:10240'],
            'music' => ['required', 'file', 'mimes:wav,mp3', 'max:10240'],
            'display' => ['required'],
        ]);

        $uuid = 'trk-' . Str::uuid();

        $imageExtension = $request->image->extension();
        $imagePath = $request->image->storeAs('tracks/images', $uuid . '.' . $imageExtension, );

        $musicExtension = $request->music->extension();
        $musicPath = $request->music->storeAs('tracks/musics', $uuid . '.' . $musicExtension, );

        Track::create([
            'uuid' => $uuid,
            'title' => $request->title,
            'artist' => $request->artist,
            'display' => $request->display === 'true' ? 1 : 0,
            'image' => $imagePath,
            'music' => $musicPath,
        ]);

        return redirect()->route('tracks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        dd('show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Track $track)
    {
        return Inertia::render('Track/edit',[
            'track' => $track,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Track $track)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'artist' => ['required', 'string', 'min:3', 'max:255'],
            'display' => ['required'],
        ]);
        
        $track->title = $request->title;
        $track->artist = $request->artist;
        $track->display = $request->display === 'true' ? 1 : 0;
        $track->save();

        return redirect()->route('tracks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Track $track)
    {
        $track->delete();
    }
}
