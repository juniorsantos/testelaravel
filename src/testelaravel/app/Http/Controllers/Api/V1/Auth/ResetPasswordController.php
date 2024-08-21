<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\DTOs\Api\V1\Auth\ResetPasswordDTO;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response as HttpStatusCode;

class ResetPasswordController extends Controller
{
    public function __invoke(Request $request)
    {
        $dto = ResetPasswordDTO::fromRequest($request);

        $status = Password::reset(
            $dto->toArray(),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            },
        );

        if ($status !== Password::PASSWORD_RESET) {
            return response()->json([
                'message' => __($status),
            ], HttpStatusCode::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json([
            'message' => __($status),
        ], HttpStatusCode::HTTP_OK);
    }
}
