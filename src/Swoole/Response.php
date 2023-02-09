<?php
declare(strict_types=1);

namespace VolodymyrKlymniuk\SwooleServerBundle\Swoole;

class Response
{
    /**
     * @param \Swoole\Http\Response                      $response
     * @param \Symfony\Component\HttpFoundation\Response $symfonyResponse
     */
    public static function toSwoole(\Swoole\Http\Response $response, \Symfony\Component\HttpFoundation\Response $symfonyResponse): void
    {
        // headers have already been sent by the developer
        if (headers_sent()) {
            return;
        }
        // headers
        $allHeadersWithoutCookies = $symfonyResponse->headers->allPreserveCaseWithoutCookies();

        foreach ($allHeadersWithoutCookies as $name => $values) {

            foreach ($values as $value) {

                if ($value) {
                    $response->header($name, (string) $value);
                }
            }
        }

        // status
        $response->status($symfonyResponse->getStatusCode());

        // cookies
        foreach ($symfonyResponse->headers->getCookies() as $cookie) {
            $response->cookie(
                $cookie->getName(),
                $cookie->getValue(),
                $cookie->getExpiresTime(),
                $cookie->getPath(),
                $cookie->getDomain(),
                $cookie->isSecure(),
                $cookie->isHttpOnly()
            );
        }

        $response->end($symfonyResponse->getContent());
    }
}