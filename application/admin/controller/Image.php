<?php
namespace app\admin\controller;
use app\admin\controller\Admin;

class Image extends Admin
{
    public function upload()
    {
    	$file = request()->file('file');
    	//图片保存位置
	    $info = $file->move( 'uploads');
	    if($info){
	        // 成功上传后 获取上传信息
	        return json(['code' => 0 , 'msg' => 'success', 'data' => ['savePath' => $info->getSaveName(), 'src' => config('domain'). 'uploads/' .$info->getSaveName()]]);
	    }else{
	        // 上传失败获取错误信息
	        return json(['code' => 0 , 'msg' => '上传失败']);
	    }
    }
}
