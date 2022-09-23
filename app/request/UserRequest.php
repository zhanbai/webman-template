<?php

namespace app\request;

class UserRequest extends FormRequest
{
    protected $rule =   [
        'phone|手机号' => 'require|phone|uniquePhone',
        'password|密码' => 'require|alphaDash|min:6',
        'sms_code|验证码' => 'require|number',
    ];

    protected $message = [];

    protected $scene = [
        'signup' => ['phone', 'password', 'sms_code'],
        'login' => ['phone', 'password'],
    ];

    // login 验证场景定义
    public function sceneLogin()
    {
    	return $this->remove('phone', 'uniquePhone');
    }
}
