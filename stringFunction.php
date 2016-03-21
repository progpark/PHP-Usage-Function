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

/**
 * 格式化毫秒时间戳
 *
 * @return float
 *
 * @author yedonghai
 */
function setMicroTime()
{
    $microTime = microtime();
    $microArr = explode(' ', $microTime);

    $microTime = (float)$microArr[1] + (float)$microArr[0];
    $microTime = round($microTime, 3);

    return $microTime;
}

/**
 * 获取访客的真实IP地址
 *
 * @return string
 */
function getClientIp()
{
    $ipOrigin = [
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED_FOR',
        'HTTP_X_FORWARDED',
        'HTTP_X_CLUSTER_CLIENT_IP',
        'HTTP_FORWARDED_FOR',
        'HTTP_FORWARDED',
        'REMOTE_ADDR'
    ];

    foreach ($ipOrigin as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
            foreach (explode(',', $_SERVER[$key]) as $ip) {
                $ip = trim($ip);
                if (!empty($ip)) {
                    return $ip;
                }
            }
        }
    }

    return '0.0.0.0';
}

/**
 * 获取服务器的真实IP地址
 *
 * @return string
 */
function getServerIp()
{
    if (isset($_SERVER['SERVER_ADDR']) && '127.0.0.1' != $_SERVER['SERVER_ADDR']) {
        $serverIp = $_SERVER['SERVER_ADDR'];
    } elseif (isset($_SERVER['HTTP_HOST']) && !empty($_SERVER['HTTP_HOST'])) {
        if (strpos($_SERVER['HTTP_HOST'], ':')) {
            $httpHost = substr($_SERVER['HTTP_HOST'], 0, strpos($_SERVER['HTTP_HOST'], ':'));
        } else {
            $httpHost = $_SERVER['HTTP_HOST'];
        }
        if (preg_match('/\d+\.\d+\.\d+\.\d+/', $httpHost)) {
            $serverIp = $httpHost;
        } else {
            $serverIp = gethostbyname($httpHost);
        }
    } elseif (isset($_SERVER['SERVER_NAME']) && !empty($_SERVER['SERVER_NAME'])) {
        $serverIp = gethostbyname($_SERVER['SERVER_NAME']);
    } else {
        $serverIp = '127.0.0.1';
    }

    return $serverIp;
}

