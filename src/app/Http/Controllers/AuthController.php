<?php


namespace App\Http\Controllers;


use Authorization\Application\Service\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function postLogin(Request $request){
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return view("login");
        }

        return redirect()->intended('/');
    }

    public function postRegister(Request $request, UserService $service)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return view("register");
        }

        $email = $request->get("email");
        $password = $request->get("password");
        $service->create($email, $password);

        return redirect()->intended("/");
    }

    public function postLogout() {
        Auth::logout();

        return redirect("/");
    }

    private function validator(array $data) {
        return Validator::make($data, [
            "name" => ["required", "string", "max:255"],
            "email" => ["required", "string", "email", "max:255"],
            // "password" => ["required", "string", "min:8", "confirmed"],
            "password" => ["required", "string", "min:8"],
        ]);
    }
}
