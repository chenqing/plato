<div class="row">
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.multiselect2side.js');?>" ></script>
    <div id="cabinetList" class="modal hide fade" tabindex="-1" role="dialog" style="width: 300px;" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">机柜设备一览</h3>
        </div>

            <div class="modal-body">
                <table id="dev-list" class="table table-striped table-condensed table-bordered">

                </table>


            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
            </div>
    </div>
<div id="cabinetAdd" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">增加机柜</h3>
    </div>
    <form class="form-horizontal" method="post" id="cab_add">

        <div class="modal-body">
            <div class="alert alert-error  hide fade in">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <p id="error"></p>
            </div>


            <fieldset>

                <div class="control-group">
                    <!-- Text input-->
                    <label class="control-label" for="input01">机柜名称</label>
                    <div class="controls">
                        <input  name="cab_name" id="cab_name" type="text" placeholder="机柜名称" class="input-xlarge">
                        <p class="help-block"></p>
                    </div>
                </div>

                <div class="control-group">
                    <!-- Select Basic -->
                    <label class="control-label">所属节点</label>
                    <div class="controls">
                        <select class="input-xlarge" name="node" id="node">

                            <?php foreach( $this->Node_model->get_child_node() as $node) : ?>
                                <option value="<?php echo $node->node_id ?>"><?php echo $node->node_name ; ?></option>
                            <?php endforeach;?>

                        </select>
                    </div>

                </div>

                <div class="control-group">
                    <label class="control-label">机柜位置</label>

                    <!-- Multiple Checkboxes -->
                    <div class="controls">
                        <textarea name="cab_location" id="cab_location" rows="4" style="width: 280px;">四楼机房进门左拐第二排第四个
                        </textarea>
                    </div>

                </div>

            </fieldset>
            <input type="hidden" name="cab_id" id="cab_id_add" value="">


        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
            <input class="btn btn-primary" type="submit"  value="保存">
        </div>
    </form>
</div>

<div id="deviceEdit" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">编辑机柜设备</h3>
        </div>
        <div class="modal-body">
            <form id="search_form" class="datagrid-toolbar" method="POST">
                <input type="text" name="server_name" id="server_name" style="margin-top: 10px;" placeholder="根据服务器名查询">
                <button class="btn">查询</button><span id="msg_ser"></span>

            </form>


            <form id="dev_add_or_edit"  >

                <div id="sel">
                    <select name="liOption[]" id='liOption' multiple='multiple' size='12' style="width:100px;">

                    </select>
                </div>
                <input type="hidden" name="cab_id" id="cab_id" value="" />


        </div>

        <div class="modal-footer">
            <input type="submit"  class="btn-primary" value="提 交"  style="margin-left: 180px;"/>
            </form>
            <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>

        </div>


    </div>
<div id="cabinetEdit" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">编辑机柜</h3>
    </div>
    <form class="form-horizontal" method="post" id="cab_edit">

        <div class="modal-body">
            <div class="alert alert-error  hide fade in">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <p id="error"></p>
            </div>


            <fieldset>

                <div class="control-group">
                    <!-- Text input-->
                    <label class="control-label" for="input01">机柜名称</label>
                    <div class="controls">
                        <input  name="cab_name" id="cab_name" type="text" placeholder="机柜名称" class="input-xlarge">
                        <p class="help-block"></p>
                    </div>
                </div>

                <div class="control-group">
                    <!-- Select Basic -->
                    <label class="control-label">所属节点</label>
                    <div class="controls">
                        <select class="input-xlarge" name="node" id="node">

                            <?php foreach( $this->Node_model->get_child_node() as $node) : ?>
                                <option value="<?php echo $node->node_id ?>"><?php echo $node->node_name ; ?></option>
                            <?php endforeach;?>

                        </select>
                    </div>

                </div>

                <div class="control-group">
                    <label class="control-label">机柜位置</label>

                    <!-- Multiple Checkboxes -->
                    <div class="controls">
                        <textarea name="cab_location" id="cab_location" rows="4" style="width: 280px;">四楼机房进门左拐第二排第四个
                        </textarea>
                    </div>

                </div>

            </fieldset>
            <input type="hidden" name="cab_id" value="">


        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
            <input class="btn btn-primary" type="submit"  value="保存">
        </div>
    </form>
