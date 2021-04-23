<?php

// +----------------------------------------------------------------------
// | 常用功能函数
// +----------------------------------------------------------------------
// | Author: liang <23426945@qq.com>
// +----------------------------------------------------------------------

declare (strict_types = 1);

if ( ! function_exists('getRandString') )
{
    /**
     * 生成指定长度的随机字符串
	 * 
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
	 * 
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
	 * 
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
	 * 
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

// +----------------------------------------------------------------------
// | Api
// +----------------------------------------------------------------------

if ( ! function_exists('data') )
{
	/**
	 * 返回数据
	 *
	 * @param string $msg
	 * @param object $data
	 * @param integer $code
	 * @return void
	 */
	function data(string $msg, object $data, int $code = 0)
	{
		return json_encode(compact('code', 'msg', 'data'), JSON_UNESCAPED_UNICODE);
	}
}

if ( ! function_exists('msg') )
{
	/**
	 * 操作成功
	 *
	 * @param string  $msg
	 * @param integer $code
	 */
	function msg(string $msg = "", int $code = 0)
	{
		throw new \Exception($msg, $code);
	}
}

if ( ! function_exists('fault') )
{
	/**
	 * 返回错误信息
	 *
	 * @param string  $msg
	 * @param integer $code
	 */
	function fault(string $msg = "", int $code = 1)
	{
		throw new \Exception($msg, $code);
	}
}

// +----------------------------------------------------------------------
// | ThinkPHP
// +----------------------------------------------------------------------

if ( ! function_exists('page') )
{
    /**
     * 获取分页参数
     *
     * @param integer $page  默认页码
     * @param integer $limit 默认每页数据条数
     * @return array
	 * @example page(...page())
     */
    function page(int $page = 1, int $limit = 10)
    {
        return [$_GET['page'] ?? $page, $_GET['limit'] ?? $limit];
    }
}

if ( ! function_exists('search') )
{
    /**
     * 用于ThinkPHP搜索器
     * 
     * @param string $fields
     * @return array
     * @example withSearch(...search('id,name'))
     */
    function search(string $fields)
    {
        $array = array_filter(explode(',', $fields));
        $build = [];
        foreach ($array as $v) {
            $key = trim($v);
            if (!empty($key)) $build[$key] = isset($_GET[$key]) ? trim($_GET[$key]) : '';
        }
        return [array_keys($build), $build];
    }
}

// +----------------------------------------------------------------------
// | Layui
// +----------------------------------------------------------------------

if ( ! function_exists('table') )
{
	/**
	 * 数据表格接口数据格式
	 *
	 * @param string  $msg
	 * @param integer $count
	 * @param array   $data
	 * @param integer $code
	 */
    function table(string $msg, int $count, array $data, int $code = 0)
    {
        return json_encode(compact('code', 'msg', 'count', 'data'), JSON_UNESCAPED_UNICODE);
    }
}