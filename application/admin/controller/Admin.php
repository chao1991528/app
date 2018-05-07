<?php
namespace app\admin\controller;
use think\Controller;

class Admin extends Controller
{
    protected $model;
    public function initialize()
    {
        $this->pageSize = config('paginate.list_rows');
        if(!$this->isLogin()){
        	return 	$this->redirect('login/index');	
        }
    }

    public function isLogin(){
    	$adminUser = session('adminuser', '', 'admin');
    	if($adminUser && $adminUser->id){
    		return true;
    	}
    	return false;
    }

    public function delete($id){
        if(!intval($id)){
            return json(['code' => 0, 'msg' => 'ID不合法']);
        }

        $model = $this->model ? $this->model : $this->request->controller();
        $res = model($model)->save(['status' => -1],['id' => $id]);
        if($res){
            return json(['code' => 200, 'msg' => '删除成功', 'jumpUrl' => $this->request->header('referer')]);
        }
        return json(['code' => 0, 'msg' => '删除失败！']);

    }
   
}
