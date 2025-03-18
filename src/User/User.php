<?php

namespace Houdunwang\Wechat\User;

use Houdunwang\Wechat\User\Traits\UserInfo;
use Houdunwang\Wechat\User\Traits\UserList;
use Houdunwang\Wechat\WeChat;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

//获取用户资料
class User extends WeChat
{
    use UserInfo, UserList;
}
