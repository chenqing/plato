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

    public function edit($cab_id,$data)
    {
        $this->db->where('cab_id',$cab_id);
        $this->db->update('cabinet',$data);
        if($this->db->affected_rows() > 0 ){
            return true ;
        }
        return false ;
    }

}