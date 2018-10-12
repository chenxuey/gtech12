<?php
/**
 * Created by PhpStorm.
 * User: chenxueyang
 * Date: 2018/10/12
 * Time: 4:16 PM
 */
namespace Home\Controller;

use Think\Controller;

class ThemeController extends BaseRestController
{

    // 获取文章列表
    public function getLists()
    {
        $this->result = D('Theme')->select();
        $this->display();
    }

    // 获取单个文章
    public function getInfo()
    {
        $themeId = I('id', 1);
        $themeRes = D('Theme')->where(['id'=>$themeId])->find();
        $review = M('review')->where(['theme_id'=>$themeId])->select();

        $this->result = ['theme'=>$themeRes, 'review'=>$review];
        $this->display();
    }

    // 添加评论
    public function addReview()
    {
        $data = [];
        $data['theme_id'] = I('theme_id');
        if ($data['theme_id'] < 1) {
            $this->status = 101;
            $this->info = '参数错误';
            $this->display();
        }
        $data['name'] = I('name');
        $data['auth_pic'] = I('auth_pic');
        $data['comment'] = I('comment');
        M('review')->add($data);
        $this->display();
    }

    public function addThumb()
    {
        $reviewId = I('id', 1);
        $res = M('review')->where(['id'=>$reviewId])->find();
        $thumb = $res['thumbs'] + 1;
        M('review')->where(['id'=>$reviewId])->save(['thumbs'=>$thumb]);
        $this->display();
    }
}