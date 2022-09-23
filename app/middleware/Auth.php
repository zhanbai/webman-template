<?php
namespace app\middleware;

use app\model\User;
use Webman\MiddlewareInterface;
use Webman\Http\Response;
use Webman\Http\Request;

class Auth implements MiddlewareInterface
{
    public function process(Request $request, callable $next) : Response
    {
        $auth = $request->header('Authorization');

        if (!$auth) {
            return fail('请先进行认证', 401);
        }

        if (!$token = jwt_decode(substr($auth, 7))) {
            return fail('请重新进行认证', 401);
        }

        if ($token->exp < time()) {
            return fail('请重新进行认证', 401);
        }

        $user = User::find($token->user->id);

        if (!$user) {
            return fail('请重新进行认证', 401);
        }
        
        $request->user = $user;

        return $next($request);
    }

}
