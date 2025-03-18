<?php

namespace Houdunwang\Wechat\QrCode;

use Houdunwang\Wechat\WeChat;
use Illuminate\Support\Facades\Http;

//二维码
class QrCode extends WeChat
{
    //生成二维码信息
    public function getQrTicket($data)
    {
        $api = $this->api . '/qrcode/create?access_token=' . $this->token();
        $response = Http::post($api, $data)->throw()->json();
        return $this->return($response);
    }

    //根据Ticket获取二维码图片
    public function getQrImageByTicket(string $ticket, $base64 = false)
    {
        $api = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=' . $ticket;
        $response = Http::get($api)->throw();

        return $this->return($base64 ? 'data:image/png;base64,' . base64_encode($response) : $response);
    }

    //生成二维码图片
    public function getQrTicketAndBase64Image($data)
    {
        $info = $this->getQrTicket($data);
        return [
            ...$info,
            'image' => $this->getQrImageByTicket($info['ticket'], true)
        ];
    }
}
