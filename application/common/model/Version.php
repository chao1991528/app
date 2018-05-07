<?php
namespace app\common\model;

use think\Model;

class Version extends Model
{
	protected $autoWriteTimestamp = true;

	public function getLastestVersionByAppType($appType = '')
    {
    	$where['status'] = 1;
        $where['app_type'] = $appType;
        return $this->where($where)->field('app_type,version,version_code,is_force,apk_url,upgrade_point')->order(['id' => 'desc'])->find(); 
    }

}