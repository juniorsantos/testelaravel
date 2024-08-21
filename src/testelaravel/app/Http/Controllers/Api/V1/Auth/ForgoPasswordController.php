<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\DTOs\Api\V1\Auth\ForgoPasswordDTO;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgoPasswordController extends Controller
{
    public function __invoke(Request $request)
    {
        $dto = ForgoPasswordDto::fromRequest($request);

        $status = Password::sendResetLink($dto->toArray());

        return $status === Password::RESET_LINK_SENT;
    }
}
