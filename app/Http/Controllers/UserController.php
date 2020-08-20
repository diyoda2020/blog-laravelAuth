<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\User;

/**
 * @group User Modul
 */
class UserController extends Controller
{

    public function index()
    {
        $user = User::all();
        return response()->json($user, 200);
    }

}
