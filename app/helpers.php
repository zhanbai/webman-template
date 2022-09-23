<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use support\Log;

/**
 * Here is your custom functions.
 */

// 环境变量
function envs($key, $default = null)
{
    static $env_config = [];
    if (!$env_config) {
        $env_config = include base_path() . '/.env';
    }
    return $env_config[$key] ?? $default;
}

// API 成功信息返回封装
function success($data = null)
{
    return json(['code' => 200, 'data' => $data, 'msg' => 'ok']);
}

// API 失败信息返回封装
function fail($msg = 'fail', $code = 400)
{
    return json(['code' => $code, 'msg' => $msg]);
}

// 生成 token
function jwt_encode($user = null, $ttl = 60 * 60 * 24)
{
    $key = envs('JWT_KEY');
    $time = time();
    $payload = [
        'iat' => $time, // 签发时间戳
        'nbf' => $time, // 某个时间戳后才能访问
        'exp' => $time + $ttl, // 过期时间
        'user' => $user,
    ];

    return JWT::encode($payload, $key, 'HS256');
}

// 解析 token
function jwt_decode($token)
{
    try {
        $key = envs('JWT_KEY');
        return JWT::decode($token, new Key($key, 'HS256'));
    } catch (\Throwable $th) {
        echo $th->getMessage();
        Log::info('jwt decode fail: ' . $th->getMessage());
        return false;
    }
}
