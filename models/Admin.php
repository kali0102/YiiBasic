<?php

namespace app\models;


use Yii;
use yii\db\ActiveRecord;
use app\helpers\Constant;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;


/**
 * This is the model class for table "{{%admin}}".
 *
 * @property string $id 主键
 * @property string $username 用户名
 * @property string $password 登录密码
 * @property string $email 邮箱
 * @property string $phone_number 手机号码
 * @property string $realname 真实姓名
 * @property string $avatar 头像
 * @property int $sex 性别（1：男、2：女、0：保密）
 * @property int $state 状态（0：禁用、1：正常）
 * @property int $logins 登录次数
 * @property string $last_login_at 最近登录时间
 * @property string $last_login_ip 最近登录IP
 * @property string $created_at 创建时间
 * @property string $updated_at 更新时间
 */
class Admin extends ActiveRecord implements IdentityInterface
{

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
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'string', 'max' => 32],

            ['password', 'trim'],
            ['password', 'required'],
            ['password', 'string', 'max' => 128],

            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'required'],
            ['email', 'string', 'max' => 64],

            ['phone_number', 'trim'],
            //['phone_number', 'app\validators\PhoneNumberValidator'],
            ['phone_number', 'default', 'value' => ''],

            ['realname', 'trim'],
            ['realname', 'default', 'value' => ''],
            ['avatar', 'default', 'value' => ''],

            ['logins', 'default', 'value' => 0],
            ['last_login_at', 'default', 'value' => 0],
            ['last_login_ip', 'default', 'value' => 0],

            ['sex', 'in', 'range' => array_keys(Constant::sexTextMap())],
            ['state', 'in', 'range' => array_keys(Constant::stateTextMap())],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'username' => '用户名',
            'password' => '登录密码',
            'email' => '邮箱',
            'phone_number' => '手机号码',
            'realname' => '真实姓名',
            'avatar' => '头像',
            'sex' => '性别', // （1：男、2：女、0：保密）
            'state' => '状态', // （0：禁用、1：正常）
            'last_login_at' => '最近登录时间',
            'last_login_ip' => '最近登录IP',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->isNewRecord ? $this->setPassword($this->password) : '';
            return true;
        }
        return false;
    }

    public function setPassword($password)
    {
        $this->password = md5($password);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return true;
    }

    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }

    public static function findByUsername($username)
    {
        $model = self::find();
        $model->select(['username', 'password', 'id']);
        $model->where(['username' => $username, 'state' => Constant::STATE_NORMAL]);
        if ($user = $model->one())
            return new Static($user);
        return null;
    }

    public static function findIdentity($id)
    {
        if ($user = Yii::$app->cache->get('__admin_' . $id))
            return unserialize($user);

        $model = static::find();
        $model->select(['username', 'password', 'id']);
        $model->where(['id' => $id]);
        $user = $model->one();
        \Yii::$app->cache->set('__admin_' . $id, serialize($user));
        return $user;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public static function find()
    {
        return new AdminQuery(get_called_class());
    }
}
