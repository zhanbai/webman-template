<?php

namespace app\request;

class UserRequest extends FormRequest
{
    protected $rule =   [
        'phone|手机号' => 'require|phone|uniquePhone',
        'password|密码' => 'require|alphaDash|min:6',
        'sms_code|验证码' => 'require|number',
        'name|名字' => 'length:2,25',
        'avatar|头像' => 'url',
    ];

    protected $scene = [
        'signup' => ['phone', 'password', 'sms_code'],
        'login' => ['phone', 'password'],
        'update' => ['name', 'avatar'],
    ];

    // 登录场景
    public function sceneLogin()
    {
        return $this->remove('phone', 'uniquePhone');
    }
}
