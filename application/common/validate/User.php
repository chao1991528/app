<?php

namespace app\common\validate;

use think\Validate;

class User extends Validate {

    protected $rule = [
        'username|用户名' => 'require|max:20|unique:admin_user',
        'password|密码' => 'require|max:32|min:6',
        'phone|手机号' => 'require|mobile',
        'signature|个性签名' => 'require|max:200',
        'sex|性别' => 'require|number',
        'image|头像' => 'require',
        'code|手机验证码' => 'require|length:4',
        'sort|排序' => 'number',
        'status|状态' => 'number'
    ];
    protected $scene = [
        'login_with_password' => ['phone', 'password'],
        'login_with_sms' => ['phone', 'code'],
        'update'
    ];

    // update 验证场景定义
    public function sceneUpdate() {
        return $this->only(['signature', 'sex', 'username', 'image','password'])->remove('password', 'require');
    }

}
