<?php
/**
 * @brief 常用的PHP字符串相关的自定义功能函数
 *
 * @author ProgPark
 * @link http://www.progpark.com
 */

/**
 * 清楚掉html的a标签中的title、target、textvalue等属性
 *
 * @param string $sText 需要处理的text文本信息
 *
 * @return string 处理后的新文本信息内容
 */
function clearHrefForText($sText) {

    $pregArr = array('/target="[_a-z]+"/', '/textvalue="(.*?)"/', '/title="(.*?)"/');

    $sNewText = preg_replace($pregArr, '', $sText);

    return $sNewText;
}

/**
 * 生成随机字符串
 *
 * @param integer $length 要生成的随机字符串长度 
 * @param string  $type   随机码类型：0，数字+字母；1，数字；2，小写字母；3，大写字母；4，特殊字符；-1，数字+字母+特殊字符
 *
 * @return string   
 */
function randomString($length = 6, $type = 0) {

    $arr = array(1=>"0123456789", 2=>"abcdefghijklmnopqrstuvwxyz", 3=>"ABCDEFGHIJKLMNOPQRSTUVWXYZ", 4=>"~@#$%^&*(){}[]|");

    if ($type == 0) {
        array_pop($arr);
        $string = implode("", $arr);
    } elseif ($type == "-1") {
        $string = implode("", $arr);
    } else {
        $string = $arr[$type];
    }

    $count = strlen($string) - 1;
    $code = '';

    for ($i = 0; $i < $length; $i++) {
        $code .= $string[rand(0, $count)];
    }

    return $code;
}

