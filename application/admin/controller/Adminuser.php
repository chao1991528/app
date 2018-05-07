<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\AdminUser as AdminUserModel;

class Adminuser extends Controller
{
    //管理员添加
    public function add()
    {
        if($this->request->isPost()){
            $data = $this->request->post();
            $result = $this->validate($data, 'app\admin\validate\AdminUser');
	        if (true !== $result) {
	        	return $this->error($result);	           
	        }else{
	        	$data['password'] = md5password($data['password']);
	        	if(AdminUserModel::create($data)){
	        		return json(['code' => 200, 'message'=>'新增成功']);	
	        	}else{
	        		return $this->error('新增失败');	
	        	}        	
	        }
        }
        return $this->fetch();
    }

}
