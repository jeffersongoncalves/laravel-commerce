<?php

namespace JeffersonGoncalves\Commerce\Storefront\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use JeffersonGoncalves\Commerce\ApiKey\Enums\ApiKeyType;
use JeffersonGoncalves\Commerce\ApiKey\Models\ApiKey;
use Symfony\Component\HttpFoundation\Response;

class EnsurePublishableApiKey
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('x-publishable-api-key');

        $valid = is_string($token) && $token !== '' && ApiKey::query()
            ->where('token', $token)
            ->where('type', ApiKeyType::Publishable)
            ->whereNull('revoked_at')
            ->exists();

        if (! $valid) {
            abort(401, 'A valid publishable API key is required.');
        }

        return $next($request);
    }
}
