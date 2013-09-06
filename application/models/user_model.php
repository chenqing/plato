<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author chenqing
 */

class User_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    public function all_user($start,$offset)
    {
        $query = $this->db->get('user',$start ,$offset);
        return $query->result();
    }



    public function get_all_user()
    {
        $query = $this->db->get('user');
        return $query->result();
    }

    public function test_json($start,$offset,$sort,$order,$user_name)
    {
        if(($offset -1) <0){
            $off = 0 ;
        }else{
            $off = ($offset -1) * $start ;
        }
        if(!empty($user_name)){
            $this->db->like('user_name',$user_name);
        }
        $this->db->order_by($sort,$order);
        $query = $this->db->get('user',$start ,$off);
        $users = array();
        foreach($query->result_array() as $user){
                $group_name = $this->Group_model->get_group_name($user['group_id']);
                $user['group_name'] = $group_name;
                array_push($users,$user);
        }
        $result["total"] = $this->db->count_all('user');
        $result['rows'] = $users;
        return json_encode($result);
    }



    public function get_all_user_json()
    {
        $this->db->select('user_id,user_name');
        $query = $this->db->get('user');
       // $result["total"] = $this->db->count_all('user');
        //$result['rows'] = $query->result_array();
        return json_encode($query->result_array());
    }



    public function get_user_by_name($name)
	{
		$this->db->where('user_name',$name);
		return $this->db->get('user');
	}
	
	public function get_user_by_id($id)
	{
        $this->db->select('user_id, group_id,user_name,user_privilege,last_login,is_active ');
        $this->db->where('user_id',$id);
		$query = $this->db->get('user');
        return $query->result_array();
	}

    public function get_password_by_id($id)
    {
        $this->db->select('user_password');
        $this->db->where('user_id',$id);
        $query = $this->db->get('user');
        foreach($query->result() as $user){
            return $user->user_password;
        }
    }

    public function change_password($id,$password)
    {
        $data = array('user_password' => $password);
        $this->db->where('user_id',$id);
        $this->db->update('user',$data);
        if ($this->db->affected_rows() == 1 )
        {
           return true;
        }

        return false ;

    }
    public function get_group_id($user_name)
    {
        $this->db->select('group_id');
        $this->db->where('user_name',$user_name);
        $query = $this->db->get('user');
        foreach($query->result() as $group){
            return $group->group_id;
        }

    }

    public function get_user_id($user_name)
    {
        $this->db->select('user_id');
        $this->db->where('user_name',$user_name);
        $query = $this->db->get('user');
        foreach($query->result() as $user){
            return $user->user_id;
        }

    }
	public function add_user($data)
	{
		$this->db->insert('user',$data);
		
		 if ($this->db->affected_rows() == 1 )
         {
             echo 1 ;
         }else
         {
             echo 0 ;
         }

	}

    public function validate_password($password,$id)
    {
        $this->db->where('user_id',$id);
        $this->db->where('user_password',$password);
        $query = $this->db->get('user');
        if($query->num_rows() == 1){
            return true;
        }

        return false ;
    }

    public function get_user_privilege($data)
    {
        #$this->db->select('user_privilege');
        $this->db->where('user_name',$data);
        $query = $this->db->get('user');

        foreach($query->result() as $p)
        return $p->user_privilege;
    }

    public function validate_user()
    {
        $this->db->where('user_name',$this->input->post('username'));
        $this->db->where('user_password',sha1($this->input->post('password')));
        $query = $this->db->get('user');

        return ($query->num_rows() == 1)?true:false;
    }
	
	public function  delete_user($id)
	{
		$this->db->where('user_id',$id);
		$this->db->delete('user');
        if($this->db->affected_rows() == 1 ){
            return true;
        }else{
            return false;
        }
	}
	
	public function update_user($data,$id)
	{
		$this->db->where('user_id',$id);
		$this->db->update('user',$data);
        if($this->db->affected_rows() == 1 ){
            return true;
        }else{
            return false;
        }
	}
	
	public function get_group()
	{
		$query = $this->db->get('group');
        return $query->result();
	}
	
	
	

}