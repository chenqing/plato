
<div class="row">
<div class="span2 well">
    <ul class="nav  nav-stacked nav-list ">
        <li class="nav-header"><span class=" icon-edit icon-2x"></span>服务器管理</li>
        <li><a href="#serverBatchAdd" data-toggle="modal"><span class="icon-plus"></span>批量添加</a></li>
        <li><a href="<?php echo base_url('manage/server')?>"><span class=" icon-twitter"></span>server管理</a></li>
        <li><a href="<?php echo base_url('manage/server/role')?>"><span class="icon-user"></span>角色管理</a></li>
        <li>&nbsp</li>
    </ul>
</div>

<div id="serverBatchAdd" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">批量添加Server</h3>
    </div>
    <div class="modal-body">
        <div class="alert alert-error  hide fade in">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <p id="error"></p>
        </div>


        <form class="form-horizontal" method="post">
            <fieldset>
                 <span class="help-block  icon-quote-left " >     格式为: 节点名称,主机名称,ip地址,主机角色,是否服务,主机描述 <br></span>
                <p></p>
                <textarea name="batserver" rows="12" style="width:95%" placeholder="行与行直接回车就行，行内字段使用逗号分割开"></textarea>
                <span class="help-block  icon-quote-left " >      比如: CMN-HF-1,CMN-HF-1-3O1,221.130.162.37,FC,1,一台FC</span>
            </fieldset>


    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
        <input class="btn btn-primary" type="submit" value="保存">
    </div>
    </form>
