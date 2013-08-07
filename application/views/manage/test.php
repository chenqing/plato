<script>
    $(document).ready(function(){
        var editRow = undefined ; //开启编辑行的index
        var groups;
        $('#datagrid').datagrid({
            url : '<?php echo base_url('manage/user/test_json') ?>',
            title: '用户管理',
            iconCls: 'icon-search',
            pagination:true,
            pageSize: 10,
            pageList:[10,20,30,40],
           // fit:true, //整体自适应
            fitColumns:true, //列自适应
            nowrap:false,//不折行
            border:false,//是不是要边框
            idField:'user_id',//约等于数据库里面的主键
            sortName:'user_id',
            sortOrder:'desc',
            loadMsg:'加载中......',
            columns:[[
                {
                    title:'编号',
                    field:'user_id',
                    width:100,
                    sortable:true,
                    checkbox:true
                },
                {
                    title:'用户组',
                    field:'group_id',
                    width:100,
                    sortable:true,
                   // panelHeight: 'auto',
                    editor:{
                        type:'combobox',
                        options:{
                           url:'<?php echo base_url('/manage/group/get_group_json') ;?>',
                            valueField:'group_id',
                            textField:'group_name',
                            required:true

                        }
                    },
                    formatter:function(value,rowData,rowIndex){
                        if(rowData.group_name){
                            return rowData.group_name ;
                        }
                    },
                    onSelect:function(ss){
                        $('div.combo-panel.panel-body.panel-body-noheader').removeAttr("style");
                    }

                },
                {
                    title:'用户组',
                    field:'group_name',
                    hidden:true
                },
                {
                    title:'用户名',
                    field:'user_name',
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
                    title:'权限',
                    field:'user_privilege',
                    width:100
                },
                {
                    title:'上次登陆',
                    field:'last_login',
                    width:100
                },
                {
                    title:'是否激活',
                    field:'is_active',
                    width:100,
                    sortable:true
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
                            user_name:'hello'
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
                    console.info(rowData);
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


        $('.btn').click(function(e){
            e.preventDefault();
            $('#datagrid').datagrid('load',{
                user_name:$('#search_form').find('[name=user_name]').val()
            });
        });
        $.ajax({
            type:"post",
            async:false,
            url:'http://localhost/manage/group/get_group_json',
            success:function(data){
                if(data){
                    groups =data;
                }
            }

        });
    });
</script>
<div id="search" >
    <form id="search_form" class="datagrid-toolbar" method="POST" >
            <input type="text" name="user_name" style="margin-top: 10px;" placeholder="根据用户名查询">
        <button class="btn">查询</button>
    </form>
</div>
<table id="datagrid"  style="hight:300px;">

</table>