<?php

namespace Houdunren\Wechat;

use Exception;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class WeChat
{
    protected $api = 'https://api.weixin.qq.com/cgi-bin';

    //微信配置
    private static $config;

    //被动消息
    private static $message;

    public function __construct()
    {
        $this->setMessage();
    }

    /**
     * 微信配置
     * @param mixed $data
     * @return mixed
     */
    public static function init($config)
    {
        self::$config = $config;
        self::bind();
    }

    /**
     * 获取配置项
     *
     * @param string $name
     */
    final protected function getConfig(string $name)
    {
        return self::$config[$name] ?? null;
    }


    /**
     * 被动消息
     * @return $this
     */
    final protected function setMessage()
    {
        $content = file_get_contents('php://input');
        if ($content) self::$message = json_decode(json_encode(@simplexml_load_string($content, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
    }

    /**
     * 获取消息
     *
     * @param string $name 消息字段
     */
    final public function getMessage(string $name = null)
    {
        if ($name) {
            return self::$message[$name] ?? '';
        }
        return self::$message;
    }

    /**
     * 微信token缓存
     * @return mixed
     * @throws RequestException
     * @throws Exception
     */
    final protected function token()
    {
        $url = $this->api . '/token?grant_type=client_credential&appid=' . $this->getConfig('wechat_official_appid') .
            '&secret=' . $this->getConfig('wechat_official_secret');
        $cacheName = 'wechat-token-cache';
        if (!Cache::has($cacheName)) {
            $res = Http::get($url)->throw()->json();
            $response = $this->return($res);
            Cache::put($cacheName, $response['access_token'], now()->addSeconds($response['expires_in']));
        }
        return Cache::get($cacheName);
    }

    /**
     * 绑定公众号
     * @return $this
     */
    final static private function bind()
    {
        if (isset($_GET['signature']) && isset($_GET['timestamp']) && isset($_GET['nonce']) && isset($_GET['echostr'])) {
            $signature = $_GET['signature'];
            $timestamp = $_GET['timestamp'];
            $nonce = $_GET['nonce'];
            $token = self::$config['wechat_official_token'];
            $tmpArr = [$token, $timestamp, $nonce];
            sort($tmpArr, SORT_STRING);
            $tmpStr = implode($tmpArr);
            $tmpStr = sha1($tmpStr);
            if ($tmpStr == $signature) {
                die($_GET['echostr']);
            }
            Log::error('微信绑定失败');
            die;
        }
    }

    /**
     * 微信返回消息格式化
     * @param mixed $response
     * @return mixed
     * @throws Exception
     */
    final protected function return($response)
    {
        $errors = include __DIR__ . '/data/errors.php';
        if (isset($response['errcode']) && $response['errcode'] != 0) {
            throw new Exception($errors[$response['errcode']] ?? $response['errmsg']);
        }
        return $response;
    }
}
