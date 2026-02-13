export interface IConfig {
  token: string
  get: Record<string, any>
  raw?: string | null
}

export interface IWechatMessage {
  ToUserName: string
  FromUserName: string
  CreateTime: number
  MsgType: 'text' | 'image' | 'voice' | 'video' | 'shortvideo' | 'location' | 'link' | 'event' | 'transfer_customer_service'
  Content?: string
  MsgId?: number
  PicUrl?: string
  MediaId?: string
  Format?: string
  Recognition?: string
  ThumbMediaId?: string
  Location_X?: string
  Location_Y?: string
  Scale?: string
  Label?: string
  Title?: string
  Description?: string
  Url?: string
  Event?: string
  EventKey?: string
  Ticket?: string
  Latitude?: string
  Longitude?: string
  Precision?: string
}
