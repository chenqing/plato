<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Relationship_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Node_model');
        $this->load->model('Server_model');
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

    public function all_relationship_real($num,$offset)
    {
        $query = $this->db->get('relationship_real',$num,$offset);

        return $query->result();
    }

    public function get_group_by_id($group_id)
    {
        $this->db->where('group_id',$group_id);
        $this->db->select('group_name,group_id');
        $query = $this->db->get('relationship');
        foreach($query->result() as $v){
            return $v->group_name;
        }
    }

    public function get_select_server($group_id)
    {
        $this->db->select('server_ids');
        $this->db->where('real_id',$group_id);
        $query = $this->db->get('relationship_real');
        $select = '';
        foreach($query->result() as $v){
            foreach(explode(',',$v->server_ids) as $s){
                 $select .= '<option value="'.$s .'">'.$this->Server_model->get_server_by_id($s) .'</option>';
            }

        }

        return $select;
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

    public function rec_add($data)
    {
        $this->db->insert('relationship_real',$data);
        if($this->db->affected_rows() >0){
            return true;
        }

        return false;
    }

    public function rec_edit($real_id,$data)
    {

        $this->db->where('real_id',$real_id);
        $this->db->update('relationship_real',$data);

        if($this->db->affected_rows() == 1){
            return true;
        }

        return false ;
    }

    public function get_tuopu_server($real_id)
    {
        $servers = array();
        $fscs = array();
        $fc = array();
        $this->db->select('server_ids');
        $this->db->where('real_id',$real_id);
        $query = $this->db->get('relationship_real');
        $tmp1 = array();
        $tmp2 = array();
        foreach($query->result() as $s )
        {
            foreach(explode(',',$s->server_ids) as $v){

                    if($this->Server_model->is_fscs($v)){

                        $tmp1['server_name'] = $this->Server_model->get_server_by_id($v);
                        array_push($fscs,$tmp1);
                    }else if($this->Server_model->is_fc($v)){
                        $tmp2['server_name'] = $this->Server_model->get_server_by_id($v);
                        array_push($fc,$tmp2);
                }
            }
        }

        $servers['fscs'] =$fscs;
        $servers['fc'] = $fc ;
        return $servers;
    }

    public function rec_check($group_id)
    {
        $this->db->where('group_id',$group_id);
        $query = $this->db->get('relationship_real');
        if($this->db->affected_rows() >= 1){
            return true;
        }

        return false ;
    }

    public function get_group_desc_by_id($group_id)
    {
        $this->db->select('group_desc');
        $this->db->where('group_id',$group_id);
        $query = $this->db->get('relationship');
        foreach ($query->result() as $v) {
            return $v->group_desc;
        }

    }

    public function get_group_api($group_name)
    {
        $this->db->select('group_name,group_desc');
        $this->db->like('group_name',$group_name);
        $query = $this->db->get('relationship');

        return $query->result_array();
    }

    public function get_relationship_api($group_name)
    {
        $servers = array();
        $fscs = array();
        $fc = array();
        $group_id = '';
        $this->db->select('group_id');
        $this->db->where('group_name',$group_name);
        $q  = $this->db->get('relationship');
        foreach($q->result() as $v){
            $group_id = $v->group_id;
        }
        $this->db->select('server_ids');
        $this->db->where('group_id',$group_id);
        $query = $this->db->get('relationship_real');
        $tmp1 = array();
        $tmp2 = array();
        foreach($query->result() as $s )
        {
            foreach(explode(',',$s->server_ids) as $v){

                if($this->Server_model->is_fscs($v)){

                    $tmp1['server_name'] = $this->Server_model->get_server_by_id($v);
                    array_push($fscs,$tmp1);
                }else if($this->Server_model->is_fc($v)){
                    $tmp2['server_name'] = $this->Server_model->get_server_by_id($v);
                    array_push($fc,$tmp2);
                }
            }
        }

        $servers['fscs'] =$fscs;
        $servers['fc'] = $fc ;
        return $servers;
    }


}