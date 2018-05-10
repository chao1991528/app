<?php

namespace app\api\controller\v1;

use lib\Aes;

class User extends AuthBase {

    /**
     * 获取用户信息
     * 用户的信息需要加密传输
     */
    public function read() {
        return responseData(1, 'ok', Aes::encrypt($this->user, config('app.aeskey')));
    }

    /*
     * 修改数据
     */

    public function update() {
        $params = $this->request->param();
        $result = $this->validate($params, 'app\common\validate\User.update');
        if (true !== $result) {
            // 验证失败 输出错误信息
            return responseData(0, $result, '', 403);
        }
        try {
            if(!empty($params['password'])){
                $params['password'] = Aes::encrypt($params['password'], config('app.aeskey'));
            }
            return model('user')->save($params, ['id' => $this->user->id]) ? responseData(1, 'ok') : responseData(0, '更新失败', [], 401);
        } catch (\Exception $e) {
            return responseData(0, $e->getMessage(), [], 500);
        }
    }

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
    *  用户取消点赞
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

}
