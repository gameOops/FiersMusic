<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $table = "tracks";

    public $timestamps = false;

    public function playlist()
    {
        return $this->hasOne('App\Playlist','id','playlist_id');
    }
}
