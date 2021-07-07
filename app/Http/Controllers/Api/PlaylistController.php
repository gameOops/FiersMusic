<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PlaylistService;

class PlaylistController extends Controller
{
    private $playlistService;

    public function __construct(PlaylistService $playlistService)
    {
        $this->playlistService = $playlistService;
    }
    public function getPlaylist(Request $request) {
        return $this->playlistService->test($request['id']);
    }
    public function getPlaylists(Request $request) {
        return $this->playlistService->getPlaylists();
    }
    public function allPlay() {
        return $this->playlistService->allPlay();
    }
    public function selectAll(Request $request) {
        return $this->playlistService->selectAll($request['artist']);
    }
    public function addNew(Request $request) {
        return $this->playlistService->addNew($request['name'],$request['author'],$request['year'],$request['image']);
    }
    public function addNewTrack(Request $request) {
        return $this->playlistService->addNewTrack($request['name'],$request['author'],$request['id'],$request['image']);
    }
    public function makeImage(Request $request) {
        return $this->playlistService->makeImage($request['text']);
    }
}
