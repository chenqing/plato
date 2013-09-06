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
<a class="fancybox" href="#login" >Inline</a>
<script type="text/javascript">
    $(document).ready(function() {
        $(".fancybox").fancybox({
            'hideOnContentClick': true,
            openEffect  : 'none',
            closeEffect	: 'none',
            helpers: {

                overlay : {
                    closeClick : true,  // if true, fancyBox will be closed when user clicks on the overlay
                    speedOut   : 200,   // duration of fadeOut animation
                    showEarly  : true,  // indicates if should be opened immediately or wait until the content is ready
                    css        : {'backgroundColor':'#000000'},    // custom CSS properties
                    locked     : false   // if true, the content will be locked into overlay
                }
            }


        });
    });
</script>


    <form class="form-horizontal" style="display: none;  width: 380px;" id="login" >
                <fieldset>
                    <legend>登陆柏拉图</legend>
                    <label for="user" class="control-label" style="width: 60px;">用户名</label><span>&nbsp&nbsp&nbsp</span>
                <input type="text" id="user" placeholder="Email" name="user">
                 <p></p>
                    <label for="pass" class="control-label" style="width: 60px;">密码  </label><span>&nbsp&nbsp&nbsp</span>
                <input type="password" id="pass" placeholder="Password">
                    <p></p


                    </fieldset>
        <div style="padding-left: 80px;">
            <button type="submit" class="btn btn-success">登陆</button><span>&nbsp&nbsp&nbsp</span>
            <input type="checkbox" id="remember" name=""> Remember me
        </div>
    </form>



