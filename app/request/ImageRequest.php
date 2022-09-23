<?php

namespace app\request;

class ImageRequest extends FormRequest
{
    protected $rule =   [
        'type|图片类型' => 'require|in:avatar',
        'image|图片' => 'require|image',
    ];
}
