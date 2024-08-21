<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\User\IndexResource;
use App\Models\User;

class ShowController extends Controller
{
    public function __invoke(User $user)
    {
        return new IndexResource($user);
    }
}
