<?php

namespace app\controller;

use app\request\SmsCodeRequest;
use Overtrue\EasySms\EasySms;
use Overtrue\EasySms\Exceptions\NoGatewayAvailableException;
use support\Cache;
use support\Request;

class SmsCodesController
{
    public function store(Request $request)
    {
        $data = $request->all();

        $validate = new SmsCodeRequest;

        if (!$validate->check($data)) {
            return fail($validate->getError());
        }

        $phone = $data['phone'];

        if (envs('APP_ENV') !== 'prod') {
            $code = '1234';
        } else {
            // 生成 4 位随机数，左侧补 0
            $code = str_pad(random_int(1, 9999), 4, 0, STR_PAD_LEFT);

            try {
                $easySms = new EasySms(config('easysms'));
                $easySms->send($phone, [
                    'template' => config('easysms.gateways.aliyun.templates.register'),
                    'data' => [
                        'code' => $code
                    ],
                ]);
            } catch (NoGatewayAvailableException $exception) {
                $message = $exception->getException('aliyun')->getMessage();
                return fail($message ?: '短信发送异常');
            }
        }

        $cacheKey = 'smsCode_' . $phone;
        $ttl = 60 * 5;
        $expiredAt = time() + $ttl;

        // 缓存验证码 5 分钟过期
        Cache::set($cacheKey, $code, $ttl);

        return success([
            'expired_at' => date('Y-m-d H:i:s', $expiredAt),
        ]);
    }
}
