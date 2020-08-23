<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    protected $userService;

    public function __construct(UserService $service)
    {
        $this->userService = $service;
    }

    public function index(Request $request)
    {
        $this->userService->addViewToEveryUser();

        return $this->userService->getUsersByWeeklyVisits($request);
    }


    public function view(User $user)
    {
        $user->addVisit();

        return new UserResource($user);
    }
}
