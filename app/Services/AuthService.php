<?php


namespace App\Services;


use App\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register($name,$email,$password,$birthday) {
        $passHash = Hash::make($password);

        $user = new User;

        $user->name = $name;
        $user->email = $email;
        $user->password = $passHash;
        $user->birthday = $birthday;
        $user->save();
        return response()->json([
            'status' => 'success'
        ]);

    }
    public function login($email,$password) {
        $user = User::where('email',$email)->first();

        if(!$user) {
            return response()->json([
                'status' => 'Пользователь не найден!',
            ],400);
        }
        $pass = $user->password;
        if(!Hash::check($password,$pass)) {
            return response()->json([
                'status' => 'Неверный пароль!',
            ],400);
        }
        $token = Hash::make(time());

        $user->token = $token;
        $user->save();
        return response()->json([
            'token' => $token
        ]);
    }
}
