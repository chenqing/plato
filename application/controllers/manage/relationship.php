<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author qing.chen@chinacache.com
 * @desc	a CI controller manage oic
 * @since 0.1
 * @date  2013-07-08
 */

class Relationship extends CI_Controller
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
        $this->load->model('Relationship_model');
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
        $this->load->view('manage/relationship_list');
        $this->load->view('manage/include/footer');
    }

    public function add()
    {
        $data['breadcrumb'] = $this->breadcrumb->get_name();
        $data['breadcrumb_link'] = $this->breadcrumb->get_link();
        //var_dump($this->breadcrumb->get_link());
        $this->load->view('manage/include/header',$data);
        $this->load->view('manage/include/navbar',$data);
        $this->load->view('manage/relationship');
        $this->load->view('manage/include/footer');
    }
    public function relationship_list()
    {
        $config['base_url'] = site_url('manage/relationship/relationship_list');
        $config['total_rows'] = $this->db->count_all('relationship_real');
        $config['per_page'] = 5;
        $config['uri_segment'] = 4;

        $this->pagination->initialize($config);
        $data['links'] = $this->pagination->create_links();
        $data['relationship_real'] = $this->Relationship_model->all_relationship_real($config['per_page'],$this->uri->segment(4));
        $data['breadcrumb'] = $this->breadcrumb->get_name();
        $data['breadcrumb_link'] = $this->breadcrumb->get_link();
        $this->load->view('manage/include/header',$data);
        $this->load->view('manage/include/navbar',$data);
        $this->load->view('manage/relationship_list_1',$data);
        $this->load->view('manage/include/footer');
    }
    public function get_relationship_by_json()
    {
        $start = $this->input->post('rows');
        $offset = $this->input->post('page');
        if($this->input->post('sort')){ $sort = $this->input->post('sort');}else{ $sort = 'group_id';}
        if($this->input->post('order')){ $order = $this->input->post('order');}else{ $order = 'dsc';}
        if($this->input->post('group_name')){ $node_name = $this->input->post('group_name');}else{ $group_name = '';}
        echo $this->Relationship_model->get_relationship_by_json($start,$offset,$sort,$order,$group_name);
    }

    public function get_select_server()
    {
        $group_id = $this->uri->segment(4);
        echo $this->Relationship_model->get_select_server($group_id);

    }

    public function group_add()
    {
        $data['node_id'] = $this->input->post('node_id');
        $data['group_name'] = $this->input->post('group_name');
        $data['group_desc'] = $this->input->post('group_desc');
        if($this->Relationship_model->group_exits($data['group_name'])){
            echo json_encode(
                array(
                    'success' => false,
                    'msg' =>'设备组已经存在',
                )
            );
            return;
        }
        if($this->Relationship_model->group_add($data)){

            echo json_encode(
                array(
                    'success' => true,
                    'msg' =>'添加成功',
                )
            );
        }else{
            echo json_encode(
                array(
                    'success' =>false,
                    'msg' =>'添加失败',
                )
            );
        }
    }


    public function get_group_by_json()
    {
        $node_id = $this->uri->segment(4);

        echo json_encode($this->Relationship_model->get_group_by_json($node_id));
    }

    public function group_edit()
    {
        $data['node_id'] = $this->input->post('node_id');
        $data['group_name'] = $this->input->post('group_name');
        $data['group_desc'] = $this->input->post('group_desc');
        $group_id = $this->input->post('group_id');
        if($this->Relationship_model->group_edit($group_id,$data)){
            echo json_encode(
                array(
                    'success' => true,
                    'msg' =>'编辑成功',
                )
            );
        }else{
            echo json_encode(
                array(
                    'success' =>false,
                    'msg' =>'编辑失败',
                )
            );
        }
    }

    public function group_delete()
    {
        $group_id = $this->input->post('ids');
        if($this->Relationship_model->group_delete($group_id)){
            echo json_encode(
                array(
                    'success' => true,
                    'msg' =>'删除成功',
                )
            );
        }else{
            echo json_encode(
                array(
                    'success' =>false,
                    'msg' =>'删除失败',
                )
            );
        }
    }

    public function rec_add()
    {
        $server_ids = $this->input->post('server_ids');
        if(is_array($server_ids)){
            $data['server_ids'] = implode(',',$server_ids);
        }else{
            $data['server_ids'] = $server_ids;
        }
        $data['group_id'] = $this->input->post('group_id');

        if($this->Relationship_model->rec_add($data)){

            echo json_encode(
                array(
                    'success' => true,
                    'msg' =>'添加成功',
                )
            );
        }else{
            echo json_encode(
                array(
                    'success' =>false,
                    'msg' =>'添加失败',
                )
            );
        }
    }



    public function rec_edit()
    {
        $server_ids = $this->input->post('server_ids');
        if(is_array($server_ids)){
            $data['server_ids'] = implode(',',$server_ids);
        }else{
            $data['server_ids'] = $server_ids;
        }
        $real_id = $this->input->post('real_id');

        if($this->Relationship_model->rec_edit($real_id,$data)){

            echo json_encode(
                array(
                    'success' => true,
                    'msg' =>'添加成功',
                )
            );
        }else{
            echo json_encode(
                array(
                    'success' =>false,
                    'msg' =>'添加失败',
                )
            );
        }
    }

    public function get_tuopu_server()
    {
        $real_id = $this->uri->segment(4);

        echo json_encode($this->Relationship_model->get_tuopu_server($real_id));
    }

}