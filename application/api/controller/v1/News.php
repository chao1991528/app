<?php
namespace app\api\controller\v1;
use app\api\controller\Common;
use apiExceptionHandle\ApiException;
class News extends Common
{
    public function index()
    {
    	//根据条件获取新闻
        $map = $this->getMap();
        $this->getPageAndSize($map);
        $News = model('news');
        $field = $News->_getListField();

        $news = $News->getNewsByCondition($map, ($this->page-1)*$this->size, $this->size,'',$field);

        return responseData(1, 'ok', $news, 200);
    }

    public function rank(){
        $news = model('News')->getRankNews();
        return responseData(1, 'ok', $news, 200);
    }

    public function read(){
        $id = input('get.id', 0, 'intval');
        if(!$id){
            throw new ApiException('id not exist', 404);
        }

        $news = model('News')->with('category')->where('status',1)->find($id);
        if(!$news){
            throw new ApiException('news not exist', 404);
        }

        $news->setInc('read_count');

        return responseData(1, 'ok', $news, 200);
    }
}
