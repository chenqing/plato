<?php
/**
 * Created by JetBrains PhpStorm.
 * User: chenqing
 * Date: 13-3-16
 * Time: 上午11:33
 * To change this template use File | Settings | File Templates.
 */

class Not_found extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('not_found');
    }
}