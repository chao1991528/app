<?php
namespace app\api\controller\v1;

class Comment extends AuthBase {

    /*
    *  用户评论
    */
    public function save(){
        $data = $this->request->post();
        $result = $this->validate($data, 'app\common\validate\Comment');
        if (true !== $result) {
            // 验证失败 输出错误信息
            return responseData(0, $result, '', 403);
        }
        $data['user_id'] = $this->user->id;
        try{
            $comment = model('comment')::create($data);
            if($comment){
                 model('news')::where('id',$data['news_id'])->setInc('comment_count');
                return responseData(1, 'ok', [], 202);
            }else{
                return responseData(0, '评论失败', [], 500);
            }
        }catch(\Exception $e){
            return responseData(0, $e->getMessage(), [], 500);
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
