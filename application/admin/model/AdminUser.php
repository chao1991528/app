<?php
namespace app\admin\model;

use think\Model;

class AdminUser extends Model
{
	protected $autoWriteTimestamp = true;

	public function setSortAttr($value)
    {
    	return $value ? $value : 100;
    }

    public static function login($username, $password){
    	$adminUser = AdminUser::where('username', $username)->find();
    	if($adminUser['password'] == md5password($password)){
            $adminUser->last_login_time = time();
            $adminUser->last_login_ip = request()->ip();
            $adminUser->save();
            session('adminuser', $adminUser, 'admin');
			return true;
		}else{
			return false;
		}
    }
}