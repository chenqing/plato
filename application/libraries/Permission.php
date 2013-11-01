<?php
/**
 * User: chenqing
 * Date: 13-7-27
 * Time: 下午2:00
 * Desc : 权限管理相关的一个类库
 */

class permission
{
    /*
     *	定义权限常量，利用位的与（&）验证用户是不是拥有该权限，利用位的或（|）来
     *	赋予用户一定的权限
     */

    const VISIT = 2 ; //默认的访客权限

    const CREATE = 4 ; //创建一个东西的权限

    const MODIFY = 8 ; //修改一个东西的权限

    const DELETE = 16 ; //删除一个东西的权限

    const STANDARD   =  32 ; // 标准权限，可以干一些自定义的事情

    protected $CI; //存储CI的核心变量

    protected $privilege ; //用户的权限值

    protected $group ;//用户所在的组

    public function __construct()
    {

        $this->CI =& get_instance();
        $this->CI->load->helper('url');
        $this->CI->load->library('session');
        $this->CI->load->model('Group_model');
    }

    /**
     * @return int|string
     * @Desc  获取回话中保存的权限
     */

    private function get_pri()
    {
        $pri = $this->CI->session->userdata('privilege');
        return (isset($pri) and is_numeric($pri)) ? $pri:2;
    }

    /**
     * @return string
     * @Desc 获取用户名
     */

    public function get_group()
    {
        $group_id = $this->CI->session->userdata('group_id');
        $name = $this->CI->Group_model->get_group_name($group_id);
        $group_name = (!empty($name))?$name:'guest';
        return $group_name ;
    }

    /**
     * @return bool
     */
    public function has_visit_permission()
    {
        if($this->get_pri() & permission::VISIT ){
            return true ;
        }

        return false ;

    }

    /**
     * @return bool
     */
    public function has_create_permission()
    {
        if($this->get_pri() & permission::CREATE ){
            return true ;
        }

        return false ;
    }

    public function has_edit_permission()
    {
        if($this->get_pri() & permission::MODIFY ){
            return true ;
        }

        return false ;
    }

    public function has_del_permission()
    {
        if($this->get_pri() & permission::DELETE ){
            return true ;
        }

        return false ;
    }


    public function has_standard_permission()
    {
        if($this->get_pri() & permission::STANDARD ){
            return true ;
        }

        return false ;
    }

    public function is_root()
    {
        if($this->get_group() == 'root'){
            return true ;
        }

        return false ;
    }

    public function is_operation()
    {
        if($this->get_group() == 'operation'){
            return true ;
        }

        return false ;
    }

    public function is_standard()
    {
        if($this->get_group() == 'standard'){
            return true ;
        }

        return false ;
    }

    public function is_guest()
    {
        if($this->get_group() == 'guest'){
            return true ;
        }

        return false ;
    }



}