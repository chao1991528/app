<?php
namespace app\admin\controller;
use app\admin\controller\Admin;

class Index extends Admin
{
    public function index()
    {
        return $this->fetch();
    }

    public function logout()
    {
    	session(null,'admin');
        $this->redirect('/admin/login/index');
    }

    public function welcome()
    {
    	echo 'welcome';
    }
}
