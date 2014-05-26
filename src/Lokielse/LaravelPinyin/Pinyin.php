<?php
namespace Lokielse\LaravelPinyin;

use Lokielse\LaravelPinyin\Lib\Pinyin as PinyinLib;

class Pinyin
{

    const POLICY_CAMEL = 1;

    const POLICY_STUDLY = 2;

    const POLICY_UNDERSCORE = 3;

    const POLICY_HYPHEN = 4;

    const POLICY_BLANK = 5;

    const POLICY_SHRINK = 6;

    protected static $defaultPolicy = self::POLICY_STUDLY;

    protected static $defaultUppercase = false;

    public static function setDefaultPolicy($policy)
    {
        self::$defaultPolicy = $policy;
    }

    public static function setDefaultUpperCase($upper)
    {
        self::$defaultUppercase = $upper;
    }

    public function convert($string, $policy = null, $uppercase = null)
    {
        if (is_null($policy)) {
            $policy = self::$defaultPolicy;
        }
        if (is_null($uppercase)) {
            $uppercase = self::$defaultUppercase;
        }
        $py = self::stringToPinyin($string);
        $py = $this->applyPolicy($py, $policy);
        $uppercase && $py = strtoupper($py);
        return $py;
    }

    private static function stringToPinyin($s)
    {
        $pinyinObj = new PinyinLib();
        $s         = preg_replace("/\s/is", "_", $s);
        $pinyin    = array();
        if ($s == "") {
            return '';
        }
        if (strlen("中文") > 4) { //if the string is not utf-8 encoding,change it to utf-8
            $s = \mb_convert_encoding($s, 'GBK', 'utf-8');
            //$s = iconv('utf-8', 'GBK', $s);
        }
        for ($i = 0; $i < strlen($s); $i++) {
            if (ord($s[$i]) > 128) {
                $char     = $pinyinObj->asc2ToPinyin(ord($s[$i]) + ord($s[$i + 1]) * 256);
                $pinyin[] = $char . '-'; //first letter
                $i++;
            } else {
                if ($i < (strlen($s) - 1)) {
                    if (ord($s[$i]) == 95) {
                        $pinyin[] = '-';
                    } elseif (ord($s[$i + 1]) <= 128) {
                        $pinyin[] = $s[$i];
                    } else {
                        $pinyin[] = $s[$i] . '-';
                    }
                } else {
                    $pinyin[] = $s[$i];
                }
            }
        }
        $pinyinStr = implode('', $pinyin);
        $pinyinStr = rtrim($pinyinStr, '-');
        return strtolower($pinyinStr);
    }

    private function applyPolicy($string, $policy)
    {
        if ($policy == self::POLICY_CAMEL) {
            $string = camel_case($string);
        } elseif ($policy == self::POLICY_UNDERSCORE) {
            $string = camel_case($string);
            $string = snake_case($string, '_');
        } elseif ($policy == self::POLICY_HYPHEN) {
            $string = snake_case($string, '-');
        } elseif ($policy == self::POLICY_STUDLY) {
            $string = studly_case($string);
        } elseif ($policy == self::POLICY_BLANK) {
            $string = preg_replace('#\-#', ' ', $string);
        } elseif ($policy == self::POLICY_SHRINK) {
            $string = preg_replace('#[\s\-]#', '', $string);
        }
        return $string;
    }
}