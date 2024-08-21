<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\DTOs\Api\V1\Auth\RegisterDTO;
use App\Enums\Api\V1\Auth\RolesEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Auth\LoginResource;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use WendellAdriel\ValidatedDTO\Exceptions\CastTargetException;
use WendellAdriel\ValidatedDTO\Exceptions\MissingCastTypeException;

class RegisterController extends Controller
{
    /**
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    public function __invoke(Request $request)
    {
        $dto = RegisterDTO::fromRequest($request);

        $user = User::create($dto->toArray());
        $user->address()->create($dto->toArray());

        event(new Registered($user));

        $credentials = [
            'email' => $dto->email,
            'password' => $dto->password,
        ];
        Auth::attempt($credentials);

        return response()->json([
            'data' => new LoginResource($user),
            'message' => 'Authenticated',
            'token' => $user->createToken(
                'Api token for'.$user->email,
                ['*'],
                now()->addMonth(),
            )->plainTextToken,
        ], 200);
    }
}
