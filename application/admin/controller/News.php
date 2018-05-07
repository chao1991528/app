<?php
namespace app\admin\controller;
use app\admin\controller\Admin;
use app\admin\model\News as NewsModel;

class News extends Admin
{
    public function add()
    {
        if(request()->isPost()){
            $data = $this->request->post();
            $news = NewsModel::create($data);
            if($news){
                return json(['code' => 200, 'msg' => '新增成功', 'jump_url' => url('news/index')]);
            }else{
                return json(['code' => 0, 'msg' => 'failed']);    
            }
            return ['code' => 200, 'msg' => 'ok'];
        }
        return $this->fetch();
    }

    public function index(){
        $params = $this->request->get();
        $params['status'] = ['neq', -1];
        $where = [
            ['status' ,'neq', -1],
        ];
        if(!empty($params['start_time'])){
            $where[] = ['create_time', 'egt', strtotime($params['start_time'])];
        }
        if(!empty($params['end_time'])){
            $where[] = ['create_time', 'elt', strtotime($params['end_time'])];
        }
        if(isset($params['cate_id'])){
            $where[] = ['cate_id', '=', $params['cate_id']];    
        }
        if(!empty($params['title'])){
            $where[] = ['title', 'like',  '%' . $params['title'] . '%'];    
        }
        $sort = ['id' => 'desc'];
        $news = NewsModel::where($where)->order($sort)->paginate(config('paginate.list_rows'))->appends($params);
        return $this->fetch('', [
            'news' => $news, 
            'params' => $params,
            'start_time' => empty($params['start_time']) ? '' : $params['start_time'],
            'end_time' => empty($params['end_time']) ? '' : $params['end_time'],
            'cate_id' => empty($params['cate_id']) ? 0 : $params['cate_id'],
            'title' => empty($params['title']) ? '' : $params['title'],
            ]
        );
    }
}
