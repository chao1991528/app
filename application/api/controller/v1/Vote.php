<?php

namespace app\api\controller\v1;

use lib\Aes;

class Vote extends AuthBase {

    /*
    *  用户点赞
    */
    public function like(){
        $id = $this->request->post('id', 0 , 'intval');
        if(empty($id)){
            return responseData(0, 'id不存在', [], 404);    
        }
        $news = model('news')::get($id);
        if(!$news){
            return responseData(0, '文章不存在', [], 404);    
        }
        $data = [
            'user_id' => $this->user->id,
            'news_id' => $id
        ];
        $like = db('user_news_like')->where($data)->find();
        if($like){
            return responseData(0, '已经点过赞了', [], 500);
        }else{
            $res = db('user_news_like')->insert($data);
            if($res){
                model('news')::where('id',$id)->setInc('agree_count');
                return responseData(1, '点赞成功');
            }
            return responseData(0, '点赞失败', [], 500);
        }
    }

    /*
    *  用户扔鸡蛋
    */
    public function unlike(){
        $id = $this->request->delete('id', 0 , 'intval');
        if(empty($id)){
            return responseData(0, 'id不存在', [], 404);    
        }
        $news = model('news')::get($id);
        if(!$news){
            return responseData(0, '文章不存在', [], 404);    
        }
        $data = [
            'user_id' => $this->user->id,
            'news_id' => $id
        ];
        $like = db('user_news_like')->where($data)->find();
        if($like){
            $res = db('user_news_like')->where($data)->delete();
            if($res){
                model('news')::where('id',$id)->setDec('agree_count');
                return responseData(1, '取消点赞成功');
            }
            return responseData(0, '取消点赞失败', [], 500);
        }else{           
            return responseData(0, '你没点过赞', [], 500);
        }
    }
    /**
     * 文章是否被该用户喜欢
     */
    public function isLike(){
        $id = $this->request->param('id', 0, 'intval');
        if(!$id){
            return responseData(0, 'id不存在', [], 403);
        }
        $news = db('news')->find(['id'=>$id, 'status'=>1]);
        if(!$news){
            return responseData(0, '文章不存在', [], 403);   
        }
        
        $like = db('user_news_like')->where(['news_id'=>$id, 'user_id'=> $this->user->id])->find();
        return $like ? responseData(1, '已喜欢', ['islike' => 1]) : responseData(1, '没点过喜欢', ['is_like'=>0]);
    }

}
