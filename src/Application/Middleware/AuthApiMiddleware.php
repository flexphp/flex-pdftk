<?php declare(strict_types=1);
/*
 * This file is part of FlexPHP.
 *
 * (c) Freddie Gar <freddie.gar@outlook.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Application\Middleware;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpForbiddenException;

class AuthApiMiddleware implements Middleware
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function process(Request $request, RequestHandler $handler): Response
    {
        $body = \json_decode((string)$request->getBody(), true) ?? [];
        $auth = $body['auth'] ?? [];

        if (empty($auth)) {
            throw new HttpBadRequestException($request, 'auth object is missed');
        }

        if (empty($auth['username']) || empty($auth['password'])) {
            throw new HttpBadRequestException($request, 'auth.username and auth.password are missed');
        }

        if (!$this->isValidUser($auth['username']) || !$this->isValidPassword($auth['username'], $auth['password'])) {
            throw new HttpForbiddenException($request, 'Sorry, you dont have permissions');
        }

        return $handler->handle($request);
    }

    private function isValidUser(string $user): bool
    {
        return \array_key_exists($user, $this->container->get('credentials'));
    }

    private function isValidPassword(string $user, string $password): bool
    {
        return !empty($this->container->get('credentials')[$user])
            && \hash('sha256', $this->container->get('credentials')[$user]) === $password;
    }
}
