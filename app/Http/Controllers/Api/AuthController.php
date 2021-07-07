<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;

class AuthController extends Controller
{
    /**
     * @var AuthService
     */
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(Request $request) {
        $customMessages = [
            'required' => 'Поле :attribute является обязательным!',
            'unique' => 'В базе данных уже есть запись с такими данными!',
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'birthday' => 'required',
        ],$customMessages);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        return $this->authService->register($request['name'],$request['email'],$request['password'],$request['birthday']);
    }
    public function login(Request $request) {
        $customMessages = [
            'required' => 'Поле :attribute является обязательным!',
        ];
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ],$customMessages);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }
        return $this->authService->login($request['email'],$request['password']);

    }
}
