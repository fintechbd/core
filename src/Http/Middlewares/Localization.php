<?php

namespace Fintech\Core\Http\Middlewares;

use Closure;
use Fintech\Core\Supports\Encryption;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     * @return JsonResponse|mixed
     */
    public function handle(Request $request, Closure $next)
    {
//        if ($request->hasHeader('Locale')) {
//            $locale = $request->header('Locale');
//
//        }
//
//        if (config('fintech.core.encrypt_response', false)) {
//
//            $headerSignature = $request->header('Locale');
//
//            if (!$headerSignature) {
//                abort(Response::HTTP_BAD_REQUEST, 'Request header signature is missing.');
//            }
//
//            $cipher = $request->input('payload', '');
//
//            $payload = Encryption::decrypt($cipher);
//
//            $payloadSignature = hash('sha256', json_encode($payload));
//
//            if ($payloadSignature != $headerSignature) {
//                abort(Response::HTTP_NOT_ACCEPTABLE, 'Request payload signature is invalid.');
//            }
//
//            $request->offsetUnset('payload');
//
//            $request->merge($payload);
//        }
//
//        $response = $next($request);
//
//        if (config('fintech.core.encrypt_response', false) && $response instanceof JsonResponse) {
//
//            $signature = hash('sha256', $response->content());
//
//            $response->header('Signature', $signature);
//
//            $response->setContent(json_encode([
//                'payload' => Encryption::encrypt($response->content())
//            ]));
//        }
//
//        return $response;

        return $next($request);
    }

}
