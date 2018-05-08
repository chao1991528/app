<?php
namespace app\api\controller\v1;
use app\api\controller\Common;

class User extends AuthBase
{
    public function info()
    {
        halt($this->user);
    }
}
