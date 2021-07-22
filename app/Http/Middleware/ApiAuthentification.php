<?php


namespace App\Http\Middleware;

use Closure;
use App\Traits\ApiResponse;

class ApiAuthentification
{
    use ApiResponse;

    const API_KEY_HEADER = 'x-api-key';

    /**
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Contracts\Routing\ResponseFactory\\Illuminate\Http\Response\mixed
     */

    public function handle(Request $request, Closure $next) {
        $token = $request->header(self::API_KEY_HEADER);

        if ($token === null) {
            return $this->sendError('Unauthorized.', 401);

        }
    }
}
