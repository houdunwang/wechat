<?php

namespace Houdunren\Wechat\Message\Traits;

// 普通消息
trait BaseMessage
{
    public function isTextMessage()
    {
        return $this->getMessage('MsgType') == 'text';
    }

    public function isImageMessage()
    {
        return $this->getMessage('MsgType') == 'image';
    }

    public function isVoiceMessage()
    {
        return $this->getMessage('MsgType') == 'voice';
    }

    public function isVideoMessage()
    {
        return $this->getMessage('MsgType') == 'video';
    }

    public function isShortVideoMessage()
    {
        return $this->getMessage('MsgType') == 'shortvideo';
    }

    public function isLocationMessage()
    {
        return $this->getMessage('MsgType') == 'location';
    }

    public function isLinkMessage()
    {
        return $this->getMessage('MsgType') == 'link';
    }
}
