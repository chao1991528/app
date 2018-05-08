<?php
namespace app\common\model;

use think\Model;

class User extends Model
{
	protected $autoWriteTimestamp = true;

	// 默认用户名
    public function setUsernameAttr($value, $data)
    {
        if(empty($value)){
            return substr_replace($data['phone'],'****',3,4); 
        }
        return $value;
    }

}