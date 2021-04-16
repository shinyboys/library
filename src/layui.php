<?php

// +----------------------------------------------------------------------
// | layui 相关功能函数
// +----------------------------------------------------------------------
// | Author: liang <23426945@qq.com>
// +----------------------------------------------------------------------

if ( ! function_exists('table') )
{
    /**
     * 数据表格
     */
    function table(string $msg, int $count, $data, int $code = 0)
    {
        return json_encode(compact('code', 'msg', 'count', 'data'), JSON_UNESCAPED_UNICODE);
    }
}