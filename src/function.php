<?php

if ( ! function_exists('aa') )
{
    function aa()
    {
        return mt_rand(1, 100);
    }
}

/**
 * 获取分页参数
 * @example page(...page())
 */
// function page()
// {
//     return [input('get.page/d', 1), input('get.limit/d', 10)];
// }