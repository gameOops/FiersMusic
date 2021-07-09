<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    protected $table = "playlists";

    public $timestamps = false;

    public function tracks()
    {
        return $this->hasMany(Track::class,'playlist_id','id');
    }
}
