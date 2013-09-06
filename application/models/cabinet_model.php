<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cabinet_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Node_model');
        $this->load->model('Server_model');
    }

    public function add($data)
    {
        $this->db->insert('cabinet',$data);
        if($this->db->affected_rows() >0){
            return true ;
        }
        return false ;

    }
    public function all_cabinet($start,$offset)
    {

        $query = $this->db->get('cabinet',$start ,$offset);
        return $query->result();
    }

    public function get_cabinet_by_id($cab_id)
    {
        $this->db->where('cab_id',$cab_id);
        $query = $this->db->get('cabinet');

        if($query){
            return $query->result_array();
        }else{
            return false ;
        }
    }

    public function get_cabinet_by_node_id($node_id)
    {
        $this->db->where('node_id',$node_id);
        $query = $this->db->get('cabinet');

        if($query){
            return $query->result_array();
        }else{
            return false ;
        }
    }

    public function get_server_by_cab_id($cab_id)
    {
        if(is_numeric($cab_id)){
            $this->db->select('dev_list');
            $this->db->where('cab_id',$cab_id);
            $query = $this->db->get('cabinet_device');
            foreach($query->result() as $r){
              return $r->dev_list;
            }
        }
    }

    public function edit($cab_id,$data)
    {
        $this->db->where('cab_id',$cab_id);
        $this->db->update('cabinet',$data);
        if($this->db->affected_rows() > 0 ){
            return true ;
        }
        return false ;
    }

    public function add_dev($data)
    {
        $this->db->insert('cabinet_device',$data);
        if($this->db->affected_rows() == 1){
            return true;
        }
        return false;
    }

    public function update_dev($data)
    {
        $this->db->where('cab_id',$data['cab_id']);
        $this->db->update('cabinet_device',$data);
        if($this->db->affected_rows() == 1){
            return true;
        }
        return false;
    }

    private function cabinet_dev_delete($cab_id)
    {
        $this->db->where('cab_id',$cab_id);
        $this->db->delete('cabinet_device');

    }

    private function get_cabinet_dev_by_id($cab_id)
    {
        $this->db->where('cab_id',$cab_id);
        $query = $this->db->get('cabinet_device');

        if($query){
            return $query->result_array();
        }else{
            return false ;
        }
    }

    public function cabinet_delete($cab_id){
        //删除的时候，注意要把cabinet_device 表里面的也删除掉
        if($this->get_cabinet_dev_by_id($cab_id)){
            $this->cabinet_dev_delete($cab_id);
        }


        $this->db->where('cab_id',$cab_id);
        $q1 = $this->db->delete('cabinet');
         if($q1){
                return true;
         }else{
                return false;
         }
    }
}