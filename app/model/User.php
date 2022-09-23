<?php

namespace app\model;

/**
 * @property integer $id (主键)
 * @property string $name 名字
 * @property string $phone 手机号
 * @property string $password 密码
 * @property mixed $created_at
 * @property mixed $updated_at
 */
class User extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    // 设置密码
    public function setPasswordAttribute($value)
    {
        if (strlen($value) != 60) {
            $value = password_hash($value, PASSWORD_DEFAULT);
        }

        $this->attributes['password'] = $value;
    }
}
