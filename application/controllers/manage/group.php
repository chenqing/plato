<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @desc 用来管理用户组的控制类
 * @date 2013-03-16
 * @name Group
 */

class Group extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Group_model');
        $this->load->library('pagination');
        $this->load->library('user_agent');
        $this->load->library('Breadcrumb');
        if( ! $this->session->userdata('is_loged_in') ){
            redirect(site_url('manage/index'));
        }
    }

    public function index()
    {
        $config['base_url'] = site_url('manage/group/index');
        $config['total_rows'] = $this->db->count_all('group');
        $config['per_page'] = 5;
        $config['uri_segment'] = 4;

        $this->pagination->initialize($config);
        $data['links'] = $this->pagination->create_links();
        $data['group'] = $this->Group_model->all_group($config['per_page'],$this->uri->segment(4));
        $data['breadcrumb'] = $this->breadcrumb->get_name();
        $data['breadcrumb_link'] = $this->breadcrumb->get_link();

        $this->load->view('manage/include/header');
        $this->load->view('manage/include/navbar',$data);
        $this->load->view('manage/group',$data);
        $this->load->view('manage/include/footer');

    }

    public function group_add()
    {
        $data['group_name'] = $this->input->post('group_name');
        $data['group_desc'] = $this->input->post('group_desc');
        if($this->input->is_ajax_request()){

           if($this->Group_model->group_add($data))
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
            redirect(base_url().'manage/group');
        }
    }

    public function group_exits()
    {
        echo $this->Group_model->group_exits($this->input->post('group_name'));
    }

    public function group_edit()
    {
        $data['group_name'] = $this->input->post('group_name');
        $data['group_desc'] = $this->input->post('group_desc');
        if($this->Group_model->group_edit($data))
            echo 1;
        else
            echo 0;


    }

    public function get_group_name()
    {
        echo json_encode($this->Group_model->get_group_name($this->uri->segment(4)));
    }

    public function group_delete()
    {
        if($this->Group_model->group_delete($this->uri->segment(4)))
            echo 1;
        else
            echo 0;
    }

    public function get_group_json()
    {
        echo $this->Group_model->get_group_json();
    }
}