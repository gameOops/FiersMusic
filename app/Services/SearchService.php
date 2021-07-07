<?php


namespace App\Services;
use App\Track;
use App\Artist;
use App\Playlist;


class SearchService
{
    public function searchTrack($name) {
        return Track::with('playlist')->where('name', 'LIKE', "%$name%")->get();
    }
    public function searchAlbum($name) {
        return Playlist::where('name', 'LIKE', "%$name%")->get();
    }

}
