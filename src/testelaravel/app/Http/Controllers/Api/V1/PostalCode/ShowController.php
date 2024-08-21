<?php

namespace App\Http\Controllers\Api\V1\PostalCode;

use App\Http\Controllers\Controller;
use App\Service\PostalCode\PostalCodeService;
use Exception;
use Illuminate\Support\Facades\Lang;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class ShowController extends Controller
{
    public function __construct(
        private PostalCodeService $postalCodeService,
    ) {
    }

    public function __invoke(string $postalCode)
    {
        try {
            $data = $this->postalCodeService->requestPostalCode($postalCode);
        } catch (UnprocessableEntityHttpException $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 422);
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 400);
        }
        return response()->json([
            'data' => $data,
            'message' => 'CEP Encontrado',
        ], 200);
    }
}