</div>
<!-- start of span9 table of group list -->
<div class="span9">
<div class="alert alert-error  hide fade in">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <p id="error"></p>
</div>
<script>
    $(document).ready(function(){
        //批量添加
        $('#serverBatchAdd').submit(function(e){
            e.preventDefault();
            var data = $('[name=batserver]').val();

            $.ajax({
                url:'<?php echo base_url('manage/server/bat_add')?>',
                type:'post',
                data:{'batserver':data},
                dataType:'json',
                success:function(data){
                    if(data.success){
                        $.messager.show({
                            msg:data.msg,
                            title:'成功'
                        });
                    }else{
                        $('#datagrid').datagrid('rejectChanges');
                        $.messager.show({
                            msg:data.msg,
                            title:'失败'
                        });
                    }
                }
            });
        });
        var editRow = undefined ; //开启编辑行的index
        var node_role = [{'node_role':'CPIS服务节点'},{'node_role':'CPIS测试节点'},{'node_role':'CDN服务节点'},{'node_role':'CDN测试节点'}];
        $('#datagrid').datagrid({
            url : '<?php echo base_url('manage/server/get_server_by_json') ?>',
            title: '节点管理',
            iconCls: 'icon-edit',
            pagination:true,
            pageSize: 10,
            pageList:[10,20,30,40],
            // fit:true, //整体自适应
            fitColumns:true, //列自适应
            nowrap:false,//不折行
            border:true,//是不是要边框
            idField:'server_id',//约等于数据库里面的主键
            sortName:'server_id',
            sortOrder:'asc',
            loadMsg:'加载中......',
            columns:[[
                {
                    title:'服务器编号',
                    field:'server_id',
                    width:100,
                    sortable:true,
                    checkbox:true
                },
                {
                    title:'所属节点',
                    field:'node_id',
                    width:60,
                    sortable:true,
                    editor:{
                        type:'combobox',
                        options:{
                            url:'<?php echo base_url('/manage/node/get_node_name_json') ;?>',
                            valueField:'node_id',
                            textField:'node_name',
                            required:true,
                            "panelHeight":"auto"

                        }
                    },
                    formatter:function(value,rowData,rowIndex){
                        if(rowData.node_name){
                            return rowData.node_name ;
                        }
                    }

                },
                {
                    title:'主机名称',
                    field:'server_name',
                    width:60,
                    sortable:true,
                    editor:{
                        type:'validatebox',
                        options:{
                            required:true
                        }
                    }
                },
                {
                    title:'主机ip',
                    field:'server_ip',
                    width:60,
                    sortable:true,
                    editor:{
                        type:'validatebox',
                        options:{
                            required:true
                        }
                    }
                },
                {
                    title:'主机角色',
                    field:'role_id',
                    width:50,
                    editor:{
                        type:'combobox',
                        options:{
                            url:'<?php echo base_url('/manage/server/get_role_name_json') ;?>',
                            //data:node_role,
                            valueField:'role_id',
                            textField:'role_name',
                            required:true,
                            "panelHeight":"auto"

                        }
                    },
                    formatter:function(value,rowData,rowIndex){
                        if(rowData.role_name){
                            return rowData.role_name ;
                        }
                    }

                },
                {
                    title:'是否空闲',
                    field:'is_active',
                    width:30,
                    align:'center',
                    sortable:true,
                    editor:{
                        type:'checkbox',
                        options:{
                            on: '1',
                            off: '0'
                        }
                    },
                    formatter:function(value,rowData,rowIndex){
                        if(rowData.is_active  == 1 ){
                            return '是' ;
                        }else{
                            return '否';
                        }
                    }

                },
                {
                    title:'主机备注',
                    field:'server_desc',
                    width:100,
                    sortable:true,
                    editor:{
                        type:'validatebox',
                        options:{

                        }
                    }
                }
            ]],
            toolbar:[
                '-',
                {
                    text:' 增加',
                    iconCls:' icon-plus-sign-alt',
                    handler:function(){
                        if(editRow != undefined){
                            $('#datagrid').datagrid('endEdit');
                        }else{
                            $('#datagrid').datagrid('appendRow',{
                                server_name:'CMN-HF-1-3O1'
                            });
                            var rows = $('#datagrid').datagrid('getRows');
                            $('#datagrid').datagrid('beginEdit',rows.length - 1 );
                            editRow = rows.length - 1 ;
                        }
                    }
                },'-',
                {
                    text:' 删除',
                    iconCls:'icon-remove',
                    handler:function(){
                        var rows =  $('#datagrid').datagrid('getSelections');
                        if(rows.length >0){
                            $.messager.confirm('请确认','真的要删除选择的项目吗？',function(b){
                                if(b){
                                    var user_ids = [] ;
                                    for(var i = 0 ; i < rows.length;i++){
                                        user_ids.push(rows[i].user_id);
                                    }
                                    console.info(user_ids.join(','));
                                }
                            });

                        }else{
                            $.messager.alert('提示','至少要选择一个吧');
                        }
                    }
                },'-',
                {
                    text:' 编辑',
                    iconCls:'icon-edit',
                    handler:function(){
                        var rows =  $('#datagrid').datagrid('getSelections');
                        var rowIndex =  $('#datagrid').datagrid('getRowIndex',rows[0] );

                        if(rows.length == 1){
                            if(editRow != undefined){
                                $('#datagrid').datagrid('endEdit');
                            }else{
                                $('#datagrid').datagrid('beginEdit', rowIndex);
                                editRow = rowIndex ;
                            }
                        }


                    }
                },'-',
                {
                    text:' 取消',
                    iconCls:'icon-add',
                    handler:function(){
                        editRow = undefined ;
                        $('#datagrid').datagrid('rejectChanges');
                        $('#datagrid').datagrid('unselectAll');
                    }
                },'-',
                {
                    text:' 保存',
                    iconCls:'icon-save',
                    handler:function(){
                        $('#datagrid').datagrid('endEdit',editRow);
                    }
                },'-'

            ],
            onAfterEdit:function(rowIndex,rowData,changes){
                var inserted = $('#datagrid').datagrid('getChanges','inserted');
                console.info(inserted);
                var updated = $('#datagrid').datagrid('getChanges','updated');
                var url = '';
                if(inserted.length > 0){
                    url = '<?php echo base_url('manage/server/server_add') ?>';

                }
                if(updated.length > 0){
                    url = '<?php echo base_url('manage/server/server_edit') ?>';

                }
                $.ajax({
                    url:url,
                    type:'post',
                    data:rowData,
                    dataType:'json',
                    success:function(data){
                        if(data.success){
                            $('#datagrid').datagrid('acceptChanges');
                            $.messager.show({
                                msg:data.msg,
                                title:'成功'
                            });
                            $('#datagrid').datagrid('load');
                            editRow = undefined;
                        }else{
                            $('#datagrid').datagrid('rejectChanges');
                            $.messager.show({
                                msg:data.msg,
                                title:'失败'
                            });
                            $('#datagrid').datagrid('load');
                            editRow = undefined;
                        }
                    }
                });

            },
            onDblClickRow:function(rowIndex,rowData){
                if(editRow != undefined){
                    $('#datagrid').datagrid('endEdit');
                }else{
                    var rows = $('#datagrid').datagrid('getRows');
                    $('#datagrid').datagrid('beginEdit', rowIndex);
                    //  console.info(rows.length);
                    editRow = rowIndex ;
                }

            }

        });


        $('button.btn').click(function(e){
            e.preventDefault();
            $('#datagrid').datagrid('load',{
                server_name:$('#search_form').find('[name=server_name]').val()
            });
        });
    });
</script>
<div id="search" >
    <form id="search_form" class="datagrid-toolbar" method="POST" >
        <input type="text" name="server_name" style="margin-top: 10px;" placeholder="根据主机名查询">
        <button class="btn">查询</button>
    </form>
</div>
<table id="datagrid"  style="hight:300px;">

</table>
</div>
</div>
<!-- end of span9 & end of group list -->
</div>
<div id="push"></div>
</div><!-- end of wrap -->

