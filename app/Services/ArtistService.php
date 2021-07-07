<?php

namespace App\Services;
use App\Playlist;
use App\Artist;
use App\Track;
use Illuminate\Http\Request;

class ArtistService
{
    public function getArtist($name) {
        return Artist::where('name',$name)->first();
    }
    public function selectTracks($name) {
        return Track::with('playlist')->where('author',$name)->take(5)->get();
    }
}
