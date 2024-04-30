<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\Users;

class RegisterController extends Controller
{
    public function RegisterUser(RegisterRequest $reg)
    {
        $user = new Users();
        $user->user_name = $reg->input('name');
        $user->user_surname = $reg->input('surname');
        $user->user_email = $reg->input('e-mail');
        $user->user_phone_number = $reg->input('phone');
        $user->user_password = $reg->input('password');
        $user->user_role = $reg->input('role');

        $user -> save();
        return redirect()->route('login')->with('success','Пользователь зарегистрирован');
    }

}
