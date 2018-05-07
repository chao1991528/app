<?php
namespace app\admin\validate;

use think\Validate;

class Adminuser extends Validate
{
    protected $rule = [
        'username|用户名'  =>  'require|max:20|unique:admin_user',
        'password|密码' =>  'require|max:32',
        'sort|排序'  => 'number',
        'status|状态' => 'number'
    ];

}