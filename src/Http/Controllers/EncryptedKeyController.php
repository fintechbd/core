<?php

namespace Fintech\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use Fintech\Core\Supports\Encryption;
use Fintech\Core\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EncryptedKeyController extends Controller
{
    use ApiResponseTrait;
    public function __invoke(Request $request): JsonResponse
    {
        return $this->success([
            'data' => [
                'status' => config('fintech.core.encrypt_response'),
                'token' => base64_encode(
                    bin2hex(
                        Encryption::key()
                    )
                )
            ]
        ]);
    }
}
