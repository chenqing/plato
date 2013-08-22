<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author qing.chen@chinacache.com
 * @desc	a CI controller index
 * @since 0.1
 * @date  2013-03-07
 */

class Node extends CI_Controller
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
        $this->load->model('Node_model');
        $this->load->library('pagination');
        $this->load->library('user_agent');
        $this->load->library('breadcrumb');
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
        $this->load->view('manage/node');
        $this->load->view('manage/include/footer');
    }

    public function get_node_by_json()
    {
        $start = $this->input->post('rows');
        $offset = $this->input->post('page');
        if($this->input->post('sort')){ $sort = $this->input->post('sort');}else{ $sort = 'node_id';}
        if($this->input->post('order')){ $order = $this->input->post('order');}else{ $order = 'dsc';}
        if($this->input->post('node_name')){ $node_name = $this->input->post('node_name');}else{ $node_name = '';}
        echo $this->Node_model->get_node_by_json($start,$offset,$sort,$order,$node_name);
    }

    public function get_node_name_json()
    {
        echo  $this->Node_model->get_node_name_json();
    }

    public function  get_node_name_api()
    {
        echo $this->Node_model->get_node_name_api();
    }

    public function get_parent_node_by_json()
    {
        echo $this->Node_model->get_parent_node_by_json();
    }

    public function add()
    {
        $data['node_name'] = $this->input->post('node_name');
        $data['node_desc'] = $this->input->post('node_desc');
        $data['node_role'] = $this->input->post('node_role');
        $data['node_parent_id'] = $this->input->post('node_parent_id');
        if($this->Node_model->node_exits($data['node_name'])){
            echo json_encode(
                array(
                    'success' => false,
                    'msg' =>'节点已经存在',
                )
            );
            return;
        }
        if($this->Node_model->add($data)){

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

    public function edit()
    {
        $data['node_name'] = $this->input->post('node_name');
        $data['node_desc'] = $this->input->post('node_desc');
        $data['node_role'] = $this->input->post('node_role');
        $data['node_parent_id'] = $this->input->post('node_parent_id');
        $node_id = $this->input->post('node_id');
        if($this->Node_model->edit($node_id,$data)){
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

    public function delete()
    {
        $node_ids = $this->input->post('ids');
        $node_id = explode(',',$node_ids);
        if($this->Node_model->delete($node_id)){
         echo    json_encode(array('success'=>'true','msg'=>'删除节点成功'));
        }else{
            echo    json_encode(array('success'=>'false','msg'=>'删除节点失败'));
        }
    }

}