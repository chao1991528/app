<?php
namespace app\admin\model;

use think\Model;

class News extends Model
{
	protected $autoWriteTimestamp = true;

	public function setSortAttr($value)
    {
    	return $value ? $value : 100;
    }

    public function getSourceTextAttr($value,$data)
    {
        $status = [0=>'网页',1=>'原创'];
        return $status[$data['source_type']];
    }

    public function getNewsByCondition( $condition = [], $from = 0, $size = 4, $order = ['id' => 'desc'] ){
    	$condition['status'] = [
    		'neq', -1
    	];

    	return $this->where($condition)->limit($from, $size)->order($order)->select();

    }

    public function getNewsCountByCondition( $condition = [] ){
    	return $this->where($condition)->count();
    }

}