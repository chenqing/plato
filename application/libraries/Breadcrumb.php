<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * User: chenqing
 * Date: 13-7-20
 * Time: 下午2:05
 * Desc : 后台的面包屑导航的一个自定义类库
 */

class breadcrumb
{
    private  $node = array(
        'group' => '用户组管理',
        'user'  => '用户管理',
        'node'  => '节点管理',
        'server' => '服务器管理',
        'other'  => '其它',
        'index'  => '首页',
        'relationship' =>'设备关系管理',
        'pbl' => 'PBL网络管理',
        'pic' => '流量图管理',
        'cabinet' => '机柜管理',
        'avatar' => '批量运行'
    );
    protected $CI;

    public function __construct()
    {

        $this->CI =& get_instance();
        $this->CI->load->helper('url');
    }

    public function get_name()
    {
        if($index = $this->CI->uri->segment(2)){

            if(array_key_exists($index,$this->node)){

                return $this->node[$index] ;
            }
        }

        if( ! $this->CI->uri->segment(2)){
            return $this->node['index'];
        }

        return false ;

    }

    public function get_link()
    {
         if($this->CI->uri->segment(2))
         {
             return $this->CI->uri->segment(2) ;
         }

        return false ;
    }

}