</div>

    <script>
        var url = location.href;
        var host = location.host;
        host = 'http://'+host;
        $(document).ready(function(){
            $("#liOption").multiselect2side({
                selectedPosition: 'right',
                moveOptions: false,
                labelsx: '服务器列表',
                labeldx: '已经选择的服务器'
            });
            $("#deviceEdit button.btn").click(function(e){
                e.preventDefault();
                var keys=$("#server_name").val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('manage/server/get_server_by_name');?>",
                    data: "server_name="+keys,
                    success: function(msg){
                        if(! msg){
                            $("#msg_ser").show().html("没有记录！");
                        }else{

                            $("#liOptionms2side__sx").html('');
                            $("#liOptionms2side__sx").append(msg);
                            $("#msg_ser").html("");
                        }
                    }
                });
                $("#msg_ser").ajaxSend(function(event, request, settings){
                    $(this).html("");
                });
            });

            $('#cabinetAdd #cab_add').submit(function(e){
                e.preventDefault();
                var cab_name = $('input[name="cab_name"]').val();
                if(cab_name.length < 1){
                    $.messager.alert('请注意','机柜的名字太短了点吧','error');
                    return false;
                }
                var node_id = $('#node').find('option:selected').val();
                var cab_location = $('#cab_location').val();
                if(cab_location.length < 5){
                    $.messager.alert('请注意','你写这么简单能找到么？','error');
                    return false;
                }

                $.post(
                  host+'/manage/cabinet/add',
                    {'cab_name':cab_name,'node_id':node_id,'cab_location':cab_location},
                    function(data){
                        if(data){
                            $.messager.show({
                                msg:'添加成功',
                                title:'成功'
                            });
                            setTimeout("$('button.close').click();", 2000);
                            setTimeout("location.reload()", 1000);

                        }else{
                            $.messager.show({
                                msg:'添加失败',
                                title:'失败'
                            });
                        }

                    }
                );

            });
            $('#show-table .edit-none').live('click',function(){
                var cab_id = $(this).attr('data-id');
                var url = host + '/manage/cabinet/get_cabinet_by_id/' + cab_id;

                $.get(
                    url,
                    'json',
                    function(data){
                        var data =eval('(' + data + ')');
                        if(data){

                            $('input[name="cab_name"]').val(data[0].cab_name);
                            var options = $('#cabinetEdit').find('option');
                            for(i = 0 ;i<options.length;i++){

                                if(options[i].value == data[0].node_id){
                                    $(options[i]).prop('selected',true);
                                }else{
                                    $(options[i]).prop('selected',false);
                                }

                            }

                            $('#cabinetEdit #cab_location').val(data[0].cab_location);
                            $('#cabinetEdit input[name="cab_id"]').val(data[0].cab_id);


                        }


                    }
                );
            });
            $('.edit-none-show').live('click',function(){
                var cab_id = $(this).attr('data-id');
                var url = host + '/manage/cabinet/get_cabinet_by_id/' + cab_id;

                $.get(
                    url,
                    'json',
                    function(data){
                        var data =eval('(' + data + ')');
                        if(data){

                            $('input[name="cab_name"]').val(data[0].cab_name);
                            var options = $('#cabinetEdit').find('option');
                            for(i = 0 ;i<options.length;i++){

                                if(options[i].value == data[0].node_id){
                                    $(options[i]).prop('selected',true);
                                }else{
                                    $(options[i]).prop('selected',false);
                                }

                            }

                            $('#cabinetEdit #cab_location').val(data[0].cab_location);
                            $('#cabinetEdit input[name="cab_id"]').val(data[0].cab_id);


                        }


                    }
                );
            });
            $('#cab_edit').submit(function(e){
                e.preventDefault();
                var cab_id = $(this).find('input[name="cab_id"]').val();
                var cab_name = $(this).find('input[name="cab_name"]').val();
                if(cab_name.length < 1){
                    $.messager.alert('请注意','机柜的名字太短了点吧','error');
                    return false;
                }
                var node_id = $('#cab_edit #node').find('option:selected').val();
                var cab_location = $('#cab_edit #cab_location').val();
                if(cab_location.length < 5){
                    $.messager.alert('请注意','你写这么简单能找到么？','error');
                    return false;
                }
                console.info(cab_id);

                $.post(
                    host+'/manage/cabinet/edit/'+cab_id,
                    {'cab_name':cab_name,'node_id':node_id,'cab_location':cab_location},
                    function(data){
                        if(data){
                            $.messager.show({
                                msg:'编辑成功',
                                title:'成功'
                            });
                            setTimeout("$('button.close').click();", 3000);
                            setTimeout("location.reload()", 1000);

                        }else{
                            $.messager.show({
                                msg:'编辑失败',
                                title:'失败'
                            });
                        }

                    }
                );

            });
            $('#cabinet_search').submit(function(e){
                e.preventDefault();
                var node_name = $('#cabinet_search input[name="node_name"]').val();
                var url = host + '/manage/cabinet/get_cabinet_by_node/' +node_name;
                $.get(
                    url,
                    'json',
                    function(data){
                        var data = eval('(' + data + ')');
                        if(data){
                            //$('#show-table').hide();
                            $('#links').hide();
                           // $('#search-table').removeClass('hidden');
                            $('#show-table').html('');
                            $('#show-table ').append(
                             "<tr><th>机柜ID</th><th>所属节点</th><th>机柜名字</th><th>机柜位置</th><th>操作</th><th></th><th>设备管理</th><th>机柜图</th></tr>"
                            );
                            var tr =' ';
                        for(var i = 0; i < data.length;i++){

                            tr += "<tr><td>"+data[i].cab_id+"</td><td>"+data[i].node_name+"</td><td>"+data[i].cab_name+"</td><td>"+data[i].cab_location+"</td>" +
                                    '<td><a href="#cabinetEdit"   data-toggle="modal" data-id ="'+data[i].cab_id+'" class="edit-none-show btn btn-info btn-smal" >编辑</a></td><td><button class="btn btn-danger btn-small	" id="icb-delete">删除</button></td><td><a href="#deviceEdit"   data-toggle="modal" data-id ="'+data[i].cab_id+'" class="btn btn-success btn-small	" id="edit-device">编辑机器</a></td><td><button class="btn btn-warning btn-small	">查看</button></td></tr>';

                        }
                            $('#show-table').append(tr);

                        }
                    }
                );
            });
            //搜索前编辑机柜机器时，动态查询后端机器
            $('#edit-device').live('click',function(){
                var node_name = $(this).parent().parent().find('td:eq(1)').text();
                var cab_id = $(this).parent().parent().find('td:eq(0)').text();
                //要把cab_id 通过hidden的input传过去
                $('input[name="cab_id"]').attr("value",cab_id);
                var get_this_node_server_url = host +'/manage/cabinet/get_server_by_node_name/' +node_name;
                var get_this_cabinet_server_url = host +'/manage/cabinet/get_server_by_cabinet_id/'+cab_id;
               //异步获取左侧的服务器列表
                $.get(
                    get_this_node_server_url,
                    'json',
                    function(data){
                        if(data ){
                            if(data == '0'){
                                $.messager.show({
                                    msg:'该节点还没有设备录入,请检查和录入',
                                    title:'请注意'
                                });
                                $('#liOptionms2side__sx').html(' ');
                                return false;
                            }
                            var data = eval('('+data+')');
                            var html = ' ';
                            for(var i = 0;i < data.length;i++){
                                html +='<option value="'+data[i].server_id+'">'+data[i].server_name+'</option> ';
                            }
                            $('#liOptionms2side__sx').html(html);
                            $('#liOptionms2side__sx option:last').attr('selected',true);
                        }
                    }
                );
                //异步获取右侧的服务器列表
                $.get(
                    get_this_cabinet_server_url,
                    'json',
                    function(data){
                        var html = ' ';
                        if(data == '0'){
                            $('#liOptionms2side__dx').html(html);
                        }else{
                            var data = eval('('+data+')');
                            for(var i = 0;i<data.length;i++){
                            html += '<option value="'+data[i].server_id+'">'+data[i].server_name+'</option>';
                            }
                            $('#liOptionms2side__dx').html(html);
                        }
                    }
                );

            });
            //搜索后的点击


            //往后端数据库里面添加或者更新设备
            //$('#dev_add_or_edit').submit(function(e){
            $('#dev_add_or_edit').live('submit',function(e){
                e.preventDefault();
                var cab_id = $('input[name="cab_id"]').val();
                $('#liOptionms2side__dx option').attr("selected",true);
                var server_ids = $('#liOptionms2side__dx').val();
                var url = host+'/manage/cabinet/server_add_or_edit'
                if( server_ids === null){
                    alert('感觉你还没选择设备，亲');
                    return false;
                }                    
               // console.info(server_ids);
                var server_list = "";
                $.each(server_ids,function(index,value){
                    if(server_ids.length -1 != index){
                    server_list+=value+",";
                    }else{
                        server_list+=value;

                    }
                });
                $.post(
                    url,
                    {'cab_id':cab_id,'dev_list':server_list},
                    function(data){
                        if(data == '1'){
                            $.messager.show({
                                'msg':'添加成功',
                                'title':'成功'
                            });
                        }else{
                            $.messager.show({
                                'msg':'添加失败,请检查后重试',
                                'title':'失败'
                            });
                        }
                    }
                );
            });
            //查看机柜
            $('#check-dev').live('click',function(){
                var cab_id = $(this).attr('data-id');
                var url = host+'/manage/cabinet/get_server_by_cabinet_id/'+cab_id;
                $.get(
                    url,
                    'json',
                    function(data){
                        var html = ' ';
                        if(data == '0'){
                            $('#dev-list').html('<b style="color: red">机柜里面还没有设备呢</b>');
                        }else{
                            var data = eval('('+data+')');

                            for(var i = 0;i<data.length;i++){
                                html += '<tr><td>'+ (i+1) +'</td><td>'+data[i].server_name+'</td><td>'+data[i].server_role+'</tr>';
                            }
                            $('#dev-list').html(' ');

                            $('#dev-list').html(html);
                        }
                    }
                );
            });
            //删除机柜，这里要确保，删除的机柜的同时，腰要把另外一个表里面的关于这个机柜装的机器列表，也要对应的删掉
            $('#icb-delete').live('click',function(){
                var cab_id = $(this).parent().parent().children().eq(0).text();
                var url = host+'/manage/cabinet/cabinet_delete/'+cab_id;
                $.messager.confirm('请注意！','你确认要删除该机柜吗？这里面可能还放着机器呢',function(r){
                    if(r){

                    $.get(
                        url,
                        function(data){
                            if(data == "1"){
                                $.messager.show({
                                    'title':'成功',
                                    'msg':'删除机柜成功'
                                });
                                setTimeout("location.reload()", 1000);

                            }else{
                                $.messager.show({
                                    'title':'失败鸟',
                                    'msg':'删除机柜失败'
                                });

                                return false;
                            }
                        }
                    );

                }
                });
            });

        });

    </script>

