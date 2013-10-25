<div class="row">
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.multiselect2side.js');?>" ></script>
    <div class="span2 well">
        <ul class="nav  nav-stacked nav-list ">
            <li class="nav-header"><span class=" icon-edit icon-2x"></span>设备关系管理</li>
            <li><a href="<?php echo base_url('manage/relationship/add')?>"><span class="icon-plus"></span>设备组添加</a></li>
            <li><a href="<?php echo base_url('manage/relationship/relationship')?>"><span class="icon-user"></span>关系组管理</a></li>
            <li><a href="<?php echo base_url('manage/relationship/relationship_list')?>"><span class="icon-user"></span>设备组修改</a></li>
            <li>&nbsp</li>
        </ul>
    </div>

    <div class="span9">
        <table class="table table-striped table-hover table-bordered" style="width: 100%;">
            <thead>

            <tr>
                <th>关系id</th>
                <th>关系组名称</th>
                <th>关系组描述</th>
                <th>成员</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php  foreach($relationship_real as $item):?>
                <tr>
                    <td><?php echo $item->real_id; ?></td>
                    <td><?php echo $this->Relationship_model->get_group_by_id($item->group_id); ?></td>
                    <td><?php echo $this->Relationship_model->get_group_desc_by_id($item->group_id); ?></td>
                    <td><?php $i = 0; foreach(explode(',',$item->server_ids) as $id ){
                            echo $this->Server_model->get_server_by_id($id)."  ";
                            $i++ ;
                            if($i >1 ){
                                echo ".....";
                                break;
                            }

                        } ?></td>


                    <td><a href="#groupEdit"  class="none" data-toggle="modal" title="编辑" data-id="<?php echo $item->real_id; ?>"><span class="icon-edit" title=""></span></a></td>
                    <td><a href="#groupShow"  class="tuopu" data-toggle="modal" title="查看拓扑图" data-id="<?php echo $item->real_id; ?>"><span class="icon-sitemap" title=""></span></a></td>
                </tr>
            <?php endforeach ;?>
            </tbody>
        </table>
        <?php echo $links; ?>


    </div>
    <div id="groupEdit" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">编辑关系组</h3>
        </div>
        <div class="modal-body">
                    <form id="search_form" class="datagrid-toolbar" method="POST">
                        <input type="text" name="server_name" id="server_name" style="margin-top: 10px;" placeholder="根据服务器名查询">
                        <button class="btn">查询</button><span id="msg_ser"></span>

                    </form>


                    <form id="sel_form"  >

                        <div id="sel">
                            <select name="liOption[]" id='liOption' multiple='multiple' size='12' style="width:100px;">
                                <?php foreach($this->Server_model->get_all_servers() as $server) :?>
                                    <option value="<?php echo $server->server_id ;?>"><?php echo $server->server_name ;?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <input type="hidden" name="real_id" id="real_id" />


            </div>

         <div class="modal-footer">
             <input type="submit"  class="btn-primary" value="提 交"  style="margin-left: 180px;"/>
             </form>
            <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>

        </div>


    </div>


    <div id="groupShow" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel"></h3>
        </div>
        <div class="modal-body">
            <h5>红色是FSCS，绿色是FC</h5>

        <p id="fscs" class="well"></p>

        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>

        </div>


    </div>

</div>
<script type="text/javascript">

    $(document).ready(function(){

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

        $('.none').click(function(){
            var group_id = $(this).attr("data-id");
            $.ajax({
                type:'GET',
                async:false,
                url:'<?php echo base_url('manage/relationship/get_select_server/')?>' + '/'+ group_id,
                success:function(data){
                    if(data){
                        $('#liOptionms2side__dx').html(data);
                        $('#real_id').val(group_id);
                    }
                }
            } );
        });


            $('.tuopu').click(function(){
                $('#fc').html('');
                $('#fscs').html('');
                var group_id = $(this).attr("data-id");
                $.get(
                    '<?php echo base_url('manage/relationship/get_tuopu_server');?>' + '/'+ group_id,
                    'json',
                    function(data){
                        var data =eval('(' + data + ')');
                        if(data){
                            for(var i = 0 ;i<data.fscs.length ;i++){
                            $('#fscs').append('<span style="color:red;">'+data.fscs[i].server_name+'</span></br>');
                            }
                            for(var i = 0 ;i<data.fc.length ;i++){
                                $('#fscs').append('<span style="color:green;">'+data.fc[i].server_name+'</span></br>');
                            }
                        }
                    }
                 );



        });

        $('#sel_form').submit(function(e){
            e.preventDefault();
            var server_ids = new Array();
            $('#liOptionms2side__dx').find('option').each(function(){
                server_ids.push($(this).val());
            });

            if(server_ids.length> $.unique(server_ids).length  ){
                $.messager.alert('出错啦','里面有重复的机器，亲！','error');
                return false;
            }
            var real_id = $("input[name='real_id']").val();
            if(! server_ids ){
                $.messager.alert('出错啦','你得往里面加点设备，亲！','error');
                return false;
            }
            var url = '<?php echo base_url('manage/relationship/rec_edit')?>';
            $.ajax({
                type:'POST',
                url:url,
                data: {server_ids:server_ids,real_id:real_id},
                success: function(data){
                    if(data){
                        $.messager.show({
                            msg:'编辑成功',
                            title:'成功'
                        });
                        setTimeout("$('button.close').click();", 3000);
                    }else{
                        $.messager.show({
                            msg:'编辑失败',
                            title:'失败'
                        });
                    }
                }}
            );
        })
    });


</script>



