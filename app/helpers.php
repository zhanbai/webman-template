<?php

/**
 * Here is your custom functions.
 */

/**
 * @return string
 */
function envs($key, $default = null)
{
    static $env_config = [];
    if (!$env_config) {
        $env_config = include base_path() . '/.env';
    }
    return $env_config[$key] ?? $default;
}

/**
 * API 成功信息返回封装
 */
function success($data)
{
    return json(['code' => 200, 'data' => $data, 'msg' => 'ok']);
}

/**
 * API 失败信息返回封装
 */
function fail($code = 400, $msg = 'fail')
{
    if (is_array($msg)) {
        $msg = implode(';', $msg);
    }
    return json(['code' => $code, 'msg' => $msg]);
}
