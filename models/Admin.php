<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%admin}}".
 *
 * @property string $id 主键
 * @property string $username 用户名
 * @property string $password 登录密码
 * @property string $email 邮箱
 * @property string $phone 手机号码
 * @property string $realname 真实姓名
 * @property string $avatar 头像
 * @property int $sex 性别（1：男、2：女、0：保密）
 * @property int $state 状态（0：禁用、1：正常）
 * @property string $last_login_time 最近登录时间
 * @property string $last_login_ip 最近登录IP
 * @property string $created_at 创建时间
 * @property string $updated_at 更新时间
 */
class Admin extends ActiveRecord
{
    const STATUS_DISABLED = 0;
    const STATUS_ENABLED = 1;

    public function behaviors()
    {
        return [TimestampBehavior::class];
    }

    public static function tableName()
    {
        return '{{%admin}}';
    }

    public function rules()
    {
        return [
            [['username', 'password', 'created_at', 'updated_at'], 'required'],
            [['sex', 'state', 'last_login_time', 'last_login_ip', 'created_at', 'updated_at'], 'integer'],
            [['username', 'phone', 'realname'], 'string', 'max' => 32],
            [['password', 'avatar'], 'string', 'max' => 128],
            [['email'], 'string', 'max' => 64],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'username' => '用户名',
            'password' => '登录密码',
            'email' => '邮箱',
            'phone' => '手机号码',
            'realname' => '真实姓名',
            'avatar' => '头像',
            'sex' => '性别', // （1：男、2：女、0：保密）
            'state' => '状态', // （0：禁用、1：正常）
            'last_login_time' => '最近登录时间',
            'last_login_ip' => '最近登录IP',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->isNewRecord ? $this->password = md5($this->password) : '';
            return true;
        }
        return false;
    }

    public static function find()
    {
        return new AdminQuery(get_called_class());
    }
}
