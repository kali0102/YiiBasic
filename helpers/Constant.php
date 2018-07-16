<?php

namespace app\helpers;

/**
 * 常量
 * @package app\helpers
 */
class Constant
{

    /**
     * 性别
     */
    const SEX_SECRECY = 0;
    const SEX_MALE = 1;
    const SEX_FEMALE = 2;

    /**
     * 状态
     */
    const STATE_DISABLED = 0;
    const STATE_NORMAL = 1;

    /**
     * 性别列表
     * @return array
     */
    static function sexTextMap()
    {
        return [
            self::SEX_MALE => '男',
            self::SEX_FEMALE => '女',
            self::SEX_SECRECY => '保密'
        ];
    }


    /**
     * 显示性别
     * @param $i
     * @return string
     */
    static function getSexText($i)
    {
        $sexMap = self::sexTextMap();
        return isset($sexMap[$i]) ? $sexMap[$i] : '-';
    }

    /**
     * 状态列表
     * @return array
     */
    static function stateTextMap()
    {
        return [
            self::STATE_NORMAL => '正常',
            self::STATE_DISABLED => '禁用'
        ];
    }

    /**
     * 显示状态
     * @param $i
     * @return string
     */
    static function getStateText($i)
    {
        $stateMap = self::stateTextMap();
        return isset($stateMap[$i]) ? $stateMap[$i] : '-';
    }
}