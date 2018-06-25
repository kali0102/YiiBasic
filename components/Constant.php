<?php

namespace app\components;

class Constant {

    const SEX_SECRECY = 0;
    const SEX_MALE = 1;
    const SEX_FEMALE = 2;

    const STATE_DISABLED = 0;
    const STATE_NORMAL = 1;


    static function getSexList() {
        return [
            self::SEX_SECRECY => '保密',
            self::SEX_MALE => '男',
            self::SEX_FEMALE => '女',
        ];
    }
}