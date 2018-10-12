<?php
namespace Home\Controller;

use Think\Controller;

class ThreadController extends BaseRestController
{
    /**
     * 获取问答列表
     */
    public function getlist()
    {
        $m = M('thread');
        $sql="select * from thread ";
        $info = $m->query($sql);

        $this->status = 0;  // code 0 正常 其它为错误 见代码描述
        $this->info = 'success'; // 代码描述
        $this->result = $info;
        $this->display();
    }

    public function getInfo()
    {

        $id = $_GET['id'];

        $m = M('thread');
        $sql="select * from thread where id = {$id}";
        $info = $m->query($sql);


        $this->status = 0;  // code 0 正常 其它为错误 见代码描述
        $this->info = 'success'; // 代码描述
        $this->result = $info[0];
        $this->display();
    }


    public function teacherList()
    {


        $m = M('teacher');
        $sql="select * from teacher";
        $info = $m->query($sql);


        $this->status = 0;  // code 0 正常 其它为错误 见代码描述
        $this->info = 'success'; // 代码描述
        $this->result = $info;
        $this->display();

    }


    public function addThread()
    {
        $data = $_POST;


        $thread = M('thread');

        $info = [];
        $info['thread_title'] = !empty($data['thread_content'])?$data['thread_content']:"";
        $info['thread_content']=!empty($data['thread_content'])?$data['thread_content']:"";
        $info['user_img']=!empty($data['user_img'])?$data['user_img']:"https://assets.xiucai.com/assets/img/caiduoduo.png";
        $info['teacher_name']=!empty($data['teacher_name'])?$data['teacher_name']:"王老师";
        $info['teacher_img']=!empty($data['teacher_img'])?$data['teacher_img']:"https://assets.xiucai.com/assets/img/caiduoduo.png";
        $info['teacher_content']=!empty($data['thread_title'])?$data['thread_title']:"";
        $info['user_name']=!empty($data['user_name'])?$data['user_name']:"宋鹏";
        $info['status']=0;

        $info['create_time']=date('Y-m-d H:i:s');

        $insertId=$thread->add($info);

        $this->status = 0;  // code 0 正常 其它为错误 见代码描述
        $this->info = 'success'; // 代码描述
        $this->result = $insertId;
        $this->display();




    }

}