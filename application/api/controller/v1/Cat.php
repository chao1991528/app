<?php
namespace app\api\controller\v1;
use app\api\controller\Common;
use apiExceptionHandle\ApiException;

class Cat extends Common
{
    public function read()
    {
        $cates = model('Category')->field('id as catid,name as catname')->select();
        return responseData(1, 'ok', $cates, 200);
    }

}
