<?php

// +----------------------------------------------------------------------
// | 常用功能函数
// +----------------------------------------------------------------------
// | Author: liang <23426945@qq.com>
// +----------------------------------------------------------------------

if ( ! function_exists('page') )
{
    /**
     * 获取分页参数
     */
    function page($page = 1, $limit = 10)
    {
        return [$_GET['page'] ?? $page, $_GET['limit'] ?? $limit];
    }
}

if ( ! function_exists('getRandString') )
{
    /**
     * 生成指定长度的随机字符串
     * @param integer $length 长度
     * @return string 随机字符串
     */
    function getRandString(int $length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
        $randomString = ''; 
        for ($i = 0; $i < $length; $i++) { 
            $randomString .= $characters[rand(0, strlen($characters) - 1)]; 
        } 
        return $randomString; 
    }
}

if ( ! function_exists('generateOrdersn') )
{
    /**
     * 随机生成18位数字订单号(18位:不包含前缀)
     * @param string $prefix 订单号前缀
     * @return string 随机订单号
     */
    function generateOrdersn(string $prefix = '')
    {
        return $prefix . date('YmdHis') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7,  13), 1))), 0, 2) . mt_rand(10, 99);
    }
}

if ( ! function_exists('wordTime') )
{
    /**
     * 将时间戳转为文字时间
     * @param integer $time
     */
    function wordTime(int $time)
    {
        $str = '';
        $time = intval(substr($time, 0, 10));
        $int = time() - $time;
        if ($int < 5){
            $str = sprintf('刚刚', $int);
        } elseif ($int < 60){
            $str = sprintf('%d秒前', $int);
        } elseif ($int < 3600) {
            $str = sprintf('%d分钟前', floor($int / 60));
        } elseif ($int < 86400){
            $str = sprintf('%d小时前', floor($int / 3600));
        } elseif ($int < 2592000) {
            $str = sprintf('%d天前', floor($int / 86400));
        } else {
            $str = date('Y-m-d H:i:s', $time);
        }
        return $str;
    }
}

if ( ! function_exists('formatNumber') )
{
    /**
     * 整数格式化, 单位转换
     * @param integer $num
     */
    function formatNumber(int $num)
    {
        $num    = intval($num);
        $length = strlen($num);
        if ( $length > 8 ) {
            $decimal = rtrim(substr($num, -8, 2), '0');
            $decimal = $decimal ? '.' . $decimal : '';
            // 亿
            return substr($num, 0, strrpos($num, substr($num, -7)) - 1) . $decimal . '亿';
        } elseif ( $length > 4 ) {
            $decimal = rtrim(substr($num, -4, 2), '0');
            $decimal = $decimal ? '.' . $decimal : '';
            // 万
            return substr($num, 0, strrpos($num, substr($num, -3)) - 1) . $decimal . 'W';
        } else {
            // 千
            return $num;
        }
    }
}

