<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\DTOs\Api\V1\Auth\LoginDTO;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Auth\LoginResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use WendellAdriel\ValidatedDTO\Exceptions\CastTargetException;
use WendellAdriel\ValidatedDTO\Exceptions\MissingCastTypeException;

class LoginController extends Controller
{
    /**
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    public function __invoke(Request $request): JsonResponse
    {
        $dto = LoginDTO::fromRequest($request);

        if (!Auth::attempt($dto->toArray())) {
            return $this->error('Invalid credentials', 401);
        }

        $user = User::firstWhere('email', $dto->email);

        $request->session()->regenerate();

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
