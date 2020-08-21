<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index()
    {
        User::addAViewToEveryone();

        return UserResource::collection(User::getByWeeklyVisits());
    }


    public function view(User $user)
    {
        $user->addVisit();

        return new UserResource($user);
    }
}
