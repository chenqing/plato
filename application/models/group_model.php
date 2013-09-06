<?php
    /**
     *
     */

class Group_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function all_group($num,$offset)
    {
        $query = $this->db->get('group',$num,$offset);

        return $query->result();
    }

    public function group_exits($group)
    {
        $this->db->where('group_name',$group);
        $query = $this->db->get('group');
        if($query->num_rows()>0)
        {
            echo 1;
        }
    }

    public function get_group_json()
    {
        $this->db->select('group_id,group_name');
        $query = $this->db->get('group');
        return json_encode($query->result_array());
    }

    public function group_add($data)
    {
        $this->db->insert('group',$data);

        if($this->db->affected_rows() == 1 )
            return true;
        else
            return false;
    }

    public function group_edit($data)
    {
            $this->db->where('group_id',$this->uri->segment(4));
            $this->db->update('group',$data);
            if($this->db->affected_rows() == 1)
                return true;
            else
                return false;
    }

    public function get_group_name($id)
    {

        $this->db->select('group_name,group_desc');
        $this->db->where('group_id',$id);
        $query = $this->db->get('group');

        return $query->result_array();

    }




    public function get_group_name_by_id($id)
    {
        $this->db->where('group_id',$id);
        $query = $this->db->get('group');


        foreach ($query->result() as $group)
        {
            return $group->group_name;
        }

    }

    public function group_delete($id)
    {
        $this->db->where('group_id',$id);
        $this->db->delete('group');
        if($this->db->affected_rows() == 1)
            echo 1;
        else
            echo 0;
    }
}