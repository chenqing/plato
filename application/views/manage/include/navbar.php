
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

                            <a  class=" fancybox btn btn-small btn-inverse" style="color: #ffffff;" href="#login1"> 登陆 </a>
                            <script>
                            window.history.forward(1);
                            </script>

                        <?php }?>
                    </p>
                    <ul class="nav">
                        <li   class="active"><a  id="index" href="<?php echo base_url('manage/') ;?>">首页</a></li>

                        <li><a id="node"  href="<?php echo base_url('manage/node') ;?>">节点管理</a></li>
                        <li><a  href="<?php echo base_url('manage/cabinet') ;?>">机柜管理</a></li>
                        <li><a href="<?php echo base_url('manage/server') ;?>">设备管理</a></li>
                        <li><a href="<?php echo base_url('manage/relationship') ;?>">设备关系管理</a></li>
                        <li><a href="<?php echo base_url('manage/avatar') ;?>">批量运行</a></li>
                        <li><a href="<?php echo base_url('manage/pbl') ;?>">网络管理</a></li>
                        <?php if($this->permission->is_operation() || $this->permission->is_root()  ){ ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">用户管理<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url('manage/user');?>"><span class="icon-user"></span> 用户管理  </a></li>
                                <li><a href="<?php echo base_url('manage/group');?>"><span class="icon-user"></span> 用户组管理</a></li>
                                <li><a href="<?php echo base_url('manage/group');?>"><span class="icon-user"></span> 日志管理</a></li>
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
    <script type="text/javascript">
        $(document).ready(function() {
            //node click
            var to_url ;
            <?php if(!$this->session->userdata('is_loged_in')){ ?>
            $('ul.nav li a').not('#index').click(function(){
                $(this).addClass('fancybox');
                to_url = $(this).attr('href');
                $(this).attr('href','#login1');

            });

            <?php } ?>
            $(".fancybox").fancybox({
                'hideOnContentClick': true,
                openEffect  : 'none',
                closeEffect	: 'none',
                helpers: {

                    overlay : {
                        opacity:'0.6',
                        closeClick : true,  // if true, fancyBox will be closed when user clicks on the overlay
                        speedOut   : 200,   // duration of fadeOut animation
                        showEarly  : true,  // indicates if should be opened immediately or wait until the content is ready
                       // css        : {'backgroundColor':'#000000'},    // custom CSS properties
                        locked     : false   // if true, the content will be locked into overlay
                    }
                }

            });
            $('form#login1').submit(function(event){
                event.preventDefault();
                var user = $('#user').val();
                var pass = $('#pass').val();
                var url = 'http://'+location.host+'/manage/user/validate_user';
                if(user.length <3){
                    $('#user_error').empty().html('   太短了');
                    $('input[name="user"]').focus()
                    return false;
                }
                if(pass.length <6){
                    $('#pass_error').empty().html(' 密码这么短？');
                    $('input[name="pass"]').focus()
                    return false;
                }
                $.post(
                    url,
                    {'username':user,'password':pass},
                    function(data){
                        if(data == 'ok'){
                            $.fancybox.close();
                            if(to_url){
                                window.location.href=to_url;
                            }else{
                                window.location.href='http://'+location.host+'/manage';

                            }
                        }else{
                            $('#pass_error').empty();
                            $('#user_error').empty();
                            $('.login-error').html('用户名或者密码错误').fadeIn();;
                        }
                    }

                );
            });
        });
    </script>




    <!-- container start -->
<div class="container">


    <div class="row">
        <ul class="breadcrumb">
            <li><a href="#">柏拉图</a> <span class="divider">/</span></li>
            <li><a href="<?php echo $breadcrumb_link; ?>"><?php echo $breadcrumb; ?></a> <span class="divider">/</span></li>

        </ul>
