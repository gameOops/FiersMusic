<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ArtistService;



class ArtistController extends Controller
{
    private $artistService;

    public function __construct(ArtistService $artistService)
    {
        $this->artistService = $artistService;
    }
    public function getArtist(Request $request)
    {
       return $this->artistService->getArtist($request['name']);
    }
    public function selectTracks(Request $request)
    {
        return $this->artistService->selectTracks($request['name']);
    }
}
