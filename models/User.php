<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property string $id 主键
 * @property string $username 用户名
 * @property string $password 登录密码
 * @property string $email 邮箱
 * @property string $phone 手机号码
 * @property string $nickname 昵称
 * @property string $avatar 头像
 * @property int $sex 性别（1：男、2：女、0：保密）
 * @property int $state 状态（0：禁用、1：正常）
 * @property string $last_login_time 最近登录时间
 * @property string $last_login_ip 最近登录IP
 * @property string $created_at 创建时间
 * @property string $updated_at 更新时间
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sex', 'state', 'last_login_time', 'last_login_ip', 'created_at', 'updated_at'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
            [['username', 'phone', 'nickname'], 'string', 'max' => 32],
            [['password', 'avatar'], 'string', 'max' => 128],
            [['email'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'username' => '用户名',
            'password' => '登录密码',
            'email' => '邮箱',
            'phone' => '手机号码',
            'nickname' => '昵称',
            'avatar' => '头像',
            'sex' => '性别（1：男、2：女、0：保密）',
            'state' => '状态（0：禁用、1：正常）',
            'last_login_time' => '最近登录时间',
            'last_login_ip' => '最近登录IP',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    /**
     * {@inheritdoc}
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }
}
