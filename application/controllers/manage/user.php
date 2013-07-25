<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author qing.chen@chinacache.com
 * @desc	a CI controller manage user
 * @since 0.1
 * @date  2013-03-07
 */

class User extends CI_Controller
{
	/*
	 *	定义权限常量，利用位的与（&）验证用户是不是拥有该权限，利用位的或（|）来	
	 *	赋予用户一定的权限
	 */

	const VISIT = 2 ; //默认的访客权限

	const CREATE = 4 ; //创建一个东西的权限

	const MODIFY = 8 ; //修改一个东西的权限

	const DELETE = 16 ; //删除一个东西的权限

	const STANDARD   =  32 ; // 标准权限，可以干一些自定义的事情

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
        $this->config->load('pagination');
        $this->load->helper('date');
	}
	
	/**
	 * 默认显示的首页
	 * 显示用户列表
	 */
	public function index()
	{
        $config['base_url'] = site_url('manage/user/index/');
        $config['total_rows'] = $this->db->count_all('user');
        $config['per_page'] = 5;
        $config['uri_segment'] = 4;
        $this->pagination->initialize($config);
        $data['user'] = $this->User_model->all_user($config['per_page'],$this->uri->segment(4));
        $data['links'] = $this->pagination->create_links();
        $data['breadcrumb'] = $this->breadcrumb->get_name();
        $data['breadcrumb_link'] = $this->breadcrumb->get_link();
        //var_dump($this->breadcrumb->get_link());
		$this->load->view('manage/include/header',$data);
		$this->load->view('manage/include/navbar',$data);
		$this->load->view('manage/user',$data);
		$this->load->view('manage/include/footer');
	}
	
	public function add()
	{

        $data['user_name'] = $this->input->post('user_name');
        $data['group_id'] = $this->input->post('group_id');
        $data['user_password'] = sha1('123456');
        $data['user_privilege'] = array();
        $temp = explode(':',$this->input->post('user_privilege'));
        foreach( $temp  as $pri)
        {
            $data['user_privilege']  |= $pri;
        }

        $data['is_active'] = $this->input->post('is_active');
        $datestring = "%Y-%m-%d  %h:%i";
        $time = time();
        $data['last_login'] = mdate($datestring, $time);

    //    var_dump($data['privilege']);

        if($this->input->is_ajax_request()){

            if($this->User_model->add_user($data))
            {
                echo 1;
            }
            else
            {
                echo 0 ;
            }
        }
        else
        {
            redirect(base_url().'manage/user');
        }

	}
	
	public function edit()
	{
        $user_id = $this->uri->segment(4) ;
        $data['user_name'] = $this->input->post('user_name');
        $data['group_id'] = $this->input->post('group_id');
        $data['user_privilege'] = $this->input->post('user_privilege');
        $data['is_active'] = $this->input->post('is_active');
        if(is_numeric($user_id) && $this->input->is_ajax_request()){
            if($this->User_model->update_user($data,$user_id)){
                echo 1;
            }else{
                echo 0;
            }
        }
        }
    public function get_user_by_id()
    {
        $user_id = $this->uri->segment(4) ;
        if(is_numeric($user_id) && $this->input->is_ajax_request()){
        echo json_encode($this->User_model->get_user_by_id($user_id));
        }
    }
	
	public function delete()
	{
        $user_id = $this->uri->segment(4) ;
        if(is_numeric($user_id) && $this->input->is_ajax_request()){
            if($this->User_model->delete_user($user_id)){
                echo 1;
            }else{
                echo 0 ;
            }

        }
	}

    public function login()
    {
        $this->load->model('User_model');
        $this->load->view('manage/include/header');
        $this->load->view('login');
        $this->load->view('manage/include/footer');
    }

    public function change_password($id)
    {
        $password = $this->User_model->get_password_by_id($id);
        $old_paaword = $this->input->post('password_old');
        $new_password_1 = $this->input->post('password_new_1');
        $new_password_2 = $this->input->post('password_new_2');
        if(sha1($old_paaword) != $password){
               echo 2;
        }

        if($old_paaword && $new_password_1&&$new_password_2){
            if($this->User_model->change_password($id,sha1($new_password_1))){
                echo 1;
            }else{
                echo 0;
            }

        }
    }

    public function change_password_root($id){
        $new_password_1 = $this->input->post('password_new_1');
        $new_password_2 = $this->input->post('password_new_2');

        if($new_password_1&&$new_password_2){
            if($this->User_model->change_password($id,sha1($new_password_1))){
                echo 1;
            }else{
                echo 0;
            }

        }

    }

    public function validate_user()
    {
        $this->load->library('form_validation');

        $config = array(
            array(
                'field'   => 'username',
                'label'   => '用户名',
                'rules'   => 'required'
            ),

            array(
                'field'   => 'password',
                'label'   => '密码',
                'rules'   => 'required'
            )

        );

        $this->form_validation->set_rules($config);
        #$this->form_validation->set_error_delimiters('<div class="alert alert-error">
         #       <a href="#" class="close" data-dismiss="alert">&times;</a>','</div>');
        $this->form_validation->set_message('required', '%s 不能为空');

        if($this->form_validation->run())
        {
            if($this->User_model->validate_user())
            {
                $data = array(
                    'user_name' => $this->input->post('username'),
                    'privilege' => $this->User_model->get_user_privilege($this->input->post('username')),
                    'is_loged_in' => 1,
                    'group_id'    =>$this->User_model->get_group_id($this->input->post('username')) ,
                );
                $this->session->set_userdata($data);
                if($this->input->post('remmber')){
                $cookie = array(
                    'name'   => 'user_name',
                    'value'  => $this->input->post('username'),
                    'expire' => '8650000',
                    'domain' => 'localhost',
                    'path'   => '/',
                    'prefix' => 'myprefix_',
                    'secure' => TRUE
                );

                $this->input->set_cookie($cookie);
                }
                redirect('manage/user');
            }
            else
            {
                $this->session->set_userdata('error','用户名或者密码错误，请重试');
                $this->login();
               // redirect('manage/user/login');
            }

        }
        else
        {
            $this->session->set_userdata('error',validation_errors());
            $this->login();
           // redirect('manage/user/login');
        }
    }
	
	

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('manage/user/login');
    }
}