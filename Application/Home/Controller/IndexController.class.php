<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends BaseRestController
{
    public function index()
    {
        $this->status = 0;  // code 0 正常 其它为错误 见代码描述
        $this->info = 'success'; // 代码描述
        $this->result = ['result'];
        $this->display();
    }
}