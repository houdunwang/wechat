import Wechat from '../index.js'

export class Type {
  constructor(protected wechat: Wechat) {}

  isText() {
    return this.wechat.request.MsgType === 'text'
  }

  isImage() {
    return this.wechat.request.MsgType === 'image'
  }

  isVoice() {
    return this.wechat.request.MsgType === 'voice'
  }

  isVideo() {
    return this.wechat.request.MsgType === 'video'
  }

  isShortVideo() {
    return this.wechat.request.MsgType === 'shortvideo'
  }

  isLocation() {
    return this.wechat.request.MsgType === 'location'
  }

  isLink() {
    return this.wechat.request.MsgType === 'link'
  }

  isEvent() {
    return this.wechat.request.MsgType === 'event'
  }

  isSubscribe() {
    return this.isEvent() && this.wechat.request.Event === 'subscribe'
  }

  isUnsubscribe() {
    return this.isEvent() && this.wechat.request.Event === 'unsubscribe'
  }

  isScan() {
    return this.isEvent() && this.wechat.request.Event === 'SCAN'
  }

  isLocationEvent() {
    return this.isEvent() && this.wechat.request.Event === 'LOCATION'
  }

  isClick() {
    return this.isEvent() && this.wechat.request.Event === 'CLICK'
  }

  isView() {
    return this.isEvent() && this.wechat.request.Event === 'VIEW'
  }

  isScanPush() {
    return this.isEvent() && this.wechat.request.Event === 'scancode_push'
  }

  isScanWait() {
    return this.isEvent() && this.wechat.request.Event === 'scancode_waitmsg'
  }

  isPicSysPhoto() {
    return this.isEvent() && this.wechat.request.Event === 'pic_sysphoto'
  }

  isPicPhotoOrAlbum() {
    return this.isEvent() && this.wechat.request.Event === 'pic_photo_or_album'
  }

  isPicWeixin() {
    return this.isEvent() && this.wechat.request.Event === 'pic_weixin'
  }

  isLocationSelect() {
    return this.isEvent() && this.wechat.request.Event === 'location_select'
  }
}
