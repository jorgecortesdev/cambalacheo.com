<?php

namespace App\Http\Middleware;

use Closure;

class ImageCacheHeadersMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);


        if ($request->isMethod('get')) {
            $etag = md5($response->getContent());
            $requestEtag = str_replace('"', '', $request->getEtags());

            if ($requestEtag && $requestEtag[0] == $etag) {
                $response->setNotModified();
            }
            $response->setEtag($etag);
        }

        $response->header('Expires', gmdate('D, d M Y H:i:s \G\M\T', time() + (60 * 60 * 24)));
        $response->header('Cache-Control', 'public, max-age=604800', true);
        $response->header('Pragma', 'cache');

        return $response;
    }
}
