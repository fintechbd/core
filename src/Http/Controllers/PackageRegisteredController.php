<?php

namespace Fintech\Core\Http\Controllers;

use Fintech\Core\Http\Resources\PackageCollection;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PackageRegisteredController extends Controller
{
    public function __invoke(Request $request): PackageCollection
    {
        $packages = collect(config('fintech.core.packages'))
            ->map(function ($package, $code) {
                return [
                    'name' => $package,
                    'code' => $code,
                    'enabled' => config("fintech.{$code}.enabled", false),
                ];
            })
            ->values();

        return new PackageCollection($packages);
    }
}
