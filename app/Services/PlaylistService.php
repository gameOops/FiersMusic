<?php

namespace App\Services;
use App\Playlist;
use App\Track;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PlaylistService
{
    public function test($id) {
        return Playlist::with('tracks')->where('id',$id)->get();
    }
    public function getPlaylists() {
        return Playlist::inRandomOrder()->take(5)->get();
    }
    public function allPlay() {
        return Playlist::with('tracks')->get();
    }
    public function selectAll($artist) {
        return Playlist::inRandomOrder()->take(5)->where('author',$artist)->get();
    }
    public function addNew($name,$author,$year,$image) {
        if(request()->hasFile('image')) {
            $file = request()->file('image');

            $name2 = $file->getClientOriginalName().'.'.$file->getClientOriginalExtension();

            $imageN['filePath'] = $name;
            $file->move(public_path().'/images/', $name2);

            $playlist = new Playlist;
            $playlist->name = $name;
            $playlist->author = $author;
            $playlist->year = $year;
            $playlist->image = '/images/'.$name2;

            $playlist->save();
        } else {
            return 'Ошибка. Фотография релиза не загружена';
        }
    }
    public function addNewTrack($name,$author,$id,$image) {
        if(request()->hasFile('track')) {
            $file = request()->file('track');

            $name2 = $file->getClientOriginalName().'.'.$file->getClientOriginalExtension();

            $imageN['filePath'] = $name;

            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 15; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }

            $file->move(public_path().'/audio/', $randomString.'.mp3');

            $playlist = new Track;
            $playlist->name = $name;
            $playlist->author = $author;
            $playlist->playlist_id = $id;
            $playlist->explict = '1';
            $playlist->src = $randomString.'.mp3';

            $playlist->save();
        } else {
            return 'Ошибка. Фотография релиза не загружена';
        }
    }
    public function makeImage($te) {
        $im = imagecreatefromjpeg(public_path().'/images/masks/default.jpg');
        $stamp = imagecreatefrompng(public_path().'/images/masks/'.random_int(1,3).'.png');
        $marge_right = 0;
        $marge_bottom = 0;
        $sx = imagesx($stamp);
        $sy = imagesy($stamp);
        imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
        $name = time();
        Imagejpeg($im,"images/".$name.".jpg"); //сохраняем рисунок в формате JPEG



        $img = Image::make(public_path("images/".$name.".jpg"));
        $img->text($te, 110, 280, function($font) {
            $font->file(public_path('fonts/arial.ttf'));
            $font->size(28);
            $font->color('#000000');
            $font->align('center');
            $font->valign('bottom');
            $font->angle(0);
        });
        $img->save(public_path('images/'.$name.'_edited.jpg'));
        unlink("images/".$name.".jpg");


    }
}
