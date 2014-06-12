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
