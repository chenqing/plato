<div class="row">
    <div class="span2 well">
        <ul class="nav  nav-stacked nav-list ">
            <li class="nav-header"><span class=" icon-edit icon-2x"></span>机柜管理</li>
            <li><a href="<?php echo base_url('manage/cabinet/edit')?>"><span class="icon-plus"></span>机柜编辑</a></li>
            <li><a href="<?php echo base_url('manage/cabinet/index')?>"><span class="icon-user"></span>设备管理</a></li>
            <li>&nbsp</li>
        </ul>
    </div>
    <div id="cabinetEdit" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">增加机柜</h3>
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


            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
                <input class="btn btn-primary" type="submit"  value="保存">
            </div>
        </form>
    </div>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.multiselect2side.js');?>" ></script>
    <script>
        var url = location.href;
        var host = location.host;
        host = 'http://'+host;
        $(document).ready(function(){
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
            $('.none').click(function(){
                var cab_id = $(this).attr('data-id');
                var url = host + '/manage/cabinet/get_cabinet_by_id/' + cab_id;
                $.get(
                    url,
                    'json',
                    function(data){
                        var data =eval('(' + data + ')');
                        if(data){
                            $('#cabinetEdit #cab_name').val(data[0].cab_name);
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
                var cab_id = $('input[name="cab_id"]').val();
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

        });

    </script>
    <div class="span8">
        <form name="cabinet_search" class="form-inline datagrid-toolbar">
            <input type="text" name="node_name" placeholder="输入节点名搜索" />
             <button type="submit" class="btn ">搜索</button>
            <div style="float: right;"><a href="#cabinetAdd" data-toggle="modal" class="btn btn-warning">增加机柜</a></div>
        </form>
        <table class="table table-hover table-condensed table-striped" style="margin-top: 5px;">
         <tr><th>机柜ID</th><th>所属节点</th><th>机柜名字</th><th>机柜位置</th><th>操作</th><th></th></tr>
            <?php foreach($cabinet as $c ):?>
            <tr><td><?php echo $c->cab_id ;?></td><td><?php echo $this->Node_model->get_node_name($c->node_id );?></td><td><?php echo $c->cab_name ;?></td><td><?php echo $c->cab_location ;?></td>
                <td><a href="#cabinetEdit"   data-toggle="modal" data-id ="<?php echo $c->cab_id ;?>" class="none btn btn-info btn-small	" id="cab_edit">编辑</a></td>
                <td><button class="btn btn-danger btn-small	">删除</button></td>
            </tr>
        <?php endforeach; ?>
        </table>
        <?php echo $links; ?>

    </div>
</div>
</div>



