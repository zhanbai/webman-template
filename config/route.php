<?php

/**
 * This file is part of webman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link      http://www.workerman.net/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

use app\controller\ImagesController;
use Webman\Route;
use app\controller\SmsCodesController;
use app\controller\UsersController;
use app\middleware\Auth;

Route::disableDefaultRoute();

// 短信验证码
Route::post('/smsCodes', [SmsCodesController::class, 'store']);
// 用户注册
Route::post('/users/signup', [UsersController::class, 'signup']);
// 用户登录
Route::post('/users/login', [UsersController::class, 'login']);
// 某个用户信息
Route::get('/users/{id}', [UsersController::class, 'show']);

Route::group('/', function () {
    // 当前用户信息
    Route::get('user', [UsersController::class, 'me']);
    // 更新当前用户信息
    Route::post('user/update', [UsersController::class, 'update']);
    // 上传图片
    Route::post('images', [ImagesController::class, 'store']);
})->middleware([
    Auth::class,
]);
