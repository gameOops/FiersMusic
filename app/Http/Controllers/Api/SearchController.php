<?php


namespace App\Http\Controllers\Api;

use App\Services\SearchService;
use Illuminate\Http\Request;

class SearchController
{
    private $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function searchTrack(Request $request) {
        return $this->searchService->searchTrack($request['query']);
    }
    public function searchAlbum(Request $request) {
        return $this->searchService->searchAlbum($request['query']);
    }
}
