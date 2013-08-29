<div class="row">
    <div class="span2 well">
        <ul class="nav  nav-stacked nav-list ">
            <li class="nav-header"><span class=" icon-edit icon-2x"></span>设备关系管理</li>
            <li><a href="<?php echo base_url('manage/relationship/add')?>"><span class="icon-plus"></span>设备组添加</a></li>
            <li><a href="<?php echo base_url('manage/relationship/relationship')?>"><span class="icon-user"></span>关系组管理</a></li>
            <li><a href="<?php echo base_url('manage/relationship/relationship_list')?>"><span class="icon-user"></span>设备组修改</a></li>
            <li>&nbsp</li>
        </ul>
    </div>
    <div id="serverRelationshioAdd" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">增加设备组</h3>
        </div>
        <div class="modal-body">
            <div class="alert alert-error  hide fade in">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <p id="error"></p>
            </div>


            <form class="form-horizontal" method="post">
                <fieldset>

                    <textarea rows="10" style="width:95%" placeholder="这一部分等到下周一有时间再整"></textarea>

                </fieldset>


        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
            <input class="btn btn-primary" type="submit" value="保存">
        </div>
        </form>
    </div>

    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.multiselect2side.js');?>" ></script>
 <script>

 </script>
<div class="span8">

    <form id="search_form" class="datagrid-toolbar" method="POST">
        <input type="text" name="server_name" id="server_name" style="margin-top: 10px;" placeholder="根据服务器名查询">
        <button class="btn">查询</button><span id="msg_ser"></span>

    </form>


    <form id="sel_form"   method="post" >

        <div class="control-group">
            <label class="control-label" for="group">首先要选择一个关系组</label>
            <div class="controls">
                <input id="cc1"  name="node_parent_name" class="easyui-combobox" data-options="
             valueField: 'node_id',
             textField: 'node_name',
             'panelHeight':'auto',
             url: '<?php echo base_url('manage/node/get_parent_node_by_json')?>',
             onSelect: function(rec){
            var url = '<?php echo base_url('manage/relationship/get_group_by_json')?>' +'/' + rec.node_id;
            $('#cc2').combobox('reload', url);
        }" />
                <input id="cc2" name="node_id"" class="easyui-combobox" data-options="valueField:'group_id',textField:'group_name','panelHeight':'auto'" />
            </div>
        </div>

        <div id="sel">
            <select name="liOption[]" id='liOption' multiple='multiple' size='12' style="width:100px;">
                <?php foreach($this->Server_model->get_all_servers() as $server) :?>
                    <option value="<?php echo $server->server_id ;?>"><?php echo $server->server_name ;?></option>
                <?php endforeach ?>
            </select>
        </div>
        <input type="submit"  class="btn-large btn-danger" value="提 交"  style="margin-left: 150px;"/>
    </form>
    </div>
    <script type="text/javascript">
        $("#liOption").multiselect2side({
            selectedPosition: 'right',
            moveOptions: false,
            labelsx: '服务器列表',
            labeldx: '已经选择的服务器'
        });
        $("button.btn").click(function(e){
            e.preventDefault();
            var keys=$("#server_name").val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('manage/server/get_server_by_name');?>",
                data: "server_name="+keys,
                success: function(msg){
                    if(msg==1){
                        $("#msg_ser").show().html("没有记录！");
                    }else{
                        $("#liOptionms2side__sx").html(msg);
                        $("#msg_ser").html("");
                    }
                }
            });
            $("#msg_ser").ajaxSend(function(event, request, settings){
                $(this).html("");
            });
        });

        $(
            $('#sel_form').submit(function(e){
            e.preventDefault();
            var server_ids  = $('#liOptionms2side__dx').val();
            var group_id = $("input[name='node_id']").val();
            if(! group_id ){
                alert('你要选择一个设备组，亲！');
                return false;
            }
            if(! server_ids ){
                alert('你得往里面加点设备，亲！');
                return false;
            }
                var check_url = '<?php echo base_url('manage/relationship/rec_check')?>'+'/'+group_id;
                $.get(
                    check_url,
                    function(data){
                        if(data){
                            $.messager.alert('出错啦','所选的组已经存在','error');
                            return false;
                        }
                    }
                );
                var post_url = '<?php echo base_url('manage/relationship/rec_add')?>';

        })
        );
    </script>
</div>
</div>



