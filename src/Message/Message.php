<?php

namespace Houdunwang\Wechat\Message;

use Houdunwang\Wechat\Message\Traits\BaseMessage;
use Houdunwang\Wechat\Message\Traits\ButtonMessage;
use Houdunwang\Wechat\Message\Traits\EventMessage;
use Houdunwang\Wechat\WeChat;

//被动消息处理
class Message extends WeChat
{
    use BaseMessage, ButtonMessage, EventMessage;

    public function text(string $content)
    {
        $xml = <<<php
        <xml>
  <ToUserName><![CDATA[%s]]></ToUserName>
  <FromUserName><![CDATA[%s]]></FromUserName>
  <CreateTime>%s</CreateTime>
  <MsgType><![CDATA[text]]></MsgType>
  <Content><![CDATA[%s]]></Content>
</xml>
php;

        return sprintf($xml, $this->getMessage('FromUserName'), $this->getMessage('ToUserName'), time(), $content);
    }

    public function news(array $data)
    {
        $xml = <<<php
        <xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>%s</CreateTime>
        <MsgType><![CDATA[news]]></MsgType>
        <ArticleCount>%s</ArticleCount>
        <Articles>
          %s
        </Articles>
      </xml>
php;

        $news = '';
        $articleXml = <<<xml
        <item>
        <Title><![CDATA[%s]]></Title>
        <Description><![CDATA[%s]]></Description>
        <PicUrl><![CDATA[%s]]></PicUrl>
        <Url><![CDATA[%s]]></Url>
      </item>
xml;
        foreach ($data as $article) {
            $news .= sprintf($articleXml, $article['title'], $article['description'], $article['picurl'], $article['url']);
        }
        return sprintf($xml, $this->getMessage('FromUserName'), $this->getMessage('ToUserName'), time(), count($data), $news);
    }
}