<div class="span2 well">
    <ul class="nav  nav-stacked nav-list ">
        <li class="nav-header input-xxlarge"><span class=" icon-edit icon-2x"></span>机柜管理</li>

        <li>&nbsp</li>
    </ul>
</div>
    <div class="span9">
        <form name="cabinet_search" id="cabinet_search" class="form-inline datagrid-toolbar">
            <input type="text" name="node_name" placeholder="输入节点名搜索" />
             <button type="submit" class="btn ">搜索</button>
            <div style="float: right;"><a id="add-cabinet" href="#cabinetAdd" data-toggle="modal" class="btn btn-primary">增加机柜</a></div>
        </form>
        <table id="show-table" class="table table-hover table-condensed table-striped" style="margin-top: 5px;">
         <tr><th>机柜ID</th><th>所属节点</th><th>机柜名字</th><th>机柜位置</th><th>操作</th><th></th><th>设备管理</th><th>机柜图</th></tr>
            <?php foreach($cabinet as $c ):?>
            <tr><td><?php echo $c->cab_id ;?></td><td><?php echo $this->Node_model->get_node_name($c->node_id );?></td><td><?php echo $c->cab_name ;?></td><td><?php echo $c->cab_location ;?></td>
                <td><a href="#cabinetEdit"   data-toggle="modal" data-id ="<?php echo $c->cab_id ;?>" class="edit-none btn btn-info btn-small	" >编辑</a></td>
                <td><button class="btn btn-danger btn-small	" id="icb-delete">删除</button></td><td><a href="#deviceEdit"   data-toggle="modal" data-id ="<?php echo $c->cab_id ;?>" id="edit-device" class="btn btn-success btn-small	">编辑机器</a></td><td><a  href="#cabinetList"  data-toggle="modal" class="btn btn-warning btn-small	" id="check-dev" data-id ="<?php echo $c->cab_id ;?>">查看</a></td>
            </tr>
        <?php endforeach; ?>
        </table>
       <div id="links"> <?php echo $links; ?> </div>

        <table  id="search-table" class=" hidden table table-hover table-condensed table-striped" style="margin-top: 5px;">
            <tr><th>机柜ID</th><th>所属节点</th><th>机柜名字</th><th>机柜位置</th><th>操作</th><th></th></tr>

        </table>

    </div>
</div>
</div>



