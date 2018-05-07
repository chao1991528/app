<?php
namespace app\common\model;

use think\Model;

class News extends Model
{
	protected $autoWriteTimestamp = true;
    protected $resultSetType = 'collection';

	public function setSortAttr($value)
    {
    	return $value ? $value : 100;
    }

    public function getSourceTextAttr($value,$data)
    {
        $status = [0=>'网页',1=>'原创'];
        return $status[$data['source_type']];
    }

    public function category()
    {
        return $this->belongsTo('Category','cate_id')->field('id,name');
    }

    public function getNewsByCondition( $condition = [], $from = 0, $size = 4, $order = ['id' => 'desc'], $field = '*'){

    	return $this->where($condition)->limit($from, $size)->order($order)->field($field)->select();

    }

    public function getNewsCountByCondition( $condition = [] ){
    	return $this->where($condition)->count();
    }

    public function getHeadNews($num = 4){
        $map = [
            'status' => 1,
            'is_home_recommend' => 1
        ];

        return $this->with('category')->where($map)->field($this->_getListField())->limit($num)->select();
    }

    public function getPositionNews($num = 20){
        $map = [
            'status' => 1,
            'is_recommend' => 1
        ];

        return $this->with('category')->where($map)->field($this->_getListField())->limit($num)->select();
    }

    public function _getListField(){
        return ['id','title','cate_id', 'image','read_count'];
    }

    public function getRankNews($num = 5){
        $map['status'] = 1;
        $order = ['read_count' => 'desc'];
        return $this->with('category')->where($map)->field($this->_getListField())->limit($num)->order($order)->select();
    }

}