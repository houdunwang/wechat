import Wechat from '../index.js'
import { Type } from './type.js'

export default class Message extends Type {
  constructor(protected wechat: Wechat) {
    super(wechat)
  }

  private base(type: string, content: string) {
    return `
      <xml>
        <ToUserName><![CDATA[${this.wechat.request.FromUserName}]]></ToUserName>
        <FromUserName><![CDATA[${this.wechat.request.ToUserName}]]></FromUserName>
        <CreateTime>${Math.floor(Date.now() / 1000)}</CreateTime>
        <MsgType><![CDATA[${type}]]></MsgType>
        ${content}
      </xml>`
  }

  text(content: string) {
    return this.base('text', `<Content><![CDATA[${content}]]></Content>`)
  }

  image(mediaId: string) {
    return this.base('image', `<Image><MediaId><![CDATA[${mediaId}]]></MediaId></Image>`)
  }

  voice(mediaId: string) {
    return this.base('voice', `<Voice><MediaId><![CDATA[${mediaId}]]></MediaId></Voice>`)
  }

  video(mediaId: string, title = '', description = '') {
    return this.base(
      'video',
      `<Video>
        <MediaId><![CDATA[${mediaId}]]></MediaId>
        <Title><![CDATA[${title}]]></Title>
        <Description><![CDATA[${description}]]></Description>
      </Video>`
    )
  }

  music(thumbMediaId: string, musicUrl = '', hqMusicUrl = '', title = '', description = '') {
    return this.base(
      'music',
      `<Music>
        <Title><![CDATA[${title}]]></Title>
        <Description><![CDATA[${description}]]></Description>
        <MusicUrl><![CDATA[${musicUrl}]]></MusicUrl>
        <HQMusicUrl><![CDATA[${hqMusicUrl}]]></HQMusicUrl>
        <ThumbMediaId><![CDATA[${thumbMediaId}]]></ThumbMediaId>
      </Music>`
    )
  }

  news(articles: { title: string; description: string; picUrl: string; url: string }[]) {
    const items = articles
      .map(
        (article) => `
      <item>
        <Title><![CDATA[${article.title}]]></Title>
        <Description><![CDATA[${article.description}]]></Description>
        <PicUrl><![CDATA[${article.picUrl}]]></PicUrl>
        <Url><![CDATA[${article.url}]]></Url>
      </item>`
      )
      .join('')

    return this.base(
      'news',
      `<ArticleCount>${articles.length}</ArticleCount>
      <Articles>${items}</Articles>`
    )
  }

  transferCustomerService() {
    return this.base('transfer_customer_service', '')
  }
}
