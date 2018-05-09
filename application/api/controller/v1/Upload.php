<?php
namespace app\api\controller\v1;

class Upload extends AuthBase
{
    /**
     * 上传文件
     */
    public function save()
    {
        $file = request()->file('file');
    	//图片保存位置
        $info = $file->move( 'uploads');
        if($info){
            // 成功上传后 获取上传信息
            return responseData(1, 'ok', ['savePath' => $info->getSaveName(), 'src' => config('domain'). 'uploads/' .$info->getSaveName()]);         
        }else{
            // 上传失败获取错误信息
            throw new ApiException('上传失败', 500);
        }
    }
}
