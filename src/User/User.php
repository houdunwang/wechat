<?php

namespace Houdunren\Wechat\User;

use Houdunren\Wechat\User\Traits\UserInfo;
use Houdunren\Wechat\User\Traits\UserList;
use Houdunren\Wechat\WeChat;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

//获取用户资料
class User extends WeChat
{
    use UserInfo, UserList;
}
