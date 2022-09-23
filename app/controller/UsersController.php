<?php

namespace app\controller;

use app\model\User;
use app\request\UserRequest;
use support\Cache;
use support\Request;

class UsersController
{
    public function signup(Request $request)
    {
        $data = $request->all();

        $validate = new UserRequest;

        if (!$validate->scene('signup')->check($data)) {
            return fail($validate->getError());
        }

        $cacheKey = 'smsCode_' . $data['phone'];
        $code = Cache::get($cacheKey);

        if (!$code) {
            return fail('验证码已失效');
        }

        if (!hash_equals($code, $data['sms_code'])) {
            return fail('验证码错误');
        }

        $user = User::create([
            'name' => $data['phone'],
            'phone' => $data['phone'],
            'password' => $data['password'],
        ]);

        // 清除验证码缓存
        Cache::delete($cacheKey);

        return success($user);
    }

    public function login(Request $request)
    {
        $data = $request->all();

        $validate = new UserRequest;

        if (!$validate->scene('login')->check($data)) {
            return fail($validate->getError());
        }

        $user = User::where('phone', $data['phone'])->first();

        if (!$user || !password_verify($data['password'], $user->password)) {
            return fail('手机号或密码错误');
        }

        $token = jwt_encode([
            'id' => $user->id,
        ]);

        return success(['token' => $token]);
    }

    public function show($id)
    {
        $user = User::find($id);
        return success($user);
    }

    public function me(Request $request)
    {
        return success($request->user);
    }
}
