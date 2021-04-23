<?php

// +----------------------------------------------------------------------
// | Author: liang <23426945@qq.com>
// +----------------------------------------------------------------------
// | Json Web Token 功能封装
// +----------------------------------------------------------------------
// | composer require firebase/php-jwt
// +----------------------------------------------------------------------
// 使用示例
// $data = [
//     'id'    => 1,
//     'name'  => '辰风沐阳',
// ];
// $token = app(\JwtAuth::class)->encode($data);
// $result = app(\JwtAuth::class)->decode($token);
// object(stdClass)#53 (2) { ["id"]=> int(1) ["name"]=> string(12) "辰风沐阳" }
// +----------------------------------------------------------------------

use Firebase\JWT\JWT;
use Firebase\JWT\SignatureInvalidException;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;

class JwtAuth
{
    /**
     * 初始化配置
     */
    public function __construct()
    {
        $this->key = 'liang';
        $this->iss = 'zhang';//签发者 可选
        $this->aud = 'wang';//接收该JWT的一方，可选
        $this->exp = 60 * 60 * 24 * 30;//有效时间,单位:秒
    }

    /**
     * 生成token
     * 
     * @param array $data
     * @return string $token
     */
    public function encode(array $data)
    {
        $time = time(); //当前时间
        $token = [
            'iss'  => $this->iss, //签发者 可选
            'aud'  => $this->aud, //接收该JWT的一方，可选
            'iat'  => $time, //签发时间
            'nbf'  => $time, //(Not Before)：某个时间点后才能访问，比如设置time+30，表示当前时间30秒后才能使用
            'exp'  => $time + $this->exp, //过期时间
            'data' => $data,
        ];
        return JWT::encode($token, $this->key);
    }

    /**
     * 解析token
     *
     * @param string $token
     * @return array
     */
    public function decode(string $token)
    {
        try {
            JWT::$leeway = 0; //当前时间减去60，把时间留点余地
            return JWT::decode($token, $this->key, ['HS256'])->data; //HS256方式，这里要和签发的时候对应
        } catch (SignatureInvalidException $e) {  //签名不正确
            fault('签名错误');
        } catch (BeforeValidException $e) {  // 签名在某个时间点之后才能用
            fault('登录暂未生效');
        } catch (ExpiredException $e) {  // token过期
            fault('登录过期');
        } catch (Exception $e) {  //其他错误
            fault($e->getMessage());
        }
    }
}