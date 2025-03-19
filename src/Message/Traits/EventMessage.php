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

    //_扫描带参数二维码事件，用户已经关注，扫码后的推送事件
    public function isSubscribeScanEvent()
    {
        return $this->getMessage('MsgType') == 'event' && $this->getMessage('Event') == 'SCAN' && $this->getMessage('EventKey') && $this->getMessage('Ticket');
    }

    public function isUnSubscribeScanEvent()
    {
        return $this->getMessage('MsgType') == 'event' && $this->getMessage('Event') == 'subscribe' && $this->getMessage('EventKey') && $this->getMessage('Ticket');
    }

    //扫描带参数二维码事件，用户已关注时的事件推送
    public function isScanEvent()
    {
        return $this->isSubscribeScanEvent() || $this->isUnSubscribeScanEvent();
    }

    public function isLocationEvent()
    {
        return $this->getMessage('MsgType') == 'event' && $this->getMessage('Event') == 'LOCATION';
    }
}
