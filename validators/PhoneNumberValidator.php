<?php

namespace app\validators;

use yii\helpers\Json;
use yii\web\JsExpression;
use yii\validators\Validator;

class PhoneNumberValidator extends Validator
{
    public $pattern = "/^1[34578]{1}\d{9}$/";

    public function init()
    {
        parent::init();
        if ($this->message === null) {
            $this->message = '{attribute}格式错误!';
        }
    }

    /**
     * 后端验证
     * @param mixed $value
     * @return array|null
     */
    protected function validateValue($value)
    {
        if (!is_string($value) || strlen($value) >= 30) {
            $valid = false;
        } else {
            $valid = preg_match($this->pattern, $value);
        }
        return $valid ? null : [$this->message, []];
    }

    /**
     * 前端验证
     * @param \yii\base\Model $model
     * @param string $attribute
     * @param \yii\web\View $view
     * @return string
     */
    public function clientValidateAttribute($model, $attribute, $view)
    {
        $pattern = new JsExpression($this->pattern);
        $message = Json::encode(str_replace('{attribute}', $model->getAttributeLabel($attribute), $this->message));

        return 'if (!(value.match(' . $pattern . '))) {messages.push(' . $message . ')};';
    }
}