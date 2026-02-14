import { XMLParser } from 'fast-xml-parser'
import { createHash } from 'node:crypto'
import { IConfig, IWechatMessage } from './types.js'
import message from './message.js'
import { Base } from './base.js'

export class Wechat extends Base {
  // 由于基类 Base 中 wechatMessage 是必选属性，此处需要明确声明
  public override wechatMessage?: IWechatMessage
  protected config: IConfig = undefined!
  public services = { message: new message(this) }

  init(config: IConfig) {
    this.config = config
    return this.parse()
  }

  parse() {
    const parser = new XMLParser()
    const parseData = parser.parse(this.config.raw ?? '') as { xml: IWechatMessage }
    const data = parseData.xml
    this.wechatMessage = data
    return this
  }

  /**
   * 验证微信服务器消息的真实性
   * @param signature 微信加密签名
   * @param timestamp 时间戳
   * @param nonce 随机数
   * @param token 开发者填写的token
   */
  public bind(config?: IConfig) {
    if (config) this.config = config
    if (!this.config) throw new Error('Wechat configuration not initialized')

    const { signature, timestamp, nonce, echostr } = this.config.get
    const token = this.config.token
    // 1. 将token、timestamp、nonce三个参数进行字典序排序
    const tmpArr = [token, timestamp, nonce].sort()

    // 2. 将三个参数字符串拼接成一个字符串进行sha1加密
    const tmpStr = tmpArr.join('')
    const sha1Str = createHash('sha1').update(tmpStr).digest('hex')
    // 3. 开发者获得加密后的字符串可与signature对比，标识该请求来源于微信
    if (sha1Str !== signature) return false
    return echostr
  }
}

export default Wechat
