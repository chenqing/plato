<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Node_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_node_by_json($start,$offset,$sort,$order,$node_name)
    {
        if(($offset -1) <0){
            $off = 0 ;
        }else{
            $off = ($offset -1) * $start ;
        }
        $this->db->order_by($sort,$order);
        if(!empty($node_name)){
            $this->db->like('node_name',$node_name);
        }
        $query = $this->db->get('node',$start ,$off);
        $nodes = array();
        foreach($query->result_array() as $node){
            $node_name = $this->get_parent_node_name($node['node_parent_id']);
            $node['parent_node_name'] = $node_name;
            array_push($nodes,$node);
        }

        $result["total"] = $this->db->count_all('node');
        $result['rows'] = $nodes;
        return json_encode($result);
    }

    public function get_parent_node_name($node_parent_id)
    {
        $this->db->where('node_id',$node_parent_id);
        $query = $this->db->get('node');
        foreach($query->result() as $v){
            return $v->node_name;
        }
    }

    public function get_node_name($node_id)
    {
        $this->db->where('node_id',$node_id);
        $query = $this->db->get('node');
        foreach($query->result() as $v){
            return $v->node_name;
        }
    }

    public function get_node_name_api()
    {
        $query = $this->db->get('node');
        $node =array();
        foreach($query->result() as $v){
            array_push($node,$v->node_name);
        }
        return json_encode($node);
    }

    public function get_node_id($node_name)
    {
        $this->db->where('node_name',$node_name);
        $this->db->where('node_parent_id !=',0);
        $query = $this->db->get('node');
        if($query->result()){
            foreach($query->result() as $v){
                return $v->node_id;
            }
        }

        return false ;
    }


    public function get_node_name_json()
    {
        $this->db->select('node_id,node_name');
        $this->db->where('node_parent_id !=',0);
        $query = $this->db->get('node');
        return json_encode($query->result_array());
    }

    public function get_parent_node_by_json()
    {
        $this->db->where('node_parent_id',0);
        $this->db->select('node_id,node_name');
        $query = $this->db->get('node');
        $arr = $query->result_array();
        array_unshift($arr,array('node_id'=> 0,'node_name'=>'无'));

        return json_encode($arr);
    }

    public function get_child_node()
    {
        $this->db->select('node_id,node_name');
        $this->db->where('node_parent_id !=' , 0);
        $query = $this->db->get('node');
        return $query->result();
    }

    public function add($data)
    {
        $this->db->insert('node',$data);
        if($this->db->affected_rows() == 1){
            return true;
        }
        return false ;
    }

    public function edit($node_id,$data)
    {
        $this->db->where('node_id',$node_id);
        $this->db->update('node',$data);
        if($this->db->affected_rows() == 1){
            return true;
        }

        return false ;
    }

    public function delete($node_id)
    {
      $message = array();
       if(is_array($node_id)){
           foreach($node_id as $n){
                 $this->db->where('node_id',$n);
                  $this->db->delete('node');
           }
       }
        if($this->db->affected_rows() >= 1){
           return true ;
        }else{
            return false;
        }
    }

    public function node_exits($node_name)
    {
        $this->db->where('node_name',$node_name);
        $query = $this->db->get('node');
        if($this->db->affected_rows() >0){
            return true;
        }else{
            return false;
        }
    }
}