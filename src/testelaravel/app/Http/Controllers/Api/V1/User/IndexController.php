<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\User\IndexResource;
use App\Models\User;

class IndexController extends Controller
{
    public function __invoke()
    {
        $users = User::paginate(50);
        return IndexResource::collection($users);
    }
}
