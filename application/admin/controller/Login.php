<?php
namespace app\admin\controller;
use think\Controller;
use think\captcha\Captcha;
use app\admin\model\AdminUser as AdminUserModel;

class Login extends Controller
{
    public function index()
    {
    	//已经登录则调到后台首页
    	$user = session('adminuser', '', 'admin');
    	if($user && $user->id){
    		return 	$this->redirect('index/index');
    	}
        return $this->fetch('login');
    }

    //验证码
    public function verify()
    {
    	$config = [
		    // 验证码字体大小
		    'fontSize'    =>    15,    
		    // 验证码位数
		    'length'      =>    4,   
		    // 关闭验证码杂点
		    'useNoise'    =>    false, 
		    //宽度
		    'imageW'      =>    100,
		    //高度
		    'imageH'      =>    41

		];
        $captcha = new Captcha($config);
        return $captcha->entry();    
    }

    //登录处理
    public function doLogin(){
    	if(request()->isPost()){
    		$data = $this->request->post();
	    	if(captcha_check($data['code'])){
	    		$res = AdminUserModel::login($data['username'], $data['password']);
	    		if($res){
	    			return json(['code' => 200, 'msg' => '登录成功']);
	    		}else{
	    			return $this->error('用户名或密码错误！');	
	    		}	
	    	}else{
	    		return $this->error('验证码错误！');
	    	}    		
    	}else{
    		return $this->error('非法请求！');
    	}
    }
}
