<?php

namespace JeffersonGoncalves\Commerce\Admin\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use JeffersonGoncalves\Commerce\ApiKey\Enums\ApiKeyType;
use JeffersonGoncalves\Commerce\ApiKey\Models\ApiKey;
use Symfony\Component\HttpFoundation\Response;

class EnsureSecretApiKey
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken() ?? $request->header('x-api-key');

        $valid = is_string($token) && $token !== '' && ApiKey::query()
            ->where('token', $token)
            ->where('type', ApiKeyType::Secret)
            ->whereNull('revoked_at')
            ->exists();

        if (! $valid) {
            abort(401, 'A valid secret API key is required.');
        }

        return $next($request);
    }
}
