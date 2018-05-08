<?php

namespace app\api\controller;

use think\Controller;
use think\Validate;
use apiExceptionHandle\ApiException;
use lib\MyEncrypt;

class Common extends Controller {

    public $header = '';
    public $size;
    public $page;

    public function initialize() {
        $this->checkRequestAuth();
    }

    public function checkRequestAuth() {
        $headers = $this->request->header();
        // //基础参数验证
        $validate = Validate::make([
                    'sign' => 'require',
                    'app-type' => 'require',
                    'did' => 'require',
                    'model' => 'require',
                    'version' => 'require',
                    'time' => 'require'
        ]);
        if (!$validate->check($headers)) {
            throw new ApiException($validate->getError(), 400);
        }
        //sign验证
        if (!MyEncrypt::checkSign($headers)) {
            throw new ApiException('sign验证失败', 401);
        }
        cache($headers['sign'], 1, config('app.sign_cache_time'));

        $this->header = $headers;
    }

    public function getPageAndSize($data) {
        $this->size = !empty($data['size']) ? $data['size'] : config('paginate.list_rows');
        $this->page = !empty($data['page']) ? $data['page'] : 1;
    }

    public function getMap() {
        $map = [
                ['status', '=', 1],
        ];
        $params = $this->request->get();
        $this->getPageAndSize($params);
        if (!empty($params['search_field']) && !empty($params['keyword'])) {
            $map[] = [$params['search_field'], 'like', "%" . $params['keyword'] . "%"];
        }
        if (!empty($params['cate_id'])) {
            $map[] = [$params['cate_id'], '=', $params['cate_id']];
        }
        return $map;
    }

}
