
    <!-- navbar start -->
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a href="#" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a href="/" class="brand"><img src="<?php echo base_url().'assets/img/logo.jpg'?>"   style="padding:0px; height: auto;" width=100px height=45px  alt=""></a>
                <div class="nav-collapse collapse">
                    <p class="navbar-text pull-right" >

                            <?php
                            if($this->session->userdata('user_name')) {
                            ?>
                        <span class=" icon-user  icon-white"></span> <a href="#" class="navbar-link" style="color: #FFFFFF;">
                            <?php
                                echo $this->session->userdata('user_name');
                            }
                              ?>
                      </a>&nbsp &nbsp
                        <?php
                        if($this->session->userdata('is_loged_in')){

                        echo '<a href="'.base_url('manage/user/logout').'" class="navbar-link" style="color: #FFFFFF;">登出</a>';
                        }else{
                            ?>

                            <a  class="btn btn-small btn-inverse" style="color: #ffffff;" href="<?php echo base_url('manage/user/login');?>"> 登陆 </a>

                        <?php }?>
                    </p>
                    <ul class="nav">
                        <li class="active"><a href="<?php echo base_url('manage/') ;?>">首页</a></li>

                        <li><a  href="<?php echo base_url('manage/node') ;?>">节点管理</a></li>
                        <li><a href="<?php echo base_url('manage/server') ;?>">设备管理</a></li>
                        <li><a href="<?php echo base_url('manage/relationship') ;?>">设备关系管理</a></li>
                        <li><a href="<?php echo base_url('manage/pic') ;?>">作图管理</a></li>
                        <li><a href="<?php echo base_url('manage/pbl') ;?>">PBL网络管理</a></li>
                        <?php if($this->permission->is_guest() ||$this->permission->is_root() ){ ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">用户管理<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url('manage/user');?>"><span class="icon-user"></span> User 管理  </a></li>
                                <li><a href="<?php echo base_url('manage/group');?>"><span class="icon-user"></span> Group 管理</a></li>
                                <li class="divider"></li>
                                <li class="nav-header">基于linux用户设计</li>
                            </ul>
                        </li>
                       <?php }?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<!-- navbar end -->

<!-- container start -->
<div class="container">

    <div class="row">
        <ul class="breadcrumb">
            <li><a href="#">柏拉图</a> <span class="divider">/</span></li>
            <li><a href="<?php echo $breadcrumb_link; ?>"><?php echo $breadcrumb; ?></a> <span class="divider">/</span></li>
            <li class="active">查看</li>
        </ul>