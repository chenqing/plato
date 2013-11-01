<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author chenqing663@foxmail.com
 * @desc	a CI controller index
 * @since 0.1
 * @date  2013-03-07
 */

class Index extends CI_Controller
{
 /*
 *	重载父类的析构函数，以及装载一些必须的助手和库文件
 */

    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper(array('url','form'));
        $this->load->library('table');
        $this->load->model('User_model');
        $this->load->model('Group_model');
        $this->load->library('pagination');
        $this->load->library('user_agent');
        $this->load->library('breadcrumb');
        $this->load->library('permission');
        $this->config->load('pagination');
        $this->load->helper('date');
    }

    public function index()
    {
        $data['breadcrumb'] = $this->breadcrumb->get_name();
        $data['breadcrumb_link'] = $this->breadcrumb->get_link();
        //var_dump($this->breadcrumb->get_link());
        $this->load->view('manage/include/header',$data);
        $this->load->view('manage/include/navbar',$data);
        $this->load->view('manage/index');
        $this->load->view('manage/include/footer');
    }

}