<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GeneratePlaylist extends Command
{

    protected $signature = 'generate:playlist';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->alert('Start generate playlists!');
    }
}
