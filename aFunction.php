<?php
/**
 * @brief 常用的PHP数组相关的自定义功能函数
 *
 * @author ProgPark
 * @link http://www.progpark.com
 */

/**
 * @brief 实现二维数组按照指定的键名对应的值进行排序的功能
 *
 * @param $originalArray  需要排序的二维数组
 * @param $sort           指定排序的方式：desc表示降序，asc表示升序
 * @param $sortKey        指定用于排序的键名，如果按键名排序则不需要传值，但是$sortType必须设置为true
 * @param $sortType       指定排序的类型：true表示按照键名本身进行排序，false表示按照键名对应的值进行排序
 * @param $sortIndex      设置排序的过程是否改变数组原来的索引关系：true表示保持索引关系，false表示改变索引关系
 *
 * @return array 返回按照指定键名排序后的数组
 */
function arraySort($originalArray, $sort = 'desc', $sortKey = '', $sortType = false, $sortIndex = false) {

    if (!is_array($originalArray)) {
    	  return $originalArray;
    }

    $sort = strtolower($sort);
    $keysValue = $newArray = array();

    if ($sortType) {
    	  $sortKey = '';
        $prefix = 'k';
    } else {
        $prefix = 'a';
    }

    if ($sort == 'asc') {
        $sortFunction = $prefix . 'sort';
    } else {
        $sortFunction = $prefix . 'rsort';
    }

    if (!empty($sortKey)) {
        foreach ($originalArray as $key=>$value) {
            $keysValue[$key] = $value[$sortKey];
        }
        $sortFunction($keysValue);
        reset($keysValue);

        foreach ($keysValue as $key=>$value) {
            if ($sortIndex) {
                $newArray[$key] = $originalArray[$key];
            } else {
                $newArray[] = $originalArray[$key];
            }
        }
    } else {
    	  foreach ($originalArray as $key => $value) {
    		    $sortFunction($originalArray[$key]);
    	  }
    	  $sortFunction($originalArray);
    	  $newArray = $originalArray;
    }

	  return $newArray;
}

/**
 * @brief 实现二维数组去除重复内容（重复的子数组）的功能
 *
 * @param $originalArray 需要进行排重操作的二维数组
 *
 * @return array 返回排除了重复数据的新数组
 */
function arrayUnique($originalArray) {

	  $arrTemp = array();

	  foreach ($originalArray as $key => $value) {
		    if (!in_array($value, $arrTemp)) {
			      array_push($arrTemp, $value);
		    }
	  }

	  return $arrTemp;
}
