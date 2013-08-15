var url = location.href;
var host = location.host;
host = 'http://'+host;
$(document).ready(function(){
    //检查用户组是是不是存在，以及用户名是不是为空等
    $('#group_name').blur(function(){
            var group_name = $('#group_name').val();
            if(group_name.length >0){
                $.post(
                    host+'/manage/group/group_exits',
                    {'group_name':group_name},

                    function(result)
                    {
                        if(result)
                        {
                            $('#error').html('用户组已存在');
                            $('div.alert').removeClass('hide');
                            return false;
                        }
                    }
                );
            }else{
                $('#error').html('组名不能为空哦');
                $('div.alert').removeClass('hide');
                $('#group_name').focus();
               // setTimeout("$('div.alert.fade').removeClass('in').addClass('out')",2000);
                setTimeout("$('div.alert').fadeOut('slow')",2000);
            }
        }
    );
    //通过ajax方法提交用户组的添加操作
    $('form').submit(function(e){
            e.preventDefault();
            var group_name = $('#group_name').val();
            var group_desc = $('#group_desc').val();
            if(group_name.length > 0){
                $.post(
                    host+'/manage/group/group_add',
                {'group_name':group_name,'group_desc':group_desc},

                    function(result)
                    {

                        if(result)
                        {
                            $('div.alert.alert-error').removeClass('alert-error');
                            $('div.alert.hide').removeClass('hide');
                            $('div.alert.fade').addClass('alert-success');
                            $('#error').html('用户组添加成功');
                            setTimeout("$('div.alert.fade').removeClass('in').addClass('out')",2000);
                            setTimeout("$('div.alert').remove()",1000);
                        }else{
                            $('#error').html('用户组添加失败');
                        }
                    }
            );
            }
        }
    );

    $('.none').click(function(e){
        //e.preventDefault();
        var group_id = $(this).attr('data-id');
        $.get(
            host+"/manage/group/get_group_name/"+group_id,
            'json',
            function(data){
                var data =eval('(' + data + ')');
                if(data){
                    $('#groupEdit #group_name').val(data[0].group_name);
                    $('#groupEdit #group_desc').val(data[0].group_desc);
                    $('#groupEdit #group_id').val(data[0].group_id);
                }
                else{
                    console.log('sorry');
                }
            }
        );



    });

    $('#groupEdit form').submit(function(e){
            e.preventDefault();
            var group_name = $('#groupEdit #group_name').val();

            var group_desc = $('#groupEdit #group_desc').val();
            var group_id = $('#groupEdit #group_id').val();
            //var group_id = $(this).attr('data-id');

            var l = $('td:contains('+group_id+')');
            var g_name = l.next();
            var g_desc = l.next().next();

            if(group_name.length >0){
                $.post(
                    host+'/manage/group/group_edit/'+group_id,
                {'group_name':group_name,'group_desc':group_desc},

                    function(result)
                    {

                        if(result)
                        {
                            $('div.alert').removeClass('alert-error hide ');
                            $('div.alert').addClass('alert-success fade in');
                            $('#groupEdit #error').html('用户组编辑成功');
                            g_name.text(group_name);
                            g_desc.text(group_desc);

                            //$('div.alert').removeClass('fade in');
                            setTimeout("$('button.close').click();", 3000);


                        }else{
                            $('#groupEdit #error').html('用户组编辑失败');
                        }
                        //$('#groupEdit div.alert').addClass('hide');
                        // setTimeout("window.location.reload()", 2000);
                    }
            );
            }
        }
    );

    $('.icon-remove').click(function(){
        var id = $(this).attr('data-id');
        if(confirm("确认要删除吗，亲？")){
            $.get(
                host+'/manage/group/group_delete/'+id,
                function(data){
                    if(data){
                        $('div.alert').removeClass('alert-error');
                        $('div.alert').removeClass('hide');
                        $('div.alert').addClass('alert-success');
                        $('div.span9 #error').html('用户组删除成功');
                        setTimeout('location.reload()',2000);

                    }else{
                        $('div.span9 #error').html('用户组删除失败');
                    }

                }

        );
        }

    });
});

