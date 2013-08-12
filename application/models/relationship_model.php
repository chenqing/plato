<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Relationship_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Node_model');
    }

    public function get_relationship_by_json($start,$offset,$sort,$order,$group_name)
    {
        if(($offset -1) <0){
            $off = 0 ;
        }else{
            $off = ($offset -1) * $start ;
        }
        $this->db->order_by($sort,$order);
        if(!empty($group_name)){
            $this->db->like('group_name',$group_name);
        }
        $query = $this->db->get('relationship',$start ,$off);
        $relationship = array();
        foreach($query->result_array() as $s){
            $node_name = $this->Node_model->get_node_name($s['node_id']);
            $s['node_name'] = $node_name;
            array_push($relationship,$s);
        }

        $result["total"] = $this->db->count_all('relationship');
        $result['rows'] = $relationship;
        return json_encode($result['rows']);
    }


    public function group_add($data)
    {
        $this->db->insert('relationship',$data);
        if($this->db->affected_rows() >0){
            return true;
        }

        return false;
    }

    public function group_exits($group_name)
    {
        $this->db->where('group_name',$group_name);
        $query = $this->db->get('relationship');
        if($this->db->affected_rows() >0){
            return true;
        }else{
            return false;
        }
    }

    public function get_group_by_json($node_id)
    {
        $this->db->where('node_id',$node_id);
        $query = $this->db->get('relationship');
        $relationship = array();
        foreach($query->result_array() as $s){
            $node_name = $this->Node_model->get_node_name($s['node_id']);
            $s['node_name'] = $node_name;
            array_push($relationship,$s);
        }

        return $relationship;
    }


    public function group_edit($group_id,$data)
    {

        $this->db->where('group_id',$group_id);
        $this->db->update('relationship',$data);

        if($this->db->affected_rows() == 1){
            return true;
        }

        return false ;
    }

    public function group_delete($group_id)
    {
        $group_id = explode(',',$group_id);
        if(count($group_id) >0){
            foreach($group_id as $g ){
                $this->db->where('group_id',$g);
                $this->db->delete('relationship');
            }
        }
        if($this->db->affected_rows() >= 1){
            return true;
        }

        return false ;
    }



}