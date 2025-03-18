<?php

namespace Houdunwang\Wechat\Message\Traits;

// 事件推送消息
trait EventMessage
{
    public function isSubscribeEvent()
    {
        return $this->getMessage('MsgType') == 'event' && $this->getMessage('Event') == 'subscribe' && !$this->getMessage('EventKey');
    }

    public function isUnSubscribeEvent()
    {
        return $this->getMessage('MsgType') == 'event' && $this->getMessage('Event') == 'unsubscribe' && !$this->getMessage('EventKey');
    }

    //_扫描带参数二维码事件，用户未关注时，进行关注后的事件推送_
    public function isSubscribeScanEvent()
    {
        return $this->getMessage('MsgType') == 'event' && $this->getMessage('Event') == 'SCAN' && $this->getMessage('EventKey');
    }

    //扫描带参数二维码事件，用户已关注时的事件推送
    public function isScanEvent()
    {
        return $this->getMessage('MsgType') == 'event' && $this->getMessage('Event') == 'SCAN' && $this->getMessage('EventKey');
    }

    public function isLocationEvent()
    {
        return $this->getMessage('MsgType') == 'event' && $this->getMessage('Event') == 'LOCATION';
    }
}
