<?php

namespace Houdunren\Wechat\Message\Traits;

// 菜单消息
trait ButtonMessage
{
    public function isButtonClick()
    {
        return $this->getMessage('MsgType') == 'event' && $this->getMessage('Event') == 'CLICK';
    }

    public function isButtonView()
    {
        return $this->getMessage('MsgType') == 'event' && $this->getMessage('Event') == 'VIEW';
    }
    public function isButtonScanCodePush()
    {
        return $this->getMessage('MsgType') == 'event' && $this->getMessage('Event') == 'scancode_push';
    }
    public function isButtonScanCodeWaitmsg()
    {
        return $this->getMessage('MsgType') == 'event' && $this->getMessage('Event') == 'scancode_waitmsg';
    }
    public function isButtonPicSysPhoto()
    {
        return $this->getMessage('MsgType') == 'event' && $this->getMessage('Event') == 'pic_sysphoto';
    }

    public function isButtonPicPhotoOrAlbum()
    {
        return $this->getMessage('MsgType') == 'event' && $this->getMessage('Event') == 'pic_photo_or_album';
    }
    public function isButtonPicWeixin()
    {
        return $this->getMessage('MsgType') == 'event' && $this->getMessage('Event') == 'pic_weixin';
    }
    public function isButtonLocationSelect()
    {
        return $this->getMessage('MsgType') == 'event' && $this->getMessage('Event') == 'location_select';
    }

    public function isButtonViewMiniProgram()
    {
        return $this->getMessage('MsgType') == 'event' && $this->getMessage('Event') == 'view_miniprogram';
    }
}
