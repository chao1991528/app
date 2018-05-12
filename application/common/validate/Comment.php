<?php

namespace app\common\validate;

use think\Validate;

class Comment extends Validate {

    protected $rule = [
        'news_id|新闻id' => 'require|number',
        'content|评论内容' => 'require|max:255'
    ];

}
