<?php

namespace app\controller;

use app\handler\ImageUploadHandler;
use app\request\ImageRequest;
use  Illuminate\Support\Str;
use support\Request;

class ImagesController
{
    public function store(Request $request, ImageUploadHandler $uploader)
    {
        $data = $request->all();
        $data['image'] = $request->file('image');

        $validate = new ImageRequest;

        if (!$validate->check($data)) {
            return fail($validate->getError());
        }

        $user = $request->user;

        $size = $data['type'] == 'avatar' ? 400 : 750;
        $result = $uploader->save($data['image'], Str::plural($data['type']), $user->id, $size);

        return success($result);
    }
}
