<?php

namespace app\request;

class SmsCodeRequest extends FormRequest
{
    protected $rule =   [
        'phone|手机号' => 'require|phone|uniquePhone',
    ];
}
