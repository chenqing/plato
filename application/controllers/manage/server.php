<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author qing.chen@chinacache.com
 * @desc	a CI controller index
 * @since 0.1
 * @date  2013-03-07
 */

class Server extends CI_Controller
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
        $this->load->model('Server_model');
        $this->load->library('pagination');
        $this->load->library('user_agent');
        $this->load->library('breadcrumb');
        $this->config->load('pagination');
        $this->load->helper('date');
        if( ! $this->session->userdata('is_loged_in') ){
            redirect(site_url('manage/index'));
        }
    }

    public function index()
    {
        $data['breadcrumb'] = $this->breadcrumb->get_name();
        $data['breadcrumb_link'] = $this->breadcrumb->get_link();
        //var_dump($this->breadcrumb->get_link());
        $this->load->view('manage/include/header',$data);
        $this->load->view('manage/include/navbar',$data);
        $this->load->view('manage/server');
        $this->load->view('manage/include/footer');
    }

    public function role()
    {
        $data['breadcrumb'] = $this->breadcrumb->get_name();
        $data['breadcrumb_link'] = $this->breadcrumb->get_link();
        //var_dump($this->breadcrumb->get_link());
        $this->load->view('manage/include/header',$data);
        $this->load->view('manage/include/navbar',$data);
        $this->load->view('manage/server_role');
        $this->load->view('manage/include/footer');
    }

    public function get_role_by_json()
    {
        $start = $this->input->post('rows');
        $offset = $this->input->post('page');
        if($this->input->post('sort')){ $sort = $this->input->post('sort');}else{ $sort = 'role_id';}
        if($this->input->post('order')){ $order = $this->input->post('order');}else{ $order = 'dsc';}
        if($this->input->post('role_name')){ $role_name = $this->input->post('role_name');}else{ $role_name = '';}
        echo $this->Server_model->get_role_by_json($start,$offset,$sort,$order,$role_name);
    }

    public function get_role_name_json()
    {
        echo $this->Server_model->get_role_name_json();
    }

    public function get_server_by_json()
    {
        $start = $this->input->post('rows');
        $offset = $this->input->post('page');
        if($this->input->post('sort')){ $sort = $this->input->post('sort');}else{ $sort = 'role_id';}
        if($this->input->post('order')){ $order = $this->input->post('order');}else{ $order = 'dsc';}
        if($this->input->post('server_name')){ $server_name = $this->input->post('server_name');}else{ $server_name = '';}
        echo $this->Server_model->get_server_by_json($start,$offset,$sort,$order,$server_name);
    }

    public function get_server_by_name()
    {
        $server_name = $this->input->post('server_name');
        echo $this->Server_model->get_server_by_name($server_name);
    }

    public function role_add()
    {
        $data['role_name'] = $this->input->post('role_name');
        $data['role_desc'] = $this->input->post('role_desc');
        if($this->Server_model->role_exits($data['role_name'])){
            echo json_encode(
                array(
                    'success' => false,
                    'msg' =>'角色已经存在',
                )
            );
            return;
        }
        if($this->Server_model->role_add($data)){

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

    public function role_edit()
    {
        $data['role_name'] = $this->input->post('role_name');
        $data['role_desc'] = $this->input->post('role_desc');
        $role_id = $this->input->post('role_id');
        if($this->Server_model->role_edit($role_id,$data)){
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

    public function role_delete()
    {
        $role_id = $this->input->post('ids');
        if($this->Server_model->role_delete($role_id)){
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

    public function server_add()
    {
        $data['role_id'] = $this->input->post('role_id');
        $data['server_desc'] = $this->input->post('server_desc');
        $data['server_name'] = $this->input->post('server_name');
        $data['server_ip'] = $this->input->post('server_ip');
        $data['node_id'] = $this->input->post('node_id');
        $data['is_active'] = $this->input->post('is_active');
        if($this->Server_model->server_exits($data['server_name'])){
            echo json_encode(
                array(
                    'success' => false,
                    'msg' =>'server已经存在',
                )
            );
            return;
        }
        if($this->Server_model->server_add($data)){

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

    public function server_edit()
    {
        $data['role_id'] = $this->input->post('role_id');
        $data['server_name'] = $this->input->post('server_name');
        $data['server_ip'] = $this->input->post('server_ip');
        $data['node_id'] = $this->input->post('node_id');
        $data['is_active'] = $this->input->post('is_active');
        $data['server_desc'] = $this->input->post('server_desc');
        $server_id = $this->input->post('server_id');
        if($this->Server_model->server_edit($server_id,$data)){
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

    public function bat_add()
    {
       $server = explode("\n",$this->input->post("batserver"));
        $i = 0 ;
       foreach($server as $v){
           $i++;
           $v = explode(',',$v);
           if(count($v) != 6){
               echo json_encode(
                   array(
                       'success' =>false,
                       'msg' => "第".$i."行格式不正确"
                   )
               );
               return;
           }
           if(! $this->Node_model->get_node_id($v[0])){
               echo json_encode(
                   array(
                       'success' =>false,
                       'msg' =>"第".$i."行输入节点不存在",
                   )
               );
               return;
           }

           if($this->Server_model->server_exits($v[1])){

               echo json_encode(
                   array(
                       'success' =>false,
                       'msg' =>"第".$i."行输入主机已经存在",
                   )
               );
               return;
           }

           if(count(explode('-',$v[1])) != 4){
               echo json_encode(
                   array(
                       'success' =>false,
                       'msg' =>"第".$i."行输入主机格式不正确",
                   )
               );
               return;
           }

           if(!preg_match('/[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}/',$v[2])){
               echo json_encode(
                   array(
                       'success' =>false,
                       'msg' =>"第".$i."行ip格式不正确",
                   )
               );
               return;
           }
           if(! $this->Server_model->get_role_id($v[3])){
               echo json_encode(
                   array(
                       'success' =>false,
                       'msg' =>"第".$i."行角色不存在",
                   )
               );
               return;
           }

           if(!in_array($v[4],array('0','1'))){
               echo json_encode(
                   array(
                       'success' =>false,
                       'msg' =>"第".$i."行 是否服务格式 不正确，只能是0或者1",
                   )
               );
               return;
           }

           $data['node_id'] = $this->Node_model->get_node_id($v[0]);
           $data['server_name'] = $v[1];
           $data['server_ip'] = $v[2];
           $data['role_id']    = $this->Server_model->get_role_id($v[3]);
           $data['is_active']  = $v[4];
           $data['server_desc'] = $v[5];

           if(!$this->Server_model->server_add($data)){
                return ;
           }

       }

        echo json_encode(
            array(
                'success' => true,
                'msg' =>'批量添加成功',
            )
        );
    }


}