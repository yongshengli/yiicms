<?php
namespace app\helpers;
use yii\helpers\StringHelper as BaseStringHelper;
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/12
 * Time: 22:37
 * Email:liyongsheng@meicai.cn
 */
class StringHelper extends BaseStringHelper
{
    /**
     * @param string $string
     * @param int $length
     * @param string $etc
     * @return string
     */
    public static function truncateUtf8String($string, $length, $etc = '...')
    {
        $result = '';
        $string = html_entity_decode(trim(strip_tags($string)), ENT_QUOTES, 'UTF-8');
        $strLen = strlen($string);
        for ($i = 0; (($i < $strLen) && ($length > 0)); $i++) {
            if ($number = strpos(str_pad(decbin(ord(substr($string, $i, 1))), 8, '0', STR_PAD_LEFT), '0')) {
                if ($length < 1.0) {
                    break;
                }
                $result .= substr($string, $i, $number);
                $length -= 1.0;
                $i += $number - 1;
            } else {
                $result .= substr($string, $i, 1);
                $length -= 0.5;
            }
        }
        $result = htmlspecialchars($result, ENT_QUOTES, 'UTF-8');
        if ($i < $strLen) {
            $result .= $etc;
        }
        return $result;
    }
}