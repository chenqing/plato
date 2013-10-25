
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
<!--end of node batch add -->
<!-- start of span9 table of group list -->
    <div class="span9">
        <form name="cabinet_search" id="cabinet_search" class="form-inline datagrid-toolbar">
            <input type="text" name="node_name" placeholder="输入节点名搜索">
            <button type="submit" class="btn ">搜索</button>
            <div style="float: right;"><a id="add-cabinet" href="#cabinetAdd" data-toggle="modal" class="btn btn-primary">增加概览</a></div>
        </form>
        <table id="show-table" class="table table-hover table-condensed table-striped" style="margin-top: 5px;">
            <tbody><tr><th>概览ID</th><th>所属节点</th><th>概览名称</th><th>操作</th><th></th><th>设备管理</th><th>拓扑图</th></tr>
            <tr><td>7</td><td>CMN-HF-1</td><td>安徽移动服务概览</td>
                <td><a href="#topologyEdit" data-toggle="modal"  data-id="7" class=" edit-none btn btn-info btn-small">编辑</a></td>
                <td><button class="btn btn-danger btn-small	" id="icb-delete">删除</button></td><td><a href="#deviceEdit" data-toggle="modal" data-id="7" id="edit-device" class="btn btn-success btn-small	">上传拓扑</a></td><td><a href="#cabinetList" data-toggle="modal" class="btn btn-warning btn-small	" id="check-dev" data-id="7">查看</a></td>
            </tr>
            <tr><td>2</td><td>CMN-NJ-L</td><td>江苏移动服务概览</td>
                <td><a href="#topologyEdit" data-toggle="modal" data-id="2" class="edit-none btn btn-info btn-small	">编辑</a></td>
                <td><button class="btn btn-danger btn-small	" id="icb-delete">删除</button></td><td><a href="#deviceEdit" data-toggle="modal" data-id="2" id="edit-device" class="btn btn-success btn-small	">上传拓扑</a></td><td><a href="#cabinetList" data-toggle="modal" class="btn btn-warning btn-small	" id="check-dev" data-id="2">查看</a></td>
            </tr>
            <tr><td>7</td><td>CMN-HF-1</td><td>安徽移动服务概览</td>
                <td><a href="#topologyEdit" data-toggle="modal" data-id="7" class="edit-none btn btn-info btn-small	">编辑</a></td>
                <td><button class="btn btn-danger btn-small	" id="icb-delete">删除</button></td><td><a href="#deviceEdit" data-toggle="modal" data-id="7" id="edit-device" class="btn btn-success btn-small	">上传拓扑</a></td><td><a href="#cabinetList" data-toggle="modal" class="btn btn-warning btn-small	" id="check-dev" data-id="7">查看</a></td>
            </tr>
            <tr><td>2</td><td>CMN-NJ-L</td><td>江苏移动服务概览</td>
                <td><a href="#topologyEdit" data-toggle="modal" data-id="2" class="edit-none btn btn-info btn-small	">编辑</a></td>
                <td><button class="btn btn-danger btn-small	" id="icb-delete">删除</button></td><td><a href="#deviceEdit" data-toggle="modal" data-id="2" id="edit-device" class="btn btn-success btn-small	">上传拓扑</a></td><td><a href="#cabinetList" data-toggle="modal" class="btn btn-warning btn-small	" id="check-dev" data-id="2">查看</a></td>
            </tr>
            <tr><td>7</td><td>CMN-HF-1</td><td>安徽移动服务概览</td>
                <td><a href="#topologyEdit" data-toggle="modal" data-id="7" class="edit-none btn btn-info btn-small	">编辑</a></td>
                <td><button class="btn btn-danger btn-small	" id="icb-delete">删除</button></td><td><a href="#deviceEdit" data-toggle="modal" data-id="7" id="edit-device" class="btn btn-success btn-small	">上传拓扑</a></td><td><a href="#cabinetList" data-toggle="modal" class="btn btn-warning btn-small	" id="check-dev" data-id="7">查看</a></td>
            </tr>

            </tbody></table>
        <div id="links">  </div>

        <table id="search-table" class=" hidden table table-hover table-condensed table-striped" style="margin-top: 5px;">
            <tbody><tr><th>机柜ID</th><th>所属节点</th><th>机柜名字</th><th>机柜位置</th><th>操作</th><th></th></tr>

            </tbody></table>

    </div>
<div id="push"></div>
</div><!-- end of wrap -->
<!-- begin of javascript -->
<script >
    $(document).ready(function() {

            $('.redactor_content').redactor({
                imageUpload: '../demo/scripts/image_upload.php'
            });

    });
</script>


<div id="topologyEdit" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width: 650px;">

    <div class="modal-body">
        <textarea class="redactor_content" name="content">
            <h2>编辑节点概览</h2>

        </textarea>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
        <input class="btn btn-primary" type="submit" value="保存">
    </div>
    </form>
</div>





