var url = location.href;
var host = location.host;
host = 'http://'+host;
$(document).ready(function(){
    //用户添加的相关动作
    $(' #userAdd form').submit(function(e){
        e.preventDefault();
        var user_name = $('#userAdd #user_name').val();
        var group     =  $('#userAdd #group').find("option:selected").val();
        var email     =  $('#userAdd #email').val();
        var privileges = [];
        $('#userAdd input[name="privileges"]:checked').each(function(){
                privileges.push($(this).val());
            }
        );

        var pris = privileges.join(':');
        var is_active = $('input[name="active"]:checked').val();

        $.post(
            host+'/manage/user/add',
            {'user_name':user_name,'group_id':group,'user_privilege':pris,'is_active':is_active},
            function(result){
                if(result){
                    $('div.alert').removeClass('alert-error');
                    $(' #userAdd div.alert').removeClass('hide');
                    $('div.alert').addClass('alert-success');
                    $('#userAdd #error').html('用户添加成功');
                    setTimeout("$('div.alert').removeClass('fade in');", 2000);
                    // setTimeout("$('div.alert').addClass('fade out');", 2000);
                    setTimeout("$('button.close').click();", 4000);
                    setTimeout("$('div.alert').hide()",3000);
                }else{
                    $(' #userAdd #error').html('用户添加失败');
                }
            }
        );

    });
    //用户编辑时，把值传过去，显示出来
    $('.none').click(function(){
        var user_id =$(this).attr('data-id');
        $.get(
            host+'/manage/user/get_user_by_id/'+user_id,
            'json',
            function(data){
                var data =eval('(' + data + ')');
                if(data){
                    $('#userEdit #user_name').val(data[0].user_name);
                    var pri = data[0].user_privilege;
                    var checks = $('#userEdit').find(':checkbox');
                    var options = $('#userEdit').find('option');
                    var radios = $('input[name="active"]');
                    var group_id = data[0].group_id;
                    var is_active = data[0].is_active;
                    // var user_id  = data[0].user_id;
                    var i ;
                    //设置是否激活的那个radio选中
                    if(is_active == 1){
                        $('#active').attr('checked','checked');
                        $('#no_active').removeAttr("checked");
                    }else{
                        $('#active').removeAttr("checked");
                        $('#no_active').attr('checked','checked');
                    }

                    for(i = 0 ;i<options.length;i++){

                        if(options[i].value == group_id){
                            $(options[i]).prop('selected',true);
                        }else{
                            $(options[i]).prop('selected',false);
                        }

                    }
                    for(i = 0;i<checks.length;i++){

                        if(checks[i].value & pri){
                            $(checks[i]).prop('checked',true);
                        }else{
                            $(checks[i]).prop('checked',false);
                        }
                    }
                    $('#userEdit #group_id').val(data[0].group_id);
                    $('#userEdit #user_id').val(data[0].user_id);

                }
                else{
                    console.log('sorry');
                }
            }
        );
    });
    //用户提交编辑后的数据
    $('#userEdit form').submit(function(e){
        e.preventDefault();
        var user_name = $('#userEdit #user_name').val();
        var group_id = $('#userEdit').find(':selected').val();
        var i ,pri = 0;
        var user_privilege = $("input[name='privileges']:checkbox:checked").each(
            function(){
                pri += Number($(this).val());
            }
        );
        var  is_active = $('#userEdit input[name="active"]:radio:checked').val();
        var user_id = $('#userEdit #user_id').val();
        if(user_id){
            $.post(
                host+'/manage/user/edit/'+user_id,
                {'user_name':user_name,'group_id':group_id,'user_privilege':pri,'is_active':is_active},
                function(result)
                {
                    if(result == 1)
                    {
                        $('div.alert').removeClass('alert-error hide');
                        $('div.alert').addClass('alert-success fade in');
                        $('#userEdit #error').html('用户编辑成功');

                        $('div.alert').removeClass('fade in');
                        setTimeout("$('button.close').click();", 3000);
                        // setTimeout("$('div.alert').remove()",3000);
                    }else{
                        $('#userEdit #error').html('用户组编辑失败');
                    }
                    //$('div.alert').addClass('hide');

                }
            );
        }
    });
    //删除用户
    $('.icon-remove').click(function(){
        var user_id =$(this).attr('data-id');
        if(confirm("确认要删除吗，亲？")){
            $.get(
                host+'/manage/user/delete/'+user_id,
                'json',
                function(data){
                    var data =eval('(' + data + ')');
                    if(data){
                        $('div.alert').removeClass('alert-error hide');
                        $('div.alert').removeClass('hide');
                        $('div.alert').addClass('alert-success');
                        $('div.span9 #error').html('用户删除成功');
                        setTimeout("$('div.alert').removeClass('fade in');", 1000);
                        setTimeout("$('div.alert').addClass('fade out');", 2000);
                        setTimeout("$('div.alert').hide()",3000);
                        $('tr td:contains('+user_id+')').parent().hide();
                    }
                    else{
                        $('div.span9 #error').html('用户删除失败');
                    }
                }
            );
        }
    });

    //更改密码
    $('#passwordEdit form').submit(function(e){
        e.preventDefault();
        var user_name = $('#passwdEdit #user_name').val();
        var user_id   = $('#passwdEdit #user_id').val();

    });
});