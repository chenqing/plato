<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author qing.chen@chinacache.com
 * @desc	a CI controller manage cabinet
 * @since 0.1
 * @date  2013-07-08
 */

class Cabinet extends CI_Controller
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
        $this->load->model('Server_model');
        $this->load->model('Node_model');
        $this->load->model('Cabinet_model');
        $this->load->library('pagination');
        $this->load->library('user_agent');
        $this->load->library('breadcrumb');
        $this->load->library('permission');
        $this->config->load('pagination');
        $this->load->helper('date');

    }

    public function index()
    {
        $config['base_url'] = site_url('manage/abinet/index/');
        $config['total_rows'] = $this->db->count_all('cabinet');
        $config['per_page'] = 5;
        $config['uri_segment'] = 4;
        $this->pagination->initialize($config);
        $data['cabinet'] = $this->Cabinet_model->all_cabinet($config['per_page'],$this->uri->segment(4));
        $data['links'] = $this->pagination->create_links();
        $data['breadcrumb'] = $this->breadcrumb->get_name();
        $data['breadcrumb_link'] = $this->breadcrumb->get_link();
        //var_dump($this->breadcrumb->get_link());
        $this->load->view('manage/include/header',$data);
        $this->load->view('manage/include/navbar',$data);
        $this->load->view('manage/cabinet',$data);
        $this->load->view('manage/include/footer');
    }

    public function get_cabinet_by_id()
    {
        $cab_id = $this->uri->segment(4);
        if($this->Cabinet_model->get_cabinet_by_id($cab_id)){
            echo json_encode($this->Cabinet_model->get_cabinet_by_id($cab_id));
        }else{
            echo 0 ;
        }
    }

    public function add()
    {
        $data['cab_name'] = $this->input->post('cab_name');
        $data['node_id'] = $this->input->post('node_id');
        $data['cab_location'] = $this->input->post('cab_location');
        if($this->Cabinet_model->add($data)){
            echo 1 ;
        }else{
            echo 0 ;
        }


    }

    public function edit()
    {
        $cab_id = $this->uri->segment(4);
        $data['cab_name'] = $this->input->post('cab_name');
        $data['node_id'] = $this->input->post('node_id');
        $data['cab_location'] = $this->input->post('cab_location');
        if($this->Cabinet_model->edit($cab_id,$data)){
            echo 1 ;
        }else{
            echo 0 ;
        }


    }


   }