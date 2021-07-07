<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getInfo(Request $request) {
        return User::where('token',$request['token'])->first();
    }
    public function getInfoId(Request $request) {
        return User::where('id',$request['id'])->first();
    }
}
