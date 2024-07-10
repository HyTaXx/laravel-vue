<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Track;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PlaylistController extends Controller
{
    public function index()
    {

        $user = auth()->user();
        $playlists = $user->playlists()->withCount('tracks')->get();

        return Inertia ::render('Playlist/index', [
            'playlists' => $playlists,
        ]);
    }

    public function create()
    {
        $tracks = Track::where('display', true)->orderBy('artist')->get();

        return Inertia::render('Playlist/create', [
            'tracks' => $tracks,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'tracks' => ['required', 'array'],
            'tracks.*' => ['required', 'string', 'exists:tracks,uuid'],
        ]);

        $tracks = Track::whereIn('uuid', $request->tracks)->where('display', true)->get();
        if( $tracks->count() !== count($request->tracks) ) {
            throw ValidationException::withMessages([
                'tracks' => 'Une musique n existe pas.',
            ]);
        }

        $playlist = Playlist::create([
            'uuid' => 'ply-' . Str::uuid(),
            'user_id' => $request->user()->id,
            'title' => $request->title,
        ]);

        $playlist->tracks()->attach($tracks->pluck('id'));

        return redirect()->route('playlists.index');
        
    }

    public function edit($id)
    {

    }

    public function show(Playlist $playlist)
    {

        $playlist->load('tracks');

        return Inertia::render('Playlist/show', [
            'playlist' => $playlist,
            'tracks' => $playlist->tracks,
        ]);
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        
    }
}
