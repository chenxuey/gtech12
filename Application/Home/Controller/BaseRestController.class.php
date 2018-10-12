<?php

/**
 * BaseController
 *
 * @uses Controller
 * @package
 * @version $id$
 * @copyright Copyright (c) 2012-2016 Gaodun Co. All Rights Reserved.
 * @author Guojing Liu <liuguojing@gaodun.com>
 * @license
 */

namespace Home\Controller;

use Think\Controller\RestController as Controller;

use Think\Log as Log;
use Think\App;

class BaseRestController extends Controller
{
    /**
     * allowMethod
     *
     * @var string
     * @access protected
     */
    protected $allowMethod = array('get', 'post', 'put', 'delete'); // REST允许的请求类型列表
    /**
     * allowType
     *
     * @var string
     * @access protected
     */
    protected $allowType = array('html', 'xml', 'json'); // REST允许请求的资源类型列表
    /**
     * defaultType
     *
     * @var string
     * @access protected
     */
    protected $defaultType = 'json';

    /**
     * _initialize
     *
     * @access protected
     * @return mixed
     */
    function _initialize()
    {

        $this->assign('status', 0);
        $this->assign('info', '');
        $this->assign('result', []);
    }

    function __call($method, $args)
    {
        if (0 === strcasecmp($method, ACTION_NAME . C('ACTION_SUFFIX'))) {
            if (method_exists($this, $this->_method)) {
                $fun = $this->_method;
                if ($method == 'index' && $this->_method == 'get') {
                    $fun = 'getIndex';
                }

                $this->$fun($method);
            } else {
                parent:: __call($method, $args);
            }
        }
    }

    /**
     * 模板显示 调用内置的模板引擎显示方法，
     * @access protected
     * @param string $templateFile 指定要调用的模板文件
     * 默认为空 由系统自动定位模板文件
     * @param string $charset 输出编码
     * @param string $contentType 输出类型
     * @param string $content 输出内容
     * @param string $prefix 模板缓存前缀
     * @return void
     */
    protected function display($templateFile = '', $charset = '', $contentType = '', $content = '', $prefix = '')
    {
        $this->ajaxReturn($this->view->get(), strtoupper('json'));
    }
}
