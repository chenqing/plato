<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Server_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Node_model');
    }

    public function get_server_by_json($start,$offset,$sort,$order,$server_name)
    {
        if(($offset -1) <0){
            $off = 0 ;
        }else{
            $off = ($offset -1) * $start ;
        }
        $this->db->order_by($sort,$order);
        if(!empty($server_name)){
            $this->db->like('server_name',$server_name);
        }
        $query = $this->db->get('server',$start ,$off);
        $server = array();
        foreach($query->result_array() as $s){
            $role_name = $this->get_role_name($s['role_id']);
            $node_name = $this->Node_model->get_node_name($s['node_id']);
            $s['role_name'] = $role_name;
            $s['node_name'] = $node_name;
            array_push($server,$s);
        }

        $result["total"] = $this->db->count_all('server');
        $result['rows'] = $server;
        return json_encode($result);
    }

    public function get_all_servers()
    {
        $this->db->select('server_id,server_name');
        $query = $this->db->get('server');
        return $query->result();
    }

    public function get_server_by_name($server_name)
    {
        $this->db->select('server_id,server_name');
        if(!empty($server_name)){
            $this->db->like('server_name',$server_name);
        }
        $query = $this->db->get('server');
        $v = "";
        foreach($query->result() as $s){
            $v.="<option value='".$s->server_id."'>".$s->server_name.'</option>';
        }

        return $v;
    }
    public function get_server_by_node_name($node_name)
    {
        $node_id = $this->Node_model->get_node_id($node_name);

        if($node_id){
            $this->db->select('server_id,node_id,server_name');
            $this->db->where('node_id',$node_id);
            $query = $this->db->get('server');
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function get_server_by_id($server_id)
    {
        $this->db->select('server_id,server_name');
        $this->db->where('server_id',$server_id);
        $query = $this->db->get('server');
        foreach($query->result() as $v){

            return $v->server_name;
        }

    }

    public function get_role_by_json($start,$offset,$sort,$order,$role_name)
    {
        if(($offset -1) <0){
            $off = 0 ;
        }else{
            $off = ($offset -1) * $start ;
        }
        $this->db->order_by($sort,$order);
        if(!empty($role_name)){
            $this->db->like('role_name',$role_name);
        }
        $query = $this->db->get('server_role',$start ,$off);

        $result["total"] = $this->db->count_all('server_role');
        $result['rows'] = $query->result_array();
        return json_encode($result);
    }

    public function get_role_name_json()
    {
        $this->db->select('role_id,role_name');
        $query = $this->db->get('server_role');
        return json_encode($query->result_array());
    }

    public function get_role_name($role_id)
    {
        $this->db->where('role_id',$role_id);
        $this->db->select('role_name');
        $query = $this->db->get('server_role');
        foreach($query->result_array() as $v){
            return $v['role_name'];
        }
    }


    public function get_role_id($role_name)
    {
        $this->db->where('role_name',$role_name);
        $query = $this->db->get('server_role');
        if($query->result_array()){
        foreach($query->result_array() as $v){
            return $v['role_id'];
            }
        }
        return false ;
    }

    public function get_role_id_by_server($server_id)
    {
        $this->db->where('server_id',$server_id);
        $this->db->select('role_id');
        $query = $this->db->get('server');
        if($query->result_array()){
            foreach($query->result_array() as $v){
                return $v['role_id'];
            }
        }
        return false ;
    }


    public function get_role_name_by_server($server_id)
    {
        return $this->get_role_name($this->get_role_id_by_server($server_id));
    }




    public function role_add($data)
    {
        $this->db->insert('server_role',$data);
        if($this->db->affected_rows() >0){
            return true;
        }

        return false;
    }

    public function role_exits($role_name)
    {

        $this->db->where('role_name',$role_name);
        $query = $this->db->get('server_role');
        if($this->db->affected_rows() >0){
            return true;
        }else{
            return false;
        }
    }

    public function role_edit($role_id,$data)
    {

         $this->db->where('role_id',$role_id);
         $this->db->update('server_role',$data);

        if($this->db->affected_rows() == 1){
            return true;
        }

        return false ;
    }

    public function role_delete($role_id)
    {
        $role_id = explode(',',$role_id);
        if(count($role_id) >0){
            foreach($role_id as $r ){
                $this->db->where('role_id',$r);
                $this->db->delete('server_role');
            }
        }
        if($this->db->affected_rows() >= 1){
            return true;
        }

        return false ;
    }

    public function server_exits($server_name)
    {

        $this->db->where('server_name',$server_name);
        $query = $this->db->get('server');
        if($this->db->affected_rows() >0){
            return true;
        }else{
            return false;
        }
    }

    public function server_add($data)
    {
        $this->db->insert('server',$data);
        if($this->db->affected_rows() >0){
            return true;
        }

        return false;
    }

    public function server_edit($server_id,$data)
    {

        $this->db->where('server_id',$server_id);
        $this->db->update('server',$data);

        if($this->db->affected_rows() == 1){
            return true;
        }

        return false ;
    }

    public function is_fscs($id){
        $role_id = $this->get_role_id_by_server($id);
        if($this->get_role_name($role_id) == "FSCS")
            return true;

        return false;

    }

    public function is_fc($id){
        $role_id = $this->get_role_id_by_server($id);
        if($this->get_role_name($role_id) == "FC"){
            return true;
        }else{

        return false;
        }

    }


}