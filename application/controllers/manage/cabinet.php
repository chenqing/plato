<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author chenqing663@foxmail.com
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
        $this->config->load('pagination');

    }

    public function index()
    {
        if( ! $this->session->userdata('is_loged_in') ){
            redirect(site_url('manage/index'));
        }
        $config['base_url'] = site_url('manage/cabinet/index/');
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

    public function get_cabinet_by_node()
    {
        $node_name = $this->uri->segment(4);
        $node_ids = $this->Node_model->get_node_id_like_node_name($node_name);
        $rows = array();
        foreach($node_ids as $n){
            if($this->Cabinet_model->get_cabinet_by_node_id($n['node_id'])){
                if(is_array($this->Cabinet_model->get_cabinet_by_node_id($n['node_id']))){
                    foreach($this->Cabinet_model->get_cabinet_by_node_id($n['node_id']) as $c){
                        array_push($rows,$c);
                    }

                }else{
                     array_push($rows,$this->Cabinet_model->get_cabinet_by_node_id($n['node_id']));
                }
            }
        }

       $result = array();
        foreach($rows as $r)
        {
            $r['node_name'] = $this->Node_model->get_node_name($r['node_id']);
            array_push($result,$r);
        }

        echo json_encode($result);
    }

    public function get_server_by_node_name()
    {
        $node_name = trim($this->uri->segment(4));
        if($arr = $this->Server_model->get_server_by_node_name($node_name))
        {
            echo json_encode($arr);
        }else{
            echo 0 ;
        }
    }

    public function get_server_by_cabinet_id()
    {
        $cab_id = trim($this->uri->segment(4));
        $server_ids = $this->Cabinet_model->get_server_by_cab_id($cab_id);
        if(empty($server_ids)){
            echo 0;
            return false;
        }
        $server_ids = explode(',',$server_ids);
        $result =array();
        if(is_array($server_ids) && count($server_ids) >0){
            foreach($server_ids as $s){
                array_push($result,array('server_id' =>$s,
                                          'server_name' => $this->Server_model->get_server_by_id($s),
                                          'server_role' => $this->Server_model->get_role_name_by_server($s)
                    ));
            }
            echo json_encode($result);
        }else{
            echo 0 ;
        }
    }

    public function add()
    {
        if( ! $this->session->userdata('is_loged_in') ){
            redirect(site_url('manage/index'));
        }
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

        if( ! $this->session->userdata('is_loged_in') ){
            redirect(site_url('manage/index'));
        }
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

    /*
     * @Desc 检查是否已经存在了在机架里面
     * */
    public function get_dev_by_cab_id($cab_id)
    {
        $this->db->where('cab_id',$cab_id);
        $query = $this->db->get('cabinet_device');
        if($this->db->affected_rows() >0 ){
            return true;
        }else{
             return false;
        }
    }
    /*
     * @Desc 往机架里面添加devices，或者edit devices
     * @return json encode server_id and server_name or 0
     * */
    public function server_add_or_edit()
    {
        //获取post过来的数据
        $data['cab_id'] = $this->input->post('cab_id');
        $data['dev_list'] = $this->input->post('dev_list');
        if($this->get_dev_by_cab_id($this->input->post('cab_id'))){
           if($this->Cabinet_model->update_dev($data)){
              echo 1;
            }else{
               echo 0 ;
           }

        }else{
            if($this->Cabinet_model->add_dev($data)){
                echo 1;
            }else{
                echo 0 ;
            }
        }

    }

    public function cabinet_delete()
    {
        if( ! $this->session->userdata('is_loged_in') ){
            redirect(site_url('manage/index'));
        }
        $cab_id = $this->uri->segment(4);
        if($this->Cabinet_model->cabinet_delete($cab_id)){
            echo 1;
        }else{
            echo 0;
        }
    }


   }