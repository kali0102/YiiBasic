<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\components\Constant;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;

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
 * @property int $logins 登录次数
 * @property string $last_login_at 最近登录时间
 * @property string $last_login_ip 最近登录IP
 * @property string $created_at 创建时间
 * @property string $updated_at 更新时间
 */
class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return '{{%user}}';
    }

    public function behaviors()
    {
        return [TimestampBehavior::class];
    }

    public function rules()
    {
        return [
            [['sex', 'state', 'last_login_at', 'last_login_ip', 'created_at', 'updated_at'], 'integer'],
            [['username', 'phone', 'nickname'], 'string', 'max' => 32],
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
            'nickname' => '昵称',
            'avatar' => '头像',
            'sex' => '性别（1：男、2：女、0：保密）',
            'state' => '状态（0：禁用、1：正常）',
            'last_login_at' => '最近登录时间',
            'last_login_ip' => '最近登录IP',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
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
        if ($user = Yii::$app->cache->get('__user_' . $id))
            return unserialize($user);

        $model = static::find();
        $model->select(['username', 'password', 'id']);
        $model->where(['id' => $id]);
        $user = $model->one();
        \Yii::$app->cache->set('__user_' . $id, serialize($user));
        return $user;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public static function find()
    {
        return new UserQuery(get_called_class());
    }
}
