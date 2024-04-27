<?php

namespace Fintech\Core\Http\Controllers;

use Fintech\Core\Http\Resources\PackageCollection;
use Fintech\Core\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PackageRegisteredController extends Controller
{
    use ApiResponseTrait;

    /**
     *
     * @param Request $request
     * @return PackageCollection
     */
    public function __invoke(Request $request): PackageCollection
    {
        $packages = collect(config('fintech.core.packages'))
            ->map(function ($package, $code) {
                return [
                    'name' => $package,
                    'code' => $code,
                    'enabled' => config("fintech.{$code}.enabled", false)
                ];
            })
            ->values();

        return new PackageCollection($packages);
    }
}
