<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Lang;

class VerificationEmailController extends Controller
{
    public function __invoke($id, Request $request)
    {

        $user = User::findOrFail($id);

        if ($user->hasVerifiedEmail()) {
            return response()->json(["msg" => Lang::get("Email already verified.")], Response::HTTP_OK);
        }

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        return response()->json(["message" => Lang::get("Email verified.")], Response::HTTP_OK);
    }
}
