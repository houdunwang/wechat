import {
  IEventMessage,
  IImageMessage,
  ILinkMessage,
  ILocationMessage,
  ITextMessage,
  IVideoMessage,
  IVoiceMessage,
  IWechatMessage,
} from './types.js'

export interface Base {
  wechatMessage?: IWechatMessage
}

export abstract class Base {
  isText(): this is this & { wechatMessage: ITextMessage } {
    return this.wechatMessage?.MsgType === 'text'
  }

  isImage(): this is this & { wechatMessage: IImageMessage } {
    return this.wechatMessage?.MsgType === 'image'
  }

  isVoice(): this is this & { wechatMessage: IVoiceMessage } {
    return this.wechatMessage?.MsgType === 'voice'
  }

  isVideo(): this is this & { wechatMessage: IVideoMessage } {
    return this.wechatMessage?.MsgType === 'video'
  }

  isShortVideo(): this is this & { wechatMessage: IVideoMessage } {
    return this.wechatMessage?.MsgType === 'shortvideo'
  }

  isLocation(): this is this & { wechatMessage: ILocationMessage } {
    return this.wechatMessage?.MsgType === 'location'
  }

  isLink(): this is this & { wechatMessage: ILinkMessage } {
    return this.wechatMessage?.MsgType === 'link'
  }

  isEvent(): this is this & { wechatMessage: IEventMessage } {
    return this.wechatMessage?.MsgType === 'event'
  }

  isSubscribe(): this is this & { wechatMessage: IEventMessage & { Event: 'subscribe' } } {
    return this.isEvent() && this.wechatMessage?.Event === 'subscribe'
  }

  isUnsubscribe(): this is this & { wechatMessage: IEventMessage & { Event: 'unsubscribe' } } {
    return this.isEvent() && this.wechatMessage?.Event === 'unsubscribe'
  }

  isScan(): this is this & { wechatMessage: IEventMessage & { Event: 'SCAN' } } {
    return this.isEvent() && this.wechatMessage?.Event === 'SCAN'
  }

  isLocationEvent(): this is this & { wechatMessage: IEventMessage & { Event: 'LOCATION' } } {
    return this.isEvent() && this.wechatMessage?.Event === 'LOCATION'
  }

  isClick(): this is this & { wechatMessage: IEventMessage & { Event: 'CLICK' } } {
    return this.isEvent() && this.wechatMessage?.Event === 'CLICK'
  }

  isView(): this is this & { wechatMessage: IEventMessage & { Event: 'VIEW' } } {
    return this.isEvent() && this.wechatMessage?.Event === 'VIEW'
  }

  isScanPush(): this is this & { wechatMessage: IEventMessage & { Event: 'scancode_push' } } {
    return this.isEvent() && this.wechatMessage?.Event === 'scancode_push'
  }

  isScanWait(): this is this & { wechatMessage: IEventMessage & { Event: 'scancode_waitmsg' } } {
    return this.isEvent() && this.wechatMessage?.Event === 'scancode_waitmsg'
  }

  isPicSysPhoto(): this is this & { wechatMessage: IEventMessage & { Event: 'pic_sysphoto' } } {
    return this.isEvent() && this.wechatMessage?.Event === 'pic_sysphoto'
  }

  isPicPhotoOrAlbum(): this is this & {
    wechatMessage: IEventMessage & { Event: 'pic_photo_or_album' }
  } {
    return this.isEvent() && this.wechatMessage?.Event === 'pic_photo_or_album'
  }

  isPicWeixin(): this is this & { wechatMessage: IEventMessage & { Event: 'pic_weixin' } } {
    return this.isEvent() && this.wechatMessage?.Event === 'pic_weixin'
  }

  isLocationSelect(): this is this & {
    wechatMessage: IEventMessage & { Event: 'location_select' }
  } {
    return this.isEvent() && this.wechatMessage?.Event === 'location_select'
  }
}
