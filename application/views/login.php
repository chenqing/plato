<style>


    .form-signin {
        #max-width: 500px;
        #padding: 2px 2px 2px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        -webkit-box-shadow: 1 1px 3px rgba(0,0,0,.05);
        -moz-box-shadow: 1 1px 3px rgba(0,0,0,.05);
        box-shadow: 1 1px 2px rgba(0,0,0,.05);
    }
    
    body {
        #background: url("<?php echo base_url('assets/img/bg.jpg'); ?>") repeat-x left center;
        background: url("http://css.tudouui.com/skin/__g/img/ui/bg/whiteBg.png") repeat left center;
        background-color: #000;
        overflow: hidden;
    }



</style>
<div class="container">
    <div class="row-fluid">
        <div class="span3">

        </div>

        <div class="  span6">

            <?php
                if($this->session->userdata('error'))
                {
                    echo '<div class="alert alert-error"><a href="#" class="close" data-dismiss="alert">&times;</a>';
                    echo $this->session->userdata('error');
                    echo '</div>';
                }
            ?>
            <form class="form-horizontal form-signin" action="validate_user" method="post">
                <fieldset>
                    <div >
                        <legend  class="text-center" style="color:#075d9f;">欢迎登陆 </legend>
                    </div>
                    <div class="control-group">

                        <!-- Text input-->
                        <label class="control-label" for="username">用户名</label>
                        <div class="controls">
                            <input type="text" placeholder="your username here..." class="input" name="username"
                                value="<?php echo set_value('username'); ?>">
                        </div>
                    </div>

                    <div class="control-group">

                        <!-- Text input-->
                        <label class="control-label" for="password">密码</label>
                        <div class="controls">
                            <input type="password" placeholder="your password" class="input" name="password">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label"></label>
                        <div class="controls">
                            <!-- Multiple Checkboxes -->
                            <label class="checkbox">
                                <input type="checkbox" value="remember me" name="remmeber">
                                remember me
                            </label>
                        </div>

                    </div>

                    <div class="control-group">
                        <label class="control-label"></label>

                        <!-- Button -->
                        <div class="controls">
                            <button class="btn btn-primary ">登陆</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<span class="text-right">
                                <a  rel="tooltip" href="#" data-toggle="tooltip"  data-placement="right"
                                    title="" data-original-title="亲，那就去cpis-opt吼一声呢">
                                    &nbsp忘记密码？
                                </a>
                            </span>
                        </div>
                    </div>

                </fieldset>
            </form>

        </div>

        <div class="span1">
            &nbsp
        </div>
    </div>

</div>
<!-- end of container -->
<div id="push"></div>