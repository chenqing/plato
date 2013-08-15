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

    <div class="span8">
    <script>
    $(document).ready(function(){
        //批量添加
        var editRow = undefined ; //开启编辑行的index
       $('#datagrid').datagrid({
            url : '<?php echo base_url('manage/relationship/get_relationship_by_json') ?>',
            title: 'Server管理',
            iconCls: 'icon-edit',
            pagination:true,
            pageSize: 10,
            pageList:[10,20,30,40],
            // fit:true, //整体自适应
            fitColumns:true, //列自适应
            nowrap:false,//不折行
            border:true,//是不是要边框
            idField:'group_id',//约等于数据库里面的主键
            sortName:'group_id',
            sortOrder:'desc',
            loadMsg:'加载中......',
            columns:[[
                {
                    title:'关系组编号',
                    field:'group_id',
                    width:100,
                    sortable:true,
                    checkbox:true
                },
                {
                    title:'所属节点',
                    field:'node_id',
                    width:40,
                    sortable:true,
                    panelHeight:'50',
                    editor:{
                        type:'combobox',
                        options:{
                            url:'<?php echo base_url('/manage/node/get_parent_node_by_json') ;?>',
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
                    title:'设备组名称',
                    field:'group_name',
                    width:100,
                    sortable:true,
                    editor:{
                        type:'validatebox',
                        options:{
                            required:true
                        }
                    }
                },
                {
                    title:'设备组描述',
                    field:'group_desc',
                    width:100,
                    sortable:true,
                    editor:{
                        type:'validatebox',
                        options:{
                            required:true
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
                                    var group_ids = [] ;
                                    for(var i = 0 ; i < rows.length;i++){
                                        group_ids.push(rows[i].group_id);
                                    }
                                    console.info(group_ids.join(','));
                                    var ids = {'ids':group_ids.join(',')};
                                    $.ajax({
                                        url:'<?php echo base_url('manage/relationship/group_delete') ?>',
                                        type:'post',
                                        data:ids,
                                        dataType:'json',
                                        success:function(data){
                                            if(data.success){
                                                $.messager.show({
                                                    msg:data.msg,
                                                    title:'成功'
                                                });
                                                $('#datagrid').datagrid('load');
                                            }else{
                                                $.messager.show({
                                                    msg:data.msg,
                                                    title:'失败'
                                                });
                                            }
                                        }
                                    });
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
                var updated = $('#datagrid').datagrid('getChanges','updated');
                var url = '';
                if(inserted.length > 0){
                    url = '<?php echo base_url('manage/relationship/group_add') ?>';

                }
                if(updated.length > 0){
                    url = '<?php echo base_url('manage/relationship/group_edit') ?>';

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
                group_name:$('#search_form').find('[name=group_name]').val()
            });
        });
    });
    </script>
    <div id="search" >
        <form id="search_form" class="datagrid-toolbar" method="POST" >
            <input type="text" name="group_name" style="margin-top: 10px;" placeholder="根据节点名查询">
            <button class="btn">查询</button>
        </form>
    </div>
    <table id="datagrid"  style="hight:300px;">

    </table>

    </div>
</div>



