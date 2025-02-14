<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\User\UserCollection;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAwaitingSurveys() {
        $users_awaiting_surveys = new UserCollection(User::where('role', 'user')->whereDoesntHave('answers')->get());

        return response()->json(['data' => $users_awaiting_surveys], 200);
    }
}
