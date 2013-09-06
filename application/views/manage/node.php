
<div class="row">
    <div class="span2 well">
        <ul class="nav  nav-stacked nav-list ">
            <li class="nav-header"><span class=" icon-edit icon-2x"></span>节点管理</li>
            <li><a href="#nodeBatchAdd" data-toggle="modal"><span class="icon-plus"></span>批量添加</a></li>
            <li><a href=""><span class="icon-user"></span>节点角色</a></li>
            <li><a href="<?php echo base_url('manage/node/topology');?>"><span class="icon-sitemap"></span>节点概览</a></li>
            <li>&nbsp</li>
        </ul>
    </div>

    <!-- begin of node batch add -->
    <div id="nodeBatchAdd" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">批量添加节点</h3>
        </div>
        <div class="modal-body">
            <div class="alert alert-error  hide fade in">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <p id="error"></p>
            </div>


            <form class="form-horizontal" method="post">
                <fieldset>

                    <textarea rows="10" style="width:95%" placeholder="使用逗号或者空格分割开，类似：上层节点 节点名称 节点描述 节点角色"></textarea>

                </fieldset>


        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
            <input class="btn btn-primary" type="submit" value="保存">
        </div>
        </form>
    </div>
    <!--end of node batch add -->
    <!-- start of span9 table of group list -->
    <div class="span9">
        <div class="alert alert-error  hide fade in">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <p id="error"></p>
        </div>
        <script>
            $(document).ready(function(){
                //批量添加
                var editRow = undefined ; //开启编辑行的index
                var node_role = [{'node_role':'CPIS服务节点'},{'node_role':'CPIS测试节点'},{'node_role':'CDN服务节点'},{'node_role':'CDN测试节点'}];
                $('#datagrid').datagrid({
                    url : '<?php echo base_url('manage/node/get_node_by_json') ?>',
                    title: 'Server管理',
                    iconCls: 'icon-edit',
                    pagination:true,
                    pageSize: 10,
                    pageList:[10,20,30,40],
                    // fit:true, //整体自适应
                    fitColumns:true, //列自适应
                    nowrap:false,//不折行
                    border:true,//是不是要边框
                    idField:'node_id',//约等于数据库里面的主键
                    sortName:'node_id',
                    sortOrder:'desc',
                    loadMsg:'加载中......',
                    columns:[[
                        {
                            title:'节点编号',
                            field:'node_id',
                            width:100,
                            sortable:true,
                            checkbox:true
                        },
                        {
                            title:'上级节点',
                            field:'node_parent_id',
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
                               if(rowData.node_parent_id == 0){
                                   return "无";
                               }
                                if(rowData.parent_node_name){
                                    return rowData.parent_node_name ;
                                }
                            },
                            onLoadSuccess:function(ss){
                                $('div.combo-panel.panel-body.panel-body-noheader').removeAttr("style");
                            }

                        },
                        {
                            title:'节点名称',
                            field:'node_name',
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
                            title:'节点描述',
                            field:'node_desc',
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
                            title:'节点角色',
                            field:'node_role',
                            width:50,
                            editor:{
                                type:'combobox',
                                options:{
                                    //url:'<?php echo base_url('/manage/node/get_parent_node_by_json') ;?>',
                                    data:node_role,
                                    valueField:'node_role',
                                    textField:'node_role',
                                    required:true,
                                    "panelHeight":"auto"

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
                                        node_name:'hello'
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
                                            var node_ids = [] ;
                                            for(var i = 0 ; i < rows.length;i++){
                                                node_ids.push(rows[i].node_id);
                                            }
                                            console.info(node_ids.join(','));
                                            var ids = {'ids':node_ids.join(',')};
                                            $.ajax({
                                                url:'<?php echo base_url('manage/node/delete') ?>',
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
                             url = '<?php echo base_url('manage/node/add') ?>';

                        }
                        if(updated.length > 0){
                             url = '<?php echo base_url('manage/node/edit') ?>';

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
                        node_name:$('#search_form').find('[name=node_name]').val()
                    });
                });
            });
        </script>
        <div id="search" >
            <form id="search_form" class="datagrid-toolbar" method="POST" >
                <input type="text" name="node_name" style="margin-top: 10px;" placeholder="根据节点名查询">
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
<!-- begin of javascript -->